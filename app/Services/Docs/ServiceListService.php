<?php

namespace App\Services\Docs;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\ServiceBase;
use App\Http\Resources\Docs\ServiceListResource;
use Illuminate\Support\Facades\File;

class ServiceListService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;
    protected function handleLogic()
    {
        $baseClass = "App\Base\ServiceBase\ServiceBase";
        $files = File::allFiles(app_path("Services"));
        $data = [];
        $i = 1;
        foreach ($files as $file) {
            $namespace = str_replace([base_path(), "app", "/", ".php"], ["", "App", "\\", ""], $file->getRealPath());
            $reflection = new \ReflectionClass(new $namespace());
            if (empty($reflection->getParentClass())) {
                continue;
            }
            if ($reflection->getParentClass()->name !== $baseClass) {
                continue;
            }
            $data[] = [
                "id" => $i,
                "service" => $namespace::code(),
                "method" => $namespace::getMethod()
            ];
            $i++;
        }
        return $this->responder()->success(__("Services docs"), [], ServiceListResource::collection($data));
    }
    public function validateRules(): array
    {
        return [];
    }
}