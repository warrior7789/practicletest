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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');


Route::group(['namespace'=>'App\Http\Controllers\Backend','prefix'=>'admin','middleware'=>['is_admin']],
 function(){  

   Route::get('dashboard', 'IndexController@index')->name('admin.dashboard');    
   Route::get('userlist', 'IndexController@userlist')->name('admin.userlist');

   Route::resource('Category', CategoryController::class);    
   Route::resource('product', ProductController::class);    
   Route::post('ckeditor/upload', 'IndexController@upload')->name('ckeditor.image-upload');

   Route::get('imagedelete/{id}','ProductController@deleteimage')->name('admin.imageDelete'); 
});
