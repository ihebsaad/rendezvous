<!-- Scripts
================================================== -->
<script type="text/javascript" src="{{ asset('public/listeo/scripts/jquery-3.6.0.min.js') }}"></script>



<script type="text/javascript" src="{{ asset('public/listeo/scripts/jquery-migrate-3.3.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/mmenu.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/listeo/scripts/chosen.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/rangeslider.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/waypoints.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/counterup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/tooltips.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/quantityButtons.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/listeo/scripts/moment.min.js') }}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/custom.js') }}"></script>


<script>
// Calendar Init
$(function() {
  function now () { 
    var d = new Date();
  var n = d.getDate()-1;
  
  d.setDate(n);
    return d; }

	$('#date-picker').daterangepicker({
		"opens": "left",
		singleDatePicker: true,
      locale: {
        "format": "DD-MM-YYYY",
        "separator": " - ",
        "applyLabel": "Appliquer",
        "cancelLabel": "Annuler",
        "fromLabel": "de",
        "toLabel": "jusq'à",
        "customRangeLabel": "Personnalisé",
        "daysOfWeek": [
            "Di",
            "Lu",
            "Ma",
            "Me",
            "Je",
            "Ve",
            "Sa"
        ],
        "monthNames": [
            "Janvier",
            "Fevrier",
            "Mars",
            "Avril",
            "Mai",
            "Juin",
            "Juillet",
            "Aout",
            "Septembre",
            "Octobre",
            "Novembre",
            "Decembre"
        ],
        "firstDay": 1
    },
    isInvalidDate: function(date) {
      var disabled_end = moment(now(), 'MM-DD-YYYY');
     var indisp=<?php if(isset($user)) {echo App\Http\Controllers\CalendrierController::get_tab_jours_indisp_rendezvous($user->id);}?>;
      var array=<?php if(isset($user)) {echo App\Http\Controllers\CalendrierController::get_tab_jours_fermeture_semaine($user->id);}?>; 
      var disabled_start = moment('09-01-2012', 'MM-DD-YYYY');
		var disabled_end = moment(now(), 'MM-DD-YYYY');
      for(var i=0; i< array.length;i++)
      for(var j=0; j< indisp.length;j++)

        if (date.day() == array[i] || date.isAfter(disabled_start) && date.isBefore(disabled_end) || date.format('YYYY-MM-DD') == indisp[j]
 )
          return true;
        return false;
  },
   
		// Disabling Date Ranges

	});});
	$(function() {
		function now () { 
    var d = new Date();
  var n = d.getDate()-1;
  
  d.setDate(n);
    return d; }
	$('#date-picker2').daterangepicker({
		"opens": "left",
		singleDatePicker: true,
      locale: {
        "format": "DD-MM-YYYY",
        "separator": " - ",
        "applyLabel": "Appliquer",
        "cancelLabel": "Annuler",
        "fromLabel": "de",
        "toLabel": "jusq'à",
        "customRangeLabel": "Personnalisé",
        "daysOfWeek": [
            "Di",
            "Lu",
            "Ma",
            "Me",
            "Je",
            "Ve",
            "Sa"
        ],
        "monthNames": [
            "Janvier",
            "Fevrier",
            "Mars",
            "Avril",
            "Mai",
            "Juin",
            "Juillet",
            "Aout",
            "Septembre",
            "Octobre",
            "Novembre",
            "Decembre"
        ],
        "firstDay": 1
    },


		// Disabling Date Ranges
    isInvalidDate: function(date) {
      var disabled_end = moment(now(), 'MM-DD-YYYY');

      var array=<?php if(isset($user)) {echo App\Http\Controllers\CalendrierController::get_tab_jours_fermeture_semaine($user->id);}?>; 
      var disabled_start = moment('09-01-2012', 'MM-DD-YYYY');
		var disabled_end = moment(now(), 'MM-DD-YYYY');
      for(var i=0; i< array.length;i++)
        if (date.day() == array[i] || date.isAfter(disabled_start) && date.isBefore(disabled_end) )
          return true;
        return false;
  },
	});
});

// Calendar animation
$('#date-picker').on('showCalendar.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-animated');
});
$('#date-picker').on('show.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-visible');
	$('.daterangepicker').removeClass('calendar-hidden');
});


$('#date-picker2').on('showCalendar.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-animated');
});
$('#date-picker2').on('show.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-visible');
	$('.daterangepicker').removeClass('calendar-hidden');
});


</script>

<script>
    lightbox.option({
      'maxWidth': 950
    })
</script>
<script>
$(".time-slot").each(function() {
	var timeSlot = $(this);
	$(this).find('input').on('change',function() {
		var timeSlotVal = timeSlot.find('strong').text();

		$('.panel-dropdown.time-slots-dropdown a').html(timeSlotVal);
		$('.panel-dropdown').removeClass('active');
	});
});
</script>
<!-- Google Autocomplete -->
<!--<script>
  function initAutocomplete() {
    var input = document.getElementById('autocomplete-input');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function() {
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        return;
      }
    });

	if ($('.main-search-input-item')[0]) {
	    setTimeout(function(){ 
	        $(".pac-container").prependTo("#autocomplete-container");
	    }, 300);
	}
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete"></script>-->