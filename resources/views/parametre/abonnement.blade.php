@extends('layouts.votreespacelayout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;

  ?>
  <?php
$parametres=DB::table('parametres')->where('id', 1)->first();
$apropos= $parametres->apropos;
$apropos_footer= $parametres->apropos_footer;
$contacter= $parametres->contacter;



$abonnement2= $parametres->abonnement2;
$cout_abonnement_annuel_classique= $parametres->cout_abon_annu_pricing;
$cout_abonnement_annuel_offrel= $parametres->cout_offrelancement3;

$abonnement3= $parametres->abonnement3;
$cout_abonnement_mensuel_classique= $parametres->cout_abon_mens_pricing;
$cout_abonnement_mensuel_offrel= $parametres->cout_offrelancement3_mens;
  

?>


  <!-- Dashboard -->
<div id="dashboard"> 
@include('layouts.back.bmenu')
<!-- Content
    ================================================== -->
<div class="dashboard-content">
<!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Paramètres </h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Paramètres </li>
                            <li>Abonnements</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        @if ($live_message = Session::get('ttmessage'))
           <div class="notification success closeable">
                <p>{{ $live_message }}</p>
                <a class="close" href="#"></a>
            </div>
            <?php Session::forget('ttmessage');  ?>
        @endif
        <div class="row">
            <div class="col-lg-12">

                <div id="add-listing">

                    <!-- Section -->
                    <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-folder-alt"></i> Abonnements</h3>
                        </div>
                        
                    
                    
                     <div class="row">
                    
                    <div class="col-md-3">
                        <label>Titre Abonnement annuel</label>                       
                        <input type="text" class="input-text"  id="abonnement2" placeholder="" value="<?php echo $abonnement2;?>"  onchange="changing(this)">
                    </div> 
                     <div class="col-md-3">
                        <label>Coût Offre Lancement </label>
                        <input type="number" class="input-text" id="cout_offrelancement3"  placeholder="" value="<?php echo $cout_abonnement_annuel_offrel;?>" onchange="changing(this)">                    
                    </div>                                     
                    <div class="col-md-3">
                        <label>Coût Plan Classique</label>
                        <input type="number" class="input-text" id="cout_abon_annu_pricing"  placeholder="" value="<?php echo $cout_abonnement_annuel_classique;?>" onchange="changing(this)">                    
                    </div>
                    <div class="col-md-3">
                        <a href="{{url('parametre/ModifierAbonnements/2')}}" class=" button " style="margin-top: 25px">Modifier le contenu </a>                  
                    </div>
                    
                    </div>

                     <div class="row">
                     
                     <div class="col-md-3">
                        <label>Titre Abonnement mensuel</label>                       
                        <input type="text" class="input-text"  id="abonnement3" placeholder="" value="<?php echo $abonnement3;?>"  onchange="changing(this)">
                    </div> 
                    <div class="col-md-3">
                        <label>Coût Offre Lancement </label>
                        <input type="number" class="input-text" id="cout_offrelancement3_mens"  placeholder="" value="<?php echo $cout_abonnement_mensuel_offrel;?>" onchange="changing(this)">                    
                    </div>                                     
                    <div class="col-md-3">
                        <label>Coût Plan Classique</label>
                        <input type="number" class="input-text" id="cout_abon_mens_pricing"  placeholder="" value="<?php echo $cout_abonnement_mensuel_classique;?>" onchange="changing(this)">                    
                    </div>
                    <div class="col-md-3">
                        <a href="{{url('parametre/ModifierAbonnements/3')}}" class=" button " style="margin-top: 25px">Modifier le contenu</a>              
                    </div>
                    
                    </div>
                    </div>
                    <!-- Section / End -->

                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
</div>
</div>
<script type="text/javascript">
    function changing(elm) {
        //alert("ok");
         var champ= elm.id;
         var val =document.getElementById(champ).value;
         
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('users.parametring') }}",
            method: "get",
            data: {champ: champ   ,val:val, _token: _token},
            success: function (data) {
                $('#'+champ).animate({
                    opacity: '0.3',
                });
                $('#'+champ).animate({
                    opacity: '1',
                });
                    swal({
                        type: 'success',
                        title: 'Modifié ...',
                        text: 'Contenu modifié avec succès'
                    //  icon: "success",
                    }); 
            }
        });
       
    }
</script>
@endsection('content')