<!-- Scripts
================================================== -->
<!-- Début de widget de badge Calendly -->
 <?php     $user = auth()->user();
  $user_type =$user->user_type;
 ?>
 <?php if( $user_type=='prestataire'  ){ ?>     
<link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
<script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>
<script type="text/javascript">window.onload = function() { Calendly.initBadgeWidget({ url: 'https://calendly.com/prenezunrendezvous/30min?hide_event_type_details=1&hide_gdpr_banner=1&background_color=020202&text_color=ffffff&primary_color=fff600', text: 'Nous sommes à votre écoute pour toute question du lundi au vendredi de 9h à 17h', color: '#000000', textColor: '#ffffff', branding: false }); }</script>
<?php } ?>
<!-- Fin de widget de badge Calendly -->   
<!-- Date Range Picker - docs: http://www.daterangepicker.com/ -->
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/dropzone.js') }}"></script>
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
<script type="text/javascript" src="{{ asset('public/listeo/scripts/quantityButtons.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/listeo/scripts/moment.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/listeo/scripts/daterangepicker.js') }}"></script>


<script type="text/javascript" src="{{ asset('public/listeo/scripts/custom.js') }}"></script>
<!-- Scripts
================================================== -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


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
        "format": "YYYY-MM-DD",
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
		// Disabling Date Range
		var disabled_start = moment('09-01-2012', 'MM-DD-YYYY');
		var disabled_end = moment(now(), 'MM-DD-YYYY');
		return date.isAfter(disabled_start) && date.isBefore(disabled_end);

		// Disabling Single Day
		// if (date.format('MM/DD/YYYY') == '08/08/2018') {
		//     return true; 
		// }
		}
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
        "format": "YYYY-MM-DD",
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
		// Disabling Date Range
		var disabled_start = moment('09-01-2012', 'MM-DD-YYYY');
		var disabled_end = moment(now(), 'MM-DD-YYYY');
		return date.isAfter(disabled_start) && date.isBefore(disabled_end);

		// Disabling Single Day
		// if (date.format('MM/DD/YYYY') == '08/08/2018') {
		//     return true; 
		// }
		}
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
$(function() {
  moment.lang('fr');
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#booking-date-range span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }
    cb(start, end);

    $('#booking-date-range').daterangepicker({
       "locale": {

        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Valider",
        "cancelLabel": "Annuler",
        "fromLabel": "De",
        "toLabel": "à",
        "customRangeLabel": "Custom",
        "daysOfWeek": [
            "Dim",
            "Lun",
            "Mar",
            "Mer",
            "Jeu",
            "Ven",
            "Sam"
        ],
        "monthNames": [
            "Janvier",
            "Février",
            "Mars",
            "Avril",
            "Mai",
            "Juin",
            "Juillet",
            "Août",
            "Septembre",
            "Octobre",
            "Novembre",
            "Décembre"
        ],
        "firstDay": 1
    },
        "opens": "left",
        "autoUpdateInput": false,
        "alwaysShowCalendars": true,
        startDate: start,
        endDate: end,
        ranges: {
           'Aujourd\'hui': [moment(), moment()],
           'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Les 7 derniers jours': [moment().subtract(6, 'days'), moment()],
           'Les 30 derniers jours': [moment().subtract(29, 'days'), moment()],
           'Ce mois': [moment().startOf('month'), moment().endOf('month')],
           'Le mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});

// Calendar animation and visual settings
$('#booking-date-range').on('show.daterangepicker', function(ev, picker) {
    $('.daterangepicker').addClass('calendar-visible calendar-animated bordered-style');
    $('.daterangepicker').removeClass('calendar-hidden');
});
$('#booking-date-range').on('hide.daterangepicker', function(ev, picker) {
    $('.daterangepicker').removeClass('calendar-visible');
    $('.daterangepicker').addClass('calendar-hidden');
});
//$("#booking-date-range").daterangepicker();
$("#booking-date-range").on("cancel.daterangepicker", function(ev, picker) {
  //alert("ok");
  var lis = $('ul[class="one"] ');
    //alert(lis[0].getAttribute("attr"));
    for (var i = 0; i < lis.length; i++) {
      //alert(i);
      
            lis[i].style.display = 'block';
        
           
    
  }
  });




 $("#booking-date-range").on("apply.daterangepicker", function(ev, picker) {
  minDateFilter = Date.parse(picker.startDate);
  //alert(moment(minDateFilter).format('DD/MM/YYYY'));
  maxDateFilter = Date.parse(picker.endDate);
  //alert(moment(maxDateFilter).format('DD/MM/YYYY'));
  var min= moment((minDateFilter)).format('YYYY-MM-DD');
  var max= moment((maxDateFilter)).format('YYYY-MM-DD');
  //alert(max);
  
var lis = $('ul[class="one"] ');

  



    for (var i = 0; i < lis.length; i++) {
      var b= moment(lis[i].getAttribute("attr"),"DD/MM/YYYY").format('YYYY-MM-DD');
      if (moment(max).isAfter(b) && moment(min).isBefore(b)) {
            lis[i].style.display = 'block';}
        else
            {lis[i].style.display = 'none';
    }
  }
  

});
</script>
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
</body>
</html>