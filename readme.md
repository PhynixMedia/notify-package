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

> Sending Instant Email: requires:
```angular2html
$to    = "david_chris@yahoo.com";
$subject = "Hello Testing Email Sender";
$message = "Testing Email Sender for application for the system we are sending for the library";
(new EmailService())->runInstant($to, $subject, $message);
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
.ENV keys:

PHYNIX_EMAIL_SENDER="Company Ltd<send@phynixmedia.co.uk>"
PHYNIX_EMAIL_API=https://fault/US-Ea
PHYNIX_SMS_API=https://wnj0nvhmyClo
PHYNIX_FCM_SENDER_ID=AAAA1Sr-UqPOjqB5gazX9I8b
PHYNIX_SEND_COUNTER=10
PHYNIX_SENDER_CODE=CompanyL
````

> Run migrations
``` 

php artisan migrate --path=/vendor/phynix/notify/src/database/migrations/2022_06_23_140303_create_log_emails_table.php
php artisan migrate --path=/vendor/phynix/notify/src/database/migrations/2022_06_23_140433_create_log_fcm_table.php
php artisan migrate --path=/vendor/phynix/notify/src/database/migrations/2022_06_23_140433_create_log_sms_table.php
```