<?php

use Illuminate\Database\Seeder;

class BlogCategoriesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //isprazni tabelu
        \DB::table('blog_categories')->truncate();

        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 5; $i ++) {
            \DB::table('blog_categories')->insert([
               // 'priority' => $i,
                'name' => $faker->city,
                'description' => $faker->realText(30),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

}
