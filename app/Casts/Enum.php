<?php

namespace App\Casts;

use Core\Enums\Transform;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Enum implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  mixed  $value
     */
    public function get($model, string $key, $value, array $attributes): ?array
    {
        return $value ? Transform::formatter($value) : null;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  mixed  $value
     */
    public function set($model, string $key, $value, array $attributes): mixed
    {
        return $value;
    }
}
