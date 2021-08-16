<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
        

Route::get('admin', function () { return view('admin'); })->middleware('checkRole:admin');
Route::get('hubin','HubinController@index')->name('hubin')->middleware(['checkRole:admin,hubin']);
Route::get('siswa', function () { return view('siswa'); });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::resource('blog', BlogController::class)->middleware('checkRole:admin');

use App\Http\Controllers\BlogController;
Route::get('/search', [BlogController::class, 'search'])->name('search');

Route::resource('user', UserController::class)->middleware(['checkRole:admin,siswa']);

