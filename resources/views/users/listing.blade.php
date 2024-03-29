@extends('layouts.backlayout')
 
 @section('content')
<style>
.fc .fc-non-business {
background-color:lightgrey;
}

</style> 

 <style>


/* The Modal (background) */
.modalkbs {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 9999; /* Sit on top */
  padding-top: 150px; /* Location of the box */
  padding-left: 200px;
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

@media only screen and (max-width: 600px) {
  .modalkbs {
    padding-left: 0px;
  }
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
</style>


<style>

.small-dialog{
	background: #ffffff;
    padding: 30px 20px;
    padding-top: 0;
    text-align: left;
    max-width: 400px;
    margin: 20px auto;
    position: relative;
    box-sizing: border-box;
    border-radius: 4px;
	}
	 button.mfp-close {
	position: absolute;
	width: 40px;
	height: 40px;
	top: -20px;
	display: block;
	right: -12px;
	cursor: pointer!important;
	z-index: 9999;
	color: #fff;
	-webkit-transition: all 0.2s ease-in-out;
	-moz-transition: all 0.2s ease-in-out;
	-o-transition: all 0.2s ease-in-out;
	-ms-transition: all 0.2s ease-in-out;
	transition: all 0.2s ease-in-out;
	border-radius:6px;
	margin: 0px;
	background-color: rgba(255, 255, 255, 0.2);
	outline: none;
	transform: translate3d(0, 0, 0);
}
#dialog_signin_part .mfp-close::after, #dialog_signin_part .mfp-close::before, #small-dialog .mfp-close::after, #small-dialog .mfp-close::before, .small-dialog .mfp-close::after, .small-dialog .mfp-close::before { top: 3px; } 
   #dialog_signin_part .mfp-close, #small-dialog .mfp-close , .small-dialog .mfp-close { top: 15px; right: 20px; width: 40px; height: 40px; } 
 #small-dialog .mfp-close, #dialog_signin_part, .mfp-close, .mfp-close:hover , .small-dialog .mfp-close{ color: #fff; }
 #dialog_signin_part .mfp-close, #small-dialog .mfp-close ,.small-dialog .mfp-close {
	color: #ff2222;
	background-color:#fff;
	border-radius: 30px;
	top: 20px;
	right: 20px;
	width: 34px;
	height: 34px;
}
</style>
<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}
.alert.ok {
  padding: 20px;
  background-color: #04aa6d;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
<style>
    .legend { list-style: none; margin-left:10px;}
    .legend li { float: left; margin-right: 15px;}
    .legend span { border: 1px solid #ccc; float: left; width: 10px; height: 12px; margin: 2px; }
  
    /* your colors */
    .legend .lightgrey { background-color: lightgrey;}
    .legend .brown { background-color: brown; }
    .legend .blue { background-color: blue; }
    .legend .red{ background-color: red; }
    .legend .green{ background-color:lightgreen; }
    .legend .pink{ background-color:pink; }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('public/fullcalendar/main.min.css') }}" />

   <!-- Dashboard -->
<div id="dashboard"> 
  
@include('layouts.back.menu')
 <style>
 table{background-color:white;border:none!important;;width:100%!important;}
 </style>

<?php use App\Service; use App\Produit ;use App\ServiceSupp; ?>
    <!-- Content -->
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

@if ( Session::has('msg') )
@if ( Session::get('msg')=="off" )
 <div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Erreur!</strong> E-mail Paypal incorrect.
</div>
@endif 
@if ( Session::get('msg')=="on" )
 <div class="alert ok">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Validé!</strong> E-mail Paypal Enregistré.
</div>
@endif 
<?php Session::forget('msg');  ?>
 @endif 

    	  
    	
    	<input type="hidden" id="user" name="" value="{{$user->id}}">
      
<!---------------------------------------------------google Map----------------------------------------------------->
           <a href="{{$user->generate_slug()}}" target="_blank" class="button pull-right "><i class="sl sl-icon-eye"> </i>Visualiser</a>

<div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-map"></i> Emplacement</h3>
                </div>       
        <div class="row">
          <div class="col-md-6">
            <h5>Adresse</h5>                    
          <input type="text" class="input-text"  name="address" id="adresse" placeholder="" onchange="changing(this);" onFocus="geolocate()" value="{{ $user->adresse }}"  >
              </div>
              <div class="col-md-6">
                    <h5>Ville</h5>                    
          <input type="text" class="input-text" name="ville" id="ville" placeholder=""      value="{{ $user->ville }}"  onchange="changing(this)">
                 
                 </div>
                 <div class="col-md-12">
                    <h5>Fuseau horaire (Obligatoire)</h5> 
                    
                <select  name="fhoraire" id="fhoraire" title="Selectionnez votre fuseau horaire" onchange="changing(this);location.reload();">
                <option value="America/Martinique" default <?php if($user->fhoraire=='America/Martinique'){echo 'selected="selected"';}?> >Martinique</option>
                <option value="America/Guadeloupe"  <?php if($user->fhoraire=='America/Guadeloupe'){echo 'selected="selected"';}?> >Guadeloupe</option>
                <option value="Europe/Paris"  <?php if($user->fhoraire=='Europe/Paris'){echo 'selected="selected"';}?> >France</option>
                <option value="America/Cayenne"  <?php if($user->fhoraire=='America/Cayenne'){echo 'selected="selected"';}?> >Guyane française</option> 
                </select>
            </div>
            <div class="col-md-12">
                  <h5>Map</h5>                    
          
            <input type="text" class="input-text" name="latitude" id="latitude" placeholder="Latitude" onchange="changing(this)"  value="{{ $user->latitude }}">
                             
            <input type="text" class="input-text" name="longitude" id="longitude" placeholder="Longitude" onchange="changing(this)"  value="{{ $user->longitude }}">
          </div> 
          <div id="utf_listing_location" class="col-md-12 utf_listing_section">
            <div id="utf_single_listing_map_block">
            <div id="utf_single_listingmap" data-latitude="{{ $user->latitude }}" data-longitude="{{ $user->longitude }}" data-map-icon="im im-icon-Marker"></div>
            <a href="#" id="utf_street_view_btn">Vue de rue</a> 
            </div>
          </div>
       <div class="col-md-12" >

        
      </div>
          <div class="col-md-12" >
            
          </div>
        

            </div>  </div>


<!-------------------------------------------------------------------------------------------------------->
<!-------------------------------------Configuration de paiement--------------------------------------->

<style type="text/css">
  a.disabled {
  pointer-events: none;
  cursor: default;
  background-color: #61b2db ;
}
</style>
<div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-present"></i>Configuration de paiement</h3>
                </div>       
        <div class="row">
		   <div class="col-md-12" >
          <div class="col-md-12" >
            <h2><b> Connecter votre compte stripe (Obligatoire pour que les clients paient les acomptes et les restes).</b></h2>
            <br>
          </div>
          <div class="col-md-12" >
            <a href="{{url('ConnectWithStripe')}}"  class="button  <?php if($user->id_stripe!=null){echo 'disabled';}?>" > </i>Connecter Avec Stripe</a>

            
        </div>
        <br>
        <div class="col-md-12" >
        <?php if(($user->type_abonn_essai && $user->type_abonn_essai=="type3" ) || ($user->type_abonn &&  $user->type_abonn=="type3" )) {  ?> 
       <?php  if($user->allow_slices){$checked='checked';} else{$checked='';}  ?>
       <label style="font-weight:normal;font-size:22px"> 
                <input style="width:20px;height:20px"  id="allow_slices"  type="checkbox"   <?php echo $checked; ?>   onchange="changing(this)"     >
        Permettre le paiement en 4 tranches pour les réservations de 200€ ou plus </label> 
          <br><br>
      </div><?php }?>

		   <!-- <div class="col-md-12" >
        <?php if(($user->type_abonn_essai && $user->type_abonn_essai=="type3" ) || ($user->type_abonn &&  $user->type_abonn=="type3" )) {  ?> 
			 <?php if($user->allow_slices){$checked='checked';} else{$checked='';}  ?>
 			 <label style="font-weight:normal;font-size:22px"> 
                <input style="width:20px;height:20px"  id="allow_slices"  type="checkbox"   <?php echo $checked; ?>   onchange="changing(this)"     >
				Permettre le paiement en 4 tranches pour les réservations de 200€ ou plus </label> 
          <br><br>
		  </div><?php }?>
          <div class="col-md-12" >
            <h2><b> Ajoutez une adresse E-mail de votre compte Paypal (Obligatoire pour que les clients paient les acomptes et les restes).</b></h2>
            <br>
</div>
          <form action="{{ route('check.paypal') }}"  >
          <div class="col-md-8">
            <label>Email :</label>
            <div >
          <input   type="text" value="{{ $user->emailPaypal }}" name="email" >
          <input type="" name="id" value="{{ $user->id }}" hidden >
          </div>
        </div>
        
        </div>  
        <div class="col-md-8">
            <div >
              <input type="submit" style="text-align:center;color:white;" value="Enregistrer"></input>
            
        </div>
        </div>  

</form>
</form> -->

            </div> 

<!-------------------------------------------------------------------------------------------------------->



			<style>
 /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
#map {
  height: 100%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#floating-panel {
  position: absolute;
  top: 10px;
  left: 25%;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
  text-align: center;
  font-family: "Roboto", "sans-serif";
  line-height: 30px;
  padding-left: 10px;
}

</style>
	  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!--
 <script   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDARlwNl95VXqSs8FfoocG-gz7wG8j37hs&callback=initMap&libraries=&v=weekly" defer ></script>

     <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDARlwNl95VXqSs8FfoocG-gz7wG8j37hs&callback=initAutocomplete&libraries=places&v=weekly"
      defer
    ></script> 
	-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDARlwNl95VXqSs8FfoocG-gz7wG8j37hs&libraries=places&callback=initialize" async defer></script>
<script>
function initialize() {
   initMap();
   initAutocomplete();
}
</script>

			<script>
function initMap() {
  const map = new google.maps.Map(document.getElementById("utf_single_listingmap"), {
    zoom: 15,
 <?php if ($user->latitude!='' && $user->longitude!='' ) {?>   center: { lat: <?php echo $user->latitude; ?>, lng: <?php echo $user->longitude; ?> },   <?php }else{?>
	 center: { lat: 48.8566, lng: 2.35222 },
 
 <?php }?>
  });
  const geocoder = new google.maps.Geocoder();
  document.getElementById("adresse").addEventListener("change", () => {
    geocodeAddress(geocoder, map);
  });
 
}

