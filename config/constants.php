<?php
use Carbon\Carbon;
$time = Carbon::now();

return [

    // A test value
    'test' => 1,

    // Camelot integration
    'camelot_webapp_url' => env('CAMELOT_WEB_SITE','www.camelot-italia.com'),

    // mail setup
    'dev_mail' => env('MAIL_DEV'),
    'admin_mail' => env('MAIL_ADMIN'),

];
