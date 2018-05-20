<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\File;
use App\Jurnal;
use App\Skripsi;
use App\Artikel;
use App\Book;
use Illuminate\Support\Facades\Storage;

class MahasiswaControllers extends Controller
{
    public function index () {
        $req = request();
        $this->author_mahasiswa($req);

        $cari = trim_all(request()->input('cari'));
        $cari = htmlspecialchars($cari);
        $files = File::list_file_homepage($cari);
        $data = array(
            'files'=> $files,
            'cari' => $cari
        );
        return view('mahasiswa.homepage.v_homepage', $data);
    }

    public function detail_file ($id_file) {
        $req = request();
        $this->author_mahasiswa($req);

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

            return view('mahasiswa.detail_file.v_detail_file', $data);
        }
    }

    public function edit_skripsi ($id_file) {

        $req = request();
        $this->author_mahasiswa($req);

        if ($req->isMethod('post')) {

            $validasi = $req->validate([
                'judul' => 'required'
            ]);

            $judul = $req->input('judul');
            $file_data = $req->file('file_data');
            $cdate = date('Y-m-d H:i:s');
            $file = File::select('path')->where('id_file', $id_file)->first();
            if ($file_data) {

                $size = $file_data->getClientSize();
                $mime_file = $file_data->getMimeType();
                $nama_asli = $file_data->getClientOriginalName();
                $hash_name = 'skripsi_'.$file_data->hashName();
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
                'kategori' => 'skripsi',
                'updated_at' => $cdate
            ));
            Skripsi::where('id_file', $id_file)
            ->update(array(
                'updated_at' => $cdate
            ));

            return redirect()->route('mahasiswa.file', ['id_file' => $id_file]);

        } else {
            $file = File::join('skripsis', 'files.id_file', '=', 'skripsis.id_file')
            ->where('files.id_file', $id_file)->first();

            if ($file == null) {
                $skripsi = '';
            } else {
                $skripsi = $file;
            }

            $data = array(
                'skripsi' => $skripsi
            );
            return view('mahasiswa.my_skripsi.v_edit_skripsi', $data);
        }
        
    }

    public function my_skripsi () {

        $req = request();
        $this->author_mahasiswa($req);

        $id_mahasiswa = $req->user()->id;

        $cari = trim_all($req->input('cari'));
        $cari = htmlspecialchars($cari);
        $file = new File();
        $file = $file->my_skripsi($id_mahasiswa, $cari);
        $data = array (
            'files' => $file,
            'cari' => $cari
        );

        return view('mahasiswa.my_skripsi.v_my_skripsi', $data);

    }

    public function author_mahasiswa ($req) {
        if ($req->user() == null) {
            Auth::logout();
            abort(401, 'This action is unauthorized.');
        }
        if (!$req->user()->authorizeRoles('mahasiswa')) {
            Auth::logout();
            abort(401, 'This action is unauthorized.');
        }
    }
}