function geocodeAddress(geocoder, resultsMap) {
  const address = document.getElementById("adresse").value;
  geocoder.geocode({ address: address }, (results, status) => {
    if (status === "OK") {
      resultsMap.setCenter(results[0].geometry.location);
      new google.maps.Marker({
        map: resultsMap,
        position: results[0].geometry.location,
      });
 	
 document.getElementById("latitude").value= results[0].geometry.location.lat();
 document.getElementById("longitude").value= results[0].geometry.location.lng();
 changing(document.getElementById('latitude'));
 changing(document.getElementById('longitude'));

   } else {
    //  alert("Ville non trouvée " + status);
    }
  });
}

 let placeSearch;
      let autocomplete;
      const componentForm = {
        street_number: "short_name",
        route: "long_name",
        locality: "long_name",
        administrative_area_level_1: "short_name",
        country: "long_name",
        postal_code: "short_name",
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
          document.getElementById("adresse"),
          { types: ["geocode"] }
        );
        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(["address_component"]);
        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener("place_changed", fillInAddress);
      }

      function fillInAddress() {
		  

        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();

        for (const component in componentForm) {
          document.getElementById(component).value = "";
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (const component of place.address_components) {
          const addressType = component.types[0];

          if (componentForm[addressType]) {
            const val = component[componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
		  document.getElementById('ville').value = document.getElementById('locality').value ;
		 
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition((position) => {
            const geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude,
            };
            const circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy,
            });
        //   autocomplete.setBounds(circle.getBounds());
          });
        }
      }

 </script>
 <!-------------------------------------------------------------------------------------------------------->

           <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-picture"></i> Images </h3>
              </div>			  
              <div class="row with-forms">  
				  <div class="utf_submit_section col-md-4">
				    <h4>Logo</h4>
					<form action="{{ route('users.ajoutimage') }}" class="dropzone"  id="dropzoneFrom"  >
					  {{ csrf_field() }}
					<input type="hidden" id="user" name="user"  value="<?php echo $user->id; ?>">
					</form>
					<!---<span id="submit-logo">Envoyer</span>-->
					<?php if($user->logo!=''){  ?>
					<img id='img-logo' src="<?php echo  URL::asset('storage/images/'.$user->logo);?>" style="max-width:150px;margin:20px 20px 20px 20px" />
				<?php  } else { "<img id='img-logo' style='display:none' /> ";  } ?>
				 </div>
				  <div class="utf_submit_section col-md-4">
					<h4>Couverture</h4>
					<form  action="{{ route('users.ajoutcouv') }}" class="dropzone"   id="dropzoneFrom2">
					 {{ csrf_field() }}
					<input type="hidden" name="user"  value="<?php echo $user->id; ?>">
					</form>
				<!--	<span id="submit-couverture">Envoyer</span>	-->		
					 <?php if($user->couverture!=''){  ?>
					<img id='img-couverture' src="<?php echo  URL::asset('storage/images/'.$user->couverture);?>" style="max-width:150px;margin:20px 20px 20px 20px">
				 	<?php  } else { "<img id='img-couverture' style='display:none' /> ";  } ?>

				  </div>
				  <div class="utf_submit_section col-md-4">
					<h4 id="images">Gallery Images</h4>
					<form action="{{ route('users.ajoutimages') }}" class="dropzone"   id="dropzoneFrom3">
					 {{ csrf_field() }}
					<input type="hidden" name="user"  value="<?php echo $user->id; ?>">
					</form>
				  </div>

				  
				<!--  https://www.webslesson.info/2018/07/dropzonejs-with-php-for-upload-file.html--> 
				    
			  </div>



<!-------------------------------------------------------------------------------------------------------->



			  <style>
	.gallery img,#img-couverture,#img-logo{
		max-width:300px;
		max-height:180px;
		
	}
  
 .gallery  figure:hover img {
	opacity: 1;
	-webkit-animation: flash 1.5s;
	animation: flash 1.5s;
}
@-webkit-keyframes flash {
	0% {
		opacity: .4;
	}
	100% {
		opacity: 1;
	}
}
@keyframes flash {
	0% {
		opacity: .4;
	}
	100% {
		opacity: 1;
	}
}


			  </style>
			  
			  <?php 
		$images=  \App\Image::where('user',$user->id)->get();
		if (count($images)>0)
		{
				echo "<h2> Galerie d'images</h2><span> cliquez sur l'image pour la supprimer</span>" ;
				echo'<div class="row">';
			
			foreach($images as $img)
			{ ?>
				<div class="col-sm-4 gallery" style="padding:10px 10px 10px 10px"><figure><img class="" src="<?php echo  URL::asset('storage/images/'.$img->thumb);?>"  /></figure><br><a class="button"  onclick="return confirm('Êtes-vous sûrs de vouloir supprimer cette image ?')"  href="{{action('UsersController@removeimage', [ 'id'=>$img->id,'user'=> $user->id  ])}}"title="supprimer" style="padding:5px 8px" ><i class="sl sl-icon-trash"></i> Supprimer </a> </div>
		<?php	
			}
			
			echo '</div>';
		 }
			  ?>

 
	  </div>

    <!---------------------------------------------probleme------------------------------------------>
  <div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-film"></i> Vidéo - Télécharger une vidéo ou copier un code de vidéo depuis youtube ..</h3>
                </div>       
        <div class="row">
       <div class="col-md-12" >
        <div class="utf_submit_section " id="videos" style="margin-right:20px;">
                    <h4 id="images">Télécharger une vidéo en format mp4</h4>
                    <a  style="float:right;"  href='#' onclick='location.reload();'>Recharger la page</a>
                    <form action="{{ route('users.ajoutvideo') }}" class="dropzone" id="dropvideo">
                     {{ csrf_field() }}
                      <input type="hidden" name="user"  value="<?php echo $user->id; ?>">
                    </form>
                  </div>
      </div>
          <div class="col-md-12" >
            <div >
                    <?php if($user->video!=''){?>
                      <video width="450" height="320" controls>
                        <source src="<?php echo  URL::asset('storage/images/'.$user->video);?>" type="video/mp4">
                        Votre navigateur ne supporte pas l'affichage de cette video.
                      </video>
                      <a  class="button" style="padding:5px 8px"  onclick="return confirm('Êtes-vous sûrs de vouloir supprimer cette video ?')"  href="{{action('UsersController@removevideo', [  'user'=> $user->id  ])}}"title="supprimer"><i class="sl sl-icon-trash"></i> Supprimer</a>
                    <?php } ?>
                  </div>
</div>
          <div class="  col-md-4" style="margin-right:20px;padding:50px 50px 50px 50px">
                        Coller le Code d'intégration depuis youtube, vimeo ..
                        <section><textarea  id="codevideo"  onchange="changing(this)" >{{ $user->codevideo }}</textarea></section>
                  </div>

                  <div class="  col-md-4" >

                    <div class="sizeA" style="overflow-x: auto;">
                        <?php if($user->codevideo!=''){
                          
                          echo $user->codevideo ;
                            }  ?> 
                          </div>
                  </div>

            </div> </div>



