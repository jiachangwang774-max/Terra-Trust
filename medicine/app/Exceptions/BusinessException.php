<?php

namespace App\Exceptions;

use App\Enums\ResponseCode;
use Exception;

class BusinessException extends Exception
{
    public function __construct(
        string $message = '业务处理失败',
        public readonly ?ResponseCode $codeEnum = null,
    ) {
        parent::__construct($message);
    }
}
