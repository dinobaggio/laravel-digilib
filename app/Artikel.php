<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    public static function detail_artikel ($id_file) {
        $artikel = self::join('files', 'artikels.id_file', '=', 'files.id_file')
        ->join('users', 'files.id_user', '=', 'users.id')
        ->select(
            'files.judul', 'files.kategori', 'files.nama_asli', 'files.hash_name', 'files.mime_file', 
            'files.extension', 'files.path', 'files.size', 'files.id_user', 'users.name', 'files.created_at',
            'files.id_file', 'artikels.id_artikel'
        )
        ->where('files.id_file', $id_file)
        ->first();
        return $artikel;
    }

    public static function detail_artikel_non_user ($id_file) {
        $artikel = self::join('files', 'artikels.id_file', '=', 'files.id_file')
        ->join('users', 'files.id_user', '=', 'users.id')
        ->select('files.judul', 'files.size', 'files.kategori', 'files.created_at', 'users.name')
        ->where('files.id_file', $id_file)
        ->first();
        return $artikel;
    }

    public static function delete_artikel ($id_file) {
        $artikel = self::where('id_file', $id_file);
        $artikel->delete();
    }
}
