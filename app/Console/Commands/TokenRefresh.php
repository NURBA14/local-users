<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\File;

class TokenRefresh extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:refresh {level}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh Access token';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $level = $this->argument('level');
        $directory = app_path("/Base/ConsoleBase/RefreshToken/" . $level . "Console.php");
        if (!File::exists($directory)) {
            $this->error("Inccorect 'level'");
            die;
        }

        $class_namespace = "\App\Base\ConsoleBase\RefreshToken\\" . $level . "Console";
        $stat = new $class_namespace();
        $tokens = $stat->data();
        $this->table(["level", "service", "token"], $tokens);

        $service = $this->ask("Enter service name");
        if (empty($service)) {
            $this->error("You have not entered 'token'");
            die;
        }
        $token_base = $this->ask("Enter new token");
        if (empty($token_base)) {
            $this->error("You have not entered 'token'");
            die;
        }

        $data = [
            "level" => $level,
            "service" => $service,
            "token" => bcrypt($token_base)
        ];
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
