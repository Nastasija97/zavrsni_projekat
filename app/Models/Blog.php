<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //mapped to table tags
    protected $table = 'blogs';
    
    
    
    //RELATIONSHIPS
    
//    public function productCategory()
//    {
//        return $this->belongsTo(
//            ProductCategory::class,
//            'product_category_id', //preneseni kljuc u tabeli deteta
//            'id' //naziv kljuca u tabeli roditelja
//        );
//    }
    
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
    
    public function scopeNewArrivals($queryBuilder)
    {
        $queryBuilder
                ->where('created_at', '>=', date('Y-m-d', strtotime('-1 month')))
                ->orderBy('created_at', 'desc');
    }
    
    
    
    //HELPER FUNCTIONS
    
    /**
     * @return boolean
     */
   
    
    public function getPhoto1Url()
    {
        return url('/themes/front/img/blog-post-1.jpeg');
    }
    
    public function getPhoto2Url()
    {
        return url('/themes/front/img/blog-post-2.jpeg');
    }
    
    public function getFrontUrl()
    {
        return route('front.pages.blog_post', [
            'blog' => $this->id,
        ]);
    }
}
