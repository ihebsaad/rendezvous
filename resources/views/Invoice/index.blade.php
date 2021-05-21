<!DOCTYPE html>
<html lang="zxx">
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Facture - Prenez un rendez vous</title>


<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('public/img/favicon.ico') }}"  >
<!-- Style CSS -->

<link href="{{ URL::asset('public/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/css/invoice.css') }}" rel="stylesheet">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&display=swap&subset=latin-ext,vietnamese" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800" rel="stylesheet" type="text/css">
</head>
<body>
<a href="javascript:window.print()" class="print-button">Imprimer</a> 
<!-- Invoice -->
<div id="invoice"> 
  <div class="row">
    <div class="col-md-6">
      <div id="logo"><img src="{{ URL::asset('storage/images/logo.png') }}" alt=""></div>
    </div>
    <div class="col-md-6">
      <p id="details"> 
	    <strong>Prenezunrendezvous.com</strong><br>
		<strong>Email:-</strong> trouvezunprestataire@gmail.com <br>
        <!--<strong>Numéro de téléphone:-</strong> +1 (0123) 456 7890-->
      </p>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-12">
      <h2 class="invoice_title">Facture</h2>
    </div>
    <div class="col-md-6">
      <p><strong>Facturé à:</strong><br>
        {{ $client }}<br> {{ $emailclient }}
      </p>
    </div>
    <div class="col-md-6 fl_right"> 
      <p><strong>Prestataire:</strong><br>
        {{ $prestataire }} <br> 
      </p>
    </div>
    <div class="col-md-12">
    </div>
	<div class="col-md-6">
      <p><strong>Méthode de paiement:</strong><br>
        Paypal<br>
		{{ $emailPaypal }}
      </p>
    </div>
    <div class="col-md-6 fl_right"> 
      <p><strong>Date de rendez-vous:</strong><br>
        {{ $date }} {{ $heure }} 
      </p>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-12">
      <table class="margin-top-20">
        <tr>
          <th>Services et Produits</th>
          <th>Quantité</th>
          <th>Prix</th>
        </tr>
        <?php //dd(is_array($reservation->services_reserves)); 
            if (is_array($reservation->services_reserves)) {
              $servicesres = $reservation->services_reserves;
            }else {
              $servicesres = json_encode($reservation->services_reserves);
            }



            foreach ($servicesres as $servicesre) {
             // echo $servicesres;
              echo  '<tr><td>'.DB::table('services')->where('id', $servicesre )->value('nom').'</td>';
              echo "<td>1</td>";
             echo '<td>'.DB::table('services')->where('id', $servicesre )->value('prix')."€ ";
             
             if ($reservation->recurrent==1) {
            echo " <b>abonnement</b>" ;
          }
          echo "</td><tr>";
            } ?>

            <?php $idproduits = DB::select( DB::raw("SELECT id_products as ids , quantity as qty FROM client_products s WHERE s.id_reservation='+$reservation->id+'" ) );
              foreach ($idproduits as $idp) {

               echo  '<tr><td>'.DB::table('produits')->where('id', $idp->ids )->value('nom_produit').'</td>';
               echo  '<td>'.$idp->qty.'</td>';
               echo '<td>'.DB::table('produits')->where('id', $idp->ids )->value('prix_unité')."€ ";
               echo "</td><tr>";
              }



               ?>



      </table>
    </div>
    <div class="col-md-12">
      <table id="totals">
		<tr>
          <th>Montant</th>
          <th><span>€{{ $reservation->montant_tot }}</span></th>
        </tr>
        <tr>
          <th>Remise</th>
          <th><span>€{{ $reservation->Remise }}</span></th>
        </tr>
		<tr>
          <th>Total </th>
          <th><span>€{{ $reservation->Net }}</span></th>
        </tr>
      </table>
    </div>
    <div class="col-md-6 "> 
<br> <?php if ($reservation->serv_suppl != null) { ?>
  <p><b>Cadeaux:</b>
        {{ $reservation->serv_suppl }} <br> 
      </p>
<?php } ?>
      
    </div>
  </div>
</div>
</body>
</html>