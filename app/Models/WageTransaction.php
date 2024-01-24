<?php

namespace App\Models;

use App\Events\NotifyAdminEvent;
use App\Models\Concerns\HasModelScope;
use App\Models\Concerns\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;


class WageTransaction extends Model
{
    use HasFactory;
    use HasModelScope;

    public $incrementing = false;

    public $observables = ['creating'];

    public const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'source_card_id',
        'amount',
        'created_at',
    ];

    protected $casts = [
        'amount' => 'double'
    ];

}
