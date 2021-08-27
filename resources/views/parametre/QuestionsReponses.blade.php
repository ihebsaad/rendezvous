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
                            <li>Questions / réponses </li>
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
          <a href="#small-dialog" id="prest" onclick="modif(this)" class="button popup-with-zoom-anim">Ajouter</a> </center>
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
          <a href="#small-dialog" id="client" onclick="modif(this)" class="button popup-with-zoom-anim">Ajouter</a> </center>
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
<!--  modal -->

       <div id="small-dialog" class=" zoom-anim-dialog mfp-hide">
          <div class="small-dialog-header">
            <h3>Ajouter une question/réponse</h3>
          </div>
  <form  method="post" enctype="multipart/form-data" action="{{ route('pagefaqs.store_question_reponse') }}" >
      {{ csrf_field() }}
      
       <div class="utf_signin_form style_one">
       <input type="hidden" name="user" value="5"  >
        <label>Question *: </label>
        <div class="fm-input">
        <textarea  type="text"  class="textarea tex-com"   id="question_client" name="question" required  ><?php //echo $pi->titre; ?></textarea>
      </div>
        <label>Réponse *: </label>
      <div class="fm-input">
       <textarea  type="text"  class="textarea tex-com"   id="question_client" name="reponse" required  ><?php //echo $pi->titre; ?></textarea>
      </div>

      <input type="hidden" id="mytype"  name="type" value="prest">
         
      <br>
           <center><input type="submit" style="text-align:center;color:white;" value="Ajouter"></input></center>

      </form>       
     </div>     
     </div>     
       
    <!-- fin  -->  
    <script type="text/javascript">
      function modif(a) {
        var x= a.getAttribute("id");
        //alert(x);
        document.getElementById("mytype").value = x ;
      }
    </script>
@endsection('content')