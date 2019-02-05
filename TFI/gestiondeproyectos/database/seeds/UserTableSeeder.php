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
        App\Domain\User::create(
                [
                    'username' => 'admin',
                    'password' => bcrypt('123456'),
                    'remember_token' => str_random(10),
                    'disabled' => false,
                    'member_id' => App\Domain\Member::where('id', 1)->get(['id'])->first()->id
                ]
        );
        factory(App\Domain\User::class,10)->create();    
}
}