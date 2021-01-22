<?php 
 $parametres=DB::table('parametres')->where('id', 1)->first();

 $apropos=$parametres->apropos_footer;?> 
 <!-- Footer -->
  <div id="footer" class="footer_sticky_part" style="padding-top:120px;padding-bottom: 70px;margin-bottom: 0px"> 
    <div class="container">
      <div class="row">
 
        <div class="col-md-3 col-sm-6 col-xs-6">
          <h4>Liens</h4>
          <ul class="social_footer_link">
            <li><a href="{{route('home')}}">Accueil</a></li>
            <li><a href="{{route('apropos')}}">A Propos</a></li>
            <li><a href="{{route('ConditionsUtilisation')}}">Conditions d'utilisation</a></li>
            <li><a href="{{route('contact')}}">Contact</a></li>
          <!--  <li><a href="#">Favoris</a></li>-->
          </ul>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
          <h4>Compte</h4>
          <ul class="social_footer_link">
            <li><a href="{{route('pricing')}}">Abonnements</a></li>		  
            @guest <li><a class="sign-in popup-with-zoom-anim" href="#dialog_signin_part" onclick="$('#litab2').trigger('click');">Inscription</a></li>
            <li><a class="sign-in popup-with-zoom-anim" href="#dialog_signin_part" onclick="$('#litab1').trigger('click');">Connexion</a></li> 
			@else
			<li><a  href="{{route('logout')}}"  >Déconnexion</a></li> 
			@endguest
          </ul>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12"> 
          <h4>A Propos</h4>
          <p style="color:black;"><?php echo $apropos;?></p>          
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="footer_copyright_part"><br>Copyright © 2021 Tous droits réservés - par eSolutions </div>
        </div>
      </div>
    </div>
  </div> 