<!-------------------------------------------------------------------------------------------------------->






            <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-list"></i> Titre & Description de votre entreprise</h3>
              </div>              
			  <div class="row with-forms">
				  <div class="col-md-6">
					<h5>nom de l'entreprise</h5>
					<input type="text" placeholder="Titre" id="titre" onchange="changing(this)" value="{{ $user->titre }}">
				  </div>
				  <div class="col-md-6">
					<h5>Responsable</h5>
					<input type="text" placeholder="Responsable Commercial"  id="responsable" onchange="changing(this)" value="{{ $user->responsable }}" >
				  </div>				  
				  <div class="col-md-12">
					<h5>Description des activités de l'entreprise</h5>
					<textarea name="description" cols="40" rows="3" id="description" placeholder="Description..." spellcheck="true"  onchange="changing(this)" > {{ $user->description }} </textarea>
				  </div>
				  <div class="col-md-12">
					<h5>Mots clés</h5>
					<textarea name="keywords" cols="40" rows="3" id="keywords" placeholder="Insérez des mots clés, séparées par des virgules" spellcheck="true"  onchange="changing(this)" >{{ $user->keywords }}</textarea>
				  </div>
			  </div>                
            </div>
          
            <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-clock"></i> Heures d'ouverture</h3>                
              </div>              
              <div class="switcher-content"> 
                <div class="row  ">
                  <div class="col-md-2">
                    <h5>Lundi :</h5>
                  </div>
                  <div class="col-md-5">
                    <input type="time"    id="lundi_o" onchange="changing(this)"  value="{{ $user->lundi_o }}" >
					</input>
                  </div>
                  <div class="col-md-5">
                    <input type="time"   id="lundi_f" onchange="changing(this)" value="{{ $user->lundi_f }}" ></input>
                  </div>
                </div>
                
                <div class="row  ">
                  <div class="col-md-2">
                    <h5>Mardi :</h5>
                  </div>
                  <div class="col-md-5">
                    <input type="time"    id="mardi_o" onchange="changing(this)"  value="{{ $user->mardi_o }}"   ></input>
                  </div>
                  <div class="col-md-5">
                    <input type="time"   id="mardi_f" onchange="changing(this)"value="{{ $user->mardi_f }}"   ></input>
                  </div>
                </div>
                
                <div class="row  ">
                  <div class="col-md-2">
                    <h5>Mercredi :</h5>
                  </div>
                  <div class="col-md-5">
                    <input type="time"   id="mercredi_o" onchange="changing(this)" value="{{ $user->mercredi_o }}"  ></input>
                  </div>
                  <div class="col-md-5">
                    <input type="time"   id="mercredi_f" onchange="changing(this)" value="{{ $user->mercredi_f }}" ></input>
                  </div>
                </div>
                
                <div class="row  ">
                  <div class="col-md-2">
                    <h5>Jeudi :</h5>
                  </div>
                  <div class="col-md-5">
                    <input type="time"    id="jeudi_o" onchange="changing(this)" value="{{ $user->jeudi_o }}" ></input>
                  </div>
                  <div class="col-md-5">
                    <input type="time"    id="jeudi_f" onchange="changing(this)" value="{{ $user->jeudi_f }}" ></input>
                  </div>
                </div>
                
                <div class="row  ">
                  <div class="col-md-2">
                    <h5>Vendredi :</h5>
                  </div>
                  <div class="col-md-5">
                    <input type="time"   id="vendredi_o" onchange="changing(this)" value="{{ $user->vendredi_o }}" ></input>
                  </div>
                  <div class="col-md-5">
                    <input type="time"   id="vendredi_f" onchange="changing(this)" value="{{ $user->vendredi_f }}" ></input>
                  </div>
                </div>
                
                <div class="row  ">
                  <div class="col-md-2">
                    <h5>Samedi :</h5>
                  </div>
                  <div class="col-md-5">
                    <input type="time"    id="samedi_o" onchange="changing(this)" value="{{ $user->samedi_o }}"  ></input>
                  </div>
                  <div class="col-md-5">
                    <input type="time"     id="samedi_f" onchange="changing(this)" value="{{ $user->samedi_f }}" ></input>
                  </div>
                </div>
                
                <div class="row  ">
                  <div class="col-md-2">
                    <h5>Dimanche :</h5>
                  </div>
                  <div class="col-md-5">
                    <input type="time"     id="dimanche_o" onchange="changing(this)" value="{{ $user->dimanche_o }}" ></input>
                  </div>
                  <div class="col-md-5">
                    <input type="time"    id="dimanche_f" onchange="changing(this)" value="<?php echo $user->dimanche_f;?>" ></input>
                  </div>
                </div>
              </div>                            
            </div>
           

             <!-- deb  heures indisponibilité  v2 -->
             <?php use App\Indisponibilite; ?>
    <?php if(($user->type_abonn_essai && $user->type_abonn_essai=="type3" ) || ($user->type_abonn &&  $user->type_abonn=="type3" )) {  ?>
      <div class="add_utf_listing_section margin-top-45"> 
				<div class="utf_add_listing_part_headline_part">
					<h3><i class="sl sl-icon-basket-loaded"></i>Heures d'indisponibilité</h3>
                </div>              
				<div class="row">
				  <div class="col-md-12 col-sm-4">
				  	<h4>(T: Titre descriptif de la période d'indisponibilité ; D: Date de début de la période ; F: date de fin de la période)</h4>
					<table id="utf_pricing_list_section">
					  <tbody class="ui-sortable"  id="indispo">
					 	<br>
					<?php   $periodes_indisp=Indisponibilite::where('prest_id',$user->id)->get();
					  foreach($periodes_indisp as $pi){
 					  ?>
 					  	<tr class="pricing-list-item pattern ui-sortable-handle">
						  <td> 
							
							<div class="fm-input pricing-name">
							  T:<input type="text" value="<?php echo $pi->titre;?>"   >
							</div>
							
							<div class="fm-input pricing-ingredients" style="min-width:30%;">
							  D:<input type="text" value="<?php $date=new DateTime($pi->date_debut) ;echo $date->format('d/m/yy H:i');?>" >
							</div>
							<div class="fm-input pricing-price" style="max-width:30%;" ><i class="data-unit"></i>
							  F:<input type="text" data-unit=""  value="<?php $date=new DateTime($pi->date_fin) ;echo $date->format('d/m/yy H:i');?> " > 
							</div>
						 	<div class="fm-close">
							<a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('CalendrierController@remove', [ 'id'=>$pi->id,'user'=> $user->id  ])}}"><i class="fa fa-remove"></i></a>
							</div>
							
							</td>
						</tr>
						
					  <?php } ?>
					  </tbody>
					</table>
					<br>
						<center>
					<a href="#indisp-dialog" class="button popup-with-zoom-anim">Ajouter</a> </center>
					<!--<a href="#" class="button add-pricing-submenu">Add Category</a> --></div>
				</div>                          
            </div>

     <?php } ?>
             <!-- fin  heures indisponibilité  v2 -->

             <!-- deb  heures indisponibilité  v3 -->
             <style type="text/css">
              .fc .fc-button-group {
    position: relative;
    display: block;
    text-align: right;
}
               @media only screen
    and (min-device-width : 0px)
    and (max-device-width : 480px) {
     .sizeA
     {
      width: 81vw;
     }    
    }
    @media only screen
    and (min-device-width : 1025px)
     {
     .sizeA
     {
      width: 100%;
     }    
    }
    @media only screen
    and (max-device-width : 1024px)
    and (min-device-width : 600px)
     {
     .sizeA
     {
      width: 100vw;
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
    }
             </style>
             <?php if(($user->type_abonn_essai && $user->type_abonn_essai=="type3" ) || ($user->type_abonn &&  $user->type_abonn=="type3" )) {  ?>
              <div class="add_utf_listing_section margin-top-45"> 
				<div class="utf_add_listing_part_headline_part">
					<h3><i class="sl sl-icon-basket-loaded"></i>Heures d'indisponibilité - Rendez vous confirmés - Heures ouverture et fermeture </h3>
                </div>              
				<div class="row">
				  <div class="col-md-12 ">
				  	<h4>Calendrier :</h4>
             <div id="legendcolor"  style="background-color:white; top:5px;"> 
            <ul class="legend">
              <li><span class="lightgrey"></span>horaires de fermeture</li>
             <li><span class="green"></span>Happy hours</li>
              <li><span class="red"></span>Indisponibilité de prestataire</li>
             <li><span class="brown"></span>Rendez-vous d'un service confirmé (Possibilité de réservation de le même service à la même date)</li>
            
             <li><span class="blue"></span>Rendez-vous d'un service confirmé (Pas de réservation de le même service à la même date)</li>
             <li><span class="pink"></span>date courante</li>
           </ul>

           </div>
					<br>
					</div>
        </div>  
        <br>

            <div class="row">
          <div class="col-md-12" >	
            <div class="sizeA" >
              <div id='calendar' style="overflow-x: auto;"></div> 
            </div>
          
				</div>
				</div>                          
            </div>

             <!-- fin  heures indisponibilité  v3 -->
         <?php } ?>			
			<div class="add_utf_listing_section margin-top-45"> 
				<div class="utf_add_listing_part_headline_part">
					<h3><i class="sl sl-icon-basket-loaded"></i>Services </h3>
                </div>              
				<div class="row">
				  <div class="col-md-12">
					<table id="utf_pricing_list_section">
					  <tbody class="ui-sortable"  id="services">
					 
					  
					  <?php
 
					  foreach($services as $service){
 					  ?>
						<tr class="pricing-list-item pattern ui-sortable-handle">
						  <td style="align-items:baseline;"> 
							<div class="fm-input">
							<?php if($service->thumb!=''){?>  <img src="<?php echo  URL::asset('storage/images/'.$service->thumb);?>"  style="max-width:100px"  /><?php }?>
							</div>
							<div class="fm-input " style="max-width: 150px">
								<label>type :</label>
								<?php if($service->recurrent=='off'){?>
								<output class="button">Simlpe</output>
							<?php } elseif($service->recurrent=='on'){?>
								<a href="javascript:void(0)"   onclick="openReccurent(<?php echo $service->id;?>)"  class="button" >Reccurent</a> 
								<?php }?>

							</div>
							<div class="fm-input " style="max-width: 190px">
								<label>Nbr services simultanés :</label>
							  <input type="number" onchange="changeService(this)" id="b<?php echo $service->id;?>" name="nbrService" value="<?php echo $service->nbrService;?>"  >
							</div>
							<div class="fm-input pricing-name" >
								<label>Nom :</label>
							  <input type="text" onchange="changeService(this)" id="i<?php echo $service->id;?>" name="nom" value="<?php echo $service->nom;?>"   >
							</div>

							<div class="fm-input pricing-ingredients">
								<label>Description :</label>
							  <input type="text" onchange="changeService(this)" id="u<?php echo $service->id;?>" name="description" value="<?php echo $service->description;?>" >
							</div>
							<div class="fm-input ">
								<label>Durée :</label>
							  <input type="time" onchange="changeService(this)" id="z<?php echo $service->id;?>" name="duree" value="<?php echo $service->duree;?>"   > 
							</div>
							<div class="fm-input pricing-price">
								<label>Prix : (€)</label>
								
							  <input type="text"   onchange="changeService(this)" id="y<?php echo $service->id;?>" name="prix"  data-unit="€"  value="<?php echo $service->prix;?>"   > 
							</div>
							

              
							 <?php if(($user->type_abonn_essai && $user->type_abonn_essai=="type3" ) || ($user->type_abonn &&  $user->type_abonn=="type3" )) {  ?>
              <div class="fm-input " name="produits" style="max-width: 150px">
								<label>Associer un produit:</label>
								<a href="javascript:void(0)"   onclick="openchoices(<?php echo $service->id;?>)"  class="button" >Produits</a> 
							</div>
            <?php }   ?> 

              <script>function openchoices(idwd) {
                  var x = document.getElementById("K"+idwd);
                 if (    x.style.display == "block") {
                 x.style.display = "none";} else {x.style.display = "block";}};
              </script>
						 	<div class="fm-close" >
             
							<a  class="delete fm-close"   style="top: 20px;" onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('ServicesController@remove', [ 'id'=>$service->id,'user'=> $user->id  ])}}"><i class="fa fa-remove"></i></a>
							</div>

							</td>
							<td style="align-items:baseline;"> 
              <div class="fm-input "  style="display: none;" id="K<?php echo $service->id;?>">
                <select class="utf_chosen_select_single" id="produit" name="produit[]" placeholder="Sélectionner un produit" onchange="changeProdSer(this)"  multiple style="font-weight: 17px !important; " >
        <option > </option>
          <?php 
          foreach($produit as $prod){
            //dd($service->produits_id);
            if ($service->produits_id != null) {
           
            if ( in_array($prod->id, $service->produits_id)) {
          echo '<option  style="font-weight: 17px;" value="'.$prod->id.'" selected>'.$prod->nom_produit.'</option>';
            
          } else {
            echo '<option  style="font-weight: 17px;" value="'.$prod->id.'" >'.$prod->nom_produit.'</option>'; 
           }
          } else {
            echo '<option  style="font-weight: 17px;" value="'.$prod->id.'" >'.$prod->nom_produit.'</option>'; 
           }


           }
          ?>
          
          <meta type="hidden" name="csrf-token" content="{{ csrf_token() }}" />

        </select>
                
                 
              </div>     
              <script>//to delete the id produit and id service from the table db 'produit_service' but it woud'nt work 
               
             function changeProdSer(a){
              var service = $(a).parent().attr('id');  
              var serviceArray=service.split('').slice(1);
              var serviceString = serviceArray.join('');
              var produit = $(a).val();
              //alert(serviceString);
		          
              var idservice = serviceString ;
              	var _token = $('input[name="_token"]').val();
               
                $.ajax({
                   url:"{{ route('services.AssociateProd') }}",
                  method:"POST",
                  data:{idservice:idservice,produit:produit, _token:_token},
                     success:function(data){	changed=true;
			               //alert(data);
                       $.notify({
                          message: 'produit ajoutée avec succès',
                        icon: 'glyphicon glyphicon-check'},{
                        type: 'success',
                        delay: 3000,
                        timer: 1000,	
                        placement: {
                        from: "bottom",
                        align: "right" },					
                      });	
                    }
                  });
                      
                  } 
                  </script>

              <div class="fm-input " style="display: none;" id="h<?php echo $service->id;?>">
                <label for="periode">Période :</label>

                <select  onchange="changeService(this)" id="x<?php echo $service->id;?>" name="periode">
                  <option  hidden><?php echo $service->periode;?></option>
                  <option >Jour</option>
                  <option >Semaine</option>
                  <option >Mois</option>
                  <option >toute les 3 semaines</option>
                  <option >1 semaine sur 2</option>
                </select> 
              </div>
						
							<div class="fm-input " style="display: none;" id="f<?php echo $service->id;?>">
								<label>Nbr de fois dans la période:</label>
							  <input type="number" onchange="changeService(this)" id="q<?php echo $service->id;?>" name="Nfois" value="<?php echo $service->Nfois;?>"   > 
							</div>
							<!--<div class="fm-input  " style="display: none;" id="p<?php echo $service->id;?>">
								<?php if($service->frequence=='Journalière'){?>
								<label id="labelperiode2">Période (N° jours) :</label>
								<?php }?>
								<?php if($service->frequence=='Hebdomadaire'){?>
								<label id="labelperiode2">Période (N° semaine) :</label>
								<?php }?>
								<?php if($service->frequence=='Mensuelle'){?>
								<label id="labelperiode2">Période (N° mois) :</label>
								<?php }?>
							  <input type="number"  onchange="changeService(this)" id="w<?php echo $service->id;?>" name="periode" value="<?php echo $service->periode;?>" >
							</div>-->
							
							</td>
							
						</tr>

					  <?php } ?>
					  </tbody>
					</table>
					<br>
	               <center>
					<a href="#small-dialog" class="button popup-with-zoom-anim">Ajouter</a> </center>
					<!--<a href="#" class="button add-pricing-submenu">Add Category</a> --></div>
				</div>                          
            </div>
   <!----------------------------------------------------------------------------->
     <!-------------------------------- Debut de Code promo--------------------------------------------->
     <?php 
     if(($user->type_abonn_essai && ($user->type_abonn_essai=="type2" || $user->type_abonn_essai=="type3" ))|| ($user->type_abonn && ($user->type_abonn=="type2" || $user->type_abonn=="type3" ))) { ?>
            <div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-diamond"></i>Code promo </h3>
                </div>              
        <div class="row">
          <div class="col-md-12">
          <table id="utf_pricing_list_section">
            <tbody class="ui-sortable"  id="services">
           <?php foreach($serviceWithCode as $Scode){ ?>
            <?php $ser =  $services->find($Scode->id_service); if($ser) {?>
            <tr class="pricing-list-item pattern ui-sortable-handle">
              <td> 
              <div class="col-md-2">
                <img src="<?php echo  URL::asset('storage/images/'.$ser->thumb);?>"  style="max-width:100px"  />
              </div>
              <div class="col-md-2" style="max-width: 150px">
                <label>Nom :</label>
                <output >{{$ser->nom}} </output>

              </div>
              <div class="col-md-2">
            <label>Pourcentage de réduction :</label>
            <div >
          <i class="data-unit" >%</i>
          <input data-unit="%"  type="number" value="{{ $Scode->reduction }}" onchange="changeReductionCode(this)" id="p{{ $Scode->id }}">
          </div>
        </div>
              <div class="col-md-2" >
                <label>Code promo :</label>
                <output >{{$Scode->code}} </output>
              </div>

              
              <div class="fm-close">
              <a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')" href="{{url('services/remove_CodePromo/'.$Scode->id)}}" ><i class="fa fa-remove"></i></a>
              </div>

              </td>
              
            </tr>
<?php } }?>
            </tbody>
          </table>
          <br>
                 <center>
          <a href="#small-dialog9" class="button popup-with-zoom-anim">Ajouter</a> </center>
          <!--<a href="#" class="button add-pricing-submenu">Add Category</a> --></div>
        </div>                          
            </div>

    <?php } ?>
