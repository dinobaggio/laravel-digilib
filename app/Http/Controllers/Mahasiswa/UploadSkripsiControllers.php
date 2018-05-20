<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;
use App\Skripsi;
use Illuminate\Support\Facades\Auth;


class UploadSkripsiControllers extends Controller
{
    public function upload_skripsi () {
        $req = request();
        $this->author_mahasiswa($req);

        if ($req->isMethod('post')) {
            $validasi = $req->validate([
                'judul' => 'required',
                'file_data' => 'required'
            ]);
            
            $id_user = $req->user()->id;
            $judul = $req->input('judul');
            $file_data = $req->file('file_data');
            $size = $file_data->getClientSize();
            $mime_file = $file_data->getMimeType();
            $nama_asli = $file_data->getClientOriginalName();
            $hash_name = 'skripsi_'.$file_data->hashName();
            $extension = $file_data->getClientOriginalExtension();
            $path = $file_data->storeAs('public/files', $hash_name);
            $cdate = date('Y-m-d H:i:s');
            $db_file = new File();
            $id_file = $db_file->insert_get_id(array(
                'judul' => $judul,
                'kategori' => 'skripsi',
                'size' => $size,
                'mime_file' => $mime_file,
                'nama_asli' => $nama_asli,
                'hash_name' => $hash_name,
                'extension' => $extension,
                'path' => $path,
                'id_user' => $id_user,
                'created_at'=>$cdate
            ));
            $jurnal_file = new Skripsi();
            $jurnal_file->insert_skripsi(array(
                'id_file' => $id_file,
                'created_at' => $cdate
            ));
            return view('mahasiswa.upload_skripsi.v_sukses');
        } else {
            return view('mahasiswa.upload_skripsi.v_upload_skripsi');
        }
    }

    public function author_mahasiswa ($req) {
        if (!$req->user()->authorizeRoles('mahasiswa')) {
            Auth::logout();
            abort(401, 'This action is unauthorized.');
        }
    }
}
