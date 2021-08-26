@extends('layouts.backlayout')
 
 @section('content')
<!-- Dashboard -->
<div id="dashboard"> 
@include('layouts.back.menu')

<!-- include summernote css/js 
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet"> 
<link href="{{ URL::asset('public/css/summernote.css') }}"  rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

<script  src="{{ URL::asset('public/js/summernote.min.js') }}"  type="text/javascript"></script>
<script src="{{  URL::asset('public/js/compose.js') }}" type="text/javascript"></script>
---> 
 <div class="utf_dashboard_content"> 
 
<!-- Session errors -->
 @if ($errors->any())
             <div class="alert alert-danger">
                 <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div><br />
 @endif
 @if (!empty( Session::get('success') ))
              <div class="notification success closeable margin-bottom-30">
            <p>{{ Session::get('success') }}</p>
            <a class="close" href="#"></a> 
		  </div>
 @endif	  
	  


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

     {{ csrf_field() }}

	 
	 
		 <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-folder-alt"></i> Abonnements</h3>
              </div>  
				    <div class="row with-forms">
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
						<a href="#Abonnement1" class="pull-right button popup-with-zoom-anim" style="margin-top: 25px">Modifier le contenu</a>
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
						<a href="#Abonnement2" class="pull-right button popup-with-zoom-anim" style="margin-top: 25px">Modifier le contenu</a>					
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
						<a href="#Abonnement3" class="pull-right button popup-with-zoom-anim" style="margin-top: 25px">Modifier le contenu</a> 				
					</div>
					
					</div>
					
					</div>	
					
		 </div>					
	  
 <!---------------------------------------modal--------------------------------------------------->
          <div id="Abonnement1" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Abonnement 1</h3>
          </div>
          <div class="utf_price_plan_features">
            <ul style="padding-bottom: 5px">
              <?php  foreach($abonnementA as $ab) { 
                       echo  '<li><span id="a'.$ab->id.'">'.$ab->contenu.'</span> <a href="javascript:void(0)"  onclick="supprimeLinge('.$ab->id.')"><i class="sl sl-icon-trash" style="color:red"></i></a> <a href="javascript:void(0)" att="a" onclick="modifLinge('.$ab->id.',this)"><i class="sl sl-icon-note" style="color:red"></i></a></li>' ; 
                     
                  
                   } ?>
                 </ul>

                            
     </div> 
     <form action="{{ route('users.editPlan') }}" method="get" > 
     <div id="Modifa">
     <textarea type="text" name="contenuPlan" placeholder="Ajouter une ligne "></textarea>
     </div><br>
     <input type="" name="abonnement" hidden="hidden" value="1">
     <input type="" name="idligne" id="idlignea" hidden="hidden" value="0">
     <div>
     <input type="submit" id="buttonSubmita" value="Ajouter" name=""> 
     <a class="button annuler1" id="annulera" att2="a" style="background-color: red;display: none;float: right;">Annuler</a>
</div>
</form>
     </div> 
	 

  <!------------------------------------Abonnement2------------------------------------------------------>
  <div id="Abonnement2" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Abonnement 2</h3>
          </div>
          <div class="utf_price_plan_features">
            <ul style="padding-bottom: 5px">
              <?php  foreach($abonnementB as $ab) { 
                       echo  '<li><span id="b'.$ab->id.'">'.$ab->contenu.'</span> <a href="javascript:void(0)"  onclick="supprimeLinge('.$ab->id.')"><i class="sl sl-icon-trash" style="color:red"></i></a> <a href="javascript:void(0)" att="b"  onclick="modifLinge('.$ab->id.', this)"><i class="sl sl-icon-note" style="color:red"></i></a></li>' ; 
                     
                  
                   } ?>
                 </ul>

                            
     </div> 
     <form action="{{ route('users.editPlan') }}" method="get" > 
     <div id="Modifb">
     <textarea type="text" name="contenuPlan" placeholder="Ajouter une ligne "></textarea>
     </div><br>
     <input type="" name="abonnement" hidden="hidden" value="2">
     <input type="" name="idligne" id="idligneb" hidden="hidden" value="0">
     <div>
     <input type="submit" id="buttonSubmitb" value="Ajouter" name=""> 
     <a class="button annuler1" id="annulerb" att2="b" style="background-color: red;display: none;float: right;">Annuler</a>
