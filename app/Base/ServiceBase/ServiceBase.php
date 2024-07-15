<?php

namespace App\Base\ServiceBase;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\Traits\ValidateTrait;
use App\Http\Responders\Responder;
use Illuminate\Support\Facades\Validator;

abstract class ServiceBase
{
    use ValidateTrait;
    protected const METHOD = HttpMethods::POST;
    public $data;
    public $responder;
    public function load(array $data)
    {
        $this->data = $data;
        return $this;
    }

    protected function responder()
    {
        if (is_null($this->responder)) {
            $this->responder = new Responder();
        }
        return $this->responder;
    }

    protected function validator()
    {
        $validator = Validator::make($this->data, $this->validateRules());
        if ($validator->fails()) {
            return ['status' => false, "data" => $validator->errors()->toArray()];
        } else {
            return ['status' => true, "data" => []];
        }
    }

    public function handle()
    {
        $validateResult = $this->validator();
        if (!$validateResult['status']) {
            return $this->responder()->error(__("Validation error"), $validateResult['data'], [], 422);
        }
        // здесь могут быть системные функци
        // проверка разрешения, логирование и тд
        return $this->handleLogic();
    }

    public static function code(): string
    {
        $class = str_replace(["App\\Services\\", "\\"], ['', "-"], static::class);
        return $class;
    }
    public static function getMethod(): string
    {
        return static::METHOD->value;
    }

    public abstract function validateRules(): array;
    protected abstract function handleLogic();
}