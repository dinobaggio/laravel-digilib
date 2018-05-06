<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Request;
use App\Http\Requests\UploadFormRequest;
use Illuminate\Support\Facades\Storage;
use App\Book;
use App\File;
use App\User;
use App\Role;

class AdminControllers extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        
    }

    public function index () {
        //dd(File::select('path')->get()[0]['path']);

        $req = request();
        $this->author_admin($req);

        $cari = trim_all(request()->input('cari'));
        $cari = htmlspecialchars($cari);
        $files = File::list_file_homepage($cari);
        $data = array(
            'files'=> $files,
            'cari' => $cari
        );
        return view('admin.homepage.v_homepage', $data);

    }

    public function list_file () {
        $req = request();
        $this->author_admin($req);

        $cari = trim_all(request()->input('cari'));
        $cari = htmlspecialchars($cari);
        $files = File::list_file($cari);
        $data = array(
            'files'=> $files,
            'cari' => $cari
        );
        return view('admin.list_file.v_list_file', $data);
        
    }

    public function detail_file($id_file) {
        $req = request();
        $this->author_admin($req);

        $file = File::detail_file($id_file);
        if ($file == true) {
            if ($file->kategori == 'ebook') {
                $book = Book::detail_ebook($id_file);
                $book->encode = base64_encode(Storage::get($book->path));
                $data = array(
                    'book' => $book
                );
                return view('admin.detail_ebook.v_detail_ebook', $data);
            }
        } else {
            $data = array(
                'book' => false
            );
            return view('admin.detail_ebook.v_detail_ebook', $data);
        }
    }


    public function delete_file($id_file) {
        $req = request();
        $this->author_admin($req);

        $file = File::detail_file($id_file);
        if ($file) {
            if ($file->kategori == 'ebook') {
                $book = Book::detail_ebook($id_file);
                Storage::delete($book->path);
                Book::delete_ebook($id_file);
                File::delete_file($id_file);
                return redirect()->route('admin.list_file');
            }
        }
    }

    public function edit_file ($id_file) {
        $req = request();
        $this->author_admin($req);

        $file = File::detail_file($id_file);
        if ($file) :
            if ($file->kategori == 'ebook') :
                $book = Book::detail_ebook($id_file);
                $data = array(
                    'book' => $book
                );
                return view('admin.edit_ebook.v_edit_ebook', $data);
            endif;
        else :
            return redirect()->route('list_file');
        endif;
    }

    public function edit_proses (Request $req) {
        $this->author_admin($req);

        $id_file = $req->input('id_file');
        $file = File::detail_file($id_file);
        if ($file->kategori == 'ebook') {
            
            $validasi = $req->validate(
                [
                    'id_file' => 'required',
                    'judul' => 'required',
                    'kategori' => 'required'
                ]
            );

            $judul = $req->input('judul');
            $kategori = $req->input('kategori');
            $file_data = $req->file('file_data');
            $cdate = date('Y-m-d H:i:s');

            if ($file_data) {
                
                $size = $file_data->getClientSize();
                $mime_file = $file_data->getMimeType();
                $nama_asli = $file_data->getClientOriginalName();
                $hash_name = $kategori.'_'.$file_data->hashName();
                $extension = $file_data->getClientOriginalExtension();
                Storage::delete($file->path);
                $path = $file_data->storeAs('public/files', $hash_name);
                
                File::where('id_file', $id_file)
                ->update(array(
                        'kategori' => $kategori,
                        'size' => $size,
                        'mime_file' => $mime_file,
                        'nama_asli' => $nama_asli,
                        'hash_name' => $hash_name,
                        'extension' => $extension,
                        'path' => $path,
                        'updated_at' => $cdate
                    ));
            }

            if ($kategori == 'ebook') {
                Book::where('id_file', $id_file)
                ->update(array(
                    'judul' => $judul,
                    'updated_at' => $cdate
                ));
            }

            return redirect()->route('admin.file', array('file_id'=>$id_file));

        }
        
        
    }

    public function upload_proses(Request $req) {
        $this->author_admin($req);

        $validasi = $req->validate(
            [
                'judul' => 'required',
                'kategori' => 'required',
                'file_data' => 'required'
            ]
        );
        
        $judul = $req->input('judul');
        $kategori = $req->input('kategori');
        $file_data = $req->file('file_data');
        $size = $file_data->getClientSize();
        $mime_file = $file_data->getMimeType();
        $nama_asli = $file_data->getClientOriginalName();
        $hash_name = $kategori.'_'.$file_data->hashName();
        $extension = $file_data->getClientOriginalExtension();
        $path = $file_data->storeAs('public/files', $hash_name);
        $cdate = date('Y-m-d H:i:s');

        $data = array(
            'judul' => $judul,
            'kategori' => $kategori,
            'size' => $size,
            'mime_file' => $mime_file,
            'nama_asli' => $nama_asli,
            'hash_name' => $hash_name,
            'extension' => $extension,
            'path' => $path
        );

        $id_file = File::insertGetId(
            array(
                'kategori' => $kategori,
                'size' => $size,
                'mime_file' => $mime_file,
                'nama_asli' => $nama_asli,
                'hash_name' => $hash_name,
                'extension' => $extension,
                'path' => $path,
                'created_at'=>$cdate
            )
        );
        if ($kategori == "ebook") :
            Book::insert(array(
                'id_file' => $id_file,
                'judul' => $judul,
                'created_at'=>$cdate
            ));
        endif;
        return redirect()->route('admin.file', array('file_id'=>$id_file));
    }

    public function download_file (Request $req) {
        $this->author_admin($req);

        if ($req->isMethod("POST")) {
            $path = $req->input('path');
            $nama_asli = $req->input('nama_asli');
            return Storage::download($path, $nama_asli);
        }
    }

    public function form_tambah_user () {
        return view('admin.tambah_user.v_tambah_user');
    }

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

    public function author_admin ($request) {
        if (!$request->user()->authorizeRoles('admin')) {
            Auth::logout();
            abort(401, 'This action is unauthorized.');
        }
    }
}
