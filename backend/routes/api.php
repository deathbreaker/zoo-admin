<?php

use Illuminate\Routing\Router;
use App\Controllers\Auth\AuthController;
use App\Controllers\Resources\AnimalController;

$animalControl = new AnimalController;
$authControl = new AuthController;

$router->get('api/user/auth', function (AuthController $authControl ){
    $authControl->auth();
});

$router->post('api/user/login', function (AuthController $authControl ){
    $authControl->login(  );
});

$router->post('api/user/register', function (AuthController $authControl ){
    $authControl->register(  );
});

$router->post('api/user/logout',  function (AuthController $authControl ){
    $authControl->logout(  );
});

$router->get('api/user/animals/{id}', function ($id, AnimalController $animalControl ){
    $animalControl->get($id);
});

$router->get('api/user/animals', function (AnimalController $animalControl ){
    $animalControl->index();
});

$router->post('api/user/animals',function (AnimalController $animalControl ){
    $animalControl->store();
});

$router->patch('api/user/animals/{id}',function ($id, AnimalController $animalControl ){
    $animalControl->update($id);
});

$router->delete('api/user/animals/{id}', function ($id, AnimalController $animalControl ){
    $animalControl->destroy($id);
});
