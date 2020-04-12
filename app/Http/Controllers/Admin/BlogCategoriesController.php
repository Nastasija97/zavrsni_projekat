<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;

class BlogCategoriesController extends Controller
{
    public function index(Request $request)
    {
        $blogCategories = BlogCategory::query()
            ->orderBy('name')
            ->get();
        
        return view('admin.blog_categories.index', [
            'blogCategories' => $blogCategories,
        ]);
    }
    
    public function add(Request $request)
    {
        return view('admin.blog_categories.add', [
            
        ]);
    }
    
    public function insert(Request $request)
    {
        $formData = $request->validate([
            'name' => ['required', 'string', 'min:2', 'unique:blog_categories,name'],
            'description' => ['nullable', 'string', 'min:10', 'max:255'],
        ]);
        
        $newBlogCategory = new BlogCategory();
        $newBlogCategory->fill($formData);
        
        //vadimo kategoriju sa najvecim prooritetom
//        $blogCategoryWithHighestPriority = BlogCategory::query()
//            ->orderBy('priority', 'desc')
//            ->first();
        
//        if ($blogCategoryWithHighestPriority) {
//            
//            $newBlogCategory->priority = $blogCategoryWithHighestPriority->priority + 1;
//        } else {
//            // dodajemo prvu kategoriju u tabeli
//            //ranije nismo imali nijednu kategoriju
//            
//            $newBlogCategory->priority = 1;
//        }
//        
        
        
        $newBlogCategory->save();
        
        session()->flash('system_message', __('Blog category has been added!'));
        
        return redirect()->route('admin.blog_categories.index');
    }
    
    public function edit(Request $request, BlogCategory $blogCategory)
    {
        return view('admin.blog_categories.edit', [
            'blogCategory' => $blogCategory,
        ]);
    }
    
    public function update(Request $request, BlogCategory $blogCategory)
    {
        
    }
    
    public function delete(Request $request)
    {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:blog_categories,id'],
        ]);
        
        $blogCategory = BlogCategory::findOrFail($formData['id']);
        
        $blogCategory->delete();
        
//        BlogCategory::query()
//            ->where('priority', '>', $blogCategory->priority)
//            ->decrement('priority')
//            /*->update([
//                'priority' => \DB::raw('priority - 1')
//            ])*/
//        ;
        
        session()->flash('system_message', __('Blog category has been deleted!'));
        
        return redirect()->route('admin.blog_categories.index');
    }
    
//    public function changePriorities(Request $request)
//    {
//        $formData = $request->validate([
//            'priorities' => ['required', 'string'],
//        ]);
//        
//        $priorities = explode(',', $formData['priorities']);
//        
//        // $formData['priorities'] -> "7,3,4,2"
//        // explode(',', $formData['priorities']) -> [7, 3, 4, 2]
//        //dd(explode(',', $formData['priorities']));
//        
//        foreach ($priorities as $key => $id) {
//            
//            // key => 0, id = 7
//            // key => 1, id = 3
//            // key => 2, id = 4
//            
//            
//            $blogCategory = BlogCategory::findOrFail($id);
//            
//            $blogCategory->priority = $key + 1;
//            
//            $blogCategory->save();
//        }
//        
//        session()->flash('system_message', __('Blog categories have been reordered!'));
//        
//        return redirect()->route('admin.blog_categories.index');
//    }
}
