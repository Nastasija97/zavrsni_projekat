<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Carbon\Carbon;
class BlogController extends Controller {

    public function index(Request $request) {
        
         $formData = $request->validate([
            'blog_category_id' => ['nullable', 'array', 'exists:blog_categories,id'],
            'tag_id' => ['nullable', 'array', 'exists:tags,id'],
            
        ]);
        
        
         $blogsQuery = Blog::query()
            ->with(['blogCategory', 'tags']); //smestiti query builder u varijablu
        
        if (isset($formData['blog_category_id'])) {
            
            $blogsQuery->whereIn('blog_category_id', $formData['blog_category_id']);
        }
        
        if (isset($formData['tag_id'])) {
            
            $blogsQuery->whereIn('tag_id', $formData['tag_id']);
        } 
                $blogs = $blogsQuery->paginate(10);
       
        $blogs->appends($formData);
    
        
        
        $latestBlogPosts = Blog::query()
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        $blogCategories = BlogCategory::query()
                ->orderBy('name')
                ->get();
        $blogTags = Tag::query()
                ->orderBy('name', 'ASC')
          //  ->withCount(['blogs'])
            ->get();
        
      
        return view('front.pages.blog', [
            'latestBlogPosts' => $latestBlogPosts,
            'blogCategories' => $blogCategories,
            'blogTags' => $blogTags,
            'blogPosts'=>$blogs,
            'formData'=>$formData
        ]);
    }

    public function singleBlog() {
        $latestBlogPosts = Blog::query()
                        ->orderBy('created_at', 'desc')
                        ->limit(3)->get();
       $blogCategories = BlogCategory::query()
                ->orderBy('name')
                ->get();
        $blogTags = Tag::query()
                ->orderBy('name', 'ASC')
          //  ->withCount(['blogs'])
            ->get();
        return view('front.pages.blog_post', [
            'latestBlogPosts' => $latestBlogPosts,
            'blogCategories' => $blogCategories,
            'blogTags' => $blogTags,
        ]);
    }

    public function search() {
        $latestBlogPosts = Blog::query()
                        ->orderBy('created_at', 'desc')
                        ->limit(3)->get();
        $blogCategories = BlogCategory::query()
                ->orderBy('name')
                ->get();
        $blogTags = Tag::query()
                ->orderBy('name', 'ASC')
          //  ->withCount(['blogs'])
            ->get();
        return view('front.pages.blog_search', [
            'latestBlogPosts' => $latestBlogPosts,
            'blogCategories' => $blogCategories,
            'blogTags' => $blogTags,
        ]);
    }

    public function author() {
        $latestBlogPosts = Blog::query()
                        ->orderBy('created_at', 'desc')
                        ->limit(3)->get();
      $blogCategories = BlogCategory::query()
                ->orderBy('name')
                ->get();
        $blogTags = Tag::query()
                ->orderBy('name', 'ASC')
          //  ->withCount(['blogs'])
            ->get();
        return view('front.pages.blog_author', [
            'latestBlogPosts' => $latestBlogPosts,
            'blogCategories' => $blogCategories,
            'blogTags' => $blogTags,
        ]);
    }

    public function tag() {
        $latestBlogPosts = Blog::query()
                        ->orderBy('created_at', 'desc')
                        ->limit(3)->get();
        $blogCategories = \DB::table('blog_categories')->get();
        $blogTags = \DB::table('tags')->get();
        return view('front.pages.blog_tag', [
            'latestBlogPosts' => $latestBlogPosts,
            'blogCategories' => $blogCategories,
            'blogTags' => $blogTags,
        ]);
    }

    public function category() {
        $latestBlogPosts = Blog::query()
                        ->orderBy('created_at', 'desc')
                        ->limit(3)->get();
      $blogCategories = BlogCategory::query()
                ->orderBy('name')
                ->get();
        $blogTags = Tag::query()
                ->orderBy('name', 'ASC')
          //  ->withCount(['blogs'])
            ->get();
        
        return view('front.pages.blog_category', [
            'latestBlogPosts' => $latestBlogPosts,
            'blogCategories' => $blogCategories,
            'blogTags' => $blogTags,
        ]);
    }

}
