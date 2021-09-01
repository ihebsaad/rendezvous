<!DOCTYPE html>
<head>
 <?php
 $parametres=DB::table('parametres')->where('id', 1)->first();


$pvideo= $parametres->video;
?>
<!-- Basic Page Needs
================================================== -->
<title> @section('title')
        Prenez un rendez vous
    @show</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('public/images/favicon.png') }}"  >
<!-- CSS
================================================== -->
<link rel="stylesheet" href="{{ asset('public/listeo/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('public/listeo/css/main-color.css') }}" id="colors">

<style type="text/css">
.main-search-container {
    height: auto;
}
.main-search-container.dark-overlay:before {
    background: rgba(46,47,50,0.01);
}

.message-popup {
  position: relative;
  background: #fff;
  margin: 0 auto;
  max-width: 455px;
  text-align: center;
}

.message-popup__header {
  line-height: 30px;
  font-size: 22px;
  margin: 0;
  padding: 50px 40px;
  color: black;
}

.default-form-close-button {
    position: absolute;
    top: 0;
    right: 0;
    width: 44px;
    height: 44px;
    font-size: 18px;
    line-height: 48px;
    text-align: center;
    color: #000;
    background: #ffd700;
    transition: background 0.3s ease;
}
</style>
</head>

<body>

<!-- Wrapper -->
<div id="wrapper">


<!-- Content
================================================== -->

<!-- Coming Soon Page -->
<div class="main-search-container dark-overlay">
    <div class="coming-soon-page" >
	<div class="container">
		<!-- Search -->
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<img src="<?php echo  URL::asset('storage/images/logoprv.png');?>" alt="">

				<h3>Nous lançerons bientôt notre site web !</h3>
				
				<!-- Countdown -->
				<div id="countdown" class="margin-top-10 margin-bottom-35"></div>
				<!-- Countdown / End -->

				<br>
				<form method="post" action="{{ route('users.addemail') }}" name="subform" id="subform" autocomplete="on">
				<div class="main-search-input gray-style margin-top-30 margin-bottom-10">
					<div class="main-search-input-item">
						@csrf
						<input name="emailprest" id="emailprest" type="text" placeholder="Votre adresse e-mail" value=""/>
					</div>
					<button class="button"  onclick="my_func()">Avertissez-moi</button>
				</div>
				</form>
			</div>
		</div>
		<!-- Search Section / End -->
	</div>
</div>
 <!-- Video -->
    <div class="video-container text-center">
        <video loop autoplay muted>
            <source   src="<?php echo  URL::asset('storage/images/'.$pvideo);?>" type="video/mp4">
        </video>
    </div>
</div>
<!-- Coming Soon Page / End -->
<div class="zoom-anim-dialog message-popup my-mfp-slide-bottom mfp-hide" id="message-error">
  <p class="message-popup__header">
    L'adresse email n'est pas valide, merci de la vérifier
  </p>
  <span id="cmod" class="js-close-button default-form-close-button"><i class="fa fa-times"></i></span>
</div>

@if(session()->has('smessage'))
    <div class="alert alert-success">
        {{ session()->get('smessage') }}
    </div>
@endif
</div>
<!-- Wrapper / End -->



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
<!--<script type="text/javascript" src="{{ asset('public/listeo/scripts/custom.js') }}"></script>-->

<!-- Countdown Script -->
<script type="text/javascript" src="{{ asset('public/listeo/scripts/jquery.countdown.min.js') }}"></script>
<script type="text/javascript">
	$("#countdown")
		.countdown('2021/09/18', function(event) {
			var $this = $(this).html(event.strftime(''
			+ '<div><span>%D</span>  <i>Jours</i></div>'
			+ '<div><span>%H</span> <i>Heures</i></div> '
			+ '<div><span>%M</span> <i>Minutes</i></div> '
			+ '<div><span>%S</span> <i>Secondes</i></div>'
		));
	});

$("#cmod").click(function(){
var magnificPopup = $.magnificPopup.instance; 
    // save instance in magnificPopup variable
    magnificPopup.close(); 
});



function my_func() {
    event.preventDefault();

    var emailprest = document.getElementById("emailprest");
    // const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  
    

  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(emailprest.value)) {

  	/*var _token = $('input[name="_token"]').val();

    $.ajax({
        url: "{{ route('users.addemail') }}",
        method: "POST",
        data: JSON.stringify({emailprest: emailprest , _token: _token}),
        dataType: 'json', // payload is json
    contentType : 'application/json',
        success: function (data) {
                         
        alert('succe'); 

         }

    });*/
    document.getElementById("subform").submit();
    
  } else {
  	$.magnificPopup.close();
  	setTimeout(function(){
  $.magnificPopup.open({
      items: {
          src: $('#message-error')
      },
      type: 'inline',
      fixedBgPos: true,
      closeBtnInside: true,
      preloader: false,
      midClick: true,
      removalDelay: 300,
      mainClass: 'my-mfp-slide-bottom',
      fixedContentPos: true,
      showCloseBtn: false
 });
}, 300);
    //alert("L'adresse email n'est pas valide, merci de la vérifier");
  }

}
</script>


</body>
</html>