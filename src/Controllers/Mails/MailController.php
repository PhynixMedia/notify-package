<?php

namespace Cms\App\Controllers\Pages;

use Cms\App\Controllers\BaseController;
use Cms\App\Models\Pages\Relations\BlogRelations;
use Illuminate\Http\Request;
use Notify\App\Controllers\NotifyBaseController;

class MailController extends NotifyBaseController {

    const EMAILS    = "mails";
    const SMS       = "sms";
    const FCM       = "fcm";
    public function __construct(){

        parent::__construct();
    }

    public function all($target){

        switch ($target) {
            case self::EMAILS:
                if ($records = $this->emailService->fetch([])) {
                    return response()->json($this->statusService::success("Fetch", $records->toArray()));
                }
            break;
            case self::SMS:
                if($records =  $this->smsService->fetch([])){
                    return response()->json($this->statusService::success("Fetch", $records->toArray()));
                }
            break;
            case self::FCM:
                if($records =  $this->fcmService->fetch([])){
                    return response()->json($this->statusService::success("Fetch", $records->toArray()));
                }
            break;
        }

        return response()->json($this->statusService::error("Fetch"));
    }

    public function get($target, $identifier){

        $params = ["id"=>$identifier];

        switch ($target) {
            case self::EMAILS:
                if ($records = $this->emailService->fetchOne($params)) {
                    return response()->json($this->statusService::success("Fetch", $records->toArray()));
                }
                break;
            case self::SMS:
                if($records =  $this->smsService->fetchOne($params)){
                    return response()->json($this->statusService::success("Fetch", $records->toArray()));
                }
                break;
            case self::FCM:
                if($records =  $this->fcmService->fetchOne($params)){
                    return response()->json($this->statusService::success("Fetch", $records->toArray()));
                }
                break;
        }

        return response()->json($this->statusService::error("Fetch"));
    }

    public function find(Request $request, $target)
    {

        $where = $request->get('target') ?? [];
        $fetch = $request->get("total");

        switch ($target) {
            case self::EMAILS:

                if ($fetch == 1) {

                    if ($records = $this->emailService->fetchOne($where)) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                } else {
                    if ($records = $this->emailService->fetch([])) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                }
                break;
            case self::SMS:

                if ($fetch == 1) {

                    if ($records = $this->smsService->fetchOne($where)) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                } else {
                    if ($records = $this->smsService->fetch([])) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                }
                break;
            case self::FCM:

                if ($fetch == 1) {

                    if ($records = $this->fcmService->fetchOne($where)) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                } else {
                    if ($records = $this->fcmService->fetch([])) {
                        return response()->json($this->statusService::success("Fetch", $records->toArray()));
                    }
                }
                break;
        }

        return response()->json($this->statusService::error("Fetch"));
    }


    public function store(Request $request, $target)
    {
        switch ($target) {
            case self::EMAILS:
                $payload = $this->emailService->prepare($request, true);
                $payload["status"] = 1;
                if (!$this->emailService->set(map_request($payload))) {
                    return response()->json($this->statusService::error("Create"));
                }
                if ($records = $this->emailService->fetch([])) {
                    return response()->json($this->statusService::success("Create", $records->toArray()));
                }
                break;
            case self::SMS:
                $payload = $this->smsService->prepare($request, true);
                $payload["status"] = 1;
                if (!$this->smsService->set(map_request($payload))) {
                    return response()->json($this->statusService::error("Create"));
                }
                if ($records = $this->smsService->fetch([])) {
                    return response()->json($this->statusService::success("Create", $records->toArray()));
                }
                break;
            case self::FCM:
                $payload = $this->fcmService->prepare($request, true);
                $payload["status"] = 1;
                if (!$this->fcmService->set(map_request($payload))) {
                    return response()->json($this->statusService::error("Create"));
                }
                if ($records = $this->fcmService->fetch([])) {
                    return response()->json($this->statusService::success("Create", $records->toArray()));
                }
                break;
        }

        return response()->json($this->statusService::error("Fetch"));
    }

    public function update(Request $request, $target)
    {
        try {

            $where = $request->get("target") ?? [];
            $data = $request->get("data") ?? [];

            \Log::info("Update Payload::: " . json_encode($request->all()));

            switch ($target) {
                case self::EMAILS:
                    if (!$records = $this->emailService->update($data, $where)) {
                        return response()->json($this->statusService::error("Update Email"));
                    }
                    break;
                case self::SMS:
                    if (!$records = $this->smsService->update($data, $where)) {
                        return response()->json($this->statusService::error("Update SMS"));
                    }
                    break;
                case self::FCM:
                    if (!$records = $this->fcmService->update($data, $where)) {
                        return response()->json($this->statusService::error("Update Template"));
                    }
                    break;
            }

            return response()->json($this->statusService::success("Update"));

        }catch (\Exception $e){
            return response()->json($this->statusService::error("Update Job"));
        }
    }

    public function delete($target, $identifier )
    {

        $data = ["status"=>0];
        $where = ["id"=> $identifier];

        switch ($target) {
            case self::EMAILS:
                if (!$records = $this->emailService->update($data, $where)) {
                    return response()->json($this->statusService::error("Update Email"));
                }
                break;
            case self::SMS:
                if (!$records = $this->smsService->update($data, $where)) {
                    return response()->json($this->statusService::error("Update SMS"));
                }
                break;
            case self::FCM:
                if (!$records = $this->fcmService->update($data, $where)) {
                    return response()->json($this->statusService::error("Update Template"));
                }
                break;
        }

        return response()->json($this->statusService::success("Delete"));
    }
}
