<?php

namespace Database\Factories\Users;

use App\Models\Users\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => str()->uuid(),
            'iin' => fake()->individualIdentificationNumber(),
            // 'iin_status' => 0,
            'phone' => str_replace(["+7", "(", ")", " "], ["", "", "", ""], fake()->phoneNumber()),
            // 'phone_status'  => fake(),
            'email' => fake()->email(),
            // 'email_status'  => fake(),
            'login' => fake()->userName(),
            'password' => Hash::make('user123'),
            // 'pincode'  => '',
            // 'smscode'  => '',
            // 'status'  => fake(),
            // 'last_visit'  => fake(),
            // 'last_device'  => fake(),
        ];
    }
}
