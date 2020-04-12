<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          //isprazni tabelu
        \DB::table('blogs')->truncate();
        
        
        
        
        $tags = \DB::table('tags')->get();
        
        $tagIds = $tags->pluck('id');
        
        $blogCategoryIds = \DB::table('blog_categories')->get()->pluck('id');
        
        
        $faker = \Faker\Factory::create();
        
        for ($i = 1; $i <= 30; $i ++) {
            
            \DB::table('blogs')->insert([
                'name' => $faker->name(),
                
                'tag_id' => $tagIds->random(),
                'blog_category_id' => $blogCategoryIds->random(),
                'url'=>$faker->url,
                'author'=>$faker->name,
            
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
