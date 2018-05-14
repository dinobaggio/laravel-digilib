<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Book;
use App\File;
use App\User;
use App\Role;
use App\Jurnal;
use App\Artikel;
use App\Skripsi;

class AdminControllers extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        
    }

    // INDEX

    public function index () {
        $req = request();
        $this->author_admin($req);
        //dd($req->user()->id);
        $cari = trim_all(request()->input('cari'));
        $cari = htmlspecialchars($cari);
        $files = File::list_file_homepage($cari);
        $user = new User();
        $data = array(
            'files'=> $files,
            'cari' => $cari,
            'user' => $user
        );
        return view('admin.homepage.v_homepage', $data);

    }

    // DETAIL FILE

    public function detail_file($id_file) {
        $req = request();
        $this->author_admin($req);

        $file = File::detail_file($id_file);
        if ($file == true) {
            if ($file->kategori == 'ebook') {
                $file_data = Book::detail_ebook($id_file);
                $data = array(
                    'file' => $file_data
                );
            } else if ($file->kategori == 'jurnal') {
                $file_data = Jurnal::detail_jurnal($id_file);
                $data = array(
                    'file' => $file_data
                );
            } else if ($file->kategori == 'artikel') {
                $file_data = Artikel::detail_artikel($id_file);
                $data = array(
                    'file' => $file_data
                );
            } else if ($file->kategori == 'skripsi') {
                $file_data = Skripsi::detail_skripsi($id_file);
                $data = array(
                    'file' => $file_data
                );
            }

            return view('admin.detail_file.v_detail_file', $data);
        } else {
            $data = array(
                'book' => false
            );
            return view('admin.detail_file.v_detail_file', $data);
        }
    }

    // DELETE FILE


    public function delete_file($id_file) {
        $req = request();
        $this->author_admin($req);

        $file = File::detail_file($id_file);
        if ($file) {
            Storage::delete($file->path);
            File::delete_file($id_file);
            return redirect()->route('admin.list_file');
        }
    }

    // DOWNLOAD FILE

    public function download_file (Request $req) {
        $this->author_admin($req);

        if ($req->isMethod("POST")) {
            $path = $req->input('path');
            $nama_asli = $req->input('nama_asli');
            return Storage::download($path, $nama_asli);
        }
    }

    // FORM TAMBAH USER

    public function form_tambah_user () {
        return view('admin.tambah_user.v_tambah_user');
    }

    // TAMBAH USER

    public function tambah_user (Request $req) {
        $this->author_admin($req);
        
        $validasi = $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|max:10'
        ]);

        $data = [
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'password' => Hash::make($req->input('password')),
            'role' => $req->input('role')
        ];

        $user = User::tambah_user($data);
        
        return redirect()->route('admin.form_tambah_user');

    }

    // AUTHORIZE ADMIN

    public function author_admin ($request) {
        if (!$request->user()->authorizeRoles('admin')) {
            Auth::logout();
            abort(401, 'This action is unauthorized.');
        }
    }
}
