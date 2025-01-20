<?php

namespace App\Exceptions;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MyException extends Exception
{
    public function render(NotFoundHttpException $e)
    {
        dd($e);
        return responseBad($e->getMessage(),404);
    }
}
