<?php

namespace App\Models\Users;

use Filterable\Interfaces\Filterable as FilterableInterface;
use Filterable\Traits\Filterable as FilterableTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Schema;

class Account extends Authenticatable implements FilterableInterface
{
    use HasFactory, FilterableTrait;

    protected $table = 'user_accounts';
    protected $guarded = [
        'created_at',
        'updated_at',
        'id',
    ];
    public static function getColumnsList() //Получение списка колонок, для валидации и тд
    {
        $cols = [
            "id",
            "uuid",
            "iin",
            "iin_status",
            "phone",
            "phone_status",
            "email",
            "email_status",
            "login",
            "pincode",
            "status",
            "last_visit",
            "last_device",
            "last_ip",
            "created_at",
            "updated_at",
        ];
        return $cols;
    }

    public static function smscodeGenerate()
    {
        return fake()->randomNumber(4, true);
    }

    public static function createNew($accountData, $profileData) //Синхронное создание Аккаунта вместе с Профилем
    {
        $uuid = Str::uuid();
        $accountData['uuid'] = $uuid;
        $profileData['uuid'] = $uuid;
        $account = static::create($accountData);
        $account->profile()->create($profileData);
        return $account;
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }


    public function getLastVisitAttribute($value) //Привожу в формат Y:m:d H:i:s
    {
        return empty($value) ? null : Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getCreatedAtAttribute($value) //Привожу в формат Y:m:d H:i:s
    {
        return empty($value) ? null : Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value) //Привожу в формат Y:m:d H:i:s
    {
        return empty($value) ? null : Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
