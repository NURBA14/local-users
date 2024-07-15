<?php

namespace App\Base\MiddlewareBase\Access;

use App\Base\MiddlewareBase\MiddlewareBase;
use Illuminate\Support\Facades\Storage;

class straightAccess extends MiddlewareBase
{
    public function handle()
    {
        $level = $this->data['level'];
        $service = $this->data['service'];
        $token = $this->data['token'];

        $storage = Storage::disk("access_tokens");

        $file_path = "straight/" . $service . ".json";
        if(!$storage->exists($file_path)){
            return $this->response(false, __("Header 'service' is incorrect"), [__("Header 'service' is incorrect")], [], 403);
        }
        $content = json_decode($storage->get($file_path));
        
        
        if(strcmp($level, $content->level) !== 0){
            return $this->response(false, __("Header 'level' is incorrect"), [__("Header 'level' is incorrect")], [], 403);
        }
        if(strcmp($service, $content->service) !== 0){
            return $this->response(false, __("Header 'service' is incorrect"), [__("Header 'service' is incorrect")], [], 403);
        }
        if(strcmp($token, $content->token) !== 0){
            return $this->response(false, __("Header 'token' is incorrect"), [__("Header 'token' is incorrect")], [], 403);
        }
        
        return $this->response(true, __("Successful access"), [], [], 200);
    }
}