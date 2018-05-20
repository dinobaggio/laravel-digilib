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

    Route::get('/', 'Admin\AdminControllers@index')->name('admin.homepage');

    // SHOW FILE
    
    Route::get('/file/{id_file}', 'Admin\AdminControllers@detail_file')->name('admin.file');
    Route::delete('/file/{id_file}', 'Admin\AdminControllers@delete_file')->name('admin.delete_file');

    // UPLOAD FILE
    Route::get('/upload', 'Admin\UploadFileControllers@form_upload')->name('admin.form_upload');

    Route::post('/upload', 'Admin\UploadFileControllers@upload_proses')->name('admin.upload_proses');

    // EDIT FILE
    Route::get('/edit_file/{id_file}', 'Admin\EditFileControllers@edit_file')->name('admin.edit_file');
    Route::get('/edit_file', function() {
        return redirect(URL::previous()); // Kembali ke URL sebelumnya bila masuk link edit file tanpa id
    });
    Route::post('/edit_file', 'Admin\EditFileControllers@edit_proses')->name('admin.edit_proses');

    //DOWNLOAD FILE
    Route::post('/download_file', 'Admin\AdminControllers@download_file')->name('admin.download_file');

    // TAMBAH USER
    Route::get('/tambah_user', 'Admin\AdminControllers@form_tambah_user')->name('admin.form_tambah_user');
    Route::post('/tambah_user', 'Admin\AdminControllers@tambah_user')->name('admin.tambah_user');
    
    Route::prefix('list_file')->group(function () {
        // LIST FILE
        Route::get('/', 'Admin\ListFileControllers@list_file')->name('admin.list_file');

        // LIST EBOOK
        Route::get('/list_ebook', 'Admin\ListFileControllers@list_ebook')->name('admin.list_ebook');

        // LIST JURNAL
        Route::get('/list_jurnal', 'Admin\ListFileControllers@list_jurnal')->name('admin.list_jurnal');

        // LIST ARTIKEL
        Route::get('/list_artikel', 'Admin\ListFileControllers@list_artikel')->name('admin.list_artikel');

        // LIST SKRIPSI
        Route::get('/list_skripsi', 'Admin\ListFileControllers@list_skripsi')->name('admin.list_skripsi');
    });
});


Route::prefix('dosen')->group(function () {
    Route::get('/', 'Dosen\DosenControllers@index')->name('dosen.homepage');
    Route::get('/file/{id_file}', 'Dosen\DosenControllers@detail_file')->name('dosen.file');
    Route::get('/my_jurnal', 'Dosen\DosenControllers@my_jurnal')->name('dosen.my_jurnal');
    Route::get('/upload_jurnal', 'Dosen\UploadJurnalControllers@upload_jurnal')->name('dosen.upload_jurnal');
    Route::post('/upload_jurnal', 'Dosen\UploadJurnalControllers@upload_jurnal')->name('dosen.upload_jurnal');
    Route::get('/edit_jurnal', function() {
        return redirect(URL::previous()); // Kembali ke URL sebelumnya bila masuk link edit jurnal tanpa id
    });
    Route::get('/edit_jurnal/{id_file}', 'Dosen\DosenControllers@edit_jurnal')->name('dosen.edit_jurnal');
    Route::post('/edit_jurnal/{id_file}', 'Dosen\DosenControllers@edit_jurnal')->name('dosen.edit_proses');     
});





Route::get('/home', 'HomeController@index')->name('home');
