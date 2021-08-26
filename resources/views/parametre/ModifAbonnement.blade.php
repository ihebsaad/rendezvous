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
            <div class="col-lg-6 col-sm-offset-3">

                <div id="add-listing">

                    <!-- Section -->
                    <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3>Contenu de l'abonnement</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="utf_price_plan_features">
            <ul style="padding-bottom: 5px">
              <?php  foreach($abonnement as $ab) { 
                       echo  '<li><span id="a'.$ab->id.'">'.$ab->contenu.'</span> <a href="javascript:void(0)"  onclick="supprimeLinge('.$ab->id.')"><i class="sl sl-icon-trash" style="color:red"></i></a> <a href="javascript:void(0)" att="a" onclick="modifLinge('.$ab->id.',this)"><i class="sl sl-icon-note" style="color:red"></i></a></li>' ; 
                     
                  
                   } ?>
                 </ul>

                            
     </div> 
                                <form action="{{ route('users.editPlan') }}" method="get" > 
     <div id="Modifa">
     <textarea type="text" name="contenuPlan" placeholder="Ajouter une ligne "></textarea>
     </div><br>
     <input type="" name="abonnement" hidden="hidden" value="1">
     <input type="" name="idligne" id="idlignea" hidden="hidden" value="0">
     <div>
     <input type="submit" id="buttonSubmita" value="Ajouter" name=""> 
     <a class="button annuler1" onclick="AnnulerF(this)" id="annulera" att2="a" style="background-color: red;display: none;float: right;">Annuler</a>
</div>
</form>
                            </div>
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
<script type="text/javascript">
    function supprimeLinge(a){
    
    if(confirm('Êtes-vous sûrs ?'))
    {
      
      var idligne = a ;
      var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('users.deleteLine') }}",
            method: "get",
            data: {idligne:idligne, _token: _token},
            success: function (data) {
                             
              location.reload() ;
             }
  
        });
    }
  }
  function modifLinge(a,b){
    var x = b.getAttribute("att");
    y=document.getElementById(x+a).innerHTML ;
    $("#annuler"+x).css("display","block");
    document.getElementById("buttonSubmit"+x).value = "Enregistrer" ;
    document.getElementById("idligne"+x).value = a ;
    $("#buttonSubmit"+x).css("background-color","green");
    document.getElementById("Modif"+x).innerHTML = '<textarea type="text" name="contenuPlan" placeholder="Ajouter une ligne ">'+y+'</textarea>';

    //alert(y);
  }
  function AnnulerF(a){
    var x= a.getAttribute("att2");
    //alert(x);
    $("#annuler"+x).css("display","none");
    document.getElementById("buttonSubmit"+x).value = "Ajouter" ;
    $("#buttonSubmit"+x).css("background-color","");
    document.getElementById("idligne"+x).value = 0 ;
    document.getElementById("Modif"+x).innerHTML = '<textarea type="text" name="contenuPlan" placeholder="Ajouter une ligne "></textarea>';
  };
</script>
@endsection('content')