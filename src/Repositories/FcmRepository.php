<?php
namespace Notify\App\Repositories;

use App\Repositories\CoreRepository;
use Notify\App\Models\FCMLog;

class FcmRepository extends CoreRepository
{
    public function __construct()
    {
        $this->model = new FCMLog();
    }
}