<?php

use Illuminate\Database\Seeder;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Domain\Member::create(
            [
                'firstName' => 'Admin',
                'lastName' => 'Admin',
                'address' => 's/n',
                'birthday' => date('Y-m-d H:i:s'),
                'CUIT' => '11-11111111-1',
                'email' => 'admin@admin.com',
                'role_id' => App\Domain\Role::where('id',1)->get(['id'])->first()->id
            ]
        );

        factory(App\Domain\Member::class,10)->create();    
    }
}
