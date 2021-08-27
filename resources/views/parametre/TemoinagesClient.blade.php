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
                    <h2>Paramètres</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Paramètres</li>
                            <li>Témoinages</li>
                            <li>Ajouter un témoinage</li>
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
                            <h3>Ajouter un témoinage</h3>
                        </div>
                        <form  method="post" enctype="multipart/form-data" action="{{ route('temoinages.store_temoinage') }}" >
      {{ csrf_field() }}
                        <input type="hidden" name="id" value="">
                        <!-- Title -->
                        <div class="row with-forms">
                            <div class="col-md-6">
                                <h5>Nom du client *: </h5>
                                <input  type="text" id="nom_client" name="nom" required  />
                                <h5>Poste du client *:</h5>
                                <input  type="text" id="poste_client" name="poste" required  />
                            </div>
                            <div class="col-md-6">
                                <h5>Témoinage <b>*</b>: </h5>
                                <textarea  type="text"  class="textarea tex-com"   id="texte_client" name="texte" required  ></textarea>
                            </div>
                        </div>

                       

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