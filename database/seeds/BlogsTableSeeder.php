<?php

use Illuminate\Database\Seeder;

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
        
        //$productCategoryIds = \DB::table('product_categories')->get()->pluck('id');
        
        
        $faker = \Faker\Factory::create();
        
        for ($i = 1; $i <= 100; $i ++) {
            
            \DB::table('blogs')->insert([
                'name' => $faker->realText(40),
                
                'tag_id' => $tagIds->random(),
                'product_category_id' => $productCategoryIds->random(),
               // 'index_page' => rand(100, 999) % 2,
               // 'price' => rand(100, 10000) / 100,
               // 'old_price' => rand(100, 10000) / 100,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
