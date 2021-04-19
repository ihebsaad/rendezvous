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
];