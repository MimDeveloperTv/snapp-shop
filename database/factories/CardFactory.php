<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CardFactory extends Factory
{
    public $card = ['6219861905878400' , '6037997535775358' , '6037691551197544','6104337821129960'] ;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => (string) Str::ulid() ,
            'number' => (string) $this->card[array_rand($this->card, 1)] ,
            'created_at' => $this->faker->date,
        ];
    }

}
