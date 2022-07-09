<?php

namespace Notify\App\Models;

use Illuminate\Database\Eloquent\Model;

class FCMLog extends Model
{

    protected $table = "log_fcm";

    protected $fillable = [
        "receiver", // this must be encrypted
        "message",
        "_state",
        "schedule_time",
        "instant",
        "status"
    ];
}