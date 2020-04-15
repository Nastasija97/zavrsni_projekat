<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
   protected $table='tags';
   protected $fillable=['name'];
   
     public function blogs()
    {
        return $this->belongsToMany(
            Blog::class,
            'blog_tags',
            'tag_id',
            'blog_id'
        );
    }
   
}
