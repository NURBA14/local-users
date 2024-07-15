<?php

namespace App\Base\ConsoleBase;

abstract class ConsoleBase
{
    protected $data;
    public function load($data)
    {
        $this->data = $data;
        return $this;
    }
    public function response(bool $status, string $message, array $errors = [], array $data = [])
    {
        return [
            "status" => $status,
            "message" => $message,
            "errors" => $errors,
            "data" => $data
        ];
    }
    abstract public function handle();

    public function data()
    {
        return [];
    }
}