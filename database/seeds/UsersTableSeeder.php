<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();
        
        \DB::table('users')->insert([
            'name'=>'Nastasija',
            'email'=>'nastasija@gmail.com',
            'password'=>\Hash::make('cubesphp'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
           
            
        ]);
        \DB::table('users')->insert([
            'name'=>'Pera',
            'email'=>'pera@gmail.com',
            'password'=>\Hash::make('cubesphp'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
           
            
        ]);
        \DB::table('users')->insert([
            'name'=>'Mika',
            'email'=>'mika@gmail.com',
            'password'=>\Hash::make('cubesphp'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
           
            
        ]);
        \DB::table('users')->insert([
            'name'=>'Zika',
            'email'=>'zika@gmail.com',
            'password'=>\Hash::make('cubesphp'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
           
            
        ]);
        \DB::table('users')->insert([
            'name'=>'Laza',
            'email'=>'laza@gmail.com',
            'password'=>\Hash::make('cubesphp'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
           
            
        ]);
    }
}
