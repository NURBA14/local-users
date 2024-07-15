<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;

class TokenCreate extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:create {level} {service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Access token create';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $level = $this->argument("level");
        $service = $this->argument("service");

        $directory = app_path("/Base/ConsoleBase/CreateToken/" . $level . "Console.php");
        if (!File::exists($directory)) {
            $this->error("Inccorect 'level'");
            die;
        }

        $token_base = $this->ask("Enter token");
        if (empty($token_base)) {
            $this->error("You have not entered 'token'");
            die;
        }
        $token = bcrypt($token_base);
        $data = [
            "level" => $level,
            "service" => $service,
            "token" => $token
        ];
        $class_namespace = "\App\Base\ConsoleBase\CreateToken\\" . $level . "Console";
        $stat = new $class_namespace();
        $res = $stat->load($data)->handle();
        if (!$res['status']) {
            $this->error($res['message']);
            die;
        }
        $this->info($res['message']);

        $tokens = $stat->data();
        $this->table(["level", "service", "token"], $tokens);
    }
}
