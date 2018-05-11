<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public static function detail_ebook ($id_file) {
        $book = self::join('files', 'books.id_file', '=', 'files.id_file')
        ->where('files.id_file', $id_file)
        ->first();
        return $book;
    }

    public static function detail_ebook_non_user ($id_file) {
        $book = self::join('files', 'books.id_file', '=', 'files.id_file')
        ->select('files.id_file', 'files.judul', 'files.size', 'files.kategori', 'files.created_at')
        ->where('files.id_file', $id_file)
        ->first();
        return $book;
    }

    public static function delete_ebook ($id_file) {
        $book = self::where('id_file', $id_file);
        $book->delete();
        return true;
    }
}
