<?php

namespace App\Models;

use App\Models\Concerns\HasModelScope;
use App\Models\Concerns\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    use HasFactory;
    use HasModelScope;

    public $incrementing = false;

    public $observables = ['creating'];

    public const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'account_id',
        'number',
        'created_at',
        'updated_at',
    ];

    protected $casts = [];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function sourceTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class,'dest_card_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public static function getBalance(string $cardId){
       return self::query()
           ->find($cardId)
           ->sourceTransactions()
           ->get()
           ->sum('amount');
    }

    public static function getCardId(string $cardNumber){
      return  self::query()->where('number',$cardNumber)->first()->getKey();
    }

    public function topTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class,'dest_card_id')
            ->orderByDesc('created_at')
            ->take(10);
    }
}
