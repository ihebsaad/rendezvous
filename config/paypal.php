<?php 
return [ 
    'client_id' => // test 'AalCYOUCLECAZi8JkWpRCQB6FDP1acLmsSWC0dKnF3R6dVORwWfo2YExwJFdwZI3qd8mS8ZIXvrvzYy6', //env('PAYPAL_CLIENT_ID',''),
   // 'AQhBOI4hV00Ad1KVimAgdA6uelgGBuRMAGmOhfJ9ETDZKsDATzwwKKnCjjnSCAfqb7fjfEFk4cisbp6_',
    'AalCYOUCLECAZi8JkWpRCQB6FDP1acLmsSWC0dKnF3R6dVORwWfo2YExwJFdwZI3qd8mS8ZIXvrvzYy6',
    'secret' => // test 'ENHh0jbRemqhawfb7LvSjAfV3bPuJ4s1f0dzdvI37FvjIf-tUnOFatwMwSsNw50k7rbGuThAgSsQ-aSi', //env('PAYPAL_SECRET',''),
  //  'EKIQ0nFX0aqJ4L4kodsY1FMAr6g3PH3TNc9fJ8IGyvcBoFAOw5XL1CPpk886lYQtnivgbaVWTC-WWb2-',
    'ENHh0jbRemqhawfb7LvSjAfV3bPuJ4s1f0dzdvI37FvjIf-tUnOFatwMwSsNw50k7rbGuThAgSsQ-aSi',
    'settings' => array(
         'mode' => 'sandbox', 
       // 'mode' => 'live',
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),

    'mode'    => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => 'haithemsahlia-facilitator_api1.gmail.com',
        'password'    => '525U34T2CMFFLM8M',
        'secret'      => 'AFcWxV21C7fd0v3bYYYRCpSSRl31Asdk19gDaL-QacT2J0j6GP6tpiYW',
        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),
        'app_id'      => 'APP-80W284485P519543T',    // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username'    => env('PAYPAL_LIVE_API_USERNAME', ''),
        'password'    => env('PAYPAL_LIVE_API_PASSWORD', ''),
        'secret'      => env('PAYPAL_LIVE_API_SECRET', ''),
        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
        'app_id'      => '',         // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can Only Be 'Sale', 'Authorization', 'Order'
    'currency'       => 'EUR',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'invoice_prefix' => env('PAYPAL_INVOICE_PREFIX', 'PAYPALDEMOAPP'),
];
 