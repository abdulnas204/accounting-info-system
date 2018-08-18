<?php

use Illuminate\Database\Seeder;

class UserDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "name" => "Administrator",
            "email" => "admin@test.com",
            "password" => \Hash::make('secret')
        ]);
    }
}
