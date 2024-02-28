<?php

namespace Notify\App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLogs extends Model
{

    protected $table = "log_emails";

    protected $fillable = [
        "from",
        "to",
        "subject",
        "message",
        "attachment",
        "_state",
        "schedule_time",
        "instant",
        "status"
    ];
}
