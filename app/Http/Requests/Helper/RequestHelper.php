<?php

namespace App\Http\Requests\Helper;

class RequestHelper
{
    public static function faToEn($text): string
    {
        return (string) str_replace(
            ['۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۰'],
            ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'],
            $text
        );
}

    public static function validateCardNumber($cardNumber): bool
    {
        if(empty($cardNumber) || strlen($cardNumber) !== 16) {
            return false;
        }
        $cardToArr = str_split($cardNumber);
        $cardTotal = 0;
        for($i = 0; $i<16; $i++) {
            $c = (int)$cardToArr[$i];
            if($i % 2 === 0) {
                $cardTotal += (($c * 2 > 9) ? ($c * 2) - 9 : ($c * 2));
            } else {
                $cardTotal += $c;
            }
        }
        return ($cardTotal % 10 === 0);
    }

}
