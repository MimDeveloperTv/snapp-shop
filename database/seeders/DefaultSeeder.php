<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Card;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $userSourceId = User::factory()->count(1)->createQuietly()->get(0)->id;
       $userDestId = User::factory()->count(1)->createQuietly()->get(0)->id;

       $accountSourceId = Account::factory()
           ->state([
               'user_id' => $userSourceId
       ])->count(1)->createQuietly()->get(0)->id;

       $accountDestId = Account::factory()
           ->state([
            'user_id' => $userDestId
           ])->count(1)->createQuietly()->get(0)->id;

      $cardSourceId = Card::factory()
          ->state([
              'account_id' => $accountSourceId
          ])->count(1)->createQuietly()->get(0)->id;

         $cardDestId = Card::factory()
          ->state([
              'account_id' => $accountDestId
          ])->count(1)->createQuietly()->get(0)->id;

         $amount = 50000;

        $transaction = Transaction::factory()
            ->state([
                'source_card_id' => $cardSourceId,
                'dest_card_id' => $cardDestId,
                'amount' =>  $amount
            ])->count(1)->createQuietly()->get(0)->id;

        $transaction = Transaction::factory()
            ->state([
                'dest_card_id' => $cardSourceId,
                'source_card_id' => $cardDestId,
                'amount' =>  -$amount
            ])->count(1)->createQuietly()->get(0)->id;

    }

}
