@extends('layouts.votreespacelayout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;

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
                    <h2>Paramètres</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Paramètres</li>
                            <li>Témoinages </li>
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
                           
                            <h3><i class="sl sl-icon-people"></i> Gestion des témoinages des clients</h3>
                        </div>
                       <?php use App\Temoinage; $temoinages=Temoinage::orderBy('id')->get();
            foreach($temoinages as $tem){
            ?>
                        <!-- Title -->
                        <div class="row with-forms">
                            <div class="col-md-12">
                                <a  class="delete fm-close" style="float: right; " onclick="return confirm('Êtes-vous sûrs ?')"   href="{{action('TemoinagesController@remove_temoinage', [ 'id'=>$tem->id ])}}"><i class="fa fa-remove"></i></a>
                            </div>
                            <div class="col-md-6">
                                <h5>Client</h5>
                                <input  type="text" idtem="<?php echo $tem->id; ?>" name="nom" placeholder="Nom du client" id="qp{{$tem->nom}}"  onchange="changing_tem(this)" required  value="<?php echo $tem->nom; ?>" />
                                <input  type="text"  idtem="<?php echo $tem->id; ?>" name="poste" placeholder="Poste du client" id="qp{{$tem->poste}}"  onchange="changing_tem(this)" required  value="<?php echo $tem->poste; ?>" />
                                
                            </div>
                            <div class="col-md-6">
                                <h5>Témoinage:</h5>
                                <textarea  type="text"  idtem="<?php echo $tem->id; ?>" class="textarea tex-com" placeholder="Contenu " name="texte" id="rp{{$tem->texte}}" onchange="changing_tem(this)" required><?php echo $tem->texte; ?></textarea>
                            </div>
                            
                        </div>
<?php } ?>
                        <!-- Description -->
                    
<div class="row with-forms">
                        <div class="col-md-12">
                                <a href="{{ route('parametre.TemoinagesClient') }}" class="button" style=" ">Ajouter</a>
                            </div>

                        </div>

                        <!-- Row / End -->
                    </div>
                    <!-- Section / End -->

                </div>
            </div>
            <div class="col-lg-12">

                <div id="add-listing">

                    <!-- Section -->
                    <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            
                            <h3><i class="sl sl-icon-people"></i> Gestion des témoinages des prestataires</h3>
                        </div>
                       <?php use App\TemoinagePrest; $temoinagesprest=TemoinagePrest::orderBy('id')->get();
            foreach($temoinagesprest as $temprest){
            ?>
                        <!-- Title -->

                        <div class="row with-forms">
                            <div class="col-md-12">
                                <a  class="delete fm-close" style="float: right; " onclick="return confirm('Êtes-vous sûrs ?')"   href="{{action('TemoinagesPrestController@remove_temoinage', [ 'id'=>$temprest->id ])}}"><i class="fa fa-remove"></i></a>
                            </div>
                            <div class="col-md-6">
                                <h5>Client</h5>
                                <input  type="text" idtem="<?php echo $temprest->id; ?>" name="nom" placeholder="Nom du prestataire" id="qpest{{$temprest->nom}}"  onchange="changing_temprest(this)" required  value="<?php echo $temprest->nom; ?>" />
                <input  type="text"  idtem="<?php echo $temprest->id; ?>" name="poste" placeholder="Poste du prestataire" id="qpest{{$temprest->poste}}"  onchange="changing_temprest(this)" required  value="<?php echo $temprest->poste; ?>" />
                                
                            </div>
                            <div class="col-md-6">
                                <h5>Témoinage:</h5>
                                <textarea  type="text"  idtem="<?php echo $temprest->id; ?>" class="textarea tex-com" placeholder="Contenu " name="texte" id="rpest{{$temprest->texte}}" onchange="changing_temprest(this)" required><?php echo $temprest->texte; ?></textarea>
                               
                            </div>
                           
                        </div>
<?php } ?>
                        <!-- Description -->
                    
<div class="row with-forms">

                            <!-- Type -->
                            <div class="col-md-12">
                                <a href="{{ route('parametre.TemoinagesPrestataire') }}" class="button" style=" ">Ajouter</a>
                            </div>

                        </div>
                        

                        <!-- Row / End -->
                    </div>
                    <!-- Section / End -->

                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
</div>
</div>

  <!--  modal pour ajouter un témoinage -->

       <div id="small-dialog" class=" zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Ajouter un témoinage</h3>
          </div>
  <form  method="post" enctype="multipart/form-data" action="{{ route('temoinages.store_temoinage') }}" >
      {{ csrf_field() }}
      
       <div class="utf_signin_form style_one">
        <label>Nom du client *: </label>
        <div class="fm-input">
        <input  type="text" id="nom_client" name="nom" required  />
      </div>
        <label>Poste du client *: </label>
      <div class="fm-input">
       <input  type="text" id="poste_client" name="poste" required  />
      </div>

       <label>Témoinage *: </label>
      <div class="fm-input">
       <textarea  type="text"  class="textarea tex-com"   id="texte_client" name="texte" required  ></textarea>
      </div>
         
      <br>
           <center><input type="submit" style="text-align:center;color:white;" value="Ajouter"></input></center>

      </form>       
     </div>     
     </div> 
@endsection('content')