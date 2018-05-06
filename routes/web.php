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

Route::get('/', 'NonUserControllers@index')->name('non_user.homepage');
Route::get('/detail_file/{id_file}', 'NonUserControllers@detail_file')->name('non_user.file');

Route::prefix('admin')->group(function () {

    Route::get('/', 'AdminControllers@index')->name('admin.homepage');

    // SHOW FILE
    Route::get('/list_file', 'AdminControllers@list_file')->name('admin.list_file');
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

});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
