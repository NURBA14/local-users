<?php

namespace App\Models\Users;

use Filterable\Interfaces\Filterable as FilterableInterface;
use Filterable\Traits\Filterable as FilterableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Schema;

class Gender extends Model implements FilterableInterface
{
    use HasFactory, FilterableTrait;
    public $timestamps = false;
    protected $guarded = [
        'id',
    ];

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }

    public static function getColumnsList()
    {
        return [
            "id",
            "name",
            "title"
        ];
    }
}
