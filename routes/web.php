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
Route::get('/blog/post/{id}','BlogController@singleBlog')->name('front.pages.blog_post');
//ruta za kategoriju 
Route::get('/blog/category/{category}','BlogController@category')->name('front.pages.blog_category');
//ruta za tag
Route::get('/blog/tag/{tag}','BlogController@tag')->name('front.pages.blog_tag');
//ruta za pretragu
Route::get('/blog/search/{searchParam}','BlogController@search')->name('front.pages.blog_search');
//ruta za autora
Route::get('/blog/author/{id}/{author}','BlogController@author')->name('front.pages.blog_author');






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
    
     //Routes for BlogCategoriesController
    Route::prefix('/blog-categories')->group(function () {
        
        Route::get('/', 'BlogCategoriesController@index')->name('admin.blog_categories.index'); // /admin/sizes
        Route::get('/add', 'BlogCategoriesController@add')->name('admin.blog_categories.add');
        Route::post('/insert', 'BlogCategoriesController@insert')->name('admin.blog_categories.insert');
        
        Route::get('/edit/{blogCategory}', 'BlogCategoriesController@edit')->name('admin.blog_categories.edit');
        Route::post('/update/{blogCategory}', 'BlogCategoriesController@update')->name('admin.blog_categories.update');
        
        Route::post('/delete', 'BlogCategoriesController@delete')->name('admin.blog_categories.delete');
        
        Route::post('/change-priorities', 'BlogCategoriesController@changePriorities')->name('admin.blog_categories.change_priorities');
        
        
    });
    
    
    
        //Routes for BlogsController
    Route::prefix('/blogs')->group(function () {
        
        Route::get('/', 'BlogsController@index')->name('admin.blogs.index'); // /admin/sizes
        Route::get('/add', 'BlogsController@add')->name('admin.blogs.add');
        Route::post('/insert', 'BlogsController@insert')->name('admin.blogs.insert');
        
        Route::get('/edit/{blog}', 'BlogsController@edit')->name('admin.blogs.edit');
        Route::post('/update/{blog}', 'BlogsController@update')->name('admin.blogs.update');
        
        Route::post('/delete', 'BlogsController@delete')->name('admin.blogs.delete');
        Route::post('/delete-photo/{blog}', 'BlogsController@deletePhoto')->name('admin.blogs.delete_photo');
        
		Route::post('/datatable', 'BlogsController@datatable')->name('admin.blogs.datatable');
    });
	
    //Routes for UsersController
    Route::prefix('/users')->group(function () {
        
        Route::get('/', 'UsersController@index')->name('admin.users.index'); // /admin/sizes
        Route::get('/add', 'UsersController@add')->name('admin.users.add');
        Route::post('/insert', 'UsersController@insert')->name('admin.users.insert');
        
        Route::get('/edit/{user}', 'UsersController@edit')->name('admin.users.edit');
        Route::post('/update/{user}', 'UsersController@update')->name('admin.users.update');
        
        Route::post('/delete', 'UsersController@delete')->name('admin.users.delete');
        Route::post('/disable', 'UsersController@disable')->name('admin.users.disable');
        Route::post('/enable', 'UsersController@enable')->name('admin.users.enable');
        Route::post('/delete-photo/{user}', 'UsersController@deletePhoto')->name('admin.users.delete_photo');
        
		Route::post('/datatable', 'UsersController@datatable')->name('admin.users.datatable');
    });
	
    	//Routes for ProfileController
    Route::prefix('/profile')->group(function () {
        
        
        Route::get('/edit', 'ProfileController@edit')->name('admin.profile.edit');
        Route::post('/update', 'ProfileController@update')->name('admin.profile.update');
        
		Route::post('/delete-photo', 'ProfileController@deletePhoto')->name('admin.profile.delete_photo');
		
		Route::get('/change-password', 'ProfileController@changePassword')->name('admin.profile.change_password');
		Route::post('/change-password', 'ProfileController@changePasswordConfirm')->name('admin.profile.change_password_confirm');
    });
    
    
});
