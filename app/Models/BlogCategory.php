<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
     protected $table = 'blog_categories';
    
    protected $fillable = ['name', 'description'];
    
    public function blog()
    {
        return $this->hasMany(
            Blog::class,
            'blog_category_id',
            'id'
        ); //vraca query builder
    }
}
