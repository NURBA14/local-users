<?php

namespace App\Http\Middleware\Check;

use App\Http\Responders\Responder;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class AccessMiddleware
{
    private $responder;
    private function responder()
    {
        if (is_null($this->responder)) {
            $this->responder = new Responder();
            return $this->responder;
        } else {
            return $this->responder;
        }
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (is_null($request->header("level", null))) {
            return $this->responder()->error(__("The 'level' header is empty"), [__("The 'level' header is empty")], [], 403);
        }
        if (is_null($request->header("service", null))) {
            return $this->responder()->error(__("The 'service' header is empty"), [__("The 'service' header is empty")], [], 403);
        }
        if (is_null($request->header("token", null))) {
            return $this->responder()->error(__("The 'token' header is empty"), [__("The 'token' header is empty")], [], 403);
        }
        $service = $request->header("service");
        $level = $request->header("level");
        $token = $request->header("token");

        $directory = app_path("/Base/MiddlewareBase/Access/" . $level . "Access.php");
        if (!File::exists($directory)) {
            return $this->responder()->error(__("Header 'level' is incorrect"), [__("Header 'level' is incorrect")], [], 403);
        }
        $access_namespace = "\App\Base\MiddlewareBase\Access\\" . $level . "Access";

        $stat = new $access_namespace();
        $data = [
            "level" => $level,
            "service" => $service,
            "token" => $token
        ];
        $result = $stat->load($data)->handle();
        if (!$result["status"]) {
            return $this->responder()->error($result["message"], $result["errors"], $result["data"], $result["code"]);
        }
        return $next($request);
    }
}