</div>
</form>
     </div> 
   

  <!---------------------------------------Abonnement3--------------------------------------------------->
  <div id="Abonnement3" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Abonnement 3</h3>
          </div>
          <div class="utf_price_plan_features">
            <ul style="padding-bottom: 5px">
              <?php  foreach($abonnementC as $ab) { 
                       echo  '<li><span id="c'.$ab->id.'">'.$ab->contenu.'</span> <a href="javascript:void(0)"  onclick="supprimeLinge('.$ab->id.')"><i class="sl sl-icon-trash" style="color:red"></i></a> <a href="javascript:void(0)" att="c" onclick="modifLinge('.$ab->id.' , this)"><i class="sl sl-icon-note" style="color:red"></i></a></li>' ; 
                     
                  
                   } ?>
                 </ul>

                            
     </div> 
     <form action="{{ route('users.editPlan') }}" method="get" > 
     <div id="Modifc">
     <textarea type="text" name="contenuPlan" placeholder="Ajouter une ligne "></textarea>
     </div><br>
     <input type="" name="abonnement" hidden="hidden" value="3">
     <input type="" name="idligne" id="idlignec" hidden="hidden" value="0">
     <div>
     <input type="submit" id="buttonSubmitc" value="Ajouter" name=""> 
     <a class="button annuler1" id="annulerc" att2="c" style="background-color: red;display: none;float: right;">Annuler</a>
</div>
</form>
     </div> 

  <!------------------------------------------------------------------------------------------>
       <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-film"></i> Logo et Video</h3>
              </div>			  
              <div class="row with-forms">    
			  				  <div class="row" >	<a  style="float:right;"  href='#' onclick='location.reload();'>Recharger la page</a>	
								  <button onclick='asendsms();'>SEND SMS</button>

			  				  </div>	  

			  	  <div class="row">
				  
				 <div class="utf_submit_section col-md-4">

				    <h4>Logo</h4>
					<form action="{{ route('users.ajoutlogo') }}" method="post" class="dropzone"  id="dropzoneFrom">
					  {{ csrf_field() }}
 					</form>
 					 
				</div>
				
			  <div class="utf_submit_section col-md-5" id="videos" style="margin-right:20px;">
					<h4 id="images">Télécharger une vidéo en format mp4</h4>

					<form action="{{ route('users.ajoutvideoslider')}}" method="post" enctype="multipart/form-data"  class="dropzone" id="dropvideo" >
					@csrf
