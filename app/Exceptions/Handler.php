<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
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

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $e)
    {
        // 로그에 예외를 기록
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if(app()->environment('production')){
            if($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException){
                return response(view('errors.notice',[
                    'title'=>'찾을 수 없습니다.',
                    'description'=>'죄송합니다 요청하신 페이지가 없습니다.'
                ]), 404);
            }
        }
        // render -> 예외를 화면에 표시하는 메서드
        return parent::render($request, $exception);
    }
}
