<?php

namespace App\Base\ConsoleBase\RefreshToken;

use App\Base\ConsoleBase\ConsoleBase;
use Illuminate\Support\Facades\Storage;

class straightConsole extends ConsoleBase
{
    public function handle()
    {
        $level = $this->data['level'];
        $service = $this->data['service'];
        $token = $this->data['token'];

        $storage = Storage::disk("access_tokens");
        $path = "/straight/" . $service . ".json";
        if (!$storage->exists($path)) {
            return $this->response(false, "'" . $service . "' service not found", [], []);
        }

        $data = (array) json_decode($storage->get($path));
        $data['token'] = $token;
        $storage->put($path, json_encode($data));
        return $this->response(true, "Token refresh", [], []);
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