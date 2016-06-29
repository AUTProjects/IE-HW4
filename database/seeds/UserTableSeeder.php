<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'sepehr',
            'last_name' => 'sabour',
            'email' => 'sepehr.sabour@gmail.com',
            'password' => bcrypt('123')
        ]);

            DB::table('users')->insert([
                'first_name' => 'mohammad',
                'last_name' => 'bagheri',
                'email' => 'mamad.bagheri@gmail.com',
                'password' => bcrypt('123')
            ]);
    }
}
