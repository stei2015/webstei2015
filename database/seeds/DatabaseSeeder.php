<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);


        DB::table('users')->insert([
        	'nim' => '16515001',
        	'username' => 'root',
        	'password' => bcrypt('crossingfield'),
        	'roles'	=> 'studentdata-showprivate-all,studentdata-edit-all'
        ]);

		DB::table('users')->insert([
        	'nim' => '16515002',
        	'username' => 'root2',
        	'password' => bcrypt('crossingfield'),
        ]);        

    }
}