<!------------------------------fin code promo----------------------------------------------->

            <!------------------------------produits----------------------------------------------->
<style>
.switch {
margin-left:29px;  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
    margin-left: -1px;
    margin-top: -4px;}

.slider.round:before {
  border-radius: 50%;
}
</style>
     



 <!-------------------------------------------produits----------------------------------->
<?php 
     if(($user->type_abonn_essai &&  $user->type_abonn_essai=="type3" )|| ($user->type_abonn &&  $user->type_abonn=="type3" )) { ?>
<div class="add_utf_listing_section margin-top-45"> 
  <div class="utf_add_listing_part_headline_part">
    <h3><i class="fa fa-product-hunt"></i>Produits </h3>
    <label class="switch">
      <input  id="toggleProd"  type="checkbox"  <?php if ($user->section_product== 'active'){ echo 'checked' ; } ?>   />
      <span class="slider round"></span>
    </label>
  </div>
  <div class="row" id="<?php echo  $user->id;?>" <?php if ($user->section_product== 'desactive') { echo 'type="checkbox"'; } ?> >
    <div class="col-md-12">
      <table id="utf_pricing_list_section">
        <tbody class="ui-sortable"  id="produits">
        <?php foreach($produit as $prod){ ?>
          <tr class="pricing-list-item pattern ui-sortable-handle">
            <td>
              <div class="fm-input">
                <?php if($prod->image!=''){?>  <img src="<?php echo  URL::asset('storage/images/'.$prod->image);?>"  style="max-width:100px"  />
                <?php } ?>
              </div>
              <div class="fm-input " style="max-width: 150px">
                <label>type :</label>
                <output class="button">{{$prod->type}}</output>
              </div>
              <div class="fm-input pricing-name" >
                <label>Nom :</label>
                <input type="text" onchange="changeProduct(this)" id="i<?php echo $prod->id;?>" name="nom_produit" value="<?php echo $prod->nom_produit;?>"   >
              </div>
              <div class="fm-input pricing-ingredients">
                <label>Description :</label>
                <input type="text" onchange="changeProduct(this)" id="h<?php echo $prod->id;?>" name="description" value="<?php echo $prod->description;?>" >
              </div>
              <div class="fm-input pricing-price">
                <label>Prix : (€)</label>
                <input type="text"   onchange="changeProduct(this)" id="x<?php echo $prod->id;?>" name="prix_unité"  data-unit="€"  value="<?php echo $prod->prix_unité;?>"   >
              </div>
              <div class="fm-close">
                <a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')" href="{{url('/services/remove_product/'.$prod->id)}}" ><i class="fa fa-remove"></i></a>
              </div>
            </td>
            <td ></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <br>
      <center><a href="#small-dialogProduct" class="button popup-with-zoom-anim">Ajouter</a></center>
      <!--<a href="#" class="button add-pricing-submenu">Add Category</a> -->
    </div>
  </div>
</div>              
     <?php } ?>        <!------------------------------------------------------------------------------>

            <!----------------------------------------------------------------------------->				
<div class="add_utf_listing_section margin-top-45"> 
				<div class="utf_add_listing_part_headline_part">
					<h3><i class="sl sl-icon-present"></i>Carte de fidélité </h3>
                </div>       
				<div class="row">
				  <div class="col-md-12" >
				  	<h2><i class="sl sl-icon-star"></i><b> La réduction s'applique à la 10ème reservation.</b></h2>
				  	<br>
				  </div>
				  <div class="col-md-2">
				  	<label>Pourcentage de réduction :</label>
				  	<div >
					<i class="data-unit" >%</i>
					<input data-unit="%"  type="number" value="{{ $user->reduction }}" onchange="changeReduction(this)" id="reductionId">
					</div>
				</div>
				</div>                          
            </div>	

  <?php if(($user->type_abonn_essai && $user->type_abonn_essai=="type3" ) || ($user->type_abonn &&  $user->type_abonn=="type3" )) {  ?>

      <div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-present"></i>Happy hours </h3>
                </div>       
        <div class="row">
          <div class="col-md-12" >
            <br>
          </div>
          <form action="{{ route('services.HappyHours') }}" method="post"  >
            {{ csrf_field() }}
            <input name="id_user" value="{{$user->id}}" hidden>
          <div class="col-md-2">
            <label>Pourcentage de réduction :</label>
            <div >
          <i class="data-unit" >%</i>
          <input data-unit="%"  type="number" value="" name="reduction" required>
          </div></div>
          <div class="col-md-2">
            <label>De :</label>
            <div >
          <input  type="datetime-local" value="" name="date_debut" required>
          </div>

        </div> 
        <div class="col-md-2">
            <label>à :</label>
            <div >
          <input  type="datetime-local" value="" name="date_fin">
          </div>

        </div>  
        <div class="col-md-2">
            <label>Places :</label>
            <div >
          <input  type="number" value="" name="places" required>
          </div>

        </div>
        <div class="col-md-2">
            <label></label>
            <div >
<center><input type="submit" style="text-align:center;color:white;" value="Ajouter"></input></center>
          </div>

        </div></form> 

      </div>
      <div class="sizeA" style="max-height: 200px; overflow-y: auto;overflow-x: scroll;">
    <table class="table" style="font-size: 150%; "  >
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Réduction</th>
      <th scope="col">Places</th>
      <th scope="col">Bénéficiaires</th>
      <th scope="col">Date</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php $x=0; foreach($happyhours as $happyhour){ $x=$x+1 ; ?>
    <tr>
      <th scope="row">{{$x}}</th>
      <td>{{$happyhour->reduction}}%</td>
      <td>{{$happyhour->places}}</td>
      <td>{{$happyhour->Beneficiaries}}</td>
      <td width="50%"><b>De</b> <?php $dateDebut = new DateTime($happyhour->dateDebut); echo $dateDebut->format('d-m-Y H:i') ; ?> <b>à</b> <?php $dateFin = new DateTime($happyhour->dateFin); echo $dateFin->format('d-m-Y H:i') ; ?></td>
      <td><a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')" href="{{url('services/remove_happyhour/'.$happyhour->id)}}"><i class="fa fa-remove"></i></a></td>
    </tr>
  <?php } ?>
 
  </tbody>
</table></div>  
</div>
 <?php } ?>

 <?php 
     if(($user->type_abonn_essai && ($user->type_abonn_essai=="type2" || $user->type_abonn_essai=="type3" ))|| ($user->type_abonn && ($user->type_abonn=="type2" || $user->type_abonn=="type3" ))) { ?>
  <div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-question"></i>Services Supplémentaires</h3>
        </div>      
        <div class="row">
          <div class="col-md-12">
           
            <center> <label><h3>Liste des règles pour les services supplémentaires</h3></label></center><br><br>
             <center> 
            <table class="table table-striped" id="table_serv_supp" style="width: 80% !important;">
                <thead>
                  <tr>
                    <th><h3>Services additionnées</h3></th>
                    <th><h3>Service(s) et/ou produit(s) offert(s)</h3></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php  $regle_ser_supp=ServiceSupp::where('prestataire',$user->id)->get();?>
                  <?php foreach($regle_ser_supp as $rss) {
                  //dd($rss->re) 
                     $res=explode('=', $rss->regle);
                    ?>
                  <tr>
                    <td>{{$res[0]}}</td>
                    <td>{{$res[1]}}</td>
                    <td><input type="button" style="width: 50px !important; color: white !important;" value="X " onclick="deleteRow(this ,<?php echo $rss->id ?>)"></td>
                  </tr>                 
                <?php } ?>
                </tbody>
              </table>
           </center> 
          <br>
           <hr>
          <br>

   <div class="">
     
        <?php $nbcomm=0;?>

          <div class="row">
          <center> <label><h3>Créez une nouvelle règle pour offrir un service ou des produits supplémentaires</h3></label></center><br><br>
          <div class="col-md-5 com_wrapper" style="border-right-style: solid;">          
         <center> <label><h3>Addition des services</h3></label></center><br>
      <?php if($nbcomm<3){?>
       <div class="row">
             <div class="col-md-10">

              <?php  $services_pres=Service::where('user',$user->id )->get(['id','nom']);?>
       
            <select name="cars" class="cars">
            <option value=""></option>
              @foreach ($services_pres as $sp)
            <option value="{{$sp->nom}}">{{$sp->nom}}</option>
            @endforeach
            </select>

          </div>

            <div class="col-md-2"> <a href="javascript:void(0);" class="com_button" title="Ajouter un champs"><?php if($nbcomm<=1){ ?><img width="26" height="26" src="{{ asset('public/img/add.png') }}" style="float:left"/> <br><?php } ?></a> </div>
      </div> 
    <?php } ?>
    </div>
    <?php  $produits_pres=Produit::where('user',$user->id )->get(['id','nom_produit']);
     
    ?>
    <div class="col-xs-1" style="width: 5px !important;" >
    </div>
     <div class="col-md-6" style="border-style: dotted; ">
      <center> <label><h3>Résultat pour l'addition des services</h3></label></center><br>
      <div class="row">
        <div class="col-md-3" >
      <center><label>Service ou produit offert (résultat): </label></center>
      </div>
      <div class="col-md-6" >
    <center> <select name="cars" id="resser1" class="Resservice" style="width:100%;">
    <option value=""></option>
     @foreach($services_pres as $sp)
     <option value="{{$sp->nom}}">{{$sp->nom}}</option>
     @endforeach
     @foreach($produits_pres as $sp)
     <option value="{{$sp->nom_produit}}">{{$sp->nom_produit}}</option>
     @endforeach

    </select></center><br>
     </div>
      <div class="col-md-1" >
        avec quatité 
     </div>
      <div class="col-md-2" >
      <input id="qteres1" type="number" value="1" min="1" max="10">
     </div>
    </div>

     <div class="row">
        <div class="col-md-3" >
      <center><label>Service ou produit offert (résultat): </label></center>
      </div>
      <div class="col-md-6" >
    <center> <select name="cars" id="resser2" class="Resservice" style="width:100%;"><option value=""></option>  @foreach($services_pres as $sp)
     <option value="{{$sp->nom}}">{{$sp->nom}}</option>
     @endforeach
     @foreach($produits_pres as $sp)
     <option value="{{$sp->nom_produit}}">{{$sp->nom_produit}}</option>
     @endforeach</select></center><br>
     </div>
      <div class="col-md-1" >
        avec quatité 
     </div>
      <div class="col-md-2" >
      <input id="qteres2" type="number" value="1" min="1" max="10">
     </div>
    </div>

     <div class="row">
        <div class="col-md-3" >
      <center><label>Service ou produit offert (résultat): </label></center>
      </div>
      <div class="col-md-6" >
    <center> <select name="cars" id="resser3" class="Resservice" style="width:100%;"><option value=""></option> @foreach($services_pres as $sp)
     <option value="{{$sp->nom}}">{{$sp->nom}}</option>
     @endforeach
     @foreach($produits_pres as $sp)
     <option value="{{$sp->nom_produit}}">{{$sp->nom_produit}}</option>
     @endforeach</select></center><br>
     </div>
      <div class="col-md-1" >
        avec quatité 
     </div>
      <div class="col-md-2" >
      <input id="qteres3" type="number" value="1" min="1" max="10">
     </div>
    </div>
      </div> 
      </div>
      <div class="row">
       <br>
      <center> <a onclick='ecrire_formule()' href="javascript:void(0)" class="button">Valider</a> </center>
       <br>
      </div> 
      <div class="row"> 
       <form method="post" action="{{route('regle_service_suppls')}}" >  
       @csrf
       <input type="hidden"  value="{{$user->id}}" name="prestataire">  
        <hr>
        <br>
       <center>
        <label>Règle totale obtenue: </label>
        <input autocomplete="off"  type="text"  size="80" style="width:80% ; " id="restotal"  name="regle" value=""/> 
      </center>
    
      </div>
      <div class="row">
       <br>
      <center> <input type="submit" class="button" value="Enregistrer" style="color:white"> </center>
       <br>
      </div> 
      </form>
   </div> 
     </div> 
   </div> 
 </div>

 <?php } ?>

		<div class="add_utf_listing_section margin-top-45"> 
				<div class="utf_add_listing_part_headline_part">
					<h3><i class="sl sl-icon-question"></i>FAQ</h3>
                </div>       
						<?php $faqs= \App\Faq::where('user',$user->id)->get(); ?>
				<div class="row">
				  <div class="col-md-12">
					<table id="utf_faq_list_section">
					  <tbody class="ui-sortable"  id="faqs">
					  <?php foreach($faqs as $faq){ ?>
						<tr class="pricing-list-item pattern ui-sortable-handle">
						  <td> 
							<div class="fm-input pricing-name">
							  <input type="text" value="<?php echo $faq->question;?>"   >
							</div>
							<div class="fm-input pricing-ingredients">
							  <input type="text" value="<?php echo $faq->reponse;?>" >
							</div>
 
						 	<div class="fm-close">
							<a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('FaqsController@remove', [ 'id'=>$faq->id,'user'=> $user->id  ])}}"><i class="fa fa-remove"></i></a>
							</div>
							</td>
						</tr>
					  <?php } ?>
					  </tbody>
					</table>
				 <a href="#small-dialog2" class="button popup-with-zoom-anim">Ajouter FAQ</a> 
					<!--<a href="#" class="button add-pricing-submenu">Add Category</a> --></div>
				</div>                          
            </div>	


           <!--  modal pour ajouter une indisponibilté -->

       <div id="indisp-dialog" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Ajouter une période d'indisponibilité</h3>
          </div>
		  <form  method="post" enctype="multipart/form-data"   action="{{ route('periodes_indisp.store') }}"  >
		  {{ csrf_field() }}
		  
		   <div class="utf_signin_form style_one">
		 	 <input type="hidden" name="user" value="{{$user->id}}"  >
              <label>Titre descriptif *: </label>
			  <div class="fm-input">
			  <input type="text" placeholder="Titre descriptif" id="tdesc"  name="tdesc" required >
			</div>
             <label>Date de début *: </label>
			<div class="fm-input">
			  <input type="datetime-local" placeholder="Début période indisponibilité *"  id="dpindisp"  name="dpindisp" required>
			</div>
            <br>
			<label>Date de fin *: </label>
			<div class="fm-input"> 
			  <input type="datetime-local" placeholder="Fin période indisponibilité *" name="fpindisp" id="fpindisp" required> 
			</div>
			<br>
	         <center><input type="submit" style="text-align:center;color:white;" value="Ajouter"></input></center>

			</form>				
		 </div>		  
		 		  
			 
		<!-- fin modal pour ajouter une indisponibilté -->	

		 <!--  modal pour ajouter une eve -->

		 {{--<div id="calendardialog" class="modalkbs">

			   <div class="modal-content">
			    <div class="modal-header">
			      <span class="close">&times;</span>
			      <h2>ajouter</h2>
			    </div>
			    <div class="modal-body">
			     <form  method="post" enctype="multipart/form-data"   action="{{ route('services.store') }}"  >
				  {{ csrf_field() }}
				 	 <input type="hidden" name="user" value="{{$user->id}}"  >
		              <label>Titre descriptif *: </label>
					  <div class="fm-input">
					  <input type="text" placeholder="Titre descriptif" id="tdesc"  name="tdesc" required >
					</div>
		             <label>Date de début *: </label>
					<div class="fm-input">
					  <input type="datetime-local" placeholder="Début période indisponibilité *"  id="dpindisp"  name="dpindisp" required>
					</div>
		            <br>
					<label>Date de fin *: </label>
					<div class="fm-input"> 
					  <input type="datetime-local" placeholder="Fin période indisponibilité *" name="fpindisp" id="fpindisp" required> 
					</div>
					<br>
			         <center><input type="submit" id="add" style="text-align:center;color:white;" value="Ajouter"></input></center>
			    </form>	
			    </div>
			    <div class="modal-footer">
			      <h3>Modal Footer</h3>
			    </div>
			  </div>

          </div>--}}

	<!-------------------------Model Produit---------------------------------------------->
  <div id="small-dialogProduct" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Ajouter un produit  </h3>
          </div>
      <form  method="post" enctype="multipart/form-data"   action="{{ route('produit.store') }}"  >
      {{ csrf_field() }}
      
     <div class="utf_signin_form style_one">
              <input type="hidden" name="user" value="{{$user->id}}"  />
               <div class="fm-input ">
                <label for="type">Type :</label>
                <select id="type" name="type" onchange="myFunctionPSelect()">
                <option value="Physique">Physique</option>
                  <option value="Numérique" >Numérique</option>
                </select> 
              </div><br>
              <div class="fm-input " id="URL" name="URL" hidden="true" >
              <label for="Fichier">Fichier:</label>
                <input type="file" name="Fichier" id="Fichier"  >
                <label for="URL_telechargement">Url de télechargement:</label>
                <input type="text" name="URL_telechargement" id="URL_telechargement" placeholder="URL de télechargement*"  >
              </div><br></div>

              
                     <div class="fm-input ">
                     <label for="image" >Importer une image</label>
          <input type="file" name="image" id="image" required >
       </div>
       <br>
     <div class="fm-input ">
                <input type="text" placeholder="Nom du produit*" id="nom"  name="nom_produit" required >
              </div>
              <div class="fm-input  ">
                <input type="text"   placeholder="description du produit*"  id="description"  name="description">
              </div>
              
              
              <div class="fm-input  "> 
                <input type="text"      placeholder="prix du produit*" name="prix_unité" id="prix" required> 
              </div>
            <input type="submit" id="add" style="text-align:center;color:white;" value="Ajouter"></input>

      </form>       
    <!-- <a class="button" id="add" style="text-align:center">Ajouter</a>-->
     </div>     
     </div>     
      <!--------------------------------------------- Fin Model Produit---------------------------------------------->

		
