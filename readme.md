## NOTIFICATION MODULE 
### SEND NOTIFICATIONS AS EMAIL, SMS OR FCM
> Credentials are required so also there are some dependencies not included in this package. Please, also not that this is not a complete application and quite alont of more packages injection into this.

> Sending Email: requires:
```angular2html
$to    = "david_chris@yahoo.com";
$subject = "Hello Testing Email Sender";
$message = "Testing Email Sender for application for the system we are sending for the library";
(new EmailService())->run($to, $subject, $message);
```

> Sending SMS requires:
```angular2html
$to    = "+447930152290";
$sms   = "Testing the new system for the applications Testing Email Sender for application for the system we are sending for the library Sender for application for the system we are sending for the library";
(new SmsService())->run($to, $sms);
(new SmsService())->runInstant($to, $sms);
```

> Sending FCM requires:
```angular2html
$receiver    = "-CkWgJ8jsAxoM";
$message = "Testing Email Sender for application for the system we are sending for the library";
(new FcmService())->run($receiver, $message);
```

> running cron job

```angular2html
Registering in Kernel:

Under Commands:

protected $commands = [
    'Notify\App\Command\SmsSender',
    'Notify\App\Command\EmailSender',
    'Notify\App\Command\FcmSender',
];

protected function schedule(Schedule $schedule)
{
    $schedule->command('notify:sms')->everyMinute();
    $schedule->command('notify:email')->everyMinute();
    $schedule->command('notify:fcm')->everyMinute();
}
```

````angular2html

````