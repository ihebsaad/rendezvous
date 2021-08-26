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

$abonnement1= $parametres->abonnement1;
$cout_abonnement1= $parametres->cout_abonnement1;
$commission_abonnement1= $parametres->commission_abonnement1;

$abonnement2= $parametres->abonnement2;
$cout_abonnement2= $parametres->cout_abonnement2;
$commission_abonnement2= $parametres->commission_abonnement2;

$abonnement3= $parametres->abonnement3;
$cout_abonnement3= $parametres->cout_abonnement3;
$commission_abonnement3= $parametres->commission_abonnement3;
  

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
                    <h2>Mon entreprise</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Mon entreprise</li>
                            <li>Titre & Description</li>
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

                    <div class="col-md-6">
                        <label>Titre Abonnement 1</label>                       
                        <input type="text" class="input-text" id="abonnement1" placeholder="" value="<?php echo $abonnement1;?>"  onchange="changing(this)">
                    </div>
                    <div class="col-md-3">
                        <label> Coût</label>                        
                        <input type="number" class="input-text" id="cout_abonnement1" placeholder="" value="<?php echo $cout_abonnement1;?>" onchange="changing(this)">
                    </div>
                    <div class="col-md-3">
                        <a href="{{url('parametre/ModifierAbonnements/1')}}" class=" button " style="margin-top: 25px">Modifier le contenu</a>
                    </div>
                    
                    </div>
                    
                    
                     <div class="row">
                    
                    <div class="col-md-6">
                        <label>Titre Abonnement 2</label>                       
                        <input type="text" class="input-text"  id="abonnement2" placeholder="" value="<?php echo $abonnement2;?>"  onchange="changing(this)">
                    </div>                                      
                    <div class="col-md-3">
                        <label>Coût </label>
                        <input type="number" class="input-text" id="cout_abonnement2"  placeholder="" value="<?php echo $cout_abonnement2;?>" onchange="changing(this)">                    
                    </div>
                    <div class="col-md-3">
                        <a href="{{url('parametre/ModifierAbonnements/2')}}" class=" button " style="margin-top: 25px">Modifier le contenu</a>                  
                    </div>
                    
                    </div>

                     <div class="row">
                     
                     <div class="col-md-6">
                        <label>Titre Abonnement 3</label>                       
                        <input type="text" class="input-text"  id="abonnement3" placeholder="" value="<?php echo $abonnement3;?>"  onchange="changing(this)">
                    </div>                                      
                    <div class="col-md-3">
                        <label>Coût </label>
                        <input type="number" class="input-text" id="cout_abonnement3"  placeholder="" value="<?php echo $cout_abonnement3;?>" onchange="changing(this)">                    
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