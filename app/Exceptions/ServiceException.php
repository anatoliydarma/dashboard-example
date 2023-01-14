<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ServiceException extends Exception
{
    public $message;

    public function __construct($message, Exception $previous = null)
    {
        $this->message = $message;
    }

    public function render()
    {
        return ['message' => $this->message];
    }

    public function report(Throwable $e)
    {
        \Log::error($e);
    }
}
