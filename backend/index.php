<?php

require_once __DIR__ . '/vendor/autoload.php';

new Database\DB;
new App\Services\CORS;

function handleUncaughtException($e){
    // Display generic error message to the user
    // Construct the error string
    $error = "Uncaught Exception: " . $message = date("Y-m-d H:i:s - ");
    $error .= $e->getMessage() . " in file " . $e->getFile() . " on line " . $e->getLine() . "\n";
    echo json_encode($error);
    // Log details of error in a file
    error_log($error, 3, "errors/log/exceptionLog.log");
}

// Register custom exception handler
set_exception_handler("handleUncaughtException");

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;

// Create a service container
$container = new Container;
// Create a request from server variables, and bind it to the container; optional
$request = Request::capture();
$container->instance('Illuminate\Http\Request', $request);
// Using Illuminate/Events/Dispatcher here (not required); any implementation of
// Illuminate/Contracts/Event/Dispatcher is acceptable
$events = new Dispatcher($container);
// Create the router instance
$router = new Router($events, $container);
// Load the routes
require_once 'routes/api.php';
// Create the redirect instance
$redirect = new Redirector(new UrlGenerator($router->getRoutes(), $request));
// use redirect
// return $redirect->home();
// return $redirect->back();
// return $redirect->to('/');
// Dispatch the request through the router
$response = $router->dispatch($request);
// Send the response back to the browser
$response->send();