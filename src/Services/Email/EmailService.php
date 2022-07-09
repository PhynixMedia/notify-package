<?php

namespace Notify\App\Services\Email;

use Phynixmedia\Mailer\Mailer;

class EmailService
{

    private $logger;
    private $mailer;

    public function __construct(){

        $this->logger = new EmailLogService();
        $this->mailer = new Mailer(config("notify-app.email_api"));
    }

    /**
     * @param $data
     * This is an instant run method
     */
    public function run(string $to, string $subject, string $message): bool
    {
        if(! $mail = $this->logger->prepareForSend($to, $subject, $message)){
            return false;
        }
        $payload = $this->logger->prepareForDb($mail, false);
        $this->logger->set(map_request($payload));
        return true;
    }

    /**
     * @param $data
     * This is an instant run method
     */
    public function runInstant(string $to, string $subject, string $message): bool
    {

        if(! $mail = $this->logger->prepareForSend($to, $subject, $message)){
            return false;
        }

        if($this->mailer->sendSMS(config("notify-app.email_api"), $mail)){
            $payload = $this->logger->prepareForDb($mail, true);
            $payload["instant"] = $payload["_state"] = $payload["status"] = 1;
            $this->logger->set(map_request($payload));
        }
        return true;
    }

    /**
     * @param $data
     * @return bool
     */
    public function runOne($data){

        $mail  = $this->logger->prepareForSend(_value($data, "to"), _value($data, "subject"), _value($data, "message"));

        if(! $mail){
            return false;
        }
        if($this->mailer->send($mail)){
            $this->logger->update(["_state"=>1], ["id"=>_value($data, "id")]);
        }
        return true;
    }

    /**
     * @param $data
     * This will be run automatically by the cronjob
     */
    public function runMany($data){

        $records = $this->logger->load(config("notify-app.send_counter"));

        \Log::info("Chckers:: " . json_encode($records->toArray()));

        foreach ($records as $record){
            $this->runOne($record);
        }
    }
}