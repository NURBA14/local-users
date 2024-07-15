<?php

namespace App\Services\Docs;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\ServiceBase;
use App\Http\Resources\Docs\ServiceShowResource;
use App\Models\Users\Gender;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class ServiceShowService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;
    protected function handleLogic()
    {
        $service = $this->data['service'];
        $baseClass = "App\Base\ServiceBase\ServiceBase";
        $serviceParh = "app/Services/" . str_replace(["-"], ['/'], $service) . ".php";
        if (!File::exists(base_path($serviceParh))) {
            return $this->responder()->error(__("Service not found"), [__("Service not found")], [], 404);
        }
        $serviceNamespace = "\App\Services\\" . str_replace(["-"], ["\\"], $service);
        $reflection = new \ReflectionClass(new $serviceNamespace());
        if ($reflection->getParentClass()->name !== $baseClass) {
            return $this->responder()->error(__("Incorrect service"), [__("Incorrect service")], [], 400);
        }
        $serviceClass = new $serviceNamespace();
        $data = [
            "service" => $serviceNamespace::code(),
            "method" => $serviceNamespace::getMethod(),
            "name" => $reflection->getShortName(),
            "namespace" => $serviceNamespace,
            "filePath" => str_replace([base_path()], [""], $reflection->getFileName()),
            "validationRules" => $serviceClass->validateRules()
        ];
        return $this->responder()->success(__("Service found"), [], new ServiceShowResource($data), 200);
    }

    public function validateRules(): array
    {
        return [
            "service" => ["required", "string"]
        ];
    }
}