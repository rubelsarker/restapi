<?php

namespace App\Exceptions;

use Exception;


use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;


class Handler extends ExceptionHandler
{
    use ExceptionTrait;
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];


    public function report(Exception $exception)
    {
        parent::report($exception);
    }


    public function render($request, Exception $exception)
    {

        if($request->expectsJson()){
           return $this->apiException($request,$exception);
        }



        return parent::render($request, $exception);
    }
}
