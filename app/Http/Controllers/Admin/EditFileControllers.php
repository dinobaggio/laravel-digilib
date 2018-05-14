<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Book;
use App\File;
use App\Jurnal;
use App\Skripsi;
use App\Artikel;

class EditFileControllers extends Controller
{
    public function edit_file ($id_file) {
        $req = request();
        $this->author_admin($req);

        $file = File::detail_file($id_file);
        if ($file) {
            if ($file->kategori == 'ebook') {
                $file_data = Book::detail_ebook($id_file);
                $data = array(
                    'file' => $file_data
                );
            } else if ($file->kategori == 'jurnal') {
                $file_data = Jurnal::detail_jurnal($id_file);
                $data = array (
                    'file' => $file_data
                );
            } else if ($file->kategori == 'artikel') {
                $file_data = Artikel::detail_artikel($id_file);
                $data = array (
                    'file' => $file_data
                );
            } else if ($file->kategori == 'skripsi') {
                $file_data = Skripsi::detail_skripsi($id_file);
                $data = array (
                    'file' => $file_data
                );
            }
            return view('admin.edit_file.v_edit_file', $data);
        } else {
            return redirect()->route('list_file');
        }
    }

    // EDIT PROSES

    public function edit_proses (Request $req) {
        $this->author_admin($req);

        $id_file = $req->input('id_file');
        $kategori = $req->input('kategori');
        $abstrak = null;
        if ($kategori == 'jurnal') {
            
            $validasi = $req->validate(
                [
                    'abstrak' => 'required',
                    'id_file' => 'required',
                    'judul' => 'required',
                    'kategori' => 'required'
                ]
            );
            $abstrak = $req->input('abstrak');
        } else {
            $validasi = $req->validate(
                [
                    'id_file' => 'required',
                    'judul' => 'required',
                    'kategori' => 'required'
                ]
            );
        }
            
            $file = File::select('path')
            ->where('id_file', $id_file)->first();
            
            $judul = $req->input('judul');
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

            $file = File::select('kategori')
            ->where('id_file', $id_file)
            ->first();

            if ($file->kategori == $kategori) {
                
                if ($kategori == 'ebook') {
                    File::where('id_file', $id_file)
                    ->update(array(
                        'judul' => $judul,
                        'kategori' => $kategori,
                        'updated_at' => $cdate
                    ));
                    Book::where('id_file', $id_file)
                    ->update(array(
                        'updated_at' => $cdate
                    ));
                } else if ($kategori == 'jurnal') {
                    File::where('id_file', $id_file)
                    ->update(array(
                        'judul' => $judul,
                        'kategori' => $kategori,
                        'updated_at' => $cdate
                    ));
                    Jurnal::where('id_file', $id_file)
                    ->update(array(
                        'abstrak' => $abstrak,
                        'updated_at' => $cdate
                    ));
                } else if ($kategori == 'artikel') {
                    File::where('id_file', $id_file)
                    ->update(array(
                        'judul' => $judul,
                        'kategori' => $kategori,
                        'updated_at' => $cdate
                    ));
                    Artikel::where('id_file', $id_file)
                    ->update(array(
                        'updated_at' => $cdate
                    ));
                } else if ($kategori == 'skripsi') {
                    File::where('id_file', $id_file)
                    ->update(array(
                        'judul' => $judul,
                        'kategori' => $kategori,
                        'updated_at' => $cdate
                    ));
                    Skripsi::where('id_file', $id_file)
                    ->update(array(
                        'updated_at' => $cdate
                    ));
                }

            } else {
                if ($file->kategori == 'ebook') {
                    Book::delete_ebook($id_file);
                    $this->kategori_baru($kategori, $judul, $id_file, $cdate, $abstrak);
                } else if ($file->kategori == 'jurnal') {
                    Jurnal::delete_jurnal($id_file);
                     $this->kategori_baru($kategori, $judul, $id_file, $cdate, $abstrak);
                } else if ($file->kategori == 'artikel') {
                    Artikel::delete_artikel($id_file);
                     $this->kategori_baru($kategori, $judul, $id_file, $cdate, $abstrak);
                } else if ($file->kategori == 'skripsi') {
                    Skripsi::delete_skripsi($id_file);
                    $this->kategori_baru($kategori, $judul, $id_file, $cdate, $abstrak);
                }
            }

            return redirect()->route('admin.file', array('file_id'=>$id_file));
        
    }
    




    public function kategori_baru ($kategori, $judul, $id_file, $cdate, $abstrak = null) {
        File::where('id_file', $id_file)
        ->update(array(
            'judul' => $judul,
            'kategori' => $kategori,
            'updated_at' => $cdate
        ));

        if ($kategori == 'jurnal') {
            Jurnal::insert(array(
                'id_file' => $id_file,
                'abstrak' => $abstrak,
                'created_at' => $cdate
            ));
        } else if ($kategori == 'ebook') {
            Book::insert(array(
                'id_file' => $id_file,
                'created_at' => $cdate
            ));
        } else if ($kategori == 'artikel') {
            Artikel::insert(array(
                'id_file' => $id_file,
                'created_at' => $cdate
            ));
        } else if ($kategori == 'skripsi') {
            Skripsi::insert(array(
                'id_file' => $id_file,
                'created_at' => $cdate
            ));
        }
    }

    // AUTHORIZE ADMIN


    public function author_admin ($request) {
        if (!$request->user()->authorizeRoles('admin')) {
            Auth::logout();
            abort(401, 'This action is unauthorized.');
        }
    }
}
