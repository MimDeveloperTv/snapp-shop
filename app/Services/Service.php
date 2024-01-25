<?php

namespace App\Services;

interface Service
{
    public const TYPE = 'PROVIDER';

    public function prepare(string $mobile,string $text);

    public function send();

}
