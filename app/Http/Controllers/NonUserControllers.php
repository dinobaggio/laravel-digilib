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
    
}
