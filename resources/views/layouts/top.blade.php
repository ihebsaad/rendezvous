  
<header id="header_part"> 
    <div id="header">
      <div class="container"> 
        <div class="utf_left_side"> 
          <div id="logo"> <a href="index_1.html"><img src="{{  URL::asset('public/images/logo.png') }}" alt=""></a> </div>
          <div class="mmenu-trigger">
			<button class="hamburger utfbutton_collapse" type="button">
				<span class="utf_inner_button_box">
					<span class="utf_inner_section"></span>
				</span>
			</button>
		  </div>
          <nav id="navigation" class="style_one">
            <ul id="responsive">
              <li><a href="{{route('home')}}">Accueil</a></li>
              <li><a href="#">A propos</a></li>
              <li><a href="{{route('listings')}}">Découvrez Nos Prestataires</a></li>
              <li><a href="#">Contact</a>             
            </ul>
          </nav>
          <div class="clearfix"></div>
        </div>
        <div class="utf_right_side">
          <div class="header_widget"> 
		     @guest
		  <a href="#dialog_signin_part" class="button border sign-in popup-with-zoom-anim"><i class="fa fa-sign-in"></i> Connexion / Inscription</a>
			@else
		  <a href="{{route('dashboard')}}" class="button border with-icon"><i class="sl sl-icon-equalizer"></i> Mon Compte</a></div>
	        @endguest

        </div>
        
        <div id="dialog_signin_part" class="zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Connexion</h3>
          </div>
          <div class="utf_signin_form style_one">
            <ul class="utf_tabs_nav">
              <li class=""><a href="#tab1">Connexion</a></li>
              <li><a href="#tab2">Inscription</a></li>
            </ul>
            <div class="tab_container alt"> 
              <div class="tab_content" id="tab1" style="display:none;">
                        					
			     <form method="POST" action="{{ route('login') }}">
				    @csrf

				<!--  <a href="javascript:void(0);" class="social_bt facebook_btn"><i class="fa fa-facebook"></i>Login avec Facebook</a>
				  <a href="javascript:void(0);" class="social_bt google_btn"><i class="fa fa-google-plus"></i>Login avec Google</a>	-->
                  <p class="utf_row_form utf_form_wide_block">
                       <input   id="email" type="text" class="input-text form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus  placeholder="Email">
			            @if ($errors->has('email')  || $errors->has('username') )
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }} {{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                  </p>
                  <p class="utf_row_form utf_form_wide_block">
                       <input   id="password" type="password" class="input-text form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required  placeholder="Mot de passe">
 					          @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
								
                  </p>
                  <div class="utf_row_form utf_form_wide_block form_forgot_part"> <span class="lost_password fl_left"> 
				  @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Mot de passe oublié?
                                    </a>
                    @endif </span>
                    <div class="checkboxes fl_right">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Se souvenir de moi
                                    </label>
                                </div>
                    </div>
                  </div>
                  <div class="utf_row_form">
                    <input type="submit" class="button border margin-top-5" name="login" value="Connexion" />
                  </div>
				 

 
                </form>
              </div>
              
              <div class="tab_content" id="tab2" style="display:none;">
                <form method="post" class="register"  action="{{ route('register') }}">
                  @csrf
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="username2">
                      <input type="text" class="input-text" name="username" id="username2" value="" placeholder="Nom d'utilisateur" />
                    </label>
                    @if ($errors->has('username'))
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                    @endif
                  </p>
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="name">
                      <input type="text" class="input-text" name="name" id="name" value="" placeholder="Prénom" />
                    </label>
                    @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                  </p>	
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="lastname">
                      <input type="text" class="input-text" name="lastname" id="lastname" value="" placeholder="Nom" />
                    </label>
                    @if ($errors->has('lastname'))
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                    @endif
                  </p>					  
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="email2">
                      <input type="text" class="input-text" name="email" id="email2" value="" placeholder="Email" />
                    </label>
                    @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                  </p>
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="password1">
                      <input class="input-text" type="password" name="password" id="password1" placeholder="Mot de passe" />
                    </label>
                    @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                  </p>
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="password2">
                      <input class="input-text" type="password" name="password_confirmation" id="password2" placeholder="Confirmation de mot de passe" />
                    </label>
                    @if ($errors->has('password_confirmation'))
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                    @endif
                  </p>

                  <p class="utf_row_form utf_form_wide_block">
                   <center> <b style="color:black">Vous êtes ?</b></center>
                    </p>
                    <div class="checkboxes  ">
                                <div class="form-check" style=" "  onclick="document.getElementById('prestataire').checked = false;">
                                    <input class="form-check-input" type="checkbox" name="user_type" id="client" value="client" >

                                    <label class="form-check-label" for="client">
                                        Client (vous cherchez des services)
                                    </label>
                                </div>
                    </div>
				 <div class="checkboxes  ">
                                <div class="form-check" style=" "  onclick="document.getElementById('client').checked = false;">
                                    <input class="form-check-input" type="checkbox" name="user_type" id="prestataire" value="prestataire" >

                                    <label class="form-check-label" for="prestataire">
                                        Prestataire (vous voulez vendre des sevices)
                                    </label>
                                </div>
                    </div>
                  <input type="submit" class="button border fw margin-top-10" name="register" value="Inscription" />
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </header>
  <div class="clearfix"></div>
  