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
        $users=\DB::table('users')->get()->pluck('name');
        
        $faker = \Faker\Factory::create();
        
        for ($i = 1; $i <= 30; $i ++) {
            
            \DB::table('blogs')->insert([
                'name' => $faker->name(),
                'description'=>$faker->realText(40),
                'tag_id' => $tagIds->random(),
                'blog_category_id' => $blogCategoryIds->random(),
                'url'=>$faker->url,
                'url_description'=>$faker->text(30),
                'author'=>$users->random(),
            'important'=>rand(100,999)%2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
