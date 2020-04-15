<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use App\User;
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
                $blogs = $blogsQuery->paginate(12);
       
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

    public function singleBlog(Request $request,Blog $blog) {
        
          $formData = $request->validate([
            'blog_category_id' => ['nullable', 'array', 'exists:blog_categories,id'],
            'tag_id' => ['nullable', 'array', 'exists:tags,id'],
            'author'=>['nullable','string','exists:users,name']
        ]);
        
       
        
        
        
        
        
       $blogCategories = BlogCategory::query()
                ->orderBy('name')
                ->get();
        $blogTags = Tag::query()
                ->orderBy('name', 'ASC')
          //  ->withCount(['blogs'])
            ->get();
        return view('front.pages.blog_post', [
            'blog'=>$blog,
            'blogCategories' => $blogCategories,
            'blogTags' => $blogTags,
        ]);
    }

    public function search(Request $request) {
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

    public function author(Request $request,User $user) {
        
           $formData = $request->validate([
            
            'author'=>['nullable','string','exists:users,name']
        ]);
        
        
         $blogsQuery = Blog::query()
            ->with(['blogCategory', 'tags']); //smestiti query builder u varijablu
        
     
      
           $blogsQuery->where('author',$user->name);
                   
        
        
        
                $blogs = $blogsQuery->paginate(6);
       
        $blogs->appends($formData);
        
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
            'blogPosts'=>$blogs,
            'formData'=>$formData,
            'user'=>$user,
        ]);
    }

    public function tag(Request $request) {
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

    public function category(Request $request,BlogCategory $blogCategory) {
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
        $blogs= Blog::query()
                 ->where('category_id',$blogCategory->id)
                ->get();
        
        return view('front.pages.blog_category', [
            'latestBlogPosts' => $latestBlogPosts,
            'blogCategories' => $blogCategories,
            'blogTags' => $blogTags,
            'blogCategory'=>$blogCategory,
            'blogPosts'=>$blogs,
        ]);
    }

}
