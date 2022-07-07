<?php declare (strict_types = 1);
namespace App\Service;

use Smsapi\Client\Curl\SmsapiHttpClient;
use Smsapi\Client\Feature\Sms\Bag\SendSmsBag;

class SmsService
{
    
    private $telephone;
    private $message;

    public function __construct($telephone, $message)
    {
        $this->message = $message;
        $this->telephone = $telephone;
    }

    public function envoiSms()
    {
        $client = new SmsapiHttpClient();
        $apiToken = 'RsuCQRXyOfkrSZgTf4p93NcZ4MCgTnRQ3cFCtH9Z';

        $service = $client->smsapiComService($apiToken);
        $sms = SendSmsBag::withMessage($this->telephone, $this->message);
        $sms->from = 'TAXXIB';
        try {
            $service->smsFeature()
                ->sendSms($sms);
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

}