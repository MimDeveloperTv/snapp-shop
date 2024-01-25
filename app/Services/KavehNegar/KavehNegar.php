<?php

namespace App\Services\KavehNegar;

use App\Services\Service;
use Illuminate\Support\Facades\Http;

class KavehNegar implements Service
{
    public string $mobile;
    public string $text;
    public mixed $config;

    public const FAILED_STATUS = 6;
    public const SEND_OK = 'success';

    public function prepare(string $mobile,string $text){

        $this->config = config('services.kavehNegar');

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function send(){
        try {
            $resp =  Http::post($this->getBaseUrl(),[
                    'message' => $this->text,
                    'receptor' => $this->mobile,
                ])->json('status');

            if($resp == self::FAILED_STATUS){
                throw new \Exception();
            }

            return self::SEND_OK;

        }
        catch (\Exception $ex){
             throw new \Exception();
        }
    }

    public function getBaseUrl(): string
    {
        return $this->config['baseUrl'] . $this->config['apiKey'] .'/sms/send.json';
    }

}
