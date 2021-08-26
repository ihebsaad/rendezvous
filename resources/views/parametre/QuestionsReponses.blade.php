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
                            <li>Titre & Description</li>
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
                            <h3><i class="sl sl-icon-basket-loaded"></i>Gestion questions / réponses pour prestataire</h3>
                        </div>
                         <div class="row">
          <div class="col-md-12 col-sm-4">
            <h4></h4>
          <table id="utf_pricing_list_section">
            <tbody class="ui-sortable"  id="indispo">
            <br>
          <?php use App\PageFaq; $PageFaq=PageFaq::where('type','prest')->orderBy('id')->get();
            foreach($PageFaq as $pf){
            ?>
              <tr class="pricing-list-item pattern ui-sortable-handle">
              <td> 
              
              <div class="fm-input pricing-name" style="min-width:80%!important;">
               Question:<!-- <input type="text" value="<?php //echo $pi->titre;?>" > -->
                <textarea  type="text"  name="question" class="textarea tex-com" placeholder="Contenu de la page A Propos" id="qp{{$pf->id}}" name="question" onchange="changing_question_reponse(this)" required  ><?php echo $pf->question; ?></textarea>
              </div>
              
              <div class="fm-input pricing-ingredients" style="min-width:90%;">
                Réponse:<!-- <input type="text" value="<?php //echo $pi->date_debut;?>" > -->
                <textarea  type="text"  class="textarea tex-com" placeholder="Contenu de la page A Propos" name="reponse" id="rp{{$pf->id}}" onchange="changing_question_reponse(this)" required><?php echo $pf->reponse; ?></textarea>
              </div>
             
              <div class="fm-close" style="top:20px; right: 0px;">
              <a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('FaqsController@remove_question_response', [ 'id'=>$pf->id ])}}"><i class="fa fa-remove"></i></a>
              </div>
              
              </td>
            </tr>
            
            <?php } ?>
            </tbody>
          </table>
          <br>
            <center>
          <a href="#question-reponse-prestataire" class="button popup-with-zoom-anim">Ajouter</a> </center>
          <!--<a href="#" class="button add-pricing-submenu">Add Category</a> --></div>
        </div>  
                    </div>
                    <!-- Section / End -->

                </div>
            </div>
             <div class="col-lg-12">

                <div id="add-listing">

                    <!-- Section -->
                    <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-basket-loaded"></i> Gestion questions / réponses pour Client</h3>
                        </div>
                         <div class="row">
          <div class="col-md-12 col-sm-4">
            <h4></h4>
          <table id="utf_pricing_list_section">
            <tbody class="ui-sortable"  id="indispo">
            <br>
          <?php   $PageFaq=PageFaq::where('type','client')->orderBy('id')->get();
            foreach( $PageFaq as $pf){
            ?>
              <tr class="pricing-list-item pattern ui-sortable-handle">
              <td> 
              
              <div class="fm-input pricing-name" style="min-width:80%!important;">
               Question:<!-- <input type="text" value="<?php //echo $pi->titre;?>" > -->
                <textarea  type="text"  class="textarea tex-com" placeholder="Contenu de la page A Propos"  id="qc{{$pf->id}}" name="question" onchange="changing_question_reponse(this)" required  ><?php echo $pf->question; ?></textarea>
              </div>
              
              <div class="fm-input pricing-ingredients" style="min-width:90%;">
                Réponse:<!-- <input type="text" value="<?php //echo $pi->date_debut;?>" > -->
                <textarea  type="text"  class="textarea tex-com" placeholder="Contenu de la page A Propos" name="reponse" id="rc{{$pf->id}}" onchange="changing_question_reponse(this)" required  ><?php echo $pf->reponse; ?></textarea>
              </div>
             
              <div class="fm-close" style="top:20px; right: 0px;">
              <a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('FaqsController@remove_question_response', ['id'=>$pf->id ])}}"><i class="fa fa-remove"></i></a>
              </div>
              
              </td>
            </tr>
            
            <?php } ?>
            </tbody>
          </table>
          <br>
            <center>
          <a href="#question-reponse-client" class="button popup-with-zoom-anim">Ajouter</a> </center>
          <!--<a href="#" class="button add-pricing-submenu">Add Category</a> --></div>
        </div> 
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