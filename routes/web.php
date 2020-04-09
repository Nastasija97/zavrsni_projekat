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




Route::get('/', 'IndexController@index')->name('front.index.index');

//ContactControlller

Route::get('/contact', 'ContactController@index')->name('front.contact.index');
//Route::post('/contact/send-message', 'ContactController@sendMessage')->name('front.contact.send_message');



Route::get('/blog', 'BlogController@index')->name('front.pages.blog');
Route::get('/blog/post/{post}','BlogController@singleBlog')->name('front.pages.blog_post');
//ruta za kategoriju 
Route::get('/blog/category/{category}','BlogController@category')->name('front.pages.blog_category');
//ruta za tag
Route::get('/blog/tag/{tag}','BlogController@tag')->name('front.pages.blog_tag');
//ruta za pretragu
Route::get('/blog/search/{searchParam}','BlogController@search')->name('front.pages.blog_search');
//ruta za autora
Route::get('/blog/author/{author}','BlogController@author')->name('front.pages.blog_author');






Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->middleware('auth')->namespace('Admin')->group(function() {


    Route::get('/', 'IndexController@index')->name('admin.index.index');


//Routes for Tags Controller
    Route::prefix('/tags')->group(function() {
        Route::get('/', 'TagsController@index')->name('admin.tags.index'); // /admin/tags
        Route::get('/add', 'TagsController@add')->name('admin.tags.add');  // /admin/tags/add
        Route::post('/insert', 'TagsController@nisert')->name('admin.tags.insert');  // /admin/tags/add
        Route::get('/edit/{tag}', 'TagsController@edit')->name('admin.tags.edit');  // /admin/tags/add
        Route::post('/update/{tag}', 'TagsController@update')->name('admin.tags.update');  // /admin/tags/add
        Route::post('/delete','TagsController@delete')->name('admin.tags.delete');
    });
});
