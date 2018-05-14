<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\File;
use App\User;

class ListFileControllers extends Controller
{
    // LIST FILE

    public function list_file () {
        $req = request();
        $this->author_admin($req);

        $cari = trim_all(request()->input('cari'));
        $cari = htmlspecialchars($cari);
        $files = File::list_file($cari);
        
        $user = new User();

        $data = array(
            'files'=> $files,
            'cari' => $cari,
            'user' => $user
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

    // AUTHORIZE ADMIN

    public function author_admin ($request) {
        if (!$request->user()->authorizeRoles('admin')) {
            Auth::logout();
            abort(401, 'This action is unauthorized.');
        }
    }
}
