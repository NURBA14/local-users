<?php

namespace App\Base\ConsoleBase\TokenList;

use App\Base\ConsoleBase\ConsoleBase;
use Illuminate\Support\Facades\Storage;

class rootConsole extends ConsoleBase
{
    public function handle()
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