<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Book;
use App\File;
use App\Jurnal;
use App\Skripsi;
use App\Artikel;

class UploadFileControllers extends Controller
{
    // FORM UPLOAD

    public function form_upload () {
        return view('admin.upload_file.v_upload_file');
    }

    // UPLOAD PROSES

    public function upload_proses(Request $req) {
        $this->author_admin($req);
        $kategori = $req->input('kategori');

        if ($kategori == 'jurnal') {
            $validasi = $req->validate(
                [
                    'judul' => 'required',
                    'kategori' => 'required',
                    'file_data' => 'required',
                    'abstrak' => 'required'
                ]
            );
            $abstrak = $req->input('abstrak');
        } else {
            $validasi = $req->validate(
                [
                    'judul' => 'required',
                    'kategori' => 'required',
                    'file_data' => 'required'
                ]
            );
        }

        $id_user = $req->user()->id;
        $judul = $req->input('judul');
        $file_data = $req->file('file_data');
        $size = $file_data->getClientSize();
        $mime_file = $file_data->getMimeType();
        $nama_asli = $file_data->getClientOriginalName();
        $hash_name = $kategori.'_'.$file_data->hashName();
        $extension = $file_data->getClientOriginalExtension();
        $path = $file_data->storeAs('public/files', $hash_name);
        $cdate = date('Y-m-d H:i:s');

        $id_file = File::insertGetId(
            array(
                'judul' => $judul,
                'kategori' => $kategori,
                'size' => $size,
                'mime_file' => $mime_file,
                'nama_asli' => $nama_asli,
                'hash_name' => $hash_name,
                'extension' => $extension,
                'path' => $path,
                'id_user' => $id_user,
                'created_at'=>$cdate
            )
        );
        if ($kategori == "ebook") {
            Book::insert(array(
                'id_file' => $id_file,
                'created_at'=>$cdate
            ));
        } else if ($kategori == 'jurnal') {
            Jurnal::insert(array(
                'id_file' => $id_file,
                'abstrak' => $abstrak,
                'created_at' => $cdate
            ));
        } else if ($kategori == 'artikel') {
            Artikel::insert(array (
                'id_file' => $id_file,
                'created_at'=>$cdate
            ));
        } else if ($kategori == 'skripsi') {
            Skripsi::insert(array (
                'id_file' => $id_file,
                'created_at'=>$cdate
            ));
        }

        return redirect()->route('admin.file', array('file_id'=>$id_file));
    }

    // AUTHORIZE ADMIN

    public function author_admin ($request) {
        if (!$request->user()->authorizeRoles('admin')) {
            Auth::logout();
            abort(401, 'This action is unauthorized.');
        }
    }
}
