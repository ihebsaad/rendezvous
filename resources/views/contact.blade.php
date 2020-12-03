@extends('layouts.frontlayout')
 
 @section('content')
 
 <?php

 $parametres=DB::table('parametres')->where('id', 1)->first();

 ?>

<br>
  <div class="container">
    <div class="row"> 
      <div class="col-md-8">
        <section id="contact" class="margin-bottom-70">
          <h4><i class="sl sl-icon-phone"></i> Envoyez un message</h4>          
          <form id="contactform">
		  {{ csrf_field() }}    

			<!--<input name="to" type="hidden"  value="ihebsaad@gmail.com" id="to"> -->               
 
            <div class="row">
              <div class="col-md-6">  
				  <input name="name" type="text" placeholder="Nom" id="nom" required />                
              </div>
              <div class="col-md-6">                
                  <input name="name" type="text" placeholder="Prénom" id="prenom" required />                
              </div>
              <div class="col-md-6">                
                  <input name="email" type="email" placeholder="Email" id="mail" required />                
              </div>
              <div class="col-md-6">
                  <input name="subject" type="text" placeholder="Sujet" id="sujet" required />              
              </div>
			  <div class="col-md-12">
				  <textarea name="comments" cols="40" rows="2" id="contenu"   placeholder="Votre Message" required></textarea>
			  </div>
            </div>            
            <input type="button" class="submit button" id="submit" value="Envoyer" />
          </form>
        </section>
      </div>
      
      <div class="col-md-4">
		<div class="utf_box_widget margin-bottom-70">
			<h3><i class="sl sl-icon-map"></i> Infos de contact</h3>
			<div class="utf_sidebar_textbox">
			  <ul class="utf_contact_detail">
				<li><strong>Tél: </strong> <span>+ 001 245 0154</span></li>
				<li><strong>Site Web: </strong> <span><a href="#">www.prenezunrendezvous.com</a></span></li>
				<li><strong>E-Mail: </strong> <span><a href="mailto:contact@prenezunrendezvous.com">contact@prenezunrendezvous.com</a></span></li>
				<li><strong>Adresse: </strong> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</span></li>
			  </ul>
			</div>	
		</div>
      </div>
    </div>
  </div>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  
  			
	 			$('#submit').click(function( ){
 		             var _token = $('input[name="_token"]').val();
 
                    var nom = $('#nom').val();
                    var prenom = $('#prenom').val();
                    var sujet = $('#sujet').val();
                    var email = $('#mail').val();
                     var contenu = $('#contenu').val();
                    var to = $('#to').val();
            
                     $.ajax({
                        url:"{{ route('reservations.contactmessage') }}",
                        method:"POST",
                        data:{nom:nom ,prenom:prenom ,sujet:sujet, email:email, contenu:contenu, to:to, _token:_token},
                        success:function(data){
 
						 	swal({
                        type: 'success',
                        title: 'Envoyé ...',
                        text: 'Message envoyé avec succès'
 					//	icon: "success",
                    }); 
					
					document.getElementById("contactform").reset();

                        }
                    });
		
                    });
			
 </script>
 @endsection