<!---------------------------------------------------------------------------------------------------->
          <div id="small-dialog9" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Ajouter un code promo  </h3>
          </div>
      <form  method="post" enctype="multipart/form-data"   action="{{ route('services.CodePromo') }}"  >
      {{ csrf_field() }}
      
     <div class="utf_signin_form style_one">
      <input type="hidden" name="user" value="{{$user->id}}"  >
       
       <div class="fm-input ">
                <label for="myServices">Services :</label>
       <select onchange="myFunctionSelect()" name="myServices">
        <?php foreach($services as $service){ ?>
                  <option value="{{$service->id}}">{{$service->nom}}</option>
                <?php } ?>
                  
                </select> 
    </div><br>
    <div class="fm-input ">
            <label>Pourcentage de réduction :</label>
            <div >
          <input   type="number" min="1" max="99" value="1" name="redu">
          </div>
        </div>
              <div class="fm-input ">
                <label>code promo :</label>
                <input type="test"  placeholder="Exemple: sc445sd7ff" id="nbrService"  name="code"  required="required">
              </div>
              <br>
            <input type="submit" id="add" style="text-align:center;color:white;" value="Ajouter"></input>

      </form>       
    <!-- <a class="button" id="add" style="text-align:center">Ajouter</a>-->
     </div>     
     </div> 


       		  
			 
		<!-- fin modal pour ajouter une eveé -->	

	        <div id="small-dialog" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Ajouter un service  </h3>
          </div>
		  <form  method="post" enctype="multipart/form-data"   action="{{ route('services.store') }}"  >
		  {{ csrf_field() }}
		  
		 <div class="utf_signin_form style_one">
		 				  <input type="hidden" name="user" value="{{$user->id}}"  >

			 <div class="fm-input ">
				  <input type="file" name="photo" id="photo" required >
			 </div>
			 <br>
		 <div class="fm-input ">
							  <input type="text" placeholder="nom de service*" id="nom"  name="nom" required >
							</div>
							<div class="fm-input  ">
							  <input type="text"   placeholder="description de service"  id="description"  name="description">
							</div>
							<div class="fm-input ">
								<label>Nbr Services simultanés :</label>
							  <input type="number" value=1 id="nbrService"  name="nbrService" >
							</div>
							<div class="fm-input  "> 
								<label >Durée de service*</label>
							  <input type="time"   value="01:00"   placeholder="durée de service*" name="duree" id="duree" required> 
							  <br>
							</div>
							<style type="text/css">
								input:checked + .slider {
							  background-color: #2196F3;
							}
							</style>
							<label>Récurrent :</label>
							<br>
							<label class="switch" >
							  <input type="checkbox" id="toggleswitch" name="toggleswitch" <?php 
     if(($user->type_abonn_essai && ($user->type_abonn_essai=="type2" || $user->type_abonn_essai=="type1" ))|| ($user->type_abonn && ($user->type_abonn=="type2" || $user->type_abonn=="type1" ))) { echo "disabled"; }?>>
							  <span class="slider round"></span>
							</label>
							<div id="reccurent" style="display: none;" >
							<div class="fm-input " >
              
                <label for="mySelect">Période :</label>

                <select id="mySelect" name="mySelect" onchange="myFunctionSelect()">
                  <option >Jour</option>
                  <option >Semaine</option>
                  <option >Mois</option>
                  <option >toute les 3 semaines</option>
                  <option >1 semaine sur 2</option>
                </select> </div>
             <br>
              <div class="fm-input " >
             <label>Nombre de fois dans la période :</label>
                <input type="number"  min=1 value="1" id="Nfois" name="Nfois"  > 
              </div><br>
								<!--<label>Nombre de fois :</label>
							  <input type="number"  value="1" id="Nfois" name="Nfois"  > 
							</div>
							<div class="fm-input ">
							  <label for="mySelect">Fréquence :</label>

								<select id="mySelect" name="mySelect" onchange="myFunctionSelect()">
								  <option >Journalière</option>
								  <option >Hebdomadaire</option>
								  <option >Mensuelle</option>
								</select> 
							</div><br>
							<div class="fm-input  ">
								<label id="labelperiode">Période (N° de jours) :</label>
							  <input type="number" id="periode"  placeholder="nombre de jours"   name="periode">
							</div><br>--></div>
							<div class="fm-input  "> 
							  <input type="text"  placeholder="prix de service*" name="prix" id="prix" required> 
							</div>
					  <input type="submit" id="add" style="text-align:center;color:white;" value="Ajouter"></input>

			</form>				
		<!-- <a class="button" id="add" style="text-align:center">Ajouter</a>-->
		 </div>		  
		 </div>		  
			
			
			
			
	  <div id="small-dialog2" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Ajouter FAQ </h3>
          </div>
		    <div class="utf_signin_form style_one">
			
		      <div class="fm-input ">
		        <input type="text" placeholder="Question" id="question">
		      </div>
			     <div class="fm-input  ">
			       <textarea   placeholder="Réponse"  id="reponse"></textarea>
			     </div>
	 
							
		      <a class="button" id="addfaq" style="text-align:center">Ajouter</a>
		    </div>		  
		 </div>	
		 
		 
			<div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-tag"></i>Catégories</h3>
              </div>              
              <div class="checkboxes in-row amenities_checkbox">
                <ul>

				
				<?php foreach($categories as $categ)
				{
					$cats_user = $categories_user->toArray();
					$idcat= $categ->id;
					if( in_array($idcat,$cats_user) ){
						$check='checked';
					}else{
					$check='';
					}
			 echo '	<li id="li-'.$categ->id.'" class="categories" >
						<input id="cat-'.$categ->id.'" type="checkbox" name="check" '.$check.'   >
						<label for="cat-'.$categ->id.'"   >'.$categ->nom.' </label>
					</li>';					 
					
				}
				
				?>			
				</ul>				
              </div>              
            </div>   
                    
            
			
		 <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-docs"></i> Infos de contact</h3>
              </div>  
			
				    <div class="row with-forms">
	 
					<div class="col-md-4">
						<label>Tél</label>						
						<input type="text" class="input-text" id="tel" placeholder="(123) 123-456" value="{{ $user->tel }}"  onchange="changing(this)">
					</div>
					<div class="col-md-4">
						<label>Email</label>						
						<input type="email" class="input-text" id="email" placeholder="test@example.com" value="{{ $user->email }}"  onchange="changing(this)">
					</div>
 
					<div class="col-md-4">
						<label>Facebook</label>						
						<input type="text" class="input-text" id="fb" placeholder="https://www.facebook.com" value="{{ $user->fb }}"  onchange="changing(this)">
					</div>
					<div class="col-md-4">
						<label>Twitter</label>						
						<input type="text" class="input-text"  id="twitter" placeholder="https://www.twitter.com" value="{{ $user->twitter }}"  onchange="changing(this)">
					</div>										
					<div class="col-md-4">
						<label>Linkedin</label>
						<input type="text" class="input-text" id="linkedin"  placeholder="https://www.linkedin.com" value="{{ $user->linkedin }}" onchange="changing(this)">					
					</div>
					<div class="col-md-4">
						<label>Instagram</label>
						<input type="text" class="input-text"  id="instagram" placeholder="https://instagram.com" value="{{ $user->instagram }}"  onchange="changing(this)">					
					</div>
				<!--	<div class="col-md-4">
						<label>Skype</label>
						<input type="text" class="input-text"  id="skype" placeholder="https://www.skype.com" value="{{ $user->skype }}"  onchange="changing(this)">					
					</div>-->
				  </div>	
               
			</div>
			 </div>
		<!---	
			 <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-docs"></i> Test Map</h3>
              </div>  
			
				    <div class="row with-forms">
			
			

    <style type="text/css">
       

      #locationField,
      #controls {
        position: relative;
        width: 480px;
      }

      #autocomplete {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 99%;
      }

      
      #address {
        border: 1px solid #000090;
        background-color: #f0f9ff;
        width: 480px;
        padding-right: 2px;
      }

      #address td {
        font-size: 10pt;
      }

      .field {
        width: 99%;
      }

      .slimField {
        width: 80px;
      }

      .wideField {
        width: 200px;
      }

      #locationField {
        height: 20px;
        margin-bottom: 2px;
      }
    </style>
	
	 
    <script>
      // This sample uses the Autocomplete widget to help the user select a
      // place, then it retrieves the address components associated with that
      // place, and then it populates the form fields with those details.
      // This sample requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script
      // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
     
    </script>
 
    <div id="locationField">
      <input
        id="autocomplete"
        placeholder="Enter your address"
        onFocus="geolocate()"
        type="text"
      />
    </div>

    <!-- Note: The address components in this sample are typical. You might need to adjust them for
               the locations relevant to your app. For more information, see
         https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
    
