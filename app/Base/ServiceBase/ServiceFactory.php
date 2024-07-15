<?php

namespace App\Base\ServiceBase;

use App\Http\Responders\Responder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

abstract class ServiceFactory
{
    private static function responder()
    {
        return new Responder();
    }
    public static function handle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "service" => ["required", "string"]
        ]);
        if ($validator->fails()) {
            return self::responder()->error(__("Validation error"), $validator->errors()->toArray(), [], 422);
        }
        $baseClass = "App\Base\ServiceBase\ServiceBase";
        $sendedService = $request->get("service", null);
        $servicePath = app_path("/Services/" . str_replace(["-"], ["/"], $sendedService)) . ".php";
        if (!File::exists($servicePath)) {
            return self::responder()->error(__("Incorrect service `code`"), [__("Incorrect service `code`")], [], 400);
        }
        $serviceNamespace = "\App\Services\\" . str_replace(["-"], ["\\"], $sendedService);
        $reflectionClass = new \ReflectionClass(new $serviceNamespace());
        if (empty($reflectionClass->getParentClass())) {
            return self::responder()->error(__("Incorrect service `code`"), [__("Incorrect service `code`")], [], 400);
        }
        if ($reflectionClass->getParentClass()->name !== $baseClass) {
            return self::responder()->error(__("Incorrect service `code`"), [__("Incorrect service `code`")], [], 400);
        }
        $serviceMethod = $serviceNamespace::getMethod();
        $requestMethod = $request->getMethod();
        if (strcmp($requestMethod, $serviceMethod) !== 0) {
            return self::responder()->error(__("This service supported {$serviceMethod} method"), [__("The {$requestMethod} method is not supported for service")], [], 400);
        }
        $service = new $serviceNamespace();
        return $service->load(request()->all())->handle();
    }
}
