<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class Animal extends Model {

    protected $table = 'animals';
    protected $fillable = ['name', 'latinname', 'count', 'imageurl'];
}