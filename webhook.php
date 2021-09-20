<?php
// webhook.php
//
// Use this sample code to handle webhook events in your integration.
//
// 1) Paste this code into a new file (webhook.php)
//
// 2) Install dependencies
//   composer require stripe/stripe-php
//
// 3) Run the server on http://localhost:4242
//   php -S localhost:4242

require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51IyZEOLYsTAPmLSFOUPFtTTEusJc2G7LSMDZEYDxBsv0iJblsOpt1dfaYu8PrEE6iX6IX7rCbpifzhdPfW7S0lzA007Y8kjGAx');
// This is your Stripe CLI webhook secret for testing your endpoint locally.
$endpoint_secret = 'whsec_xKKyAxoEUKpozExCw8I0anJj9PpBKCcD';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
//dd($sig_header);
$event = null;

try {
  $event = \Stripe\Webhook::constructEvent(
    $payload, $sig_header, $endpoint_secret
  );

} catch(\UnexpectedValueException $e) {
  // Invalid payload
  http_response_code(400);
  exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
  // Invalid signature
  //dd($e);
  http_response_code(400);
  exit();
}

// Handle the event
switch ($event->type) {
  case 'customer.subscription.created':
  {
    $customer = $event->data->object;
  };
  case 'customer.subscription.deleted':
  {
    echo "offfff" ;
   
    //$customer = $event->data->object;
  };
  case 'customer.subscription.updated':
  {
    $customer = $event->data->object;
  };
  case 'invoice.payment_failed':
  {
  if ($event->lines->data->subscription==null) {

    http_response_code(200);
  exit();
  } else {
    $servername = 'localhost:3306';
            $username = 'rendezvoususer';
            $password = '!h9gv2P1';
            $dbname = "rendezvous";
            
            //On établit la connexion
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            //On vérifie la connexion
            if($conn->connect_error){
                die('Erreur : ' .$conn->connect_error);
            }

            $sql = "UPDATE abonnements SET invoice=0 WHERE IdStripe=".$event->lines->data->subscription."";
            if ($conn->query($sql) === TRUE) {
              //echo "Record updated successfully";
            } else {
              //echo "Error updating record: " . $conn->error;
            }

    //$invoice = $event->data->object;
  }};
  // ... handle other event types
  default:
    echo 'Received unknown event type ' . $event->lines->data->subscription;
}

http_response_code(200);