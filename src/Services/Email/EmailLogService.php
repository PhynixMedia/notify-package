<?php

namespace Notify\App\Services\Email;

use App\Services\Service;
use Notify\App\Repositories\EmailRepository;

class EmailLogService extends Service
{

    public function __construct(){

        $this->repository = new EmailRepository();
    }

    public function load(int $count){

        return $this->takeWhere(["_state" => 0, "instant" => 0], $count);
    }

    public function prepareForSend(string $to, string $subject, string $message): ?array
    {
        return (array) [
            "to" => $to,
            "from"  => config("notify-app.email_sender"),
            "subject"   => $subject,
            "message"   => $message
        ];
    }

    public function prepareForDb(array $data, $is_instant = false): ?array
    {

        if(!_value((object) $data, "from", false) || !_value((object) $data, "to", false) || !_value((object) $data, "subject", false) ||  !_value((object) $data, "message", false)){
            return null;
        }

        $payload = $this->prepare(map_request($data), true);

        if($is_instant){
            $payload["instant"] = $payload["_state"] = $payload["status"] = 1;
        }else{
            $payload["status"]  = 1;
            $payload["instant"] = $payload["_state"] = 0;
        }
        return $payload;
    }
}