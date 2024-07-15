<?php

namespace App\Base\ConsoleBase\CreateToken;

use App\Base\ConsoleBase\ConsoleBase;
use Illuminate\Support\Facades\Storage;

class rootConsole extends ConsoleBase
{
    public function handle()
    {
        $level = $this->data['level'];
        $service = $this->data['service'];
        $token = $this->data["token"];
        $storage = Storage::disk("access_tokens");
        $path = "root/" . $service . ".json";
        if ($storage->exists($path)) {
            return $this->response(true, "'" . $service . "'" . " already has token", [], []);
        }
        $data = [
            "level" => $level,
            "service" => $service,
            "token" => $token
        ];
        if (!$storage->put($path, json_encode($data))) {
            return $this->response(false, "token not created", [], []);
        }
        return $this->response(true, "token created", [], []);
    }

    public function data()
    {
        $storage = Storage::disk("access_tokens");
        $files = $storage->files("/root/");
        $data = [];
        foreach ($files as $file) {
            $json = $storage->get($file);
            $data[] = (array) json_decode($json);
        }
        return $data;
    }
}