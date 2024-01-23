<?php

namespace App\Http\Requests\Helper;

class RequestHelper
{
    // Convert farsi number to latin
    public static function faToEn($text): string
    {
        return (string) str_replace(
            ['۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۰'],
            ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'],
            $text
        );
}

}
