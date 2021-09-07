@extends('layouts.votreespacelayout')


 
@section('content')



  <?php 
  use \App\Http\Controllers\CategoriesController;
use \App\Http\Controllers\UsersController;
use \App\User;
  ?>
 <div id="dashboard"> 
@include('layouts.back.bmenu')

<div class="dashboard-content">
<input type="hidden" id="user" name="" value="{{$user->id}}">
    <!-- Titlebar -->
    <div id="titlebar">
      <div class="row">
        <div class="col-md-12">
          <h2>Portefeuille</h2>
          <!-- Breadcrumbs -->
          <nav id="breadcrumbs">
            <ul>
              <li>Portefeuille</li>
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
          <div class="dashboard-stat-content wallet-totals"><h4>{{$Somme[0]->somme}}</h4> <span>la somme gagnée <strong class="wallet-currency">EURO</strong></span></div>
          <div class="dashboard-stat-icon"><i class="im im-icon-Money-2"></i></div>
        </div>
      </div>
      <!-- Item -->
      <div class="col-lg-4 col-md-6">
        <div class="dashboard-stat color-3">

          <div class="dashboard-stat-content wallet-totals"><h4>{{$CA[0]->somme}}</h4> <span>Chiffre d’affaire (mensuelle) <strong class="wallet-currency">EURO</strong></span> </div>
          <div class="dashboard-stat-icon"><i class="im im-icon-Money-Bag"></i></div>
          <div class="" style="float: right;margin:5px 15px 5px 5px ;background-color: #ffae00"><b><span><a class="button"   onclick="downloadCSV()" style="background-color: #ffae00"><i class="fa fa-download" aria-hidden="true"></i> scv</a></span></b></div>
        </div>
      </div>

      <!-- Item -->
      <div class="col-lg-4 col-md-6">
        <div class="dashboard-stat color-2">
          <div class="dashboard-stat-content"><h4>{{$res[0]->nbr}}</h4> <span>Total das commandes (réservations)</span></div>
          <div class="dashboard-stat-icon"><i class="im im-icon-Shopping-Cart"></i></div>
        </div>
      </div>

    </div>

    <div class="row">
      
      <!-- Invoices -->
      <div class="col-lg-6 col-md-12">
        <div class="dashboard-list-box invoices with-icons margin-top-20">
          <h4>Revenues </h4>
          <ul>
            <?php foreach($revenues as $rev){ ?>
            <li><i class="list-box-icon sl sl-icon-basket"></i>
              <strong>{{$rev->details}}</strong>
              <ul>
                
                <li class="paid">Bénéfice net: <span>{{$rev->montant}}€</span></li>
                
                <li>Date: <?php  
                    $dateres = new DateTime($rev->created_at); echo $dateres->format('d/m/Y') ; ?></li>
              </ul>
              <ul>

                <li>Payer: <?php $clt=User::where('id',$rev->user)->first(); echo $clt->name;  ?></li>
              </ul>
            </li>
            <?php } ?> 
           

          </ul>
        </div>
      </div>
            
      <!-- Invoices -->
      <div class="col-lg-6 col-md-12">
        <div class="dashboard-list-box invoices with-icons margin-top-20">
          <a  href="#small-dialog" class="button popup-with-zoom-anim"  style="margin:15px 5px 5px 5px ; float: right;" >Définir la méthode de paiement</a> 

          <h4>Historique des paiements</h4>
          <ul>
             <?php foreach($payment as $pay){ ?>
            <li><i class="list-box-icon sl sl-icon-wallet"></i>
              <strong>{{$pay->montant}}€</strong>
              <ul>
                <li class="paid">payé</li>
                <li>Date: <?php  
                    $dateres = new DateTime($pay->created_at); echo $dateres->format('d/m/Y') ; ?></li>
                <li>Détails: {{$pay->details}}</li>
              </ul>
            </li>
               <?php } ?> 
            
    
          </ul>
        </div>
      </div>
      
    
    </div>

  </div>
  <!-- Content / End -->

