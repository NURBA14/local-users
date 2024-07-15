<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;

class TokenList extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:list {level}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Access tokens list';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $level = $this->argument("level");
        $directory = app_path("/Base/ConsoleBase/TokenList/" . $level . "Console.php");
        if (!File::exists($directory)) {
            $this->error("Inccorect 'level'");
            die;
        }
        $class_namespace = "\App\Base\ConsoleBase\TokenList\\" . $level . "Console";
        $stat = new $class_namespace();
        $tokens = $stat->handle();

        $this->table(['level', "service", "token"], $tokens);
    }
}
