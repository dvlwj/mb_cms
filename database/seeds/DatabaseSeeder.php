<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'userlevel' => 'admin',
            'email' =>  'admin@example.com',
            'password' => bcrypt('123'),
            'created_by' => '1',
            'created_at' => Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'operator',
            'username' => 'operator',
            'userlevel' => 'pegawai',
            'email' =>  'operator@example.com',
            'password' => bcrypt('123'),
            'created_by' => '1',
            'created_at' => Carbon::now()
        ]);

        // $this->call(UsersTableSeeder::class);
        // $this->call(CategoriesSeeder::class);
        // $this->call(ProductsSeeder::class);
    }
}