</div>


   
  <!--  modal -->
<style type="text/css">
  a.disabled {
  pointer-events: none;
  cursor: default;
  background-color: #e4e4e4 ;
}

</style>
       <div id="small-dialog" class=" zoom-anim-dialog mfp-hide">
          <div class="small-dialog-header">
            <h3>Configuration de paiement</h3>
          </div>
          <div class="row">
       <div class="col-md-12" >
          <div class="col-md-12" >
            <h4> Connecter votre compte stripe (Obligatoire pour que les clients paient les acomptes et les restes).</h4>
          
          </div>
          <div class="col-md-12" >
            <a href="{{url('ConnectWithStripe')}}"  class="button  <?php if($user->id_stripe!=null){echo 'disabled';}?>" > </i>Connecter Avec Stripe</a>

            
        </div>
       
      <div class="col-md-10" >
        <label>Pourcentage d'acompte:</label>
        <input type="number" min="10" max="90" value="20" onchange="changeAcompte(this)" name="">
      </div>
        <div class="col-md-12" >
        <?php if(($user->type_abonn_essai && $user->type_abonn_essai=="type3" ) || ($user->type_abonn &&  $user->type_abonn=="type3" )) {  ?> 
       <?php  if($user->allow_slices){$checked='checked';} else{$checked='';}  ?>
       <label style="font-weight:normal;font-size:22px"> 
                <input style="width:20px;height:20px"  id="allow_slices"  type="checkbox"   <?php echo $checked; ?>   onchange="changing(this)"     >
        Permettre le paiement en 4 tranches pour les réservations de 200€ ou plus </label> 
          <br>
      </div><?php }?>

    </div></div>
                    
         </div>       
                  
             
        <!-- fin modal -->   
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
     <script type="text/javascript">

      function changeAcompte(a){
        var val = $(a).val();
        //alert($(a).val());
        var user = $('#user').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
                    url: "{{ route('changeAcompte') }}",
                    method: "get",
                    data: {user: user, val: val, _token: _token},
                    success: function (data) {
                       //alert("oui");
                       
             
         
          
                     }
          
                });
      
      }




        function changing(elm) {
               //alert("ok");
     var champ = elm.id;
       var val = document.getElementById(champ).value;
        
    // cas checkbox allow_slices    
   if(champ=='allow_slices'){
      if ($('#allow_slices').is(':checked'))
         {val=1;}else{val=0;} 
   }
                var user = $('#user').val();
               // alert("user="+user);
                //if ( (val != '')) {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('users.updating') }}",
                    method: "get",
                    data: {user: user, champ: champ, val: val, _token: _token},
                    success: function (data) {
                       //alert("oui");
                       swal({
                        type: 'success',
                        title: 'Modifié ...',
                        text: 'Modifié avec succès'
                    //  icon: "success",
                    }); 
             
         
          
                     }
          
                });

            }



    function downloadCSV(){
      Swal.fire({
  title: 'Cliquer sur la période',
  icon: 'info',
  html:
    '<a href="{{ route("downloadCSVday") }}"><b>Journalier</b></a> / <a href="{{ route("downloadCSVweek") }}"><b>Abdomadaire</b></a> / <a href="{{ route("downloadCSVmonth") }}"><b>Mensuel</b></a>/ <a href="{{ route("downloadCSVyear") }}"><b>Annuel</b></a> ' ,
  showDenyButton: false,
  showCancelButton: false,
  confirmButtonText: `Annuler`,
})

     /* Swal.fire(

  'sélectionner la période',
  'That thing is still around?',
  'question'
)*/
      /*alert("ok");
        //alert($(a).val());
        var user = $('#user').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
                    url: "{{ route('downloadCSV') }}",
                    method: "get",
                    data: {user: user, _token: _token},
                    success: function (data) {
                       alert("oui");
                       
             
         
          
                     }
          
                });*/
      }
     </script>
    
    
 @endsection

 

@section('footer_scripts')

 
@stop