<?php

namespace Database\Seeders;

use App\Models\Users\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name" => "none",
                "title" => "Не установлен"
            ],
            [
                "name" => "male",
                "title" => "Мужчина",
            ],
            [
                "name" => "female",
                "title" => "Женщина"
            ]
        ];
        DB::table("genders")->insert($data);
    }
}
