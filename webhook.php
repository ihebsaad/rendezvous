<?php

use DateTime;
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


require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51IyZEOLYsTAPmLSFOUPFtTTEusJc2G7LSMDZEYDxBsv0iJblsOpt1dfaYu8PrEE6iX6IX7rCbpifzhdPfW7S0lzA007Y8kjGAx');
// This is your Stripe CLI webhook secret for testing your endpoint locally.
$endpoint_secret = 'whsec_wJs1HzAXjKFqonTRUOojoAP4NzzMdkAL';

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
if ($event->type=='customer.subscription.created') {
  $customer = $event->data->object;
}
elseif ($event->type=='customer.subscription.deleted') {
  echo "Record updated successfully";
  $sql = "SELECT * FROM `abonnements` WHERE IdStripe='".$event->data->object->id."'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result -> fetch_assoc();
    $id = $row["id"];
    $dateAbn=$row["created_at"];

}
echo $dateAbn ;
//$id=DB::table('abonnements')->where('IdStripe', $event->lines->data->subscription)->value('id');
  $todayy = date('Y-m-d H:i:s');
  //$dateAbn=DB::table('abonnements')->where('id', $id)->value('created_at');
      //$dateAbn=DB::table('abonnements')->where('id', $id)->value('created_at');
      $dateAbn = new DateTime("2021-10-07 13:14:19");
      echo $dateAbn;
      $date = $dateAbn->format('Y-m-d H:i:s');
        $today= new DateTime();
        $m = $dateAbn->format('n');
        $x = $today->format('n');
        $interval = date_diff($dateAbn, $today)->m;
        $y = date('Y-m-d H:i:s', strtotime($date. ' + '.$interval.' month'));
        if ($todayy > $y) {
          //dd("ok");
          $y = date('Y-m-d H:i:s', strtotime($y. ' + 1 month'));
        }
        $sql = "UPDATE abonnements SET expire=".$y." WHERE IdStripe='".$event->data->object->id."'";
         if ($conn->query($sql) === TRUE) {
              //echo "Record updated successfully";
            } else {
              //echo "Error updating record: " . $conn->error;
            }
        $sql = "UPDATE abonnements SET statut='annuler' WHERE IdStripe='".$event->data->object->id."'";
         if ($conn->query($sql) === TRUE) {
              //echo "Record updated successfully";
            } else {
              //echo "Error updating record: " . $conn->error;
            }
}
elseif ($event->type=='invoice.payment_succeeded') {
  if ($event->data->object->subscription==null) {
echo "null";
    http_response_code(200);
  exit();
  } else {
    $sql = "SELECT * FROM `abonnements` WHERE IdStripe='".$event->data->object->subscription."'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              $row = $result -> fetch_assoc();
              $invoice = $row["invoiceId"]; 
              $invo = $row["invoice"]; 
              $iduser =  $row["user"]; 

          }
          if ($invo==1) {
            http_response_code(200);
            exit();
          } else {
            $AInvoice = "".$event->data->object->id."";
           
            if ($invoice==$AInvoice) {
              echo "oiiiiiiiiiiiiii";
              $sql = "UPDATE abonnements SET invoice=1 WHERE IdStripe='".$event->data->object->subscription."'";
            if ($conn->query($sql) === TRUE) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . $conn->error;
            }
            $sql = "UPDATE abonnements SET invoiceId=null WHERE IdStripe='".$event->data->object->subscription."'";
            if ($conn->query($sql) === TRUE) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . $conn->error;
            }
            $sql = "UPDATE users SET invoiceStripe=1 WHERE id='".$iduser."'";
            if ($conn->query($sql) === TRUE) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . $conn->error;
            }
          $sql = "UPDATE users SET invoiceLink=null WHERE id='".$iduser."'";
            if ($conn->query($sql) === TRUE) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . $conn->error;
            }


            }else{
              echo "null2";
    http_response_code(200);
            }

          }

  }
}
elseif ($event->type=='invoice.payment_failed') {
  //echo ($event->data->object->subscription);
  if ($event->data->object->subscription==null) {
echo "null";
    http_response_code(200);
  exit();
  } else {
    $sql = "SELECT * FROM `abonnements` WHERE IdStripe='".$event->data->object->subscription."'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              $row = $result -> fetch_assoc();
              $invoice = $row["invoiceId"];  

          }
          if ($invoice != null && $invoice !=$event->data->object->id) {
            echo "okkkkkk ";
           
\Stripe\Stripe::setApiKey('sk_test_51IyZEOLYsTAPmLSFOUPFtTTEusJc2G7LSMDZEYDxBsv0iJblsOpt1dfaYu8PrEE6iX6IX7rCbpifzhdPfW7S0lzA007Y8kjGAx');

$invoice = \Stripe\Invoice::retrieve($invoice);
$invoice->voidInvoice();
            
          }

    

            $sql = "UPDATE abonnements SET invoice=0 WHERE IdStripe='".$event->data->object->subscription."'";
            if ($conn->query($sql) === TRUE) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . $conn->error;
            }
            $sql = "UPDATE abonnements SET invoiceId='".$event->data->object->id."' WHERE IdStripe='".$event->data->object->subscription."'";
            if ($conn->query($sql) === TRUE) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . $conn->error;
            }



            $sql = "SELECT * FROM `abonnements` WHERE IdStripe='".$event->data->object->subscription."'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              $row = $result -> fetch_assoc();
              $iduser = $row["user"];  

          }
          $sql = "UPDATE users SET invoiceStripe=0 WHERE id='".$iduser."'";
            if ($conn->query($sql) === TRUE) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . $conn->error;
            }
          $sql = "UPDATE users SET invoiceLink='".$event->data->object->hosted_invoice_url."' WHERE id='".$iduser."'";
            if ($conn->query($sql) === TRUE) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . $conn->error;
            }

    //$invoice = $event->data->object;
  }
}

http_response_code(200);