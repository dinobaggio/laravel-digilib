<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    public static function detail_jurnal ($id_file) {
        $jurnal = self::join('files', 'jurnals.id_file', '=', 'files.id_file')
        ->join('users', 'files.id_user', '=', 'users.id')
        ->select(
            'files.judul', 'files.kategori', 'files.nama_asli', 'files.hash_name', 'files.mime_file', 
            'files.extension', 'files.path', 'files.size', 'files.id_user', 'users.name', 'files.created_at',
            'files.id_file', 'jurnals.id_jurnal', 'jurnals.abstrak'
        )
        ->where('files.id_file', $id_file)
        ->first();
        return $jurnal;
    }

    public static function detail_jurnal_non_user ($id_file) {
        $jurnal = self::join('files', 'jurnals.id_file', '=', 'files.id_file')
        ->join('users', 'files.id_user', '=', 'users.id')
        ->select('files.judul', 'files.size', 'files.kategori', 'jurnals.abstrak', 'files.created_at', 'users.name')
        ->where('files.id_file', $id_file)
        ->first();
        return $jurnal;
    }

    public static function delete_jurnal ($id_file) {
        $jurnal = self::where('id_file', $id_file);
        $jurnal->delete();
    }
}
