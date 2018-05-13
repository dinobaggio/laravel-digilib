<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public static function detail_ebook ($id_file) {
        $book = self::join('files', 'books.id_file', '=', 'files.id_file')
        ->join('users', 'files.id_user', '=', 'users.id')
        ->select(
            'files.judul', 'files.kategori', 'files.nama_asli', 'files.hash_name', 'files.mime_file', 
            'files.extension', 'files.path', 'files.size', 'files.id_user', 'users.name', 'files.created_at',
            'files.id_file', 'books.id_book'
        )
        ->where('files.id_file', $id_file)
        ->first();
        return $book;
    }

    public static function detail_ebook_non_user ($id_file) {
        $book = self::join('files', 'books.id_file', '=', 'files.id_file')
        ->join('users', 'files.id_user', '=', 'users.id')
        ->select('files.id_file', 'files.judul', 'files.size', 'files.kategori', 'files.created_at', 'users.name')
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
