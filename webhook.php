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
    echo 'Received unknown event type ' . $event->lines->data->subscription;
}

http_response_code(200);