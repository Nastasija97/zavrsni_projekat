<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller {

    public function index() {




        $blogPosts = Blog::query()
                ->orderBy('created_at')
                ->get();

        $importantBlogPosts = Blog::query()
                ->importantBlogPosts()
                ->limit(3)
                ->get();

        $latestBlogPosts = Blog::query()
                ->orderBy('created_at', 'desc')
                ->take(12)
                ->limit(3)
               
                ->get();
      

        return view('front.index.index', [
            'blogPosts' => $blogPosts,
            'importantBlogPosts' => $importantBlogPosts,
            'latestBlogPosts' => $latestBlogPosts,
        ]);
    }

}
