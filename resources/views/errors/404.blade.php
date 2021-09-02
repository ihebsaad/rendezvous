@extends('layouts.frontv2layout')
@section('content')




<!-- Content
================================================== -->


<!-- Container -->
<div class="container NotFound">
      
    <div class="notFound-row">
    <img src="<?php echo  URL::asset('storage/images/logoprv.png');?>" alt="" class="notFound-img" style="
    margin-top: 69px;
">
    </div>
	<div class="row"  >
   
		<div class="col-md-12.notFound" style="margin-left: -35px;">

			<section id="not-found" >
				<h3 class="notFound-h3">OUPS! </h3>
				<center><h4 style="word-spacing: 5px;
    line-height: 31px;
    color: black;
    font-size: 21px;
    margin-left: 955px;
    margin-top: 76px;
    font-family: 'Raleway';;"class="notFound-h4">   Nous sommes désolés, mais la page que vous recherchez n’existe pas. Nous vous invitons de retourner à la page d’accueil. </h4></center>

				<!-- Search -->
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
                        <br><br><br>
                    <a href="{{route('home')}}" class="submit button" ><span class="arrow"></span>Revenir à la page d'accueil</a>
					</div>
				</div>
				<!-- Search Section / End -->


			</section>

		</div>
	</div>

</div>
<!-- Container / End -->



<script type="text/javascript" src="{{ asset('public/listeo/scripts/typed.js') }}"></script>

@endsection('content')