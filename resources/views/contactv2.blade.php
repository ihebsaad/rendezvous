@extends('layouts.frontv2layout')
@section('content')



<!-- Content
================================================== -->


<!-- Container -->
<br><br>
<div class="container">

	<div class="row">

	
		<div class="col-md-8">

			<section id="contact">
				<h4 class="headline margin-bottom-35" style="    color: gold;"> Envoyez un message</h4>

				<div id="contact-message"></div> 
                <form method="POST" enctype="multipart/form-data"  action="{{ route('contactAdd')}}" class="signup-form" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">
						<div class="col-md-6">
							<div>
								<input name="nom" type="text" id="nom" placeholder="Nom" required="required" />
							</div>
						</div>

						<div class="col-md-6">
							<div>
								<input name="prenom" type="text" id="prenom" placeholder="Prénom"  required="required" />
							</div>
						</div>
					</div>
                    <div class="row">
                    <div class="col-md-6">
							<div>
								<input name="email" type="email" id="email" placeholder="Email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required" />
							</div>
						</div>
						<div class="col-md-6">
							<div>
								<input name="telephone" type="text" id="telephone" placeholder="Téléphone" required="required" />
							</div>
						</div>

						
					</div>

					<div>
						<textarea name="contenu" cols="40" rows="3" id="contenu" placeholder="Votre message" spellcheck="true" required="required"></textarea>
					</div>

					<input type="submit" class="submit button" style="    width: 349px;margin-left: -4px;" id="submit" value="Envoyer" />

					</form>
			</section>
		</div>
		<!-- Contact Form / End -->
			<!-- Contact Details -->
			<div class="col-md-4">

<h4 class="headline margin-bottom-30" style="    color: gold;" >Infos de contact</h4>
<!-- Contact Details -->
<div class="sidebar-textbox">
	<ul class="contact-details" style="    margin-top: -18px;">
		<li><i class="im im-icon-Phone-2" style="color:white;"></i> <strong  style="color:white;font-weight: revert;">Tél:</strong> <span><a  href="#">+596 696 93 04 77</a> </span></li>
		<li ><i class="im im-icon-Globe" style="color:white;"></i> <strong  style="color:white;font-weight: revert;" >Site Web:</strong> <span><a href="#">www.prenezunrendezvous.com</a></span></li>
		<li  ><i class="im im-icon-Envelope" style="color:white;"></i> <strong  style="color:white;font-weight: revert;">E-Mail:</strong> <span><a href="#">contact@prenezunrendezvous.com</a></span></li>
	</ul>
</div>

</div>

<!-- Contact Form -->

	</div>

</div>
<br><br>
<!-- Container / End -->



<!-- Container / End -->


<script type="text/javascript" src="{{ asset('public/listeo/scripts/typed.js') }}"></script>
@if(session()->has('sucmessage'))
    <div class="alert alert-success">
        {{ session()->get('sucmessage') }}
    </div>
@endif

@endsection('content')