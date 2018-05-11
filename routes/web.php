<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\NonUserControllers;


Route::get('/', 'NonUserControllers@index')->name('non_user.homepage');
Route::get('/detail_file/{id_file}', 'NonUserControllers@detail_file')->name('non_user.file');
Auth::routes();
Route::get('/pros_login', 'NonUserControllers@pros_login')->name('non_user.pros_login');
Route::get('/register', function () { return redirect()->route('login'); });

// ADMIN
Route::prefix('admin')->group(function () {

    Route::get('/', 'AdminControllers@index')->name('admin.homepage');

    // SHOW FILE
    
    Route::get('/file/{id_file}', 'AdminControllers@detail_file')->name('admin.file');
    Route::delete('/file/{id_file}', 'AdminControllers@delete_file')->name('admin.delete_file');

    // UPLOAD FILE
    Route::get('/upload', function () {
        return view('admin.upload_file.v_upload_file');
    })->name('admin.form_upload');

    Route::post('/upload', 'AdminControllers@upload_proses')->name('admin.upload_proses');

    // EDIT FILE
    Route::get('/edit_file/{id_file}', 'AdminControllers@edit_file')->name('admin.edit_file');
    Route::get('/edit_file', function() {
        return redirect(URL::previous());
    });
    Route::post('/edit_file', 'AdminControllers@edit_proses')->name('admin.edit_proses');

    //DOWNLOAD FILE
    Route::post('/download_file', 'AdminControllers@download_file')->name('admin.download_file');

    // TAMBAH USER
    Route::get('/tambah_user', 'AdminControllers@form_tambah_user')->name('admin.form_tambah_user');
    Route::post('/tambah_user', 'AdminControllers@tambah_user')->name('admin.tambah_user');
    
    Route::prefix('list_file')->group(function () {
        // LIST FILE
        Route::get('/', 'AdminControllers@list_file')->name('admin.list_file');

        // LIST EBOOK
        Route::get('/list_ebook', 'AdminControllers@list_ebook')->name('admin.list_ebook');

        // LIST JURNAL
        Route::get('/list_jurnal', 'AdminControllers@list_jurnal')->name('admin.list_jurnal');

        // LIST ARTIKEL
        Route::get('/list_artikel', 'AdminControllers@list_artikel')->name('admin.list_artikel');

        // LIST SKRIPSI
        Route::get('/list_skripsi', 'AdminControllers@list_skripsi')->name('admin.list_skripsi');
    });
    
    

    

});






Route::get('/home', 'HomeController@index')->name('home');
