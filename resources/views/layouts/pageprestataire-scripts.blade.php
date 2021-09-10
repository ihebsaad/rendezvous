
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
 
  function showalert() {
        alert("you just pressed the button");
    }

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
  <script src="{{ asset('public/scripts/chosen.min.js') }}"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 <script  src="{{ URL::asset('public/scripts/moment.min.js')}}"   ></script> 

<script src="{{  URL::asset('public/fullcalendar/main.min.js') }}"></script>
<script src="{{  URL::asset('public/fullcalendar/locales/fr.js') }}"></script>