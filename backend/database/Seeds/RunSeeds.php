<?php
namespace Database\Seeds;

class RunSeeds {


    private $tableAnimals;
    private $tableUsers;

    public function __construct(){
        $this->seedAnimals = new AnimalsTableSeeder();
        $this->seedUsers =  new UsersTableSeeder();
    }

    public function run(){
        $this->seedAnimals->run();
        $this->seedUsers ->run();
    }
    
}

