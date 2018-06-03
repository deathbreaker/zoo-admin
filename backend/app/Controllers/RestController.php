<?php
namespace App\Controllers;

interface RestController
{
    public function index( );

    public function store( );

    public function get($id);

    public function update($id);

    public function destroy($id);

    public function getData();

    public function sendData($data, $code = 200);
}