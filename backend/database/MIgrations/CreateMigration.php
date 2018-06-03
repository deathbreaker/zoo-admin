<?php

namespace Database\Migrations;


use Database\Migrations\CreateAnimalsTable;
use Database\Migrations\CreateUsersTable;
use Database\DB;

class CreateMigration{

    private $tableAnimals;
    private $tableUsers;

    public function __construct(){
        new DB();
        $this->tableAnimals = new CreateAnimalsTable;
        $this->tableUsers =  new CreateUsersTable;
    }

    public function run(){
        $this->tableAnimals->up();
        $this->tableUsers ->up();
    }


}