<?php 
return [ 
    'client_id' => // test 'AalCYOUCLECAZi8JkWpRCQB6FDP1acLmsSWC0dKnF3R6dVORwWfo2YExwJFdwZI3qd8mS8ZIXvrvzYy6', //env('PAYPAL_CLIENT_ID',''),
   // 'AQhBOI4hV00Ad1KVimAgdA6uelgGBuRMAGmOhfJ9ETDZKsDATzwwKKnCjjnSCAfqb7fjfEFk4cisbp6_',
    'AThjz56X69vxz_voqkSvfOaCPslWkDa6mwdZF4Pe7jqKG_qN9iA8L09Kapl1fpUVVfpnjM5b06qttYY-',
    'secret' => // test 'ENHh0jbRemqhawfb7LvSjAfV3bPuJ4s1f0dzdvI37FvjIf-tUnOFatwMwSsNw50k7rbGuThAgSsQ-aSi', //env('PAYPAL_SECRET',''),
  //  'EKIQ0nFX0aqJ4L4kodsY1FMAr6g3PH3TNc9fJ8IGyvcBoFAOw5XL1CPpk886lYQtnivgbaVWTC-WWb2-',
    'EM10ylTG8nI5JGyMQKkADrS_ZRg0lTYNdJVPJrTuPLrb_91X0R4cASKrYZSnwLKQ-tGrEuO3A5vqVGfx',
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
        'username'    => 'saadiheb_api1.gmail.com',
        'password'    => 'J2J8R3JNCRMAMWMK',
        'secret'      => 'A7wBk1nTUygtTdre6D4nQ-L4GhurAZfz8rkfxbcTR-zr7F1jswZCno.h',
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
 