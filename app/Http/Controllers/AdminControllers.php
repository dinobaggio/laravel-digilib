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
        $data = array(
            'files'=> $files,
            'cari' => $cari
        );
        return view('admin.homepage.v_homepage', $data);

    }

    // LIST FILE

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

    // LIST EBOOK

    public function list_ebook () {
        $req = request();
        $this->author_admin($req);

        $cari = trim_all(request()->input('cari'));
        $cari = htmlspecialchars($cari);
        $files = File::list_ebook($cari);
        $data = array(
            'files'=> $files,
            'cari' => $cari
        );
        return view('admin.list_ebook.v_list_ebook', $data);
        
    }

    // LIST JURNAL

    public function list_jurnal () {
        $req = request();
        $this->author_admin($req);

        $cari = trim_all(request()->input('cari'));
        $cari = htmlspecialchars($cari);
        $files = File::list_jurnal($cari);
        $data = array(
            'files'=> $files,
            'cari' => $cari
        );
        return view('admin.list_jurnal.v_list_jurnal', $data);
        
    }

    // LIST  ARTIKEL

    public function list_artikel () {
        $req = request();
        $this->author_admin($req);

        $cari = trim_all(request()->input('cari'));
        $cari = htmlspecialchars($cari);
        $files = File::list_artikel($cari);
        $data = array(
            'files'=> $files,
            'cari' => $cari
        );
        return view('admin.list_artikel.v_list_artikel', $data);
        
    }

    // LIST SKRIPSI

    public function list_skripsi () {
        $req = request();
        $this->author_admin($req);

        $cari = trim_all(request()->input('cari'));
        $cari = htmlspecialchars($cari);
        $files = File::list_skripsi($cari);
        $data = array(
            'files'=> $files,
            'cari' => $cari
        );
        return view('admin.list_skripsi.v_list_skripsi', $data);
        
    }

    // DETAIL FILE

    public function detail_file($id_file) {
        $req = request();
        $this->author_admin($req);

        $file = File::detail_file($id_file);
        if ($file == true) {
            if ($file->kategori == 'ebook') {
                $book = Book::detail_ebook($id_file);
                $data = array(
                    'file' => $book
                );
                return view('admin.detail_file.v_detail_file', $data);
            } else if ($file->kategori == 'jurnal') {
                $jurnal = Jurnal::detail_jurnal($id_file);
                $data = array(
                    'file' => $jurnal
                );
                return view('admin.detail_file.v_detail_file', $data);
            } else if ($file->kategori == 'artikel') {
                $artikel = Artikel::detail_artikel($id_file);
                $data = array(
                    'file' => $artikel
                );
                return view('admin.detail_file.v_detail_file', $data);
            } else if ($file->kategori == 'skripsi') {
                $skripsi = Skripsi::detail_skripsi($id_file);
                $data = array(
                    'file' => $skripsi
                );
                return view('admin.detail_file.v_detail_file', $data);
            }
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
            if ($file->kategori == 'ebook') {
                $book = Book::detail_ebook($id_file);
                Storage::delete($book->path);
                File::delete_file($id_file);
                return redirect()->route('admin.list_file');
            } else if ($file->kategori == 'jurnal') {
                $jurnal = Jurnal::detail_jurnal($id_file);
                Storage::delete($jurnal->path);
                File::delete_file($id_file);
                return redirect()->route('admin.list_file');
            } else if ($file->kategori == 'artikel') {
                $artikel = Artikel::detail_artikel($id_file);
                Storage::delete($artikel->path);
                File::delete_file($id_file);
                return redirect()->route('admin.list_file');
            } else if ($file->kategori == 'skripsi') {
                $skripsi = Skripsi::detail_skripsi($id_file);
                Storage::delete($skripsi->path);
                File::delete_file($id_file);
                return redirect()->route('admin.list_file');
            }
        }
    }

    // EDIT FILE

    public function edit_file ($id_file) {
        $req = request();
        $this->author_admin($req);

        $file = File::detail_file($id_file);
        if ($file) {
            if ($file->kategori == 'ebook') {
                $book = Book::detail_ebook($id_file);
                $data = array(
                    'file' => $book
                );
                return view('admin.edit_file.v_edit_file', $data);
            } else if ($file->kategori == 'jurnal') {
                $jurnal = Jurnal::detail_jurnal($id_file);
                $data = array (
                    'file' => $jurnal
                );
                return view('admin.edit_file.v_edit_file', $data);
            } else if ($file->kategori == 'artikel') {
                $artikel = Artikel::detail_artikel($id_file);
                $data = array (
                    'file' => $artikel
                );
                return view('admin.edit_file.v_edit_file', $data);
            } else if ($file->kategori == 'skripsi') {
                $skripsi = Skripsi::detail_skripsi($id_file);
                $data = array (
                    'file' => $skripsi
                );
                return view('admin.edit_file.v_edit_file', $data);
            }
        } else {
            return redirect()->route('list_file');
        }
    }

    // EDIT PROSES

    public function edit_proses (Request $req) {
        $this->author_admin($req);

        $id_file = $req->input('id_file');
        $kategori = $req->input('kategori');

        if ($kategori == 'jurnal') {
            
            $validasi = $req->validate(
                [
                    'abstrak' => 'required',
                    'id_file' => 'required',
                    'judul' => 'required',
                    'kategori' => 'required'
                ]
            );
            $abstrak = $req->input('abstrak');
        } else {
            $validasi = $req->validate(
                [
                    'id_file' => 'required',
                    'judul' => 'required',
                    'kategori' => 'required'
                ]
            );
        }

            $judul = $req->input('judul');
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
                        'size' => $size,
                        'mime_file' => $mime_file,
                        'nama_asli' => $nama_asli,
                        'hash_name' => $hash_name,
                        'extension' => $extension,
                        'path' => $path
                    ));
            }

            $file = File::select('kategori')
            ->where('id_file', $id_file)
            ->first();

            if ($file->kategori == $kategori) {

                if ($kategori == 'ebook') {
                    File::where('id_file', $id_file)
                    ->update(array(
                        'judul' => $judul,
                        'kategori' => $kategori,
                        'updated_at' => $cdate
                    ));
                    Book::where('id_file', $id_file)
                    ->update(array(
                        'updated_at' => $cdate
                    ));
                } else if ($kategori == 'jurnal') {
                    File::where('id_file', $id_file)
                    ->update(array(
                        'judul' => $judul,
                        'kategori' => $kategori,
                        'updated_at' => $cdate
                    ));
                    Jurnal::where('id_file', $id_file)
                    ->update(array(
                        'abstrak' => $abstrak,
                        'updated_at' => $cdate
                    ));
                } else if ($kategori == 'artikel') {
                    File::where('id_file', $id_file)
                    ->update(array(
                        'judul' => $judul,
                        'kategori' => $kategori,
                        'updated_at' => $cdate
                    ));
                    Artikel::where('id_file', $id_file)
                    ->update(array(
                        'updated_at' => $cdate
                    ));
                } else if ($kategori == 'skripsi') {
                    File::where('id_file', $id_file)
                    ->update(array(
                        'judul' => $judul,
                        'kategori' => $kategori,
                        'updated_at' => $cdate
                    ));
                    Skripsi::where('id_file', $id_file)
                    ->update(array(
                        'updated_at' => $cdate
                    ));
                }

            } else {
                if ($file->kategori == 'ebook') {
                    Book::delete_ebook($id_file);
                    File::where('id_file', $id_file)
                    ->update(array(
                        'judul' => $judul,
                        'kategori' => $kategori,
                        'updated_at' => $cdate
                    ));

                    if ($kategori == 'jurnal') {
                        Jurnal::insert(array(
                            'id_file' => $id_file,
                            'abstrak' => $abstrak,
                            'created_at' => $cdate
                        ));
                    } else if ($kategori == 'artikel') {
                        Artikel::insert(array(
                            'id_file' => $id_file,
                            'created_at' => $cdate
                        ));
                    } else if ($kategori == 'skripsi') {
                        Skripsi::insert(array(
                            'id_file' => $id_file,
                            'created_at' => $cdate
                        ));
                    }
                } else if ($file->kategori == 'jurnal') {
                    Jurnal::delete_jurnal($id_file);
                    File::where('id_file', $id_file)
                    ->update(array(
                        'judul' => $judul,
                        'kategori' => $kategori,
                        'updated_at' => $cdate
                    ));

                    if ($kategori == 'ebook') {
                        Book::insert(array(
                            'id_file' => $id_file,
                            'created_at' => $cdate
                        ));
                    } else if ($kategori == 'artikel') {
                        Artikel::insert(array(
                            'id_file' => $id_file,
                            'created_at' => $cdate
                        ));
                    } else if ($kategori == 'skripsi') {
                        Skripsi::insert(array(
                            'id_file' => $id_file,
                            'created_at' => $cdate
                        ));
                    }

                } else if ($file->kategori == 'artikel') {

                    Artikel::delete_artikel($id_file);
                    File::where('id_file', $id_file)
                    ->update(array(
                        'judul' => $judul,
                        'kategori' => $kategori,
                        'updated_at' => $cdate
                    ));

                    if ($kategori == 'ebook') {
                        Book::insert(array(
                            'id_file' => $id_file,
                            'created_at' => $cdate
                        ));
                    } else if ($kategori == 'jurnal') {
                        Jurnal::insert(array(
                            'id_file' => $id_file,
                            'abstrak' => $abstrak,
                            'created_at' => $cdate
                        ));
                    } else if ($kategori == 'skripsi') {
                        Skripsi::insert(array(
                            'id_file' => $id_file,
                            'created_at' => $cdate
                        ));
                    }

                } else if ($file->kategori == 'skripsi') {
                    Skripsi::delete_skripsi($id_file);
                    File::where('id_file', $id_file)
                    ->update(array(
                        'judul' => $judul,
                        'kategori' => $kategori,
                        'updated_at' => $cdate
                    ));

                    if ($kategori == 'ebook') {
                        Book::insert(array(
                            'id_file' => $id_file,
                            'created_at' => $cdate
                        ));
                    } else if ($kategori == 'jurnal') {
                        Jurnal::insert(array(
                            'id_file' => $id_file,
                            'abstrak' => $abstrak,
                            'created_at' => $cdate
                        ));
                    } else if ($kategori == 'artikel') {
                        Artikel::insert(array(
                            'id_file' => $id_file,
                            'created_at' => $cdate
                        ));
                    }
                }
            }

            

            return redirect()->route('admin.file', array('file_id'=>$id_file));
        
    }

    // UPLOAD PROSES

    public function upload_proses(Request $req) {
        $this->author_admin($req);
        $kategori = $req->input('kategori');

        if ($kategori == 'jurnal') {
            $validasi = $req->validate(
                [
                    'judul' => 'required',
                    'kategori' => 'required',
                    'file_data' => 'required',
                    'abstrak' => 'required'
                ]
            );
            $abstrak = $req->input('abstrak');
        } else {
            $validasi = $req->validate(
                [
                    'judul' => 'required',
                    'kategori' => 'required',
                    'file_data' => 'required'
                ]
            );
        }

        $id_user = $req->user()->id;
        $judul = $req->input('judul');
        $file_data = $req->file('file_data');
        $size = $file_data->getClientSize();
        $mime_file = $file_data->getMimeType();
        $nama_asli = $file_data->getClientOriginalName();
        $hash_name = $kategori.'_'.$file_data->hashName();
        $extension = $file_data->getClientOriginalExtension();
        $path = $file_data->storeAs('public/files', $hash_name);
        $cdate = date('Y-m-d H:i:s');

        $id_file = File::insertGetId(
            array(
                'judul' => $judul,
                'kategori' => $kategori,
                'size' => $size,
                'mime_file' => $mime_file,
                'nama_asli' => $nama_asli,
                'hash_name' => $hash_name,
                'extension' => $extension,
                'path' => $path,
                'id_user' => $id_user,
                'created_at'=>$cdate
            )
        );
        if ($kategori == "ebook") {
            Book::insert(array(
                'id_file' => $id_file,
                'created_at'=>$cdate
            ));
        } else if ($kategori == 'jurnal') {
            Jurnal::insert(array(
                'id_file' => $id_file,
                'abstrak' => $abstrak,
                'created_at' => $cdate
            ));
        } else if ($kategori == 'artikel') {
            Artikel::insert(array (
                'id_file' => $id_file,
                'created_at'=>$cdate
            ));
        } else if ($kategori == 'skripsi') {
            Skripsi::insert(array (
                'id_file' => $id_file,
                'created_at'=>$cdate
            ));
        }

        return redirect()->route('admin.file', array('file_id'=>$id_file));
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
