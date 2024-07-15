<?php

namespace App\Base\ConsoleBase\CreateToken;

use App\Base\ConsoleBase\ConsoleBase;
use Illuminate\Support\Facades\Storage;

class straightConsole extends ConsoleBase
{
    public function handle()
    {
        $level = $this->data['level'];
        $service = $this->data['service'];
        $token = $this->data["token"];
        $storage = Storage::disk("access_tokens");
        $path = "straight/" . $service . ".json";
        if ($storage->exists($path)) {
            $token_data = (array) json_decode($storage->get($path));
            return $this->response(true, "'" . $service . "'" . " already has token", [], $token_data);
        }
        $data = [
            "level" => $level,
            "service" => $service,
            "token" => $token
        ];

        if (!$storage->put($path, json_encode($data))) {
            return $this->response(false, "token not created", [], []);
        }
        return $this->response(true, "token created", [], $data);
    }

    public function data()
    {
        $storage = Storage::disk("access_tokens");
        $files = $storage->files("/straight/");
        $data = [];
        foreach ($files as $file) {
            $json = $storage->get($file);
            $data[] = (array) json_decode($json);
        }
        return $data;
    }
}