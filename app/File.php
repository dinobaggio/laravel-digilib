<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public static function list_file ($cari = '') {
        $page = 5;
        if ($cari != '') {
            $files = self::join('books', 'files.id_file', '=', 'books.id_book')
            ->select('files.id_file', 'books.judul', 'files.nama_asli', 'files.size', 'files.kategori', 'files.path')
            ->where('judul', 'LIKE', "%$cari%")
            ->orWhere('nama_asli', 'LIKE', "%$cari%")
            ->orderBy('books.judul', 'asc')
            ->paginate($page);
            return $files;
        }

        $files = self::join('books', 'files.id_file', '=', 'books.id_book')
        ->select('files.id_file', 'books.judul', 'files.size', 'files.kategori', 'files.path')
        ->orderBy('books.judul', 'asc')
        ->paginate($page);
        return $files;
    }

    public static function list_file_homepage ($cari = '') {
        $page = 6;
        
        if ($cari != '') {
            $files = self::join('books', 'files.id_file', '=', 'books.id_book')
            ->select('files.id_file', 'books.judul', 'files.nama_asli', 'files.size', 'files.kategori', 'files.path', 'files.extension')
            ->where('judul', 'LIKE', "%$cari%")
            ->orWhere('nama_asli', 'LIKE', "%$cari%")
            ->orderBy('files.created_at', 'desc')
            ->paginate($page);
            return $files;
        }

        $files = self::join('books', 'files.id_file', '=', 'books.id_book')
        ->select('files.id_file', 'books.judul', 'files.size', 'files.kategori', 'files.path')
        ->orderBy('files.created_at', 'desc')
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
