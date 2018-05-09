<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    public static function detail_artikel ($id_file) {
        $artikel = self::join('files', 'artikels.id_file', '=', 'files.id_file')
        ->where('files.id_file', $id_file)
        ->first();
        return $artikel;
    }

    public static function detail_artikel_non_user ($id_file) {
        $artikel = self::join('files', 'artikels.id_file', '=', 'files.id_file')
        ->select('files.judul', 'files.size', 'files.kategori')
        ->where('files.id_file', $id_file)
        ->first();
        return $artikel;
    }

    public static function delete_artikel ($id_file) {
        $artikel = self::where('id_file', $id_file);
        $artikel->delete();
    }
}
