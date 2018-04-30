<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Request;
use App\Http\Requests\UploadFormRequest;
use Illuminate\Support\Facades\Storage;
use App\Book;
use App\File;

class UserControllers extends Controller
{
    public function index () {
        return view('welcome');
    }
}
