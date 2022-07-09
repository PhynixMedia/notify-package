<?php

namespace Notify\App\Services\Sms;

use Phynixmedia\Mailer\Mailer;

class SmsService
{

    private $logger;
    private $mailer;

    public function __construct(){

        $this->logger = new SmsLogService();
        $this->mailer = new Mailer(config("notify-app.email_api"));
    }

    /**
     * @param $data
     * This is an instant run method
     */
    public function run($to, $sms): bool
    {
        if(! $mail = $this->logger->prepareForSend($to, $sms)){
            return false;
        }
        $payload = $this->logger->prepareForDb(_value((object)$mail, "sms"), false);
        $payload["instant"] = $payload["_state"] = 0;
        $payload["status"] = 1;
        $this->logger->set(map_request($payload));
       return true;
    }

    /**
     * @param $data
     * This is an instant run method
     */
    public function runInstant($to, $sms): bool
    {

        if(! $mail = $this->logger->prepareForSend($to, $sms)){
            return false;
        }

        if($this->mailer->sendSMS(config("notify-app.sms_api"), $mail)){
            $payload = $this->logger->prepareForDb(_value((object)$mail, "sms"), true);
            $payload["instant"] = $payload["_state"] = $payload["status"] = 1;
            $this->logger->set(map_request($payload));
        }
        return true;
    }

    /**
     * @param $data
     * @return bool
     */
    public function runOne($data): bool
    {

        $mail = $this->logger->prepareForSend(_value($data, "to"), _value($data, "sms"));

        if(! $mail){
            return false;
        }
        if($this->mailer->sendSMS(config("notify-app.sms_api"), $mail)){
            $this->logger->update(["_state"=>1], ["id"=>_value($data, "id")]);
        }
        return true;
    }

    /**
     * @param $data
     * This will be run automatically by the cronjob
     */
    public function runMany($data){

        $records = $this->logger->load(5);
        foreach ($records as $record){
            $this->runOne($record);
        }
    }
}