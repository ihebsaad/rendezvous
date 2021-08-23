@extends('layouts.votreespacelayout')

 <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/buttons.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/scroller.bootstrap.css') }}" />

 
@section('content')


<style type="text/css">
 
      @media only screen
    and (min-device-width : 0px)
    and (max-device-width : 480px) {
     .sizeA
     {
      width: 86vw;
     } 
     .sizeB
     {
      height: 100px;
     }    
    }
    @media only screen
    and (min-device-width : 1024px)
     {
     .sizeA
     {
      width: 100%;
     } 
     .sizeB
     {
      height:  800px;
     }    
    }
    @media only screen
    and (max-device-width : 1023px)
    and (min-device-width : 600px)
     {
     .sizeA
     {
      width: 100vw;
     } 
     .sizeB
     {
      height:  800px;
     }    
    }
     @media only screen
    and (max-device-width : 600px)
    and (min-device-width : 450px)
     {
     .sizeA
     {
      width: 50vw;
     }  
     .sizeB
     {
      height: 100px;
     }   
    }
             </style>
  <?php 
  use \App\Http\Controllers\CategoriesController;

  ?>
 <div id="dashboard"> 
@include('layouts.back.bmenu')

<div class="dashboard-content">

    <!-- Titlebar -->
    <div id="titlebar">
      <div class="row">
        <div class="col-md-12">
          <h2>Wallet</h2>
          <!-- Breadcrumbs -->
          <nav id="breadcrumbs">
            <ul>
              <li><a href="#">Home</a></li>
              <li>Dashboard</li>
              <li>Wallet</li>
            </ul>
          </nav>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="row">

      <!-- Item -->
      <div class="col-lg-4 col-md-6">
        <div class="dashboard-stat color-1">
          <div class="dashboard-stat-content wallet-totals"><h4>84.50</h4> <span>Solde retirable <strong class="wallet-currency">USD</strong></span></div>
          <div class="dashboard-stat-icon"><i class="im im-icon-Money-2"></i></div>
        </div>
      </div>
      <!-- Item -->
      <div class="col-lg-4 col-md-6">
        <div class="dashboard-stat color-3">
          <div class="dashboard-stat-content wallet-totals"><h4>245.15</h4> <span>Gains totaux <strong class="wallet-currency">USD</strong></span></div>
          <div class="dashboard-stat-icon"><i class="im im-icon-Money-Bag"></i></div>
        </div>
      </div>

      <!-- Item -->
      <div class="col-lg-4 col-md-6">
        <div class="dashboard-stat color-2">
          <div class="dashboard-stat-content"><h4>3</h4> <span>Total das commandes (réservations)</span></div>
          <div class="dashboard-stat-icon"><i class="im im-icon-Shopping-Cart"></i></div>
        </div>
      </div>

    </div>

    <div class="row">
      
      <!-- Invoices -->
      <div class="col-lg-6 col-md-12">
        <div class="dashboard-list-box invoices with-icons margin-top-20">
          <h4>Gains <div class="comission-taken">Fee: <strong>15%</strong></div></h4>
          <ul>
            
            <li><i class="list-box-icon sl sl-icon-basket"></i>
              <strong>Appartement Sunway</strong>
              <ul>
                <li class="paid">$99.00</li>
                <li class="unpaid">Frais: $14.50</li>
                <li class="paid">Bénéfice net: <span>$84.50</span></li>
                <li>Commande: #00124</li>
                <li>Date: 01/02/2019</li>
              </ul>
            </li>
            
            <li><i class="list-box-icon sl sl-icon-basket"></i>
              <strong>Appartement Sunway</strong>
              <ul>
                <li class="paid">$67.00</li>
                <li class="unpaid">Frais: $10.05</li>
                <li class="paid">Bénéfice net: <span>$56.95</span></li>
                <li>Commande: #00123</li>
                <li>Date: 22/01/2019</li>
              </ul>
            </li>
            
            <li><i class="list-box-icon sl sl-icon-basket"></i>
              <strong>Appartement Sunway</strong>
              <ul>
                <li class="paid">$122.00</li>
                <li class="unpaid">Frais: $18.30</li>
                <li class="paid">Bénéfice net: <span>$103.70</span></li>
                <li>Commande: #00122</li>
                <li>Date: 18/01/2019</li>
              </ul>
            </li>

          </ul>
        </div>
      </div>
            
      <!-- Invoices -->
      <div class="col-lg-6 col-md-12">
        <div class="dashboard-list-box invoices with-icons margin-top-20">
          <h4>Historique des paiements</h4>
          <ul>
            
            <li><i class="list-box-icon sl sl-icon-wallet"></i>
              <strong>$84.50</strong>
              <ul>
                <li class="unpaid">Non payé</li>
                <li>Période: 02/2019</li>
              </ul>
            </li>
                
            <li><i class="list-box-icon sl sl-icon-wallet"></i>
              <strong>$189.20</strong>
              <ul>
                <li class="paid">Payé</li>
                <li>Période: 01/2019</li>
              </ul>
            </li>
    
          </ul>
        </div>
      </div>
      
    
    </div>

  </div>
  <!-- Content / End -->

</div>


   
   

    
 @endsection

 

@section('footer_scripts')

 
@stop