<?php
namespace Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class CreateAnimalsTable {

    public function up(){
        Capsule::schema()->create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('latinname');
            $table->integer('count');
            $table->string('imageurl');
            $table->timestamps();
        });
    }

    public static function down(){
        Capsule::schema()->dropIfExists('animals');
    }
    
}