<?php
namespace Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable {


    public function up(){
        Capsule::schema()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('age');
            $table->tinyInteger('phonenumber')->nullable();
            $table->string('role');
            $table->timestamps();
        });
    }

    public static function down(){
        Capsule::schema()->dropIfExists('users');
    }
    
}

