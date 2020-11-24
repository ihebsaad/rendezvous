<?php 
return [ 
    'client_id' => 'AalCYOUCLECAZi8JkWpRCQB6FDP1acLmsSWC0dKnF3R6dVORwWfo2YExwJFdwZI3qd8mS8ZIXvrvzYy6' //env('PAYPAL_CLIENT_ID',''),
    'secret' => 'ENHh0jbRemqhawfb7LvSjAfV3bPuJ4s1f0dzdvI37FvjIf-tUnOFatwMwSsNw50k7rbGuThAgSsQ-aSi' //env('PAYPAL_SECRET',''),
    'settings' => array(
        'mode' => 'sandbox' // env('PAYPAL_MODE','sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
];