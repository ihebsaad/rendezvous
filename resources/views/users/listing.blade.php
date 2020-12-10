@extends('layouts.backlayout')
 
 @section('content')
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
   <!-- Dashboard -->
<div id="dashboard"> 
@include('layouts.back.menu')
 <style>
 table{background-color:white;border:none!important;;width:100%!important;}
 </style>

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
    	  <a href="{{route('viewlisting',['id'=> $user->id] )}}" target="_blank" class="button pull-right "><i class="sl sl-icon-eye"> </i>Visualiser</a> 

      <div class="row">
        <div class="col-lg-12">
          <div id="utf_add_listing_part">             
	   
               {{ csrf_field() }}
			 <input type="hidden"    id="user"  value="{{$id}}" >

            <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-map"></i> Emplacement</h3>
              </div>
              <div class="utf_submit_section"> 
                <div class="row with-forms"> 				  
                  <div class="col-md-6">
				      <h5>Adresse</h5>                    
					<input type="text" class="input-text"  name="address" id="adresse" placeholder="" onchange="changing(this);" onFocus="geolocate()" value="{{ $user->adresse }}"  >
              </div>  				  
    	<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script>
  /*   (function() {
          var placesAutocomplete2 = places({
         appId: 'plCFMZRCP0KR',
      apiKey: 'aafa6174d8fa956cd4789056c04735e1',
       container: document.querySelector('#ville'),

    });
 //   placesAutocomplete2.on('change', function resultSelected(e) {
  //   document.querySelector('#codep').value = e.suggestion.postcode || '';
  //  });
     })();	*/
