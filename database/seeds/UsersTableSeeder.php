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
            'name'=>'Nastasija Perovic',
            'email'=>'nastasija@gmail.com',
            'password'=>\Hash::make('cubesphp'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
           
            
        ]);
        \DB::table('users')->insert([
            'name'=>'Will Byers',
            'email'=>'pera@gmail.com',
            'password'=>\Hash::make('cubesphp'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
           
            
        ]);
        \DB::table('users')->insert([
            'name'=>'Anthony Hockins',
            'email'=>'mika@gmail.com',
            'password'=>\Hash::make('cubesphp'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
           
            
        ]);
        \DB::table('users')->insert([
            'name'=>'Nina Petrovic',
            'email'=>'zika@gmail.com',
            'password'=>\Hash::make('cubesphp'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
           
            
        ]);
        \DB::table('users')->insert([
            'name'=>'Lazar Nikolic',
            'email'=>'laza@gmail.com',
            'password'=>\Hash::make('cubesphp'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
           
            
        ]);
    }
}
