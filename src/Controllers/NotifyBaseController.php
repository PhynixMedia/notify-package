<?php

namespace Notify\App\Controllers;

use App\Http\Controllers\Controller;
use Notify\App\Services\StatusService;
use Notify\App\Services\Email\EmailLogService;
use Notify\App\Services\Fcm\FcmLogService;
use Notify\App\Services\Sms\SmsLogService;

class NotifyBaseController extends Controller
{

    protected $statusService;
    protected $emailService;
    protected $smsService;
    protected $fcmService;
    protected $chatService;

    public function __construct(){

        date_default_timezone_set('Europe/London');

        $this->statusService = new StatusService();
        $this->emailService = new EmailLogService();
        $this->smsService = new SmsLogService();
        $this->fcmService = new FcmLogService();

    }
}