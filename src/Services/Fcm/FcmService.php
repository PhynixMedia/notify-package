<?php

namespace Notify\App\Services\Fcm;

use Phynixmedia\Mailer\Mailer;

class FcmService
{

    private $logger;
    private $pusher;

    public function __construct(){

        $this->pusher = new FCMRequest();
        $this->logger = new FcmLogService();
    }

    /**
     * @param $data
     * This is an instant run method
     */
    public function run(string $receiver, string $message): bool
    {

        $payload = $this->logger->prepareForDb([
            "receiver"  => encrypt($receiver),
            "message"   => $message
        ], false);

        if(! $this->logger->set(map_request($payload))){
            return false;
        }
        return true;
    }

    /**
     * @param $data
     * This is an instant run method
     */
    public function runInstant(string $receiver, string $message): bool
    {

        if($this->pusher->send(FCMRequest::payload($receiver, "", $message))){
            $payload = $this->logger->prepareForDb([
                "receiver"  => encrypt($receiver),
                "message"   => $message
            ], true);
            $payload["instant"] = $payload["_state"] = $payload["status"] = 1;
            if( $this->logger->set(map_request($payload))){
                return true;
            }
        }
        return false;
    }

    /**
     * @param $data
     * @return bool
     */
    public function runOne($data): bool
    {
        $receiver = decrypt(_value($data, "receiver"));
        $message = _value($data, "message");

        if(! $receiver || !$message){
            return false;
        }
        if($this->pusher->send(FCMRequest::payload($receiver, "", $message))){
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