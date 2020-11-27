@extends('layouts.blanklayout')

@section('content')
<style>
body{background-color:lightgrey;}
</style>
<div class="container"  >
              <div class="row" style="margin-top:100px"  >
			  
              <div class="col-sm-3"   >
			  </div>
                <div class="col-sm-6"  style="background-color:black;color:white" >
				<center><h2 style="color:white">Connexion </h2></center><br>
			     <form method="POST" action="{{ route('login') }}">
				  
				    @csrf

				<!--  <a href="javascript:void(0);" class="social_bt facebook_btn"><i class="fa fa-facebook"></i>Login avec Facebook</a>
				  <a href="javascript:void(0);" class="social_bt google_btn"><i class="fa fa-google-plus"></i>Login avec Google</a>	-->
                  <p class="utf_row_form utf_form_wide_block">
                       <input   id="email" type="email" class="input-text form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus  placeholder="Email">
 					            @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
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
                  <div class="utf_row_form utf_form_wide_block form_forgot_part"> 
				  	    <span class="lost_password  fl_left "> 
				    <a style="color:white" class="btn btn-link" href="{{ route('register') }}">
                      Nouveau? Inscription ici
                     </a>
					 </span>
				  </div>
                  <div class="utf_row_form utf_form_wide_block form_forgot_part"> 
				   
				   <span class="lost_password fl_left"> 
				
				  @if (Route::has('password.request'))
                                    <a style="color:white" class="btn btn-link" href="{{ route('password.request') }}">
                                        Mot de passe oublié?
                                    </a>
                    @endif 
					</span>
                    <div class="checkboxes fl_right">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label style="color:white" class="form-check-label" for="remember">
                                        Se souvenir de moi
                                    </label>
                                </div>
                    </div>
                  </div>
                  <div class="utf_row_form">
                    <input type="submit" class="button border margin-top-5" name="login" value="Connexion" />
                  </div><br><br>
				 

 
                </form>
              </div>
			    <div class="col-sm-3"   >

              </div>
              </div>
	</div>		  
@endsection
