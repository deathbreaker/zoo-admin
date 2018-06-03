<?php

namespace App\Controllers\Resources;
use App\Models\Animal;

use App\Controllers\RestController;
use App\Controllers\RestApi;

class AnimalController implements RestController {

    use RestApi;

    public function index()
    {
        //return $this->sendData(["animals" => Animal::all()]);
        echo Animal::all();
    }

    public function store( )
    {
        $animal = new Animal();
        $animal->name =   $this->getData()->name;
        $animal->latinname =   $this->getData()->latinname;
        $animal->count =   $this->getData()->count;
        $animal->imageurl = '/fassets/images/seznam-zvirat/empty.jpg';
        $animal->save();

        return   $this->sendData(["animals" => $animal], 201);
    }


    public function get($id)
    {
         return  $this->sendData(["animals" => Animal::find($id)]);
    }


    public function update(  $id)
    {

        $animal = Animal::find($id);
        $animal->name =   $this->getData()->name;
        $animal->latinname =   $this->getData()->latinname;
        $animal->count =   $this->getData()->count;
        $animal->save();
        return   $this->sendData(["animals" => $animal], 200);
    }


    public function destroy($id)
    {
        Animal::find($id)->delete();
        return  $this->sendData(["message" => "Animal was successfully deleted"], 204);
    }

}