<!-- 					 <div id="myAwesomeDropzone" class="dropzone"></div>
 --> 				</form>
			 </div>

			  </div>
	 
			   
			  </div>
		</div>	
    <!-----------------------------text ---------------------------------------->
    <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-folder-alt"></i> Textes du vidéo d'accueil</h3>
              </div>  
            <div class="row with-forms">
           <div class="row">

          <div class="col-md-12">
            <label>Texte :</label>           
            <input id="idtext" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "106" value="{{$parametres->hometext}}" />
          </div>
          
          </div>
          
          
           <div class="row">
          
          <div class="col-md-2">
            <label>Textes animés :</label>           
            <input id="texta1" name="texta1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "106" value="{{$parametres->texta1}}" />
          </div>                    
          <div class="col-md-2">
            <label> </label>
            <input id="texta2" name="texta2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "106" value="{{$parametres->texta2}}" />          
          </div>                   
          <div class="col-md-2">
            <label> </label>
            <input id="texta3" name="texta3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "106" value="{{$parametres->texta3}}" />          
          </div>                   
          <div class="col-md-2">
            <label> </label>
            <input id="texta4" name="texta4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "106" value="{{$parametres->texta4}}" />          
          </div>                   
          <div class="col-md-2">
            <label> </label>
            <input id="texta5" name="texta5" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "106" value="{{$parametres->texta5}}" />          
          </div>
          
          </div>

           <div class="row">
           
           <div class="col-md-6">
            <input type="submit" onclick="savetext()" style="text-align:center;color:white;" value="Enregistrer"></input>
          </div>         
          
          </div>
          
          </div>  
          
     </div> 

     <!-- deb  temoinages clients  designv3 -->

      <div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-people"></i>Gestion des témoinages des clients</h3>
                </div>              
        <div class="row">
          <div class="col-md-12 col-sm-4">
            <h4></h4>
          <table id="utf_pricing_list_section">
            <tbody class="ui-sortable"  id="indispo">
            <br>
          <?php use App\Temoinage; $temoinages=Temoinage::orderBy('id')->get();
            foreach($temoinages as $tem){
            ?>
              <tr class="pricing-list-item pattern ui-sortable-handle">
              <td> 
              
              <div class="fm-input pricing-name" style="min-width:50%;">
               Client: 
                <input  type="text" idtem="<?php echo $tem->id; ?>" name="nom" placeholder="Nom du client" id="qp{{$tem->nom}}"  onchange="changing_tem(this)" required  value="<?php echo $tem->nom; ?>" />
                <input  type="text"  idtem="<?php echo $tem->id; ?>" name="poste" placeholder="Poste du client" id="qp{{$tem->poste}}"  onchange="changing_tem(this)" required  value="<?php echo $tem->poste; ?>" />
              </div>
              
              <div class="fm-input pricing-ingredients" style="min-width:30%;">
                Témoinage:<!-- <input type="text" value="<?php //echo $pi->date_debut;?>" > -->
                <textarea  type="text"  idtem="<?php echo $tem->id; ?>" class="textarea tex-com" placeholder="Contenu " name="texte" id="rp{{$tem->texte}}" onchange="changing_tem(this)" required><?php echo $tem->texte; ?></textarea>
              </div>
             
              <div class="fm-close" style="top:20px; right: 20px;">
              <a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('TemoinagesController@remove_temoinage', [ 'id'=>$tem->id ])}}"><i class="fa fa-remove"></i></a>
              </div>
              
              </td>
            </tr>
            
            <?php } ?>
            </tbody>
          </table>
          <br>
            <center>
          <a href="#ajout-temoinage" class="button popup-with-zoom-anim">Ajouter</a> </center>
          <!--<a href="#" class="button add-pricing-submenu">Add Category</a> --></div>
        </div>                          
            </div>


             <!-- fin  temoinages clients  designv3 -->

    <!-- deb  temoinages prestataires  designv3 -->

      <div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-people"></i>Gestion des témoinages des prestataires</h3>
                </div>              
        <div class="row">
          <div class="col-md-12 col-sm-4">
            <h4></h4>
          <table id="utf_pricing_list_section">
            <tbody class="ui-sortable"  id="indispo">
            <br>
          <?php use App\TemoinagePrest; $temoinagesprest=TemoinagePrest::orderBy('id')->get();
            foreach($temoinagesprest as $temprest){
            ?>
              <tr class="pricing-list-item pattern ui-sortable-handle">
              <td> 
              
              <div class="fm-input pricing-name" style="min-width:50%;">
               Client: 
                <input  type="text" idtem="<?php echo $temprest->id; ?>" name="nom" placeholder="Nom du prestataire" id="qpest{{$temprest->nom}}"  onchange="changing_temprest(this)" required  value="<?php echo $temprest->nom; ?>" />
                <input  type="text"  idtem="<?php echo $temprest->id; ?>" name="poste" placeholder="Poste du prestataire" id="qpest{{$temprest->poste}}"  onchange="changing_temprest(this)" required  value="<?php echo $temprest->poste; ?>" />
              </div>
              
              <div class="fm-input pricing-ingredients" style="min-width:30%;">
                Témoinage:<!-- <input type="text" value="<?php //echo $pi->date_debut;?>" > -->
                <textarea  type="text"  idtem="<?php echo $temprest->id; ?>" class="textarea tex-com" placeholder="Contenu " name="texte" id="rpest{{$temprest->texte}}" onchange="changing_temprest(this)" required><?php echo $temprest->texte; ?></textarea>
              </div>
             
              <div class="fm-close" style="top:20px; right: 20px;">
              <a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('TemoinagesPrestController@remove_temoinage', [ 'id'=>$temprest->id ])}}"><i class="fa fa-remove"></i></a>
              </div>
              
              </td>
            </tr>
            
            <?php } ?>
            </tbody>
          </table>
          <br>
            <center>
          <a href="#ajout-temoinageprest" class="button popup-with-zoom-anim">Ajouter</a> </center>
          <!--<a href="#" class="button add-pricing-submenu">Add Category</a> --></div>
        </div>                          
            </div>


             <!-- fin  temoinages prestataires  designv3 -->


    <!-----------------------------boxes ---------------------------------------->
    <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-screen-desktop"></i>Comment ça marche</h3>
              </div>  
           <div class="row">

          <div class="col-md-3">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <br>
            <!-- <h5 class="card-title text-muted text-uppercase text-center">Free</h5> -->
            <center><span  style="color:#006ED2" ><i class="fa  fa-search fa-5x"></i></span></center>
            <!-- <h6 class="card-price text-center">$0<span class="period">/month</span></h6> -->
            <br>
            <br>
            <center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "106" id="Box1a" style="font-size:130%;">{{$parametres->Box1a}}</textarea></center><center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "50" id="Box1b" style="color:grey; height: 50px!imoptant ;min-height: 120px;">{{$parametres->Box1b}}</textarea></center>
            <!-- <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a> -->
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <br>
            <!-- <h5 class="card-title text-muted text-uppercase text-center">Free</h5> -->
            <center><span  style="color:#006ED2"><i class="fa fa-check fa-5x"></i></span></center>
            <!-- <h6 class="card-price text-center">$0<span class="period">/month</span></h6> -->
            <br>
            <br>
            <center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "106" id="Box2a" style="font-size:130%;padding-bottom: 25px">{{$parametres->Box2a}}</textarea><center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "50" id="Box2b" style="color:grey; height: 50px!imoptant ;min-height: 120px;">{{$parametres->Box2b}}</textarea></center><br>
            <br>    </center>
            <!-- <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a> -->
         
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <br>
            <!-- <h5 class="card-title text-muted text-uppercase text-center">Free</h5> -->
            <center><span style="color:#006ED2" ><i class="fa fa-calendar fa-5x"></i></span></center>
            <!-- <h6 class="card-price text-center">$0<span class="period">/month</span></h6> -->
            <br>
            <br>
            <center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "106" id="Box3a" style="font-size:130%;padding-bottom: 23px">{{$parametres->Box3a}}</textarea></center><center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "50" id="Box3b" style="color:grey; height: 50px!imoptant ;min-height: 120px;">{{$parametres->Box3b}}</textarea></center> <br>
            <!-- <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a> -->
         </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <br>
            <!-- <h5 class="card-title text-muted text-uppercase text-center">Free</h5> -->
            <center><span  style="color:#006ED2"><i class="fa icon-material-outline-credit-card fa-5x"></i></span></center>
            <!-- <h6 class="card-price text-center">$0<span class="period">/month</span></h6> -->
            <br>
            <br>
            <center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "106" id="Box4a" style="font-size:130%;">{{$parametres->Box4a}}</textarea></center>
            <center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "50" id="Box4b" style="color:grey; height: 50px!imoptant ;min-height: 120px;">{{$parametres->Box4b}}</textarea></center>
            <!-- <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a> -->
          </div>
        </div>
      </div>

          
          </div>  
          <div class="col-md-6">
            <input type="submit" onclick="ChangeBoxes()" style="text-align:center;color:white;" value="Enregistrer"></input>
          </div>
     </div>   
    <!-------------------------------------------------------------------------->  
    <style type="text/css">
      figure {
  border: 1px #cccccc solid;
  padding: 4px;
  margin: 4px;
}

