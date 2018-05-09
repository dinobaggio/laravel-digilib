<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    public static function detail_jurnal ($id_file) {
        $jurnal = self::join('files', 'jurnals.id_file', '=', 'files.id_file')
        ->where('files.id_file', $id_file)
        ->first();
        return $jurnal;
    }

    public static function detail_jurnal_non_user ($id_file) {
        $jurnal = self::join('files', 'jurnals.id_file', '=', 'files.id_file')
        ->select('files.judul', 'files.size', 'files.kategori', 'jurnals.abstrak')
        ->where('files.id_file', $id_file)
        ->first();
        return $jurnal;
    }

    public static function delete_jurnal ($id_file) {
        $jurnal = self::where('id_file', $id_file);
        $jurnal->delete();
    }
}
