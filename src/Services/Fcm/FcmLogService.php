<?php

namespace Notify\App\Services\Fcm;

use App\Services\Service;
use Notify\App\Repositories\FcmRepository;

class FcmLogService extends Service
{

    public function __construct(){

        $this->repository = new FcmRepository();
    }

    /**
     * @param int $count
     * @return mixed
     */
    public function load(int $count)
    {
        return $this->takeWhere(["_state"=>0, "instant"=>0], $count);
    }

    public function prepareForDb(array $data, $is_instant = false){

        if( !_value((object)$data, "receiver", false) ||  !_value((object)$data, "message", false)){
            return null;
        }

        $payload    = $this->prepare(map_request( $data ), true);

        if($is_instant){
            $payload["instant"] = $payload["_state"] = $payload["status"] = 1;
        }else{
            $payload["status"]  = 1;
            $payload["instant"] = $payload["_state"] = 0;
        }

        return $payload;
    }
}