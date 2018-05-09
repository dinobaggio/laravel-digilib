<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UploadFormRequest;
use Illuminate\Support\Facades\Storage;
use App\Book;
use App\File;

class NonUserControllers extends Controller
{
    public function __construct(){
        
        
    }
    public function index () {
        $req = request();
        if (Auth::check()) {
            $role = $req->user()->getRole()->name;
            return $this->cek_login($role);
        }

        $cari = trim_all(request()->input('cari'));
        $cari = htmlspecialchars($cari);
        $files = File::list_file_homepage($cari);
        $data = array(
            'files'=> $files,
            'cari' => $cari
        );
        return view('non_user.homepage.v_homepage', $data);
    }

    public function detail_file($id_file) {
        $req = request();
        if (Auth::check()) {
            $role = $req->user()->getRole()->name;
            return $this->cek_login($role);
        }

        $file = File::detail_file($id_file);
        if ($file == true) {
            if ($file->kategori == 'ebook') {
                $book = Book::detail_ebook($id_file);
                $book->encode = base64_encode(Storage::get($book->path));
                $data = array(
                    'book' => $book
                );
                return view('non_user.detail_ebook.v_detail_ebook', $data);
            }
        } else {
            $data = array(
                'book' => false
            );
            return view('non_user.detail_ebook.v_detail_ebook', $data);
        }
    }

    public function pros_login () {
        $req = request();
        $role = $this->author($req);
        return $this->cek_login($role);
    }

    private function author ($req) {
        $role = $req->user()->getRole()->name;
        if (!$req->user()->authorizeRoles($role)) {
            Auth::logout();
            abort(401, 'This action is unauthorized.');
        }
        return $role;
    }

    private function cek_login ($role) {
        if ($role == 'admin') {
            return redirect()->route('admin.homepage');
        } else if ($role == 'dosen') {
            return redirect()->route('dosen.homepage'); // rencana
        } else if ($role == 'mahasiswa') {
            return redirect()->route('mahasiswa.homepage'); //rencana
        }
    }  
    
}
