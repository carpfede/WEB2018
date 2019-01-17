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
        App\User::create(
                [
                    'name' => 'admin',
                    'email' => 'admin@gmail.com',
                    'username' => 'admin',
                    'password' => bcrypt('123456'),
                    'remember_token' => str_random(10),
                    'disabled' => false
                ]
        );

        factory(App\User::class,10)->create();    
}
}
