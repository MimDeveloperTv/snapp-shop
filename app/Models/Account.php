<?php

namespace App\Models;

use App\Models\Concerns\HasModelScope;
use App\Models\Concerns\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Account extends Model
{
    use HasFactory;
    use HasModelScope;

    public $incrementing = false;

    public $observables = ['creating'];

    public const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [];

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }

}
