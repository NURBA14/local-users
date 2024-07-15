<?php

namespace App\Base\ConsoleBase\DeleteToken;

use App\Base\ConsoleBase\ConsoleBase;
use Illuminate\Support\Facades\Storage;

class straightConsole extends ConsoleBase
{
    public function handle()
    {
        $service = $this->data['service'];
        $storage = Storage::disk("access_tokens");
        $path = "straight/" . $service . ".json";
        if (!$storage->exists($path)) {
            return $this->response(false, "'" . $service . "' service does not exist", [], []);
        }

        if (!$storage->delete($path)) {
            return $this->response(false, "'" . $service . "' not deleted", [], []);
        }

        return $this->response(true, "Success delete {$service} token", [], []);
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