<?php

namespace Database\Factories\Users;

use App\Models\Users\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fullName = fake()->name();
        list($lastName, $firstName) = explode(" ", $fullName);
        $surName = fake()->lastName();

        return [
            // 'account_id' => rand(1, 50), // must be set out side
            // 'uuid' => str()->uuid(), // must be set out side
            // 'iin', // must be set out side
            'nickname' => fake()->word(),
            'name' => $firstName,
            'surname' => $surName,
            'lastname' => $lastName,
            // 'birthdate' => fake()->date(),
            // 'deathdate',
            // 'gender_id' => fake()->numberBetween(1, 3),
            // 'nationality_id' => fake()->numberBetween(1, 5),
            // 'resident',
            // 'father_iin',
            // 'mother_iin',
            // 'guardian_iin',
            // 'status',
        ];
    }
}
