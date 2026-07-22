<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Support\Result;
use App\Enums\ResponseCode;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException) {
            return Result::error(
                ResponseCode::PARAM_ERROR,
                collect($e->errors())->flatten()->first()
            );
        }

        if ($e instanceof AuthenticationException) {
            return Result::error(ResponseCode::UNAUTHORIZED);
        }

        if ($e instanceof ModelNotFoundException) {
            return Result::error(ResponseCode::DATA_NOT_FOUND);
        }

        if ($e instanceof NotFoundHttpException) {
            return Result::error(ResponseCode::DATA_NOT_FOUND, '接口不存在');
        }

        if ($e instanceof BusinessException) {
            return Result::error(
                $e->codeEnum ?? ResponseCode::BUSINESS_ERROR,
                $e->getMessage()
            );
        }

        if ($e instanceof QueryException) {
            Log::channel('exception')->error('数据库异常', [
                'trace_id' => $request->attributes->get('trace_id'),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings(),
                'message' => $e->getMessage(),
            ]);

            return Result::error(ResponseCode::DATABASE_ERROR);
        }

        Log::channel('exception')->error($e->getMessage(), [
            'trace_id' => $request->attributes->get('trace_id'),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);

        return Result::error(ResponseCode::SYSTEM_ERROR);
    }
}
