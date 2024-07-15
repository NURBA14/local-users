<?php

namespace App\Base\ConsoleBase\TokenList;

use App\Base\ConsoleBase\ConsoleBase;
use Illuminate\Support\Facades\Storage;

class straightConsole extends ConsoleBase
{
    public function handle()
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