-->
    <table id="address" style="visibility:hidden" >
      <tr>
        <td class="label">Street address</td>
        <td class="slimField">
          <input class="field" id="street_number" disabled="true" />
        </td>
        <td class="wideField" colspan="2">
          <input class="field" id="route" disabled="true" />
        </td>
      </tr>
      <tr>
        <td class="label">City</td>
        <td class="wideField" colspan="3">
          <input class="field" id="locality" disabled="true" />
        </td>
      </tr>
      <tr>
        <td class="label">State</td>
        <td class="slimField">
          <input
            class="field"
            id="administrative_area_level_1"
            disabled="true"
          />
        </td>
        <td class="label">Zip code</td>
        <td class="wideField">
          <input class="field" id="postal_code" disabled="true" />
        </td>
      </tr>
      <tr>
        <td class="label">Country</td>
        <td class="wideField" colspan="3">
          <input class="field" id="country" disabled="true" />
        </td>
      </tr>
    </table> 
		<!--	
			</div>
			</div> -->
			
			 
			
			
			
			<!--<a href="#" class="button preview">Enregistrer</a> </div>-->
        </div>
      <!--  <div class="col-md-12">
          <div class="footer_copyright_part">Copyright © 2019 All Rights Reserved.</div>
        </div>-->
      </div>
    </div>    
  </div>  
</div>  
  
  <script src="{{  URL::asset('public/scripts/perfect-scrollbar.min.js') }}" ></script>
<!-- <link rel="stylesheet"   href="{{ URL::asset('public/css/bootstrap.css')}}">
<link rel="stylesheet"   href="{{ URL::asset('public/css/bootstrap-grid.css')}}">-->

<!--	<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">-->
	<link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
<!--    <script src="//bootstrap-notify.remabledesigns.com/js/bootstrap-notify.min.js"></script>
 -->   <script src="../public/js/bootstrap-notify.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js" integrity="sha512-vCgNjt5lPWUyLz/tC5GbiUanXtLX1tlPXVFaX5KAQrUHjwPcCwwPOLn34YBFqws7a7+62h7FRvQ1T0i/yFqANA==" crossorigin="anonymous"></script> -->
 <!--  <script  src="{{ URL::asset('public/js/notify.js')}}"></script>-->


