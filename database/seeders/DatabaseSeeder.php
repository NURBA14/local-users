<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Users\Account;
use App\Models\Users\Profile;
use Database\Seeders\Users\NominalUsers;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(NominalUsers::class); //Не запускайте
    }
}
