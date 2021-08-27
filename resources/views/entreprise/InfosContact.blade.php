@extends('layouts.votreespacelayout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;

  ?>

  <!-- Dashboard -->
<div id="dashboard"> 
@include('layouts.back.bmenu')
<!-- Content
    ================================================== -->
<div class="dashboard-content">
<!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Mon entreprise</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Mon entreprise</li>
                            <li>Infos de contact</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        @if ($live_message = Session::get('ttmessage'))
           <div class="notification success closeable">
                <p>{{ $live_message }}</p>
                <a class="close" href="#"></a>
            </div>
            <?php Session::forget('ttmessage');  ?>
        @endif
        <div class="row">
            <div class="col-lg-12">

                <div id="add-listing">

                    <!-- Section -->
                    <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-docs"></i> Infos de contact</h3>
                        </div>
                        <form method="post" action="{{ route('changeInfosContact') }}" name="changeInfosContact" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <!-- Title -->
                        <div class="row with-forms">
                            <!-- Phone -->
                          <div class="col-md-4">
                            <h5>Phone <span>(optional)</span></h5>
                            <input type="text" name="Phone" value="{{ $user->tel }}">
                          </div>
                    

                          <!-- Email Address -->
                          <div class="col-md-4">
                            <h5>E-mail <span>(optional)</span></h5>
                            <input type="email" name="email" value="{{ $user->email }}">
                          </div>

                          <!-- Linkedin -->
                          <div class="col-md-4">
                            <h5>Linkedin <span>(optional)</span></h5>
                            <input type="text" name="linkedin" value="{{ $user->linkedin }}">
                          </div>

                        </div>
                        <!-- Row -->
                        <div class="row with-forms">

                          <!-- Phone -->
                          <div class="col-md-4">
                            <h5 class="fb-input"><i class="fa fa-facebook-square"></i> Facebook <span>(optional)</span></h5>
                            <input type="text" name="fb" placeholder="https://www.facebook.com/" value="{{ $user->fb }}">
                          </div>

                          <!-- Website -->
                          <div class="col-md-4">
                            <h5 class="twitter-input"><i class="fa fa-twitter"></i> Twitter <span>(optional)</span></h5>
                            <input type="text" name="twitter" placeholder="https://www.twitter.com/" value="{{ $user->twitter }}">
                          </div>

                          <!-- Email Address -->
                          <div class="col-md-4">
                            <h5 class="gplus-input"><i class="fa fa-instagram"></i> Instagram <span>(optional)</span></h5>
                            <input type="text" name="instagram" placeholder="https://www.Instagram.com/" value="{{ $user->instagram }}">
                          </div>

                        </div>
                        <!-- Row / End -->
                        
                        <!-- Row -->
                        <div class="row with-forms">

                            <!-- Type -->
                            <div class="col-md-12">
                                <input type="submit" class="button preview" value='Enregistrer' />
                            </div>

                        </div>
                        <!-- Row / End -->
                    </form>
                    </div>
                    <!-- Section / End -->

                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
</div>
</div>
@endsection('content')