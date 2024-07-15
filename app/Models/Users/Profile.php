<?php

namespace App\Models\Users;

use Filterable\Interfaces\Filterable as FilterableInterface;
use Filterable\Traits\Filterable as FilterableTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Schema;

class Profile extends Model implements FilterableInterface
{
    use HasFactory, FilterableTrait;

    protected $table = "user_profiles";
    protected $guarded = [
        'created_at',
        'updated_at',
        'id',
    ];
    public static function getColumnsList() //Получение списка колонок, для валидации
    {
        $cols = [
            "id",
            "account_id",
            "uuid",
            "iin",
            "nickname",
            "name",
            "surname",
            "lastname",
            "birthdate",
            "deathdate",
            "gender_id",
            "nationality_id",
            "resident",
            "father_iin",
            "mother_iin",
            "guardian_iin",
            "status",
            "created_at",
            "updated_at",
        ];
        return $cols;
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class);
    }

    public function getCreatedAtAttribute($value) //TODO Привожу в формат Y:m:d H:i:s
    {
        return empty($value) ? null : Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value) //TODO Привожу в формат Y:m:d H:i:s
    {
        return empty($value) ? null : Carbon::parse($value)->format('Y-m-d H:i:s');
    }

}
