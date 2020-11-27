@extends('layouts.blanklayout')

@section('content')
<style>
body{background-color:lightgrey;}
</style>
<div class="container"  >
              <div class="row" style="margin-top:10px"  >
			  
              <div class="col-sm-3"   >
			  </div>
                <div class="col-sm-6"  style="background-color:black;color:white" >
				<center><h2 style="color:white">Inscription </h2></center><br>
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
                   <center> <b style="color:white">Vous êtes ?</b></center>
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
                  <input type="submit" class="button border fw margin-top-10" style="margin-bottom:10px;width:100%" name="register" value="Inscription" />
                </form>
              </div>
			    <div class="col-sm-3"   >

              </div>
              </div>
	</div>		  
@endsection