<!-- Maps --> 
<!-- <script src="https://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>   -->
<!--<script src="{{  URL::asset('public/scripts/infobox.min.js') }}"></script> -->
<script src="{{  URL::asset('public/scripts/markerclusterer.js') }}"></script> 
<!--<script src="{{  URL::asset('public/scripts/maps.js') }}"></script>-->
<script>
/*
$(".utf_opening_day.utf_js_demo_hours .utf_chosen_select").each(function() {
	$(this).append(''+
        '<option></option>'+
        '<option>Fermé</option>'+
        '<option>01:00</option>'+
        '<option>02:00</option>'+
        '<option>03:00</option>'+
        '<option>04:00</option>'+
        '<option>05:00</option>'+
        '<option>06:00</option>'+
        '<option>07:00</option>'+
        '<option>08:00</option>'+
        '<option>09:00</option>'+
        '<option>10:00</option>'+
        '<option>11:00</option>'+
        '<option>12:00</option>'+
        '<option>13:00</option>'+
        '<option>14:00</option>'+
        '<option>15:00</option>'+
        '<option>16:00</option>'+
        '<option>17:00</option>'+
        '<option>18:00</option>'+
        '<option>19:00</option>'+
        '<option>20:00</option>'+
        '<option>21:00</option>'+
        '<option>22:00</option>'+
        '<option>23:00</option>'+
        '<option>00:00</option>');
});

<?php if ($user->lundi_o !=''){?>
$("#lundi_o").val("<?php echo $user->lundi_o ; ?>");
<?php } ?>
<?php if ($user->lundi_f !=''){?>
$("#lundi_f").val("<?php echo $user->lundi_f ; ?>");
<?php } ?>
<?php if ($user->mardi_o !=''){?>
$("#mardi_o").val("<?php echo $user->mardi_o ; ?>");
<?php } ?>
<?php if ($user->mardi_f !=''){?>
$("#mardi_f").val("<?php echo $user->mardi_f ; ?>");
<?php } ?>
<?php if ($user->mercredi_o !=''){?>
$("#mercredi_o").val("<?php echo $user->mercredi_o ; ?>");
<?php } ?>
<?php if ($user->mercredi_f !=''){?>
$("#mercredi_f").val("<?php echo $user->mercredi_f ; ?>");
<?php } ?>
<?php if ($user->jeudi_o !=''){?>
$("#jeudi_o").val("<?php echo $user->jeudi_o ; ?>");
<?php } ?>
<?php if ($user->jeudi_f !=''){?>
$("#jeudi_f").val("<?php echo $user->jeudi_f ; ?>");
<?php } ?>
<?php if ($user->vendredi_o !=''){?>
$("#vendredi_o").val("<?php echo $user->vendredi_o ; ?>");
<?php } ?>
<?php if ($user->vendredi_f !=''){?>
$("#vendredi_f").val("<?php echo $user->vendredi_f ; ?>");
<?php } ?>
<?php if ($user->samedi_o !=''){?>
$("#samedi_o").val("<?php echo $user->samedi_o ; ?>");
<?php } ?>
<?php if ($user->samedi_f !=''){?>
$("#samedi_f").val("<?php echo $user->samedi_f ; ?>");
<?php } ?>
<?php if ($user->dimanche_o !=''){?>
$("#dimanche_o").val("<?php echo $user->dimanche_o ; ?>");
<?php } ?>
<?php if ($user->dimanche_f !=''){?>
$("#dimanche_f").val("<?php echo $user->dimanche_f ; ?>");
<?php } ?>
*/
</script> 
<script>     function changeProduct(a){
      //alert("ok");
      var valchange = $(a).val();
      var idchange = ($(a).attr('id')).substring(1);
      var namechange = $(a).attr('name');

      //alert(namechange);
      var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('produit.modif') }}",
                        method:"POST",
            data:{valchange:valchange,idchange:idchange,namechange:namechange, _token:_token},
                        success:function(data){
                          
                        }
                    });

  };  
function myFunctionPSelect(){

var x = document.getElementById("type").value;
//alert(document.getElementById("periode").placeholder);
if (x=="Numérique") {
  document.getElementById("URL").style.display = 'block';
  //document.getElementByName("mySelectinput")[0].placeholder=nombre de jours;
}else if(x=="Physique"){document.getElementById("URL").style.display = 'none';}
}
</script>  
<script>
var input = document.getElementById('toggleProd');

    input.addEventListener('change',function(){
        if(this.checked) {
            
            alert("oui"); 
        } else {
             alert("non");
        }
    });
   
</script>
<script src="{{  URL::asset('public/scripts/dropzone.js') }}"></script>


   <script>
    function changeReductionCode(x){
      var id = $(x).attr('id');
      id=id.substring(1) ;
     // alert(id);
      var valchange = $(x).val();
     // alert(valchange);
      var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('services.reduction_CodePromo') }}",
                        method:"POST",
            data:{valchange:valchange, _token:_token, id:id},
                        success:function(data){
                         // alert("ok");
                        }
                    });

    }
   	function changeReduction(x){
   		var valchange = $(x).val();
   		//alert(valchange);
   		var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('services.reduction') }}",
                        method:"POST",
						data:{valchange:valchange, _token:_token},
                        success:function(data){
                        	//alert("ok");
                        }
                    });

   	}
   	function changeService(a){
   		//alert("ok");
   		var valchange = $(a).val();
   		var idchange = ($(a).attr('id')).substring(1);
   		var namechange = $(a).attr('name');
   		if (namechange=="frequence") {
   			//alert("oui");
   			if (valchange=="Journalière") {
   				//alert("oui");
    		document.getElementById("labelperiode2").innerHTML = "Période (N° de jours) : ";
    		//document.getElementByName("mySelectinput")[0].placeholder=nombre de jours;
    	}
    	else if (valchange=="Hebdomadaire") {
    		document.getElementById("labelperiode2").innerHTML = "Période (N° de semaines) : ";
    	

    	}
    	else if (valchange=="Mensuelle") {
    		document.getElementById("labelperiode2").innerHTML = "Période (N° de mois) : ";
    	

    	}

   		}
   		//alert(namechange);
   		var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('services.modif') }}",
                        method:"POST",
						data:{valchange:valchange,idchange:idchange,namechange:namechange, _token:_token},
                        success:function(data){
                        	
                        }
                    });


			 };
   	function openReccurent(idwd){
// alert(idwd);
   var x = document.getElementById("f"+idwd);
   var y = document.getElementById("h"+idwd);
   //var z = document.getElementById("p"+idwd);
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "block";
   // z.style.display = "block";
  } else {
    x.style.display = "none";
    y.style.display = "none";
   //z.style.display = "none";
  }
   	};
    var input = document.getElementById('toggleswitch');
    var divreccurent = document.getElementById('reccurent');

    input.addEventListener('change',function(){
        if(this.checked) {
            divreccurent.style.display = "block";
        } else {
             divreccurent.style.display = "none";
        }
    });
    function myFunctionSelect(){
    	var x = document.getElementById("mySelect").value;
    	//alert(document.getElementById("periode").placeholder);
    	if (x=="Journalière") {
    		document.getElementById("labelperiode").innerHTML = "Période (N° de jours) : ";
    		//document.getElementByName("mySelectinput")[0].placeholder=nombre de jours;
    		$("#periode").attr("placeholder", "Nombre de jours");
    	}
    	else if (x=="Hebdomadaire") {
    		document.getElementById("labelperiode").innerHTML = "Période (N° de semaines) : ";
    		$("#periode").attr("placeholder", "Nombre de semaines");
    	

    	}
    	else if (x=="Mensuelle") {
    		document.getElementById("labelperiode").innerHTML = "Période (N° de mois) : ";
    		$("#periode").attr("placeholder", "Nombre de mois");
    	

    	}
    }
  

   	function changing(elm) {
               
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
                    method: "POST",
                    data: {user: user, champ: champ, val: val, _token: _token},
                    success: function (data) {
                        $('#' + champ).animate({
                            opacity: '0.3',
                        });
                        $('#' + champ).animate({
                            opacity: '1',
                        });
						 
				 	 $.notify({
 					message: 'Modifié avec succès',
					icon: 'glyphicon glyphicon-check'
					},{
 					type: 'success',
					delay: 3000,
					timer: 1000,	
					placement: {
						from: "bottom",
						align: "right"
						},					
					});	
				  
                     }
					
                });

            }
   	$(document).ready(function() {
            

 			
			// $('.categories').click(function(event ){
				$(document).on('change', '.categories', function() {
 						idelemt = (this).id;
				cat= idelemt.slice(3);
 			///here
 	           var checked =document.getElementById('cat-'+cat).checked  ;
 	          // var checked =$(this).prop("checked");
  			   var user = $('#user').val();
 				 var _token = $('input[name="_token"]').val();
					var loading=false;
					if($(this).prop("checked") == true){
 			  checked=true;
 			}
 			else{

 				if($(this).prop("checked") == false){
 			           checked=false;
 			       }

 			    }
			 // alert(checked);
				if( checked ){
                    $.ajax({
                        url:"{{ route('categories.insert') }}",
                        method:"POST",
                        data:{user:user,categorie:cat, _token:_token},
                        success:function(data){
							changed=true;
							
					 $.notify({
 					message: 'Catégorie ajoutée avec succès',
					icon: 'glyphicon glyphicon-check'
					},{
 					type: 'success',
					delay: 3000,
					timer: 1000,	
					placement: {
						from: "bottom",
						align: "right"
						},					
					});	
						}
						
                    });
					loading=true;
					}else{
 					  $.ajax({
                        url:"{{ route('categories.removecatuser') }}",
                        method:"POST",
                        data:{user:user,categorie:cat, _token:_token},
                        success:function(data){
							changed=true;
					
					$.notify({
 					message: 'Catégorie supprimée avec succès',
					icon: 'glyphicon glyphicon-check'
					},{
 					type: 'success',
					delay: 3000,
					timer: 1000,	
					placement: {
						from: "bottom",
						align: "right"
						},					
					});		
						}
						
                    });
 					 loading=true;

					}
					 	 if (loading) {
                return ;
              }
				  //	


			 });
			 
			 
	/*		
			  $('#add').click(function( ){
                var user = $('#user').val();
                var nom = $('#nom').val();
                var description = $('#description').val();
                var prix = $('#prix').val();
                var duree = $('#duree').val();
                var photo = $('#photo').val();

				if ((nom != '')  )
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('services.add') }}",
                        method:"POST",
						cache:false,
						contentType: false,
						processData: false, 
						data:{user:user,nom:nom,description:description,prix:prix ,photo:photo, _token:_token},
                        success:function(data){

                         //    alert(data);
                         service =parseInt(data);
						 if(service>0)
						{
							newElem=$('<tr class="pricing-list-item pattern ui-sortable-handle"><td><div class="fm-input pricing-name"> <label>Nom :</label><input type="text" value="'+nom+'"   ></div><div class="fm-input pricing-ingredients"><label>Description :</label><input type="text" value="'+description+'" ></div><div class="fm-input "><label>Durée :</label><input type="time"  value="'+duree+'"   ></div><div class="fm-input pricing-price"><label>Prix :</label><i class="data-unit">€</i><input type="text"    data-unit="€"  value="'+prix+'"   ></div><div class="fm-close"><a  class="delete fm-close"  onclick="return confirm(`Êtes-vous sûrs ?`)"  href="https://$_SERVER[HTTP_HOST]/services/remove/'+service+'"><i class="fa fa-remove"></i></a></div></td></tr>');	 
 						            newElem.appendTo('table#utf_pricing_list_section');

					 	//$('#small-dialog').modal('hide');
 						$( ".mfp-close" ).trigger( "click" );

										 	 $.notify({
 					message: 'Service ajouté avec succès',
					icon: 'glyphicon glyphicon-check'
					},{
 					type: 'success',
					delay: 3000,
					timer: 1000,	
					placement: {
						from: "bottom",
						align: "right"
						},					
					});	
						//$('#small-dialog').modal({show:true});
	
 						}
	   


                        }
                    });
                }else{
                    // alert('ERROR');
                }
            });*/
			
			
		 $('#addfaq').click(function( ){
                var user = $('#user').val();
                var question = $('#question').val();
                var reponse = $('#reponse').val();
 
				if ((nom != '')  )
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('faqs.add') }}",
                        method:"POST",
                        data:{user:user,question:question,reponse:reponse , _token:_token},
                        success:function(data){

                         //    alert(data);
                         faq =parseInt(data);
						 if(faq>0)
						{
							newElem=$('<tr class="pricing-list-item pattern ui-sortable-handle"><td><div class="fm-input pricing-name"> <input type="text" value="'+question+'"   ></div><div class="fm-input pricing-ingredients"><textarea >'+reponse+'</textarea></div><div class="fm-close"><a  class="delete fm-close"  onclick="return confirm(`Êtes-vous sûrs ?`)"  href="https://$_SERVER[HTTP_HOST]/services/remove/'+faq+'"><i class="fa fa-remove"></i></a></div></td></tr>');	 
 						            newElem.appendTo('table#utf_faq_list_section');

  						$( ".mfp-close" ).trigger( "click" );

 					 	 $.notify({
 					message: 'Ajouté avec succès',
					icon: 'glyphicon glyphicon-check'
					},{
 					type: 'success',
					delay: 3000,
					timer: 1000,	
					placement: {
						from: "bottom",
						align: "right"
						},					
					});	
					
 						}
	   


                        }
                    });
                }else{
                    // alert('ERROR');
                }
            });
			
			
			
			
			function insertcat(cat)
			{
				
			///here
 		var checked =document.getElementById('cat-'+cat).checked  ;
		 //alert(checked);
				  var user = $('#user').val();

				  //alert(user);
				 // alert(cat);
				 var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('categories.insert') }}",
                        method:"POST",
                        data:{user:user,categorie:cat, _token:_token},
                        success:function(data){
						
				 	 $.notify({
 					message: 'Catégorie ajoutée avec succès',
					icon: 'glyphicon glyphicon-check'
					},{
 					type: 'success',
					delay: 3000,
					timer: 1000,	
					placement: {
						from: "bottom",
						align: "right"
						},					
					});	
					
						}
						
                    });
 			}
			
			
			
			
			 
 Dropzone.options.dropzoneFrom = {
 // autoProcessQueue: false,
  acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",
  init: function(){
  /* var submitButton = document.querySelector('#submit-logo');
   myDropzone = this;
   submitButton.addEventListener("click", function(){
    myDropzone.processQueue();
   });*/
   this.on("complete", function(){
  /*  if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
    {
     var _this = this;
     _this.removeAllFiles();
    }*/
  //  list_image(); 
	$('#img-logo').hide();
				 	 $.notify({
 					message: 'Modifié avec succès',
					icon: 'glyphicon glyphicon-check'
					},{
 					type: 'success',
					delay: 3000,
					timer: 1000,	
					placement: {
						from: "bottom",
						align: "right"
						},					
					});	
					
 });
  },
 };
  
  Dropzone.options.dropzoneFrom2 = {
 // autoProcessQueue: false,
  acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",
  init: function(){
 
   this.on("complete", function(){
  /*  if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
    {
     var _this = this;
     _this.removeAllFiles();
    }*/
  //  list_image(); 
	$('#img-couverture').hide();
				 	 $.notify({
 					message: 'Modifié avec succès',
					icon: 'glyphicon glyphicon-check'
					},{
 					type: 'success',
					delay: 3000,
					timer: 1000,	
					placement: {
						from: "bottom",
						align: "right"
						},					
					});	
 });
  },
 };
 
 
   Dropzone.options.dropzoneFrom3 = {
 // autoProcessQueue: false,
  acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",
  init: function(){
 
   this.on("complete", function(){
 
  //  list_image(); 
 				 	 $.notify({
 					message: 'Ajoutée(s) avec succès',
					icon: 'glyphicon glyphicon-check'
					},{
 					type: 'success',
					delay: 3000,
					timer: 1000,	
					placement: {
						from: "bottom",
						align: "right"
						},					
					});	
 });
  },
 };
 
   Dropzone.options.dropvideo = {
 // autoProcessQueue: false,
  acceptedFiles:".mp4",
  init: function(){
 
   this.on("complete", function(){
  /*  if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
    {
     var _this = this;
     _this.removeAllFiles();
    }*/
  //  list_image(); 
	$('#img-couverture').hide();

					 	 $.notify({
 					message: 'Modifié avec succès',
					icon: 'glyphicon glyphicon-check'
					},{
 					type: 'success',
					delay: 3000,
					timer: 1000,	
					placement: {
						from: "bottom",
						align: "right"
						},					
					});	
 });
  },
 };

});
    </script>
	<script src="{{  URL::asset('public/fullcalendar/main.min.js') }}"></script>
	<script src="{{  URL::asset('public/fullcalendar/locales/fr.js') }}"></script>

	<script>

  document.addEventListener('DOMContentLoaded', function() {
    var initialLocaleCode = 'fr';
    var localeSelectorEl = document.getElementById('locale-selector');
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridWeek,dayGridMonth,timeGridDay,listMonth'
      },
      
      locale: initialLocaleCode,
      initialView:'timeGridWeek',
      buttonIcons: false, // show the prev/next text
      weekNumbers: true,
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      selectable:true,
      dayMaxEvents: true, // allow "more" link when too many events
      dateClick: function (info) {
      	var mod = document.getElementById("calendardialog");
      	//alert(mod);
      	 mod.style.display = "block";
      	
      },
        eventClick: function(info) {

          if (info.event.start) {
           //alert(info.event.start);
            }
       },
       businessHours: <?php echo \App\Http\Controllers\CalendrierController::ouverture_fermeture_horaire($user->id); ?>,
      
      events:<?php echo \App\Http\Controllers\CalendrierController::indisponibilte_rendezvous_horaire($user->id); ?>
    });

    calendar.render();
    
    // build the locale selector's options
   

   

  });

