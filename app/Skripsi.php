<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    public static function detail_skripsi ($id_file) {
        $skripsi = self::join('files', 'skripsis.id_file', '=', 'files.id_file')
        ->join('users', 'files.id_user', '=', 'users.id')
        ->select(
            'files.judul', 'files.kategori', 'files.nama_asli', 'files.hash_name', 'files.mime_file', 
            'files.extension', 'files.path', 'files.size', 'files.id_user', 'users.name', 'files.created_at',
            'files.id_file', 'skripsis.id_skripsi'
        )
        ->where('files.id_file', $id_file)
        ->first();
        return $skripsi;
    }

    public static function detail_skripsi_non_user ($id_file) {
        $skripsi = self::join('files', 'skripsis.id_file', '=', 'files.id_file')
        ->join('users', 'files.id_user', '=', 'users.id')
        ->select('files.id_file', 'files.judul', 'files.size', 'files.kategori', 'files.created_at', 'users.name')
        ->where('files.id_file', $id_file)
        ->first();
        return $skripsi;
    }

    public static function delete_skripsi ($id_file) {
        $skripsi = self::where('id_file', $id_file);
        $skripsi->delete();
    }
}
