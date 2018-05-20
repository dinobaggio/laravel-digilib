<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;
use App\Jurnal;

class UploadJurnalControllers extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        
    }

    public function upload_jurnal () {
        $req = request();
        $this->author_dosen($req);

        if ($req->isMethod('post')) {
            $validasi = $req->validate([
                'judul' => 'required',
                'file_data' => 'required',
                'abstrak' => 'required'
            ]);
            
            $abstrak = $req->input('abstrak');
            $id_user = $req->user()->id;
            $judul = $req->input('judul');
            $file_data = $req->file('file_data');
            $size = $file_data->getClientSize();
            $mime_file = $file_data->getMimeType();
            $nama_asli = $file_data->getClientOriginalName();
            $hash_name = 'jurnal_'.$file_data->hashName();
            $extension = $file_data->getClientOriginalExtension();
            $path = $file_data->storeAs('public/files', $hash_name);
            $cdate = date('Y-m-d H:i:s');
            $db_file = new File();
            $id_file = $db_file->insert_get_id(array(
                'judul' => $judul,
                'kategori' => 'jurnal',
                'size' => $size,
                'mime_file' => $mime_file,
                'nama_asli' => $nama_asli,
                'hash_name' => $hash_name,
                'extension' => $extension,
                'path' => $path,
                'id_user' => $id_user,
                'created_at'=>$cdate
            ));
            $jurnal_file = new Jurnal();
            $jurnal_file->insert_jurnal(array(
                'id_file' => $id_file,
                'abstrak' => $abstrak,
                'created_at' => $cdate
            ));
            return view('dosen.upload_jurnal.v_sukses');
        } else {
            return view('dosen.upload_jurnal.v_upload_jurnal');
        }
        

        return "Comeback later";
    }



    // AUTHORIZE DOSEN

    public function author_dosen ($request) {
        if (!$request->user()->authorizeRoles('dosen')) {
            Auth::logout();
            abort(401, 'This action is unauthorized.');
        }
    }
}
