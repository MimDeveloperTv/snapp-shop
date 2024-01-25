<?php

namespace App\Models;

use App\Events\NotifyEvent;
use App\Models\Concerns\HasModelScope;
use App\Models\Concerns\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;


class Transaction extends Model
{
    use HasFactory;
    use HasModelScope;

    public $incrementing = false;

    public $observables = ['creating','created'];

    public const UPDATED_AT = null;

    public const WAGE_AMOUNT = 500;
    public const LIMIT_MIN_AMOUNT = 1000;
    public const LIMIT_MAX_AMOUNT = 50000000;

    protected $fillable = [
        'id',
        'source_card_id',
        'dest_card_id',
        'amount',
        'created_at',
    ];

    protected $casts = [
        'amount' => 'double'
    ];


    public static function SendNotifyAdmin(Account $order){
        NotifyEvent::dispatch($order);
    }

}
