<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;

class TokenDelete extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:delete {level}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Access token delete';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $level = $this->argument("level");

        $directory = app_path("/Base/ConsoleBase/DeleteToken/" . $level . "Console.php");
        if (!File::exists($directory)) {
            $this->error("Inccorect 'level'");
            die;
        }
        $class_namespace = "\App\Base\ConsoleBase\DeleteToken\\" . $level . "Console";
        $stat = new $class_namespace();
        $tokens = $stat->data();
        $this->table(["level", "service", "token"], $tokens);
        $service = $this->ask("Enter 'service' to delete");
        if (empty($service)) {
            $this->error("You have not entered 'service'");
            die;
        }
        $data = [
            'service' => $service
        ];
        $res = $stat->load($data)->handle();
        if (!$res['status']) {
            $this->error($res['message']);
            die;
        }
        $this->info($res['message']);
    }
}
