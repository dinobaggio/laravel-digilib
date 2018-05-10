<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public static function list_file ($cari = '') {
        $page = 5;
        if ($cari != '') {
            $files = self::select('id_file', 'judul', 'nama_asli', 'size', 'kategori', 'path', 'created_at')
            ->where('judul', 'LIKE', "%$cari%")
            ->orWhere('nama_asli', 'LIKE', "%$cari%")
            ->orderBy('judul', 'asc')
            ->paginate($page);
            return $files;
        }

        $files = self::select('id_file', 'judul', 'size', 'kategori', 'path', 'created_at')
        ->orderBy('judul', 'asc')
        ->paginate($page);
        return $files;
    }

    public static function list_file_homepage ($cari = '') {
        $page = 6;
        
        if ($cari != '') {
            $files = self::select('id_file', 'judul', 'nama_asli', 'size', 'kategori', 'path', 'extension', 'created_at')
            ->where('judul', 'LIKE', "%$cari%")
            ->orWhere('nama_asli', 'LIKE', "%$cari%")
            ->orderBy('created_at', 'desc')
            ->paginate($page);
            return $files;
        }

        $files = self::select('id_file', 'judul', 'size', 'kategori', 'path', 'created_at')
        ->orderBy('created_at', 'desc')
        ->paginate($page);
        return $files;
    }

    public static function detail_file ($id_file) {
        $file = self::select('id_file', 'kategori', 'path')
        ->where('id_file', $id_file)->first();
        return $file;
    }

    public static function delete_file ($id_file) {
        $file = self::where('id_file', $id_file);
        $file->delete();
    }
}