figcaption {
  background-color: black;
  color: white;
  font-style: italic;
  padding: 2px;
  text-align: center;
}
    </style>
 	<!-----------------------------A propos ---------------------------------------->
    <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-screen-desktop"></i>A Propos</h3>
              </div>  
           <div class="row">

          <div class="col-md-12">
            <input id="apropos1a" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "106" value="{{$parametres->apropos1a}}" />

            <textarea id="apropos1b" style="">{{$parametres->apropos1b}}</textarea>
          </div>
          <div class="col-md-6">
            <input id="apropos2a" type="text" name="" value="{{$parametres->apropos2a}}">
            <textarea id="apropos2b" style="height: 560px">{{$parametres->apropos2b}}</textarea>
          </div>
          <div class="col-md-6">
            <div class="row">

              <div class="col-md-12">
                <input id="apropos3a" type="text" value="{{$parametres->apropos3a}}" name="">
              </div>
              <div class="col-md-4" style="margin-top: 20px;">
                <figure style="max-height: 250px" class="float-left">
                  <center><img src="public/images/david.jpg" alt="Mr MAXIME David Martiniquais" style="max-height: 200px"></center>
                  <figcaption>Mr MAXIME David</figcaption>
                 </figure>
              </div>
              <div class="col-md-8">
                <br>
                <textarea id="apropos3b" style="height: 200px">{{$parametres->apropos3b}}</textarea>
              </div>
              <div class="col-md-12">
                <textarea id="apropos3c" style="height: 300px">{{$parametres->apropos3c}}</textarea>
              </div>
              
            </div>
            
            
            
          </div>
          <div class="col-md-6">
            <input  type="submit" onclick="saveApropos()" style="text-align:center;color:white;" value="Enregistrer"></input>
          </div>
          
          </div>  
          
     </div>   
    <!-------------------------------------------------------------------------->
	
		 <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-docs"></i> Contenus</h3>
              </div>  
			
			 <div class="row with-forms">
	 	
	 
	 <label>Contenu de la page "A Propos"</label><br>
    <div class="row">
       <div class="form-group ">
           <label for="contenu">  </label>
             <div class="editor" >
              <textarea style="min-height: 380px;"  id="apropos" type="text"  class="textarea tex-com" placeholder="Contenu de la page A Propos" name="apropos" required  ><?php echo $apropos; ?></textarea>
              </div>
         </div>
    </div>
	
	 <div class="row" style="margin-bottom:30px">
	   <button   class="button"  onclick=";updating('apropos'); "   ><b><i class="sl sl-icon--save"></i> Enregistrer</b></button>
   </div>
   <br><br>
   
   <label>Contenu de "A Propos" dans le Footer</label><br>
	    <div class="row">
       <div class="form-group ">
                    <label for="contenu"></label>
                    <div class="editor" >
                        <textarea style="min-height: 380px;"  id="apropos_footer" type="text"  class="textarea tex-com" placeholder="Contenu A propos du Footer" name="apropos_footer" required  ><?php echo $apropos_footer; ?></textarea>
                    </div>
         </div>
    </div>
	
 <div class="row" style="margin-bottom:30px">
	   <button   class="button"  onclick="  updating('apropos_footer'); "   ><b><i class="sl sl-icon--save"></i> Enregistrer</b></button>
  </div>

