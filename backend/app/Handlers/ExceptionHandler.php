<?php
/**
 * Created by PhpStorm.
 * User: Derid
 * Date: 24.05.2018
 * Time: 17:16
 */

namespace App\Handlers;



use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionHandler
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $e = $event->getException();
        if (!$e instanceof ApiProblemException) {
            return;
        }

        $response = new JsonResponse(
            $apiProblem->toArray(),
            $apiProblem->getStatusCode()
        );
        $response->headers->set('Content-Type', 'application/problem+json');
    }
}