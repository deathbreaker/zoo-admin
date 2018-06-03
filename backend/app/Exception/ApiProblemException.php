<?php


use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiProblemException extends HttpException
{


    public function getApiProblem()
    {
        return $this->apiProblem;
    }

}