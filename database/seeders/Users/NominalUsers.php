<?php

namespace Database\Seeders\Users;

use App\Models\Users\Account;
use App\Models\Users\Gender;
use App\Models\Users\Nationality;
use App\Models\Users\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * класс создает номинальных пользователей которые активны не удалены и тому подобное
 */
class NominalUsers extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::factory(10)->create()->each(function ($account) {
            Profile::factory()->create([
                'account_id' => $account->id,
                'uuid' => $account->uuid,
                'iin' => $account->iin,
            ]);
        });
    }

}
