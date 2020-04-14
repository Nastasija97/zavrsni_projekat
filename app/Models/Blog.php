<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //mapped to table tags
    protected $table = 'blogs';
  
     protected $fillable = [
        'blog_category_id','tag_id', 'name', 'description',
         'important', 'details'
    ];
    
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
    
       public function isOnIndexPage()
    {
        return $this->important == 1 ? true : false;
    }
   
    public function getBackgroundPhotoUrl()
    {
        return url('/themes/front/img/featured-pic-1.jpeg');
    }


    public function getBlogPostPhoto1Url()
    {
        return url('/themes/front/img/blog-post-3.jpeg');
    }
    
    public function getBlogPostPhoto2Url()
    {
        return url('/themes/front/img/blog-post-2.jpeg');
    }
   
    public function getPhoto1ThumbUrl()
	{
		
		if ($this->photo1) {
			return url('/storage/blogs/thumbs/' . $this->photo1);
		}
		
		return url('/themes/front/img/small-thumbnail-1');
	}
	
	public function deletePhoto1()
	{
		if (!$this->photo1) {
			return $this; //fluent interface
		}
		
		$photoFilePath = public_path('/storage/blogs/' . $this->photo1);
		
		if (!is_file($photoFilePath)) {
			//informacija o fajlu postoji u bazi
			//ali fajl e postoji fizicki na Hard Disku
			return $this;
		}
		
		unlink($photoFilePath);
		
		//brisanje thumb verzije
		
		$photoThumbPath = public_path('/storage/blogs/thumbs/' . $this->photo1);
		
		if (!is_file($photoThumbPath)) {
			//thumb slika ne postoji na disku
			return $this;
		}
		
		unlink($photoThumbPath);
		
		return $this;
	}
          public function getPhoto2Url()
    {
		if ($this->photo2) {
			return url('/storage/products/' . $this->photo2);
		}
		
        return url('/themes/front/img/blog-post-2');
    }
    
    public function getPhoto2ThumbUrl()
	{
		//originalna slika: /storage/products/11_photo1_blabla.png - 600x800
		//thumb slika		: /storage/products/thumbs/11_photo1_blabla.png  - 300 x 300
		
		if ($this->photo2) {
			return url('/storage/products/thumbs/' . $this->photo2);
		}
		
		return url('/themes/front/img/small-thumbnail-3');
	}
        public function deletePhotos()
	{
		$this->deletePhoto1();
		$this->deletePhoto2();
		
		return $this;
	}
	
    public function getFrontUrl()
    {
        return route('front.pages.blog_post', [
            'blog' => $this->id,
            'seoSlug' => \Str::slug($this->name),
        ]);
    }
    public function getAuthorsProfilePicture(){
        return url('/themes/front/img/avatar-1.jpg');
    }
    public function getBlogPostThumbPhotoUrl(){
        return url('/themes/front/img/small-thumbnail-1.jpg');
    }
    
    
    
}
