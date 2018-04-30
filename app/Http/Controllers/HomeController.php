<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $role = $this->author($request);

        if ($role == 'admin') {
            return redirect()->route('admin.homepage');
        } else if ($role == 'dosen') {

        } else if ($role == 'mahasiswa') {

        }

        return view('home');
    }

    public function author ($request) {
        $role = $request->user()->getRole()->name;
        if (!$request->user()->authorizeRoles($role)) {
            Auth::logout();
            abort(401, 'This action is unauthorized.');
        }

        return $role;
    }
}
