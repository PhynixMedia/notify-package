<?php

namespace Notify\App\Services\Sms;

use App\Services\Service;
use Notify\App\Models\EmailLogs;
use Notify\App\Models\SMSLog;
use Notify\App\Repositories\SmsRepository;

class SmsLogService extends Service
{

    public function __construct(){

        $this->repository = new SmsRepository();
    }

    /**
     * @param int $count
     * @return mixed
     */
    public function load(int $count)
    {
        return $this->takeWhere(["_state"=>0, "instant"=>0], $count);
    }

    public function prepareForSend(string $to, string $sms): ?array
    {
        return ["sms" => [
            "issms" => true,
            "to"    => $to,
            "code"  => config("notify-app.sender_code"),
            "from"  => "IndyCabs",
            "sms"   => $sms
        ]];
    }

    public function prepareForDb(array $data, $is_instant = false){

        if(!_value((object)$data, "code", false) || !_value((object)$data, "to", false) ||  !_value((object)$data, "sms", false)){
            return null;
        }

        $payload    = $this->prepare(map_request( $data ), true);
        $payload["page_count"] = self::getCharLength(_value((object)$data, "sms", ""));

        if($is_instant){
            $payload["instant"] = $payload["_state"] = $payload["status"] = 1;
        }else{
            $payload["status"]  = 1;
            $payload["instant"] = $payload["_state"] = 0;
        }

        return $payload;
    }

    public static function getCharLength(string $character): int
    {
        return count(str_split($character, 140) ?? []);
    }
}