@extends('layouts.frontv2layout')
@section('content')




<!-- Content
================================================== -->


<!-- Container -->
<div id="wrapper" style="background-image: url(http://localhost/rendezvous/public/listeo/images/test.jpg);
    background-repeat: no-repeat;
    background-size: cover;">
<div class="container ">
      
   
	<div class="row"  >
	<div class="col-lg-6 col-md-12">
		<br><br><br><br>
					<img src="<?php echo  URL::asset('storage/images/logoprv.png');?>" alt="" >

                        <br><br><br><br><br>
                  <center> <a href="{{route('home')}}" class="submit button" ><span class="arrow"></span>Revenir à la page d'accueil</a></center> 
					<br><br></br></div><br><br><br><br><br><br>
					<div class="col-lg-6 col-md-12" >
<center>
					<section id="not-found" >
						<h3 style="color: #333;
			font-size: 95px;;
			font-family: 'Raleway';
		">OUPS! </h3>
						<h4 style="hite-space: pre-wrap;
			word-spacing: 12px;
			line-height: 37px;
			color: black;
			font-size: 21px;
			font-family: 'Raleway';">	 <strong> Nous sommes désolés, mais la page que vous recherchez n’existe pas. Nous vous invitons de retourner à la page d’accueil. </h4>
</strong> </center> 
				<!-- Search -->
					
				<!-- Search Section / End -->


			</section>

		</div>
					<div class="col-lg-2 col-md-2"><br></div>
	
	</div>

</div>
<!-- Container / End -->


</div>

<script type="text/javascript" src="{{ asset('public/listeo/scripts/typed.js') }}"></script>

@endsection('content')