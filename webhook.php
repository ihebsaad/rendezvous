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

// This is your Stripe CLI webhook secret for testing your endpoint locally.
$endpoint_secret = 'whsec_rwPn2MsYhTNgrGqNu6jnbVPFvQlzxnQY';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
  $event = \Stripe\Webhook::constructEvent(
    $payload, $sig_header, $endpoint_secret
  );
  $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = "Mickey Mouse\n";
fwrite($myfile, $txt);
$txt = "Minnie Mouse\n";
fwrite($myfile, $txt);
fclose($myfile);
} catch(\UnexpectedValueException $e) {
  // Invalid payload
  http_response_code(400);
  exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
  // Invalid signature
  http_response_code(400);
  exit();
}

// Handle the event
switch ($event->type) {
  case 'payment_intent.amount_capturable_updated':
    $paymentIntent = $event->data->object;
  case 'payment_intent.canceled':
    $paymentIntent = $event->data->object;
  case 'payment_intent.created':
    $paymentIntent = $event->data->object;
  case 'payment_intent.payment_failed':
    $paymentIntent = $event->data->object;
  case 'payment_intent.processing':
    $paymentIntent = $event->data->object;
  case 'payment_intent.requires_action':
    $paymentIntent = $event->data->object;
  case 'payment_intent.succeeded':
    $paymentIntent = $event->data->object;
  // ... handle other event types
  default:
    echo 'Received unknown event type ' . $event->type;
}

http_response_code(200);