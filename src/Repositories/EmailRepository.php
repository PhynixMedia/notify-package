<?php
namespace Notify\App\Repositories;

use App\Repositories\CoreRepository;
use Notify\App\Models\EmailLogs;

class EmailRepository extends CoreRepository
{
    public function __construct()
    {
        $this->model = new EmailLogs();
    }
}