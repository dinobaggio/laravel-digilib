<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public static function list_file ($cari = '') {
        $page = 5;
        if ($cari != '') {
            $files = self::join('users', 'files.id_user', '=', 'users.id')
            ->select(
                'files.id_file', 'files.judul', 'files.nama_asli', 'files.size', 'files.kategori', 'files.path', 
                'files.id_user', 'users.name', 'files.created_at'
            )
            ->where('files.judul', 'LIKE', "%$cari%")
            ->orWhere('files.nama_asli', 'LIKE', "%$cari%")
            ->orderBy('files.judul', 'asc')
            ->paginate($page);
            return $files;
        }

        $files = self::join('users', 'files.id_user', '=', 'users.id')
        ->select(
            'files.id_file', 'files.judul', 'files.size', 'files.kategori', 'files.path', 
            'files.id_user', 'users.name', 'files.created_at'
        )
        ->orderBy('files.judul', 'asc')
        ->paginate($page);
        
        return $files;
    }

    public static function list_file_homepage ($cari = '') {
        $page = 6;
        
        if ($cari != '') {
            $files = self::join('users', 'files.id_user', '=', 'users.id')
            ->select(
                'files.id_file', 'files.judul', 'files.nama_asli', 'files.size', 'files.kategori', 
                'files.path', 'files.extension', 'files.id_user', 'users.name', 'files.created_at'
            )
            ->where('files.judul', 'LIKE', "%$cari%")
            ->orWhere('files.nama_asli', 'LIKE', "%$cari%")
            ->orderBy('files.created_at', 'desc')
            ->paginate($page);
            return $files;
        }

        $files = self::join('users', 'files.id_user', '=', 'users.id')
        ->select(
            'files.id_file', 'files.judul', 'files.size', 'files.kategori', 'files.path', 
            'files.id_user', 'users.name', 'files.created_at'
        )
        ->orderBy('files.created_at', 'desc')
        ->paginate($page);
        return $files;
    }

    public static function list_ebook ($cari = '') {
        $page = 5;
        if ($cari != '') {
            $files = self::join('users', 'files.id_user', '=', 'users.id')
            ->select(
                'files.id_file', 'files.judul', 'files.nama_asli', 'files.size', 'files.kategori', 
                'files.path', 'files.id_user','users.name', 'files.created_at'
            )
            ->where('files.kategori', 'ebook')
            ->where('files.judul', 'LIKE', "%$cari%")
            ->orWhere('files.kategori', 'ebook')
            ->where('files.nama_asli', 'LIKE', "%$cari%")
            ->orderBy('files.judul', 'asc')
            ->paginate($page);
            return $files;
        }

        $files = self::join('users', 'files.id_user', '=', 'users.id')
        ->select(
            'files.id_file', 'files.judul', 'files.size', 'files.kategori', 'files.path', 
            'files.id_user', 'users.name','files.created_at'
        )
        ->where('files.kategori', 'ebook')
        ->orderBy('files.judul', 'asc')
        ->paginate($page);
        return $files;
    }

    public static function list_jurnal ($cari = '') {
        $page = 5;
        if ($cari != '') {
            $files = self::join('users', 'files.id_user', '=', 'users.id')
            ->select(
                'files.id_file', 'files.judul', 'files.nama_asli', 'files.size', 'files.kategori', 
                'files.path', 'files.id_user', 'users.name', 'files.created_at'
            )
            ->where('files.kategori', 'jurnal')
            ->where('files.judul', 'LIKE', "%$cari%")
            ->orWhere('files.kategori', 'jurnal')
            ->where('files.nama_asli', 'LIKE', "%$cari%")
            ->orderBy('files.judul', 'asc')
            ->paginate($page);
            return $files;
        }

        $files = self::join('users', 'files.id_user', '=', 'users.id')
        ->select(
            'files.id_file', 'files.judul', 'files.size', 'files.kategori', 'files.path', 
            'files.id_user', 'users.name', 'files.created_at'
        )
        ->where('files.kategori', 'jurnal')
        ->orderBy('files.judul', 'asc')
        ->paginate($page);
        return $files;
    }

    public static function list_artikel ($cari = '') {
        $page = 5;
        if ($cari != '') {
            $files = self::join('users', 'files.id_user', '=', 'users.id')
            ->select(
                'files.id_file', 'files.judul', 'files.nama_asli', 'files.size', 'files.kategori', 'files.path', 
                'files.id_user', 'users.name', 'files.created_at'
            )
            ->where('files.kategori', 'artikel')
            ->where('files.judul', 'LIKE', "%$cari%")
            ->orWhere('files.kategori', 'artikel')
            ->where('files.nama_asli', 'LIKE', "%$cari%")
            ->orderBy('files.judul', 'asc')
            ->paginate($page);
            return $files;
        }

        $files = self::join('users', 'files.id_user', '=', 'users.id')
        ->select(
            'files.id_file', 'files.judul', 'files.size', 'files.kategori', 'files.path', 
            'files.id_user', 'users.name', 'files.created_at'
        )
        ->where('files.kategori', 'artikel')
        ->orderBy('files.judul', 'asc')
        ->paginate($page);
        return $files;
    }

    public static function list_skripsi ($cari = '') {
        $page = 5;
        if ($cari != '') {
            $files = self::join('users', 'files.id_user', '=', 'users.id')
            ->select(
                'files.id_file', 'files.judul', 'files.nama_asli', 'files.size', 'files.kategori', 
                'files.path', 'files.id_user', 'users.name', 'files.created_at'
            )
            ->where('files.kategori', 'skripsi')
            ->where('files.judul', 'LIKE', "%$cari%")
            ->orWhere('files.kategori', 'skripsi')
            ->where('files.nama_asli', 'LIKE', "%$cari%")
            ->orderBy('files.judul', 'asc')
            ->paginate($page);
            return $files;
        }

        $files = self::join('users', 'files.id_user', '=', 'users.id')
        ->select(
            'files.id_file', 'files.judul', 'files.size', 'files.kategori', 
            'files.path', 'files.id_user', 'users.name', 'files.created_at'
        )
        ->where('files.kategori', 'skripsi')
        ->orderBy('files.judul', 'asc')
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

    public function my_jurnal ($id_dosen, $cari = '') {
        $page = 5;
        if ($cari != '') {
            return self::join('users', 'files.id_user', '=', 'users.id')
            ->select(
                'files.id_file', 'files.judul', 'files.nama_asli', 'files.size', 'files.kategori', 
                'files.path', 'files.id_user', 'users.name', 'files.created_at'
            )
            ->where('files.id_user', $id_dosen)
            ->where('files.kategori', 'jurnal')
            ->where('files.judul', 'LIKE', "%$cari%")
            ->paginate($page);
        }
        return self::join('users', 'files.id_user', '=', 'users.id')
        ->select(
            'files.id_file', 'files.judul', 'files.nama_asli', 'files.size', 'files.kategori', 
            'files.path', 'files.id_user', 'users.name', 'files.created_at'
        )
        ->where('id_user', $id_dosen)
        ->where('kategori', 'jurnal')
        ->paginate($page);
    }

    public function my_skripsi ($id_mahasiswa, $cari = '') {
        $page = 5;
        if ($cari != '') {
            return self::join('users', 'files.id_user', '=', 'users.id')
            ->select(
                'files.id_file', 'files.judul', 'files.nama_asli', 'files.size', 'files.kategori', 
                'files.path', 'files.id_user', 'users.name', 'files.created_at'
            )
            ->where('files.id_user', $id_mahasiswa)
            ->where('files.kategori', 'skripsi')
            ->where('files.judul', 'LIKE', "%$cari%")
            ->paginate($page);
        }
        return self::join('users', 'files.id_user', '=', 'users.id')
        ->select(
            'files.id_file', 'files.judul', 'files.nama_asli', 'files.size', 'files.kategori', 
            'files.path', 'files.id_user', 'users.name', 'files.created_at'
        )
        ->where('id_user', $id_mahasiswa)
        ->where('kategori', 'skripsi')
        ->paginate($page);
    }

    public function insert_get_id ($ray) {
        return self::insertGetId($ray);
    }
}
