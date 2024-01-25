<?php

namespace App\Services\Ghasedak;

use App\Services\Service;
use App\Services\ServiceFactory;
use Illuminate\Support\Facades\Http;

class Ghasedak implements Service
{
    public string $mobile;
    public string $text;
    public mixed $config;

    public const SEND_OK = 'success';

    public function prepare(string $mobile,string $text){

        $this->config = config('services.ghasedak');

        return $this;
    }

    public function send(){
        try {
          $resp =  Http::withHeader('apikey',$this->config['apiKey'])
                ->post($this->config['baseUrl'],[
                    'message' => $this->text,
                    'sender' => $this->config['sender'],
                    'receptor' => $this->mobile,
                ])->json('result');

          if(!$resp == self::SEND_OK){
              throw new \Exception();
          }

          return self::SEND_OK;

        }
        catch (\Exception $ex){
            return ServiceFactory::make(ServiceFactory::KAVEH_NEGAR)
                   ->prepare($this->mobile,$this->text)->send();
        }
    }

}
