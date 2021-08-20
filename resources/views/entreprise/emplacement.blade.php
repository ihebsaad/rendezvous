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
                    <h2>Mon entreprise</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Mon entreprise</li>
                            <li>Emplacement</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        @if ($live_message = Session::get('empmessage'))
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
                            <h3><i class="fa fa-map-marker"></i> Emplacement</h3>
                        </div>
                        <form method="post" action="{{ route('changeemplacement') }}" name="changeemplacement" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <!-- Title -->
                        <div class="row with-forms">
                            <div class="col-md-6">
                                <h5>Adresse</h5>
                                <input class="search-field" type="text" placeholder="Votre adresse" id="adresse"   name="adresse" value="{{ $user->adresse }}"  onFocus="geolocate()">
                            </div>
                            <div class="col-md-6">
                                <h5>Ville</h5>
                                <input class="search-field" type="text"  placeholder="Votre ville"  name="ville"  id="ville" value="{{ $user->ville }}" >
                            </div>
                        </div>

                        <!-- Row -->
                        <div class="row with-forms">

                            <!-- Type -->
                            <div class="col-md-12">
                                    <h5>Fuseau horaire (Obligatoire)</h5>
                                    <select class="chosen-select-no-single" name="fhoraire" id="fhoraire" title="Selectionnez votre fuseau horaire" >
                                        <option  value="America/Martinique"  default <?php if($user->fhoraire=='America/Martinique'){echo 'selected="selected"';}?> >Martinique</option>  
                                        <option value="America/Guadeloupe"  <?php if($user->fhoraire=='America/Guadeloupe'){echo 'selected="selected"';}?> >Guadeloupe</option>
                                        <option value="Europe/Paris"  <?php if($user->fhoraire=='Europe/Paris'){echo 'selected="selected"';}?> >France</option>
                                        <option value="America/Cayenne"  <?php if($user->fhoraire=='America/Cayenne'){echo 'selected="selected"';}?> >Guyane française</option> 
                                    </select>
                            </div>

                        </div>
                        <!-- Row / End -->

                        <!-- Row -->
                        <div class="row with-forms">
                            <!-- Type -->
                            <div class="col-md-12">
                                <h5>Map</h5>
                            </div>
                        </div>
                        <div class="row with-forms">
                            <!-- Type -->
                            <div class="col-md-6">
                                <input type="text" class="search-field" name="latitude" id="latitude" placeholder="Latitude"  value="{{ $user->latitude }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="search-field" name="longitude" id="longitude" placeholder="Longitude" value="{{ $user->longitude }}">
                            </div>
                        </div>
                        <div class="row with-forms">
                            <!-- Type -->
                            <div class="col-md-12">
                                <div id="utf_listing_location" class="col-md-12 utf_listing_section">
                                    <div id="utf_single_listing_map_block">
                                    <div id="utf_single_listingmap" data-latitude="{{ $user->latitude }}" data-longitude="{{ $user->longitude }}" data-map-icon="im im-icon-Marker"></div>
                                    <!--<a href="#" id="utf_street_view_btn">Vue de rue</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row -->
                        <div class="row with-forms">

                            <!-- Type -->
                            <div class="col-md-12">
                                <input type="submit" class="button preview" value='Enregistrer' />
                            </div>

                        </div>
                        <!-- Row / End -->
                    </form>
                    </div>
                    <!-- Section / End -->

                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
</div>
</div>
@endsection('content')

<style type="text/css">
 .utf_listing_section {
    display: inline-block;
    width: 100%;
}
 #utf_single_listing_map_block {
    height: 410px;
    position: relative;
    padding-top: 5px;
    display: block;
}
  #utf_single_listingmap {
    height: 400px;
    border-radius: 3px;
}
.gm-style {
    font: 400 11px Roboto, Arial, sans-serif;
    text-decoration: none;
}
.gm-style-pbc {
    transition: opacity ease-in-out;
    background-color: rgba(0,0,0,0.45);
    text-align: center;
}
#utf_street_view_btn, #geoLocation, #scrollEnabling {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 999;
    font-size: 13px;
    line-height: 21px;
}
#utf_street_view_btn, #geoLocation, #scrollEnabling, #mapnav-buttons a {
    color: #333;
    background-color: #fff;
    padding: 7px 18px;
    padding-top: 9px;
    font-weight: 500;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    -transition: all 0.2s ease-in-out;
    box-sizing: border-box;
    display: inline-block;
    border-radius: 4px;
    box-shadow: 0px 1px 4px -1px rgb(0 0 0 / 20%);
}

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
}ht: 100%;
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