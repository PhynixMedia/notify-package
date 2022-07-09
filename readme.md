## NOTIFICATION MODULE 
### SEND NOTIFICATIONS AS EMAIL, SMS OR FCM
> Credentials are required so also there are some dependencies not included in this package. Please, also not that this is not a complete application and quite alont of more packages injection into this.

> Sending Email: requires:
```angular2html
$to    = "david4real_chris@yahoo.com";
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
$receiver    = "eafzQ0wd90JDnF1eTigajp:APA91bGvAFQDwi0z0SCLt5EjxA_5XNproeWcfzwLhrmPCeE3apnjg3W5MU3rWv51q58IWSZxLD1S7mPUk46j6qlCPu3isy2u213iNR1r8sA-fIEVAjFlQQr0Znp5uGS-CkWgJ8jsAxoM";
$message = "Testing Email Sender for application for the system we are sending for the library";
(new FcmService())->run($receiver, $message);
```