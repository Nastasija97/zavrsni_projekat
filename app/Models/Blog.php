<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //mapped to table tags
    protected $table = 'blogs';
    
    
    
    //RELATIONSHIPS
    
    public function blogCategory()
    {
        return $this->belongsTo(
           BlogCategory::class,
            'blog_category_id', //preneseni kljuc u tabeli deteta
            'id' //naziv kljuca u tabeli roditelja
        );
    }
    
//    public function brand()
//    {
//        //navedena je klasa sa kojom se vrsi relacija
//        //ostale informacije ce laravel sam shvatiti,
//        //ako je ispostovana konvencija
//        return $this->belongsTo(Brand::class);
//    }
    
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'blog_tags',
            'blog_id',
            'tag_id'
        );
    }
    
    
    // QUERY SCOPES
    
  
    
    
       public function scopeImportantBlogPosts($queryBuilder)
    {
        $queryBuilder->where('important', 1)
                ->where('created_at', '>=', date('Y-m-d', strtotime('-3 month')))
                ->orderBy('created_at', 'desc');
    }
    //HELPER FUNCTIONS
    
    /**
     * @return boolean
     */
   
    public function getBackgroundPhotoUrl()
    {
        return url('/themes/front/img/featured-pic-1.jpeg');
    }


    public function getBlogPostPhoto1Url()
    {
        return url('/themes/front/img/blog-post-1.jpeg');
    }
    
    public function getBlogPostPhoto2Url()
    {
        return url('/themes/front/img/blog-post-2.jpeg');
    }
   
    
    
    public function getFrontUrl()
    {
        return route('front.pages.blog_post', [
            'blog' => $this->id,
        ]);
    }
    public function getAuthorsProfilePicture(){
        return url('/themes/front/img/avatar-1.jpg');
    }
}