</script>

<script>
var modal = document.getElementById("calendardialog");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks on <span> (x), close the modal
/*span.onclick = function() {
  modal.style.display = "none";
}*/

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
	$(document).ready(function() {
var obj={
         "startTime":'',
          "endTime": '',
          "daysOfWeek": ['1', '2', '3' ]
       };

       //alert(JSON.stringify(obj));
   });
</script>
<!-- <input autocomplete="off"  style="width:100% ;" size="50" type="text" onkeyup="changing(this)" id="field_name[]"  name="field_name[]" value=""/> -->
<?php 
     if(($user->type_abonn_essai && ($user->type_abonn_essai=="type2" || $user->type_abonn_essai=="type3" ))|| ($user->type_abonn && ($user->type_abonn=="type2" || $user->type_abonn=="type3" ))) { ?>
<script type="text/javascript">
     $(document).ready(function(){
    var maxField = <?php echo (5-$nbcomm); ?>; //Input fields increment limitation
    var comButton = $('.com_button'); //Add button selector
    var comwrapper = $('.com_wrapper'); //Input field wrapper
    var comfieldHTML = '<div class="row"><br><center><img width="26" height="26"  src="{{ asset('public/img/plus.png') }}"/></center><br><div class="col-md-10"> <select name="cars" class="cars"><option value=""></option><?php foreach ($services_pres as $sp) { ?>
            <option value="{{$sp->nom}}">{{$sp->nom}}</option> <?php } ?> </select></div> <div class="col-md-2"> <a href="javascript:void(0);" class="comremove_button"> <img width="26" height="26" style="float:left " src="{{ asset('public/img/moin.png') }}"/></a><br></div>  </div>'; //New input field html
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(comButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(comwrapper).append(comfieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(comwrapper).on('click', '.comremove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

     $(comwrapper).on('change', '.cars', function(e){
       //alert($(this).find(":selected").text()) ;//Decrement field counter       
    });

});
</script>
<?php } ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

  function ecrire_formule() {  
  var inputs = $(".cars");
  var formule='';
       for(var i = 0; i < inputs.length; i++){
          if($(inputs[i]).find(":selected").text())
          {
            if(i!=0)
            {
            formule+=' + '+$(inputs[i]).find(":selected").text();
            }
            else
            {
            formule+=$(inputs[i]).find(":selected").text();
            }
          }
        } 

        //alert(formule);  

        var res1=$("#resser1").find(":selected").text();
        var qteres1=$("#qteres1").val();
        var res2=$("#resser2").find(":selected").text();
        var qteres2=$("#qteres2").val();
        var res3=$("#resser3").find(":selected").text();
        var qteres3=$("#qteres3").val();

        if(!res1 && !res2 && !res3 || !formule)
        {
          if(!res1 && !res2 && !res3)
          {
            swal("Vous devez saisir au moins un service ou un produit à offrir !");
          }
           else{
            swal("Vous devez saisir au moins un service dans la section Addition des services !");
          }
        }
        else
        {
          if(res1)
          {
            formule+=' = '+qteres1+' '+res1;
          }
          if(res2)
          {
             if(!res1)
             {
              formule+=' = '+qteres2+' '+res2;
             }
             else
             {
              formule+=' + '+qteres2+' '+res2;
             }
          }

          if(res3)
          {
             if(!res2 && !res1)
             {
              formule+=' = '+qteres3+' '+res3;
             }
             else
             {
              formule+=' + '+qteres3+' '+res3;
             }
          }

         $('#restotal').val(formule);

        }

                
 //myWindow=window.open('lead_data.php?leadid=1','myWin','width=400,height=650')
}

function deleteRow(r,id) {
  var i = r.parentNode.parentNode.rowIndex;
  document.getElementById("table_serv_supp").deleteRow(i);

  //var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ url('/') }}"+"/supprimer_serv_suppl/"+id,
            method:"get",
            data:{id:id},
            success:function(data){
             // alert(data);
              swal("Règle supprimée avec succès");
            }
        });


}
</script>

<?php
$myArr = array('title'=>"John", 'start'=>"Mary", 'v'=>"Peter", 'b'=>"Sally");

$myJSON = json_encode($myArr);

//dd(\App\Http\Controllers\calendrierController::indisponibilte_rendezvous_horaire($user->id));

//dd($myJSON);
?>

@endsection  