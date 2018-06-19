<?php

use Illuminate\Database\Seeder;
use App\Entities\User as UserEntity;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // create user with admin role
        factory(UserEntity::class, 1)->create([
            "name"=> "Super Admin",
            "email"=>"admin@admin.com",
            "password" => bcrypt("adminadmin"),
        ]);

    }
}
