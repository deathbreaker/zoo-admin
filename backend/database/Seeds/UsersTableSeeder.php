<?php

namespace Database\Seeds;


use App\Models\User;
use Database\Hash;

class UsersTableSeeder {


    public function run(){
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.cz',
            'password' => Hash::bcrypt("123456789"),
            'age' => "22",
            'phonenumber' => 777777777,
            'role' => "admin"
        ]);

        User::create([
            'name' => 'some user',
            'email' => 'user@user.cz',
            'password' => Hash::bcrypt("123456"),
            'age' => "22",
            'phonenumber' => null,
            'role' => "user"
        ]);

    }


}