<!-- deb  heures indisponibilité  v2 -->

      <div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-basket-loaded"></i>Gestion questions / réponses pour prestataire</h3>
                </div>              
        <div class="row">
          <div class="col-md-12 col-sm-4">
            <h4></h4>
          <table id="utf_pricing_list_section">
            <tbody class="ui-sortable"  id="indispo">
            <br>
          <?php use App\PageFaq; $PageFaq=PageFaq::where('type','prest')->orderBy('id')->get();
            foreach($PageFaq as $pf){
            ?>
              <tr class="pricing-list-item pattern ui-sortable-handle">
              <td> 
              
              <div class="fm-input pricing-name" style="min-width:50%;">
               Question:<!-- <input type="text" value="<?php //echo $pi->titre;?>" > -->
                <textarea  type="text"  name="question" class="textarea tex-com" placeholder="Contenu de la page A Propos" id="qp{{$pf->id}}" name="question" onchange="changing_question_reponse(this)" required  ><?php echo $pf->question; ?></textarea>
              </div>
              
              <div class="fm-input pricing-ingredients" style="min-width:30%;">
                Réponse:<!-- <input type="text" value="<?php //echo $pi->date_debut;?>" > -->
                <textarea  type="text"  class="textarea tex-com" placeholder="Contenu de la page A Propos" name="reponse" id="rp{{$pf->id}}" onchange="changing_question_reponse(this)" required><?php echo $pf->reponse; ?></textarea>
              </div>
             
              <div class="fm-close" style="top:20px; right: 20px;">
              <a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('FaqsController@remove_question_response', [ 'id'=>$pf->id ])}}"><i class="fa fa-remove"></i></a>
              </div>
              
              </td>
            </tr>
            
            <?php } ?>
            </tbody>
          </table>
          <br>
            <center>
          <a href="#question-reponse-prestataire" class="button popup-with-zoom-anim">Ajouter</a> </center>
          <!--<a href="#" class="button add-pricing-submenu">Add Category</a> --></div>
        </div>                          
            </div>


             <!-- fin  heures indisponibilité  v2 -->
   <!-- deb  heures indisponibilité  v2 -->

      <div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-basket-loaded"></i>Gestion questions / réponses pour Client</h3>
                </div>              
        <div class="row">
          <div class="col-md-12 col-sm-4">
            <h4></h4>
          <table id="utf_pricing_list_section">
            <tbody class="ui-sortable"  id="indispo">
            <br>
          <?php   $PageFaq=PageFaq::where('type','client')->orderBy('id')->get();
            foreach( $PageFaq as $pf){
            ?>
              <tr class="pricing-list-item pattern ui-sortable-handle">
              <td> 
              
              <div class="fm-input pricing-name" style="min-width:50%;">
               Question:<!-- <input type="text" value="<?php //echo $pi->titre;?>" > -->
                <textarea  type="text"  class="textarea tex-com" placeholder="Contenu de la page A Propos"  id="qc{{$pf->id}}" name="question" onchange="changing_question_reponse(this)" required  ><?php echo $pf->question; ?></textarea>
              </div>
              
              <div class="fm-input pricing-ingredients" style="min-width:30%;">
                Réponse:<!-- <input type="text" value="<?php //echo $pi->date_debut;?>" > -->
                <textarea  type="text"  class="textarea tex-com" placeholder="Contenu de la page A Propos" name="reponse" id="rc{{$pf->id}}" onchange="changing_question_reponse(this)" required  ><?php echo $pf->reponse; ?></textarea>
              </div>
             
              <div class="fm-close" style="top:20px; right: 20px;">
              <a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('FaqsController@remove_question_response', ['id'=>$pf->id ])}}"><i class="fa fa-remove"></i></a>
              </div>
              
              </td>
            </tr>
            
            <?php } ?>
            </tbody>
          </table>
          <br>
            <center>
          <a href="#question-reponse-client" class="button popup-with-zoom-anim">Ajouter</a> </center>
          <!--<a href="#" class="button add-pricing-submenu">Add Category</a> --></div>
        </div>                          
            </div>


             <!-- fin  heures indisponibilité  v2 -->
  
  
  <!--
   <br><br>
  <div class="row">
       <div class="form-group ">
         <label for="contenu"></label>
          <div class="editor" >
           <textarea style="min-height: 380px;"  id="contacter" type="text"  class="textarea tex-com" placeholder="Contenu de la page contact" name="contact" required  ><?php// echo $contacter; ?></textarea>
           </div>
         </div>
    </div>
	
	
 <div class="row">
	   <button  class="button"  onclick=" ;updating('contact'); "   ><b><i class="sl sl-icon--save"></i> Enregistrer</b></button>
   </div>
