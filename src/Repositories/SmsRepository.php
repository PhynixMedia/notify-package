<?php
namespace Notify\App\Repositories;

use App\Repositories\CoreRepository;
use Notify\App\Models\SMSLog;

class SmsRepository extends CoreRepository
{
    public function __construct()
    {
        $this->model = new SMSLog();
    }
}