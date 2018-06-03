<?php
/**
 * Created by PhpStorm.
 * User: Derid
 * Date: 26.05.2018
 * Time: 17:26
 */

namespace App\Controllers;

trait RestApi
{
    public function getData()
    {
        return json_decode(file_get_contents('php://input'));
    }

    public function sendData($data, $code = 200)
    {
        // set the actual code
        http_response_code($code);
        // set the header to make sure cache is forced
        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
        // treat this as json
        header('Content-Type: application/json');
        $status = array(
            200 => '200 OK',
            400 => '400 Bad Request',
            422 => 'Unprocessable Entity',
            500 => '500 Internal Server Error'
        );
        // ok, validation error, or failure
        header('Status: ' . $status[$code]);
        // return the encoded json
        echo json_encode([
            'status' => $code, // success or not?
            'daticka' => $data
        ]);
    }

}