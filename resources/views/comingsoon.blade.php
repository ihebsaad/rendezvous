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

				<h3>Nous lançons bientôt notre site web !</h3>
				
				<!-- Countdown -->
				<div id="countdown" class="margin-top-10 margin-bottom-35"></div>
				<!-- Countdown / End -->

				<br>

				<div class="main-search-input gray-style margin-top-30 margin-bottom-10">
					<div class="main-search-input-item">
						<input type="text" placeholder="Votre adresse e-mail" value=""/>
					</div>
					<button class="button">Avertissez-moi</button>
				</div>
				
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
		.countdown('2021/09/04', function(event) {
			var $this = $(this).html(event.strftime(''
			+ '<div><span>%D</span>  <i>Jours</i></div>'
			+ '<div><span>%H</span> <i>Heures</i></div> '
			+ '<div><span>%M</span> <i>Minutes</i></div> '
			+ '<div><span>%S</span> <i>Secondes</i></div>'
		));
	});
</script>


</body>
</html>