<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    public static function detail_skripsi ($id_file) {
        $skripsi = self::join('files', 'skripsis.id_file', '=', 'files.id_file')
        ->where('files.id_file', $id_file)
        ->first();
        return $skripsi;
    }

    public static function detail_skripsi_non_user ($id_file) {
        $skripsi = self::join('files', 'skripsis.id_file', '=', 'files.id_file')
        ->select('files.id_file', 'files.judul', 'files.size', 'files.kategori', 'files.created_at')
        ->where('files.id_file', $id_file)
        ->first();
        return $skripsi;
    }

    public static function delete_skripsi ($id_file) {
        $skripsi = self::where('id_file', $id_file);
        $skripsi->delete();
    }
}
