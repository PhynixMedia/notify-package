<?php

namespace Notify\App\Models;

use Illuminate\Database\Eloquent\Model;

class SMSLog extends Model
{

    protected $table = "log_sms";

    protected $fillable = [
        "to",
        "sms",
        "_state",
        "schedule_time",
        "instant",
        "page_count",
        "status"
    ];
}