</script>	 
                  <div class="col-md-6">
                    <h5>Ville</h5>                    
 					<input type="text" class="input-text" name="ville" id="ville" placeholder=""      value="{{ $user->ville }}"  onchange="changing(this)">
                 
                 </div>                  
                  <div class="col-md-12">
                  <h5>Map</h5>                    
				  <div class="row with-forms">
					<div class="col-md-6">
						<input type="text" class="input-text" name="latitude" id="latitude" placeholder="Latitude" onchange="changing(this)"  value="{{ $user->latitude }}">
					</div>
					<div class="col-md-6">                    
						<input type="text" class="input-text" name="longitude" id="longitude" placeholder="Longitude" onchange="changing(this)"  value="{{ $user->longitude }}">
					</div> 
				  </div> 	
                  </div>				  				  
				  <div id="utf_listing_location" class="col-md-12 utf_listing_section">
					  <div id="utf_single_listing_map_block">
						<div id="utf_single_listingmap" data-latitude="{{ $user->latitude }}" data-longitude="{{ $user->longitude }}" data-map-icon="im im-icon-Marker"></div>
						<a href="#" id="utf_street_view_btn">Vue de rue</a> 
					  </div>
				  </div>
                </div>
              </div>
            </div>
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

           <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-picture"></i> Images </h3>
              </div>			  
              <div class="row with-forms">  
				  <div class="utf_submit_section col-md-4">
				    <h4>Logo</h4>
					<form action="{{ route('users.ajoutimage') }}" class="dropzone"  id="dropzoneFrom">
					  {{ csrf_field() }}
					<input type="hidden" name="user"  value="<?php echo $user->id; ?>">
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
  
       <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-film"></i> Vidéo - Télécharger une vidéo ou copier un code de vidéo depuis youtube ..</h3>
              </div>			  
              <div class="row with-forms">    
			  
			  	  <div class="row">
			  <div class="utf_submit_section col-md-5" id="videos" style="margin-right:20px;">
					<h4 id="images">Télécharger une vidéo en format mp4</h4>
					<div class="row" >	<a  style="float:right;"  href='#' onclick='location.reload();'>Recharger la page</a>	</div>	  

					<form action="{{ route('users.ajoutvideo') }}" class="dropzone" id="dropvideo">
					 {{ csrf_field() }}
					<input type="hidden" name="user"  value="<?php echo $user->id; ?>">
					</form>
			 </div>
				 <div class="col-md-5">
	
					<?php if($user->video!=''){?>
					<video width="450" height="320" controls>
					<source src="<?php echo  URL::asset('storage/images/'.$user->video);?>" type="video/mp4">
					Votre navigateur ne supporte pas l'affichage de cette video.
					</video>
					 <a  class="button" style="padding:5px 8px"  onclick="return confirm('Êtes-vous sûrs de vouloir supprimer cette video ?')"  href="{{action('UsersController@removevideo', [  'user'=> $user->id  ])}}"title="supprimer"><i class="sl sl-icon-trash"></i> Supprimer</a></span>
					<?php } ?>
			    </div>
			  </div>
			  <div class="row" style="margin-top:20px">

			   <div class="  col-md-5" style="margin-right:20px;padding:50px 50px 50px 50px">
			   Coller le Code d'intégration depuis youtube, vimeo ..
				<section><textarea  id="codevideo"  onchange="changing(this)" >{{ $user->codevideo }}</textarea></section>
					
			   </div>
			   <div class="  col-md-5">
			   <?php if($user->codevideo!=''){
				
				echo $user->codevideo ;
					}  ?>

			   </div>
			   
			   </div>
			   
			  </div>
		</div>	  
 	
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
			
			<div class="add_utf_listing_section margin-top-45"> 
				<div class="utf_add_listing_part_headline_part">
					<h3><i class="sl sl-icon-basket-loaded"></i>Services</h3>
                </div>              
				<div class="row">
				  <div class="col-md-12">
					<table id="utf_pricing_list_section">
					  <tbody class="ui-sortable"  id="services">
					  <?php
 
					  foreach($services as $service){
 					  ?>
						<tr class="pricing-list-item pattern ui-sortable-handle">
						  <td> 
							<div class="fm-input">
							<?php if($service->thumb!=''){?>  <img src="<?php echo  URL::asset('storage/images/'.$service->thumb);?>"  style="max-width:100px"  /><?php }?>
							</div>
							<div class="fm-input pricing-name">
							  <input type="text" value="<?php echo $service->nom;?>"   >
							</div>
							<div class="fm-input pricing-ingredients">
							  <input type="text" value="<?php echo $service->description;?>" >
							</div>
							<div class="fm-input pricing-price"><i class="data-unit">€</i>
							  <input type="text"    data-unit="€"  value="<?php echo $service->prix;?>"   > 
							</div>
						 	<div class="fm-close">
							<a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('ServicesController@remove', [ 'id'=>$service->id,'user'=> $user->id  ])}}"><i class="fa fa-remove"></i></a>
							</div>
							</td>
						</tr>
					  <?php } ?>
					  </tbody>
					</table>
					<a href="#small-dialog" class="button popup-with-zoom-anim">Ajouter</a> 
					<!--<a href="#" class="button add-pricing-submenu">Add Category</a> --></div>
				</div>                          
            </div>				



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
			

	        <div id="small-dialog" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Ajouter un service</h3>
          </div>
		  <form  method="post" enctype="multipart/form-data"   action="{{ route('services.store') }}"  >
		  {{ csrf_field() }}
		  
		 <div class="utf_signin_form style_one">
		 				  <input type="hidden" name="user" value="{{$user->id}}"  >

			 <div class="fm-input ">
				  <input type="file" name="photo" id="photo" required >
			 </div>
		 <div class="fm-input ">
							  <input type="text" placeholder="nom de service*" id="nom"  name="nom" required >
							</div>
							<div class="fm-input  ">
							  <input type="text"   placeholder="description de service"  id="description"  name="description">
							</div>
							<div class="fm-input  "> 
							  <input type="text"      placeholder="prix de service*" name="prix" id="prix" required> 
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
   <script src="//bootstrap-notify.remabledesigns.com/js/bootstrap-notify.min.js"></script>
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
<script src="{{  URL::asset('public/scripts/dropzone.js') }}"></script>


   <script>
            function changing(elm) {
                var champ = elm.id;

                var val = document.getElementById(champ).value;

                var user = $('#user').val();
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

 			
			 $('.categories').click(function(event ){
 						idelemt = (this).id;
				cat= idelemt.slice(3);
 			///here
 	           var checked =document.getElementById('cat-'+cat).checked  ;
  			   var user = $('#user').val();
 				 var _token = $('input[name="_token"]').val();
					var loading=false;
 			
			  
				if( ! checked    ){
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
			 
			 
			
			  $('#add').click(function( ){
                var user = $('#user').val();
                var nom = $('#nom').val();
                var description = $('#description').val();
                var prix = $('#prix').val();
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
							newElem=$('<tr class="pricing-list-item pattern ui-sortable-handle"><td><div class="fm-input pricing-name"> <input type="text" value="'+nom+'"   ></div><div class="fm-input pricing-ingredients"><input type="text" value="'+description+'" ></div><div class="fm-input pricing-price"><i class="data-unit">€</i><input type="text"    data-unit="€"  value="'+prix+'"   ></div><div class="fm-close"><a  class="delete fm-close"  onclick="return confirm(`Êtes-vous sûrs ?`)"  href="https://$_SERVER[HTTP_HOST]/services/remove/'+service+'"><i class="fa fa-remove"></i></a></div></td></tr>');	 
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
            });
			
			
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
		 alert(checked);
				  var user = $('#user').val();

				  alert(user);
				  alert(cat);
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
    </script>
	

@endsection  