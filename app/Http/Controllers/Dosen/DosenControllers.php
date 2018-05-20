<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;
use App\Book;
use App\Jurnal;
use App\Artikel;

class DosenControllers extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        
    }

    public function index () {
        $req = request();
        $this->author_dosen($req);

        $cari = trim_all(request()->input('cari'));
        $cari = htmlspecialchars($cari);
        $files = File::list_file_homepage($cari);
        $data = array(
            'files'=> $files,
            'cari' => $cari
        );
        return view('dosen.homepage.v_homepage', $data);
    }

    // DETAIL FILE

    public function detail_file ($id_file) {
        $req = request();
        $this->author_dosen($req);

        $file = File::detail_file($id_file);
        if ($file == true) {
            if ($file->kategori == 'ebook') {
                $file_data = Book::detail_ebook($id_file);
                $data = array(
                    'file' => $file_data
                );
            } else if ($file->kategori == 'jurnal') {
                $file_data = Jurnal::detail_jurnal($id_file);
                $data = array(
                    'file' => $file_data
                );
            } else if ($file->kategori == 'artikel') {
                $file_data = Artikel::detail_artikel($id_file);
                $data = array(
                    'file' => $file_data
                );
            } else if ($file->kategori == 'skripsi') {
                $file_data = Skripsi::detail_skripsi($id_file);
                $data = array(
                    'file' => $file_data
                );
            }

            return view('dosen.detail_file.v_detail_file', $data);
        }
    }

    // MY JURNAL
    
    public function my_jurnal() {
        $req = request();
        $this->author_dosen($req);

        $id_dosen = $req->user()->id;

        $cari = trim_all($req->input('cari'));
        $cari = htmlspecialchars($cari);
        $file = new File();
        $file = $file->my_jurnal($id_dosen, $cari);
        $data = array (
            'files' => $file,
            'cari' => $cari
        );

        return view('dosen.my_jurnal.v_my_jurnal', $data);
    }

    public function edit_jurnal ($id_file) {
        $req = request();
        $this->author_dosen($req);

        if ($req->isMethod('post')) {

            $validasi = $req->validate([
                'judul' => 'required',
                'abstrak' => 'required'
            ]);

            $judul = $req->input('judul');
            $abstrak = $req->input('abstrak');
            $file_data = $req->file('file_data');
            $cdate = date('Y-m-d H:i:s');
            if ($file_data) {
                
                $size = $file_data->getClientSize();
                $mime_file = $file_data->getMimeType();
                $nama_asli = $file_data->getClientOriginalName();
                $hash_name = $kategori.'_'.$file_data->hashName();
                $extension = $file_data->getClientOriginalExtension();
                Storage::delete($file->path);
                $path = $file_data->storeAs('public/files', $hash_name);
                
                File::where('id_file', $id_file)
                ->update(array(
                        'size' => $size,
                        'mime_file' => $mime_file,
                        'nama_asli' => $nama_asli,
                        'hash_name' => $hash_name,
                        'extension' => $extension,
                        'path' => $path
                    ));
            }

            File::where('id_file', $id_file)
            ->update(array(
                'judul' => $judul,
                'kategori' => 'jurnal',
                'updated_at' => $cdate
            ));
            Jurnal::where('id_file', $id_file)
            ->update(array(
                'abstrak' => $abstrak,
                'updated_at' => $cdate
            ));

        } else {
            $file = File::join('jurnals', 'files.id_file', '=', 'jurnals.id_file')
            ->where('files.id_file', $id_file)->first();

            if ($file->kategori != 'jurnal') {
                $jurnal = '';
            } else {
                $jurnal = $file;
            }

            $data = array(
                'jurnal' => $jurnal
            );
            return view ('dosen.my_jurnal.v_edit_jurnal', $data);
        }

    } 

    public function edit_proses ($id_file) {
        $req = request();
        $this->author_dosen($req);

        $validasi = $req->validate([

        ]);

    }

    // AUTHORIZE DOSEN
    public function author_dosen ($request) {
        if (!$request->user()->authorizeRoles('dosen')) {
            Auth::logout();
            abort(401, 'This action is unauthorized.');
        }
    }
}
