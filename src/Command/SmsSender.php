<?php
namespace Notify\App\Command;

use Illuminate\Console\Command;
use Notify\App\Events\SmsEvent;

class SmsSender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send user update newsletter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        event(new SmsEvent());
    }
}