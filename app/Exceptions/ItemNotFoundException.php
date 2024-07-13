<?php

namespace App\Exceptions;

use Exception;

class ItemNotFoundException extends Exception
{
    protected $message;

    public function __construct($message = "Resource not found")
    {
        parent::__construct($message);
    }

    public function render($request)
    {
        return response()->json([
            'success' => false,
            'message' => $this->message,
            'data' => null
        ], 404);
    }
}