-->

					</div>	
					
		 </div>	
		 
		 





	  
	 </div>
 </div>
     <!--  modal pour ajouter une indisponibilté -->

       <div id="question-reponse-client" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Ajouter une question/réponse au client</h3>
          </div>
    <form method="post" enctype="multipart/form-data" action="{{ route('pagefaqs.store_question_reponse') }}">
      {{ csrf_field() }}
      
       <div class="utf_signin_form style_one">
       <input type="hidden" name="user" value="5"  >
        <label>Question *: </label>
        <div class="fm-input">
        <textarea  type="text"  class="textarea tex-com"   name="question" required  ><?php //echo $pi->titre; ?></textarea>
      </div>
             <label>Réponse *: </label>
      <div class="fm-input">
        <textarea  type="text"  class="textarea tex-com"   name="reponse" required  ><?php //echo $pi->titre; ?></textarea>
      </div>
            <br>
      <input type="hidden"  name="type" value="client">
     
      <br>
           <center><input type="submit" style="text-align:center;color:white;" value="Ajouter"></input></center>

      </form>       
     </div>     
     </div>     
       
    <!-- fin modal pour ajouter une indisponibilté -->  
 
  <!--  modal pour ajouter une indisponibilté -->

       <div id="question-reponse-prestataire" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Ajouter une question/réponse pour prestataire</h3>
          </div>
  <form  method="post" enctype="multipart/form-data" action="{{ route('pagefaqs.store_question_reponse') }}" >
      {{ csrf_field() }}
      
       <div class="utf_signin_form style_one">
       <input type="hidden" name="user" value="5"  >
        <label>Question *: </label>
        <div class="fm-input">
        <textarea  type="text"  class="textarea tex-com"   id="question_client" name="question" required  ><?php //echo $pi->titre; ?></textarea>
      </div>
        <label>Réponse *: </label>
      <div class="fm-input">
       <textarea  type="text"  class="textarea tex-com"   id="question_client" name="reponse" required  ><?php //echo $pi->titre; ?></textarea>
      </div>

      <input type="hidden"  name="type" value="prest">
         
      <br>
           <center><input type="submit" style="text-align:center;color:white;" value="Ajouter"></input></center>

      </form>       
     </div>     
     </div>     
       
    <!-- fin modal pour ajouter une indisponibilté -->  

      <!--  modal pour ajouter un témoinage -->

       <div id="ajout-temoinage" class="small-dialog zoom-anim-dialog mfp-hide">
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
       
    <!-- fin modal pour ajouter une indisponibilté -->  
    <!--  modal pour ajouter un témoinage prestataire-->

       <div id="ajout-temoinageprest" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Ajouter un témoinage</h3>
          </div>
  <form  method="post" enctype="multipart/form-data" action="{{ route('temoinagesprest.store_temoinage') }}" >
      {{ csrf_field() }}
      
       <div class="utf_signin_form style_one">
        <label>Nom du prestataire *: </label>
        <div class="fm-input">
        <input  type="text" id="nom_prest" name="nom" required  />
      </div>
        <label>Poste du prestataire *: </label>
      <div class="fm-input">
       <input  type="text" id="poste_prest" name="poste" required  />
      </div>

       <label>Témoinage *: </label>
      <div class="fm-input">
       <textarea  type="text"  class="textarea tex-com"   id="texte_prest" name="texte" required  ></textarea>
      </div>
         
      <br>
           <center><input type="submit" style="text-align:center;color:white;" value="Ajouter"></input></center>

      </form>       
     </div>     
     </div>     
       
    <!-- fin modal pour ajouter une indisponibilté -->  
  
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script src="{{  URL::asset('public/scripts/dropzone.js') }}"></script>
 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script> -->

