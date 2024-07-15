<?php

namespace App\Base\MiddlewareBase;

abstract class MiddlewareBase
{
    protected $data;
    public function load($data)
    {
        $this->data = $data;
        return $this;
    }

    protected function response(bool $status, string $message, array $errors = [], array $data = [], $code = 400)
    {
        return [
            "status" => $status,
            "message" => $message,
            "errors" => $errors,
            "data" => $data,
            "code" => $code
        ];
    }
    abstract public function handle();
}