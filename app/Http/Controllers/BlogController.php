<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller {

    public function index() {

        return view('front.pages.blog');
    }

    public function singleBlog() {

        return view('front.pages.blog_post', [
        ]);
    }
public function search(){
    
    return view('front.pages.blog_search');
}
public function author(){
    
    return view('front.pages.blog_author');
}
public function tag(){
    
    return view('front.pages.blog_tag');
}
public function category(){
    
    return view('front.pages.blog_category');
}

}