<script>
  function supprimeLinge(a){
    
    if(confirm('Êtes-vous sûrs ?'))
    {
      
      var idligne = a ;
      var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('users.deleteLine') }}",
            method: "get",
            data: {idligne:idligne, _token: _token},
            success: function (data) {
                             
              location.reload() ;
             }
  
        });
    }
  }
  function modifLinge(a,b){
    var x = b.getAttribute("att");
    y=document.getElementById(x+a).innerHTML ;
    $("#annuler"+x).css("display","block");
    document.getElementById("buttonSubmit"+x).value = "Enregistrer" ;
    document.getElementById("idligne"+x).value = a ;
    $("#buttonSubmit"+x).css("background-color","green");
    document.getElementById("Modif"+x).innerHTML = '<textarea type="text" name="contenuPlan" placeholder="Ajouter une ligne ">'+y+'</textarea>';

    //alert(y);
  }
  $('.annuler1').on('click',function(){
    var x= this.getAttribute("att2");
    //alert(x);
    $("#annuler"+x).css("display","none");
    document.getElementById("buttonSubmit"+x).value = "Ajouter" ;
    $("#buttonSubmit"+x).css("background-color","");
    document.getElementById("idligne"+x).value = 0 ;
    document.getElementById("Modif"+x).innerHTML = '<textarea type="text" name="contenuPlan" placeholder="Ajouter une ligne "></textarea>';
  });
    function saveApropos(){
    //alert("okko");
     var apropos1a = document.getElementById("apropos1a").value;
    var apropos1b = document.getElementById("apropos1b").value;

    var apropos2a = document.getElementById("apropos2a").value;
    var apropos2b = document.getElementById("apropos2b").value;

    var apropos3a = document.getElementById("apropos3a").value;
    var apropos3b = document.getElementById("apropos3b").value;
    var apropos3c = document.getElementById("apropos3c").value;

     //alert(Box1a);
    var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('users.ChangeApropos') }}",
                    method: "POST",
                    data: {apropos1a: apropos1a,apropos1b: apropos1b,apropos2a: apropos2a,apropos2b: apropos2b,apropos3a: apropos3a,apropos3b: apropos3b,apropos3c:apropos3c , _token: _token},
                    success: function (data) {
                                     
                    swal({
                        type: 'success',
                        title: 'Modifié ...',
                        text: 'Contenu modifié avec succès'
          //  icon: "success",
                    }); 
          
                     }
          
                });
  }
  function ChangeBoxes(){
    //alert("okko");
     var Box1a = document.getElementById("Box1a").value;
    var Box1b = document.getElementById("Box1b").value;

    var Box2a = document.getElementById("Box2a").value;
    var Box2b = document.getElementById("Box2b").value;

    var Box3a = document.getElementById("Box3a").value;
    var Box3b = document.getElementById("Box3b").value;

    var Box4a = document.getElementById("Box4a").value;
    var Box4b = document.getElementById("Box4b").value;
     //alert(Box1a);
    var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('users.ChangeBoxes') }}",
                    method: "POST",
                    data: {Box1a: Box1a,Box1b: Box1b,Box2a: Box2a,Box2b: Box2b,Box3a: Box3a,Box3b: Box3b, Box4a: Box4a,Box4b: Box4b, _token: _token},
                    success: function (data) {
                                     
                    swal({
                        type: 'success',
                        title: 'Modifié ...',
                        text: 'Contenu modifié avec succès'
          //  icon: "success",
                    }); 
          
                     }
          
                });
  }
  function savetext(){
   
    var val = document.getElementById("idtext").value;
    var valta1 = document.getElementById("texta1").value;
    var valta2 = document.getElementById("texta2").value;
    var valta3 = document.getElementById("texta3").value;
    var valta4 = document.getElementById("texta4").value;
    var valta5 = document.getElementById("texta5").value;
     //alert(val);
    var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('users.changehometext') }}",
                    method: "POST",
                    data: {val: val,valta1: valta1,valta2: valta2,valta3: valta3,valta4: valta4,valta5: valta5, _token: _token},
                    success: function (data) {
                                     
                    swal({
                        type: 'success',
                        title: 'Modifié ...',
                        text: 'Contenu modifié avec succès'
          //  icon: "success",
                    }); 
          
                     }
          
                });
  }
    function changing_question_reponse(elm) {
                var champ = elm.name;
               // alert(champ);
                var id1= elm.id;
                var id=id1.substr(2);
                //alert(id);
                var type=id1.substring(0,2);
              // alert(type);
                var val = document.getElementById(id1).value;
                //alert(val);
              
                //if ( (val != '')) {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('pagefaqs.update_question_reponse') }}",
                    method: "POST",
                    data: { id:id, type:type, champ: champ, val: val, _token: _token},
                    success: function (data) {
                        $('#' + champ).animate({
                            opacity: '0.3',
                        });
                        $('#' + champ).animate({
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

// changing_tem
    function changing_tem(elm) {
                var id = elm.getAttribute("idtem"); 
                var champ = elm.name;
              // alert(type);
                var val = elm.value;
                
                //if ( (val != '')) {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('temoinages.update_temoinage') }}",
                    method: "POST",
                    data: { id:id, champ: champ, val: val, _token: _token},
                    success: function (data) {
                        $('#' + champ).animate({
                            opacity: '0.3',
                        });
                        $('#' + champ).animate({
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

  // changing_tem
    function changing_temprest(elm) {
                var id = elm.getAttribute("idtem"); 
                var champ = elm.name;
              // alert(type);
                var val = elm.value;
                
                //if ( (val != '')) {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('temoinagesprest.update_temoinage') }}",
                    method: "POST",
                    data: { id:id, champ: champ, val: val, _token: _token},
                    success: function (data) {
                        $('#' + champ).animate({
                            opacity: '0.3',
                        });
                        $('#' + champ).animate({
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

   function changing(elm) {
         var champ= elm.id;
		 var val =document.getElementById(champ).value;
		 
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('users.parametring') }}",
            method: "POST",
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
 					//	icon: "success",
                    }); 
            }
        });
       
    }

 function asendsms() {
 	var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('users.sendsms') }}",
            method: "POST",
            data: {_token: _token},
            success: function (data) {
				 	swal({
                        type: 'success',
                        title: 'SMS ...',
                        text: 'SMS envoyé avec succès'
 					//	icon: "success",
                    }); 
            }
        });
 }
	
	   function updating(elm) {
 		 var val =document.getElementById(elm).value;
		 
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('users.parametring') }}",
            method: "POST",
            data: {champ: elm   ,val:val, _token: _token},
            success: function (data) {
                $('#'+elm).animate({
                    opacity: '0.3',
                });
                $('#'+elm).animate({
                    opacity: '1',
                });
				 	swal({
                        type: 'success',
                        title: 'Modifié ...',
                        text: 'Paramètre modifié avec succès'
 					//	icon: "success",
                    }); 
            }
        });
       
    }
	
	
	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
			 
 Dropzone.options.dropzoneFrom = {
 // autoProcessQueue: false,
  acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",
  method: 'POST',
  init: function(){
 
   this.on("complete", function(){
   
				 	swal({
                        type: 'success',
                        title: 'Terminé ...',
                        text: 'téléchargement terminé avec succès'
 					//	icon: "success",
                    }); 
					
 });
  },
 };
 
 
   Dropzone.options.dropvideo = {
 // autoProcessQueue: false,
  acceptedFiles:".mp4",
  method: 'POST',
  init: function(){
 
   this.on("complete", function(){
 
 	 	swal({
                        type: 'success',
                        title: 'Terminé ...',
                        text: 'téléchargement terminé avec succès'
 					//	icon: "success",
                    }); 
					
 
 });
  },
 };

  /*Dropzone.options.myAwesomeDropzone = {
                url: "{{ route('users.ajoutvideoslider') }}",
                method: 'POST',
                autoProcessQueue: true,
                uploadMultiple: true,
                parallelUploads: 3,
                maxFiles: 3,
                addRemoveLinks: true,
                thumbnailMethod: 'crop',
                resizeWidth: 500,
                resizeHeight: 500,
                resizeQuality: 0.3,
                acceptedFiles: ".mp4",
                dictDefaultMessage: "Mettre votre vidéo ici!",


                init: function () {
                    var myDropzone = this;
                  $('#submit_form').on("click", function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();      
                    });



                    this.on("sending", function(file, xhr, formData){
                        $('#dropvideo').each(function() {
                            //title = $(this).find('input[name="title"]').val();
                            _token=$(this).find('input[name="_token"]').val();
                            alert( _token);
                            formData.append('_token', _token);
                        });
                    });
                    this.on("success", function(file, response) {
                    	swal({
                        type: 'success',
                        title: 'Terminé ...',
                        text: 'téléversement terminé avec succès'
 					//	icon: "success",
                    }); 

                    });
                    this.on("completemultiple", function(files) {
                        // Here goes what you want to do when the upload is done
                        // Redirect, reload , load content ......
                        swal({
                        type: 'success',
                        title: 'Terminé ...',
                        text: 'téléversement terminé avec succès'
 					//	icon: "success",
                    }); 

                    });
                },

            };*/
