<?php

namespace Database\Seeders;

use App\Models\Users\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["name_rus" => 'Казах', "name_kaz" => 'Қазақ'],
            ["name_rus" => 'Русский', "name_kaz" => 'Орыс'],
            ["name_rus" => 'Авар', "name_kaz" => 'Авар'],
            ["name_rus" => 'Агул', "name_kaz" => 'Агул'],
            ["name_rus" => 'Адыгей', "name_kaz" => 'Адыгей'],
            ["name_rus" => 'Азербайжан', "name_kaz" => 'Әзірбайжан'],
            ["name_rus" => 'Араб', "name_kaz" => 'Араб'],
            ["name_rus" => 'Армян', "name_kaz" => 'Армян'],
            ["name_rus" => 'Башкир', "name_kaz" => 'Башқұрт'],
            ["name_rus" => 'Белорус', "name_kaz" => 'Белорус'],
            ["name_rus" => 'Болгар', "name_kaz" => 'Болгар'],
            ["name_rus" => 'Грек', "name_kaz" => 'Грек'],
            ["name_rus" => 'Грузин', "name_kaz" => 'Грузин'],
            ["name_rus" => 'Дагистан', "name_kaz" => 'Дағыстан'],
            ["name_rus" => 'Даргин', "name_kaz" => 'Даргин'],
            ["name_rus" => 'Дунган', "name_kaz" => 'Дұңған'],
            ["name_rus" => 'Еврей', "name_kaz" => 'Еврей'],
            ["name_rus" => 'Ингуш', "name_kaz" => 'Ингуш'],
            ["name_rus" => 'Индус', "name_kaz" => 'Индус'],
            ["name_rus" => 'Иран', "name_kaz" => 'Иран'],
            ["name_rus" => 'Ирланд', "name_kaz" => 'Ирланд'],
            ["name_rus" => 'Итальян', "name_kaz" => 'Итальян'],
            ["name_rus" => 'Кабардин', "name_kaz" => 'Кабардин'],
            ["name_rus" => 'Калмык', "name_kaz" => 'Қалмық'],
            ["name_rus" => 'Канадец', "name_kaz" => 'Канада'],
            ["name_rus" => 'Каракалпак', "name_kaz" => 'Қарақалпақ'],
            ["name_rus" => 'Карачай', "name_kaz" => 'Карашай'],
            ["name_rus" => 'Киргиз', "name_kaz" => 'Қырғыз'],
            ["name_rus" => 'Кореец', "name_kaz" => 'Кореец'],
            ["name_rus" => 'Кумык', "name_kaz" => 'Кумык'],
            ["name_rus" => 'Курт', "name_kaz" => 'Курт'],
            ["name_rus" => 'Лакиец', "name_kaz" => 'Лакиец'],
            ["name_rus" => 'Латыш', "name_kaz" => 'Латыш'],
            ["name_rus" => 'Лач', "name_kaz" => 'Лач'],
            ["name_rus" => 'Лезгин', "name_kaz" => 'Лезгин'],
            ["name_rus" => 'Литовец', "name_kaz" => 'Литовец'],
            ["name_rus" => 'Молдаван', "name_kaz" => 'Молдаван'],
            ["name_rus" => 'Морд', "name_kaz" => 'Морд'],
            ["name_rus" => 'Немец', "name_kaz" => 'Неміс'],
            ["name_rus" => 'Ногай', "name_kaz" => 'Ноғай'],
            ["name_rus" => 'Норвежец', "name_kaz" => 'Норвежец'],
            ["name_rus" => 'Осетин', "name_kaz" => 'Осетин'],
            ["name_rus" => 'Поляк', "name_kaz" => 'Поляк'],
            ["name_rus" => 'рутул', "name_kaz" => 'рутул'],
            ["name_rus" => 'Табасар', "name_kaz" => 'Табасар'],
            ["name_rus" => 'Таджик', "name_kaz" => 'Тәжік'],
            ["name_rus" => 'Талец', "name_kaz" => 'Талец'],
            ["name_rus" => 'Татар', "name_kaz" => 'Татар'],
            ["name_rus" => 'Туркмен', "name_kaz" => 'Түрікпен'],
            ["name_rus" => 'Турок', "name_kaz" => 'Түрік'],
            ["name_rus" => 'Удин', "name_kaz" => 'Удин'],
            ["name_rus" => 'Удмурт', "name_kaz" => 'Удмурт'],
            ["name_rus" => 'Узбек', "name_kaz" => 'Өзбек'],
            ["name_rus" => 'Уйгур', "name_kaz" => 'Ұйғыр'],
            ["name_rus" => 'Украин', "name_kaz" => 'Украин'],
            ["name_rus" => 'Цыган', "name_kaz" => 'Цыған'],
            ["name_rus" => 'Чечен', "name_kaz" => 'Шешен'],
            ["name_rus" => 'Чуваш', "name_kaz" => 'Чуваш'],
            ["name_rus" => 'Шотландец', "name_kaz" => 'Шотландец'],
            ["name_rus" => 'Эстонец', "name_kaz" => 'Эстон'],
            ["name_rus" => 'Китай', "name_kaz" => 'Қытай'],
            ["name_rus" => 'Хакас', "name_kaz" => 'Хакас'],
            ["name_rus" => 'Курд', "name_kaz" => 'Күрд'],
            ["name_rus" => 'Поляк', "name_kaz" => 'Поляк'],
            ["name_rus" => 'Саха', "name_kaz" => 'Саха'],
            ["name_rus" => 'Нигериец', "name_kaz" => 'Нигериялық'],
            ["name_rus" => 'Пакистанец', "name_kaz" => 'Пакистандық']
        ];
        DB::table("nationalities")->insert($data);
    }
}