</script>
<script>

/*Dropzone.autoDiscover = false;
var acceptedFileTypes = "video/*"; //dropzone requires this param be a comma separated list
// imageDataArray variable to set value in crud form
var imageDataArray = new Array;
// fileList variable to store current files index and name
var fileList = new Array;
var i = 0;
$(function(){
    uploader = new Dropzone(".dropzone",{
        url: "{{url('/users/ajoutvideoslider')}}",
        paramName : "file",
        uploadMultiple :false,
        acceptedFiles : "image/*,video/*,audio/*",
        addRemoveLinks: false,
        forceFallback: false,
        maxFilesize: 256, // Set the maximum file size to 256 MB
        parallelUploads: 100,
    });//end drop zone
    uploader.on("success", function(file,response) {
        imageDataArray.push(response)
        fileList[i] = {
            "serverFileName": response,
            "fileName": file.name,
            "fileId": i
        };
   
        i += 1;
        $('#item_images').val(imageDataArray);
    });
    uploader.on("removedfile", function(file) {
        var rmvFile = "";
        for (var f = 0; f < fileList.length; f++) {
            if (fileList[f].fileName == file.name) {
                // remove file from original array by database image name
                imageDataArray.splice(imageDataArray.indexOf(fileList[f].serverFileName), 1);
                $('#item_images').val(imageDataArray);
                // get removed database file name
                rmvFile = fileList[f].serverFileName;
                // get request to remove the uploaded file from server
                $.get( "{{url('item/image/delete')}}", { file: rmvFile } )
                  .done(function( data ) {
                    //console.log(data)
                  });
                // reset imageDataArray variable to set value in crud form
                
                console.log(imageDataArray)
            }
        }
        
    });
});*/
</script>





@endsection