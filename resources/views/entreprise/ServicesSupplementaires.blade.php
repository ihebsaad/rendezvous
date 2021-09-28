@extends('layouts.votreespacelayout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;

  ?>
  <?php use App\Service; use App\Produit ;use App\ServiceSupp; ?>


  <!-- Dashboard -->
<div id="dashboard"> 
  <style>
    @media (min-width: 992px){
.qtybotn {
 
    width: 23.666667%!important;
}}
  </style>
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
                            <li>Services Supplémentaires</li>
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
                    <div class="add-listing-section ">
                        
                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3>Services Supplémentaires</h3>
                            <!-- Switcher -->
                            <label class="switch" style="display:none;"><input type="checkbox" checked style="display:none;"><span class="slider round" style="display:none;"></span></label>
                        </div>

                        <!-- Switcher ON-OFF Content -->
                        <div class="switcher-content">
        <div class="row">
          <div class="col-md-12">
           
            <center> <label><h3>Liste des règles pour les services supplémentaires</h3></label></center><br><br>
             <center> 
            <table class="table table-striped" id="table_serv_supp" style="width: 80% !important;">
                <thead>
                  <tr>
                    <th><h3>Services additionnées</h3></th>
                    <th><h3>Service(s) et/ou produit(s) offert(s)</h3></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php  $regle_ser_supp=ServiceSupp::where('prestataire',$user->id)->get();?>
                  <?php foreach($regle_ser_supp as $rss) {
                  //dd($rss->re) 
                     $res=explode('=', $rss->regle);
                    ?>
                  <tr>
                    <td><?php echo $res[0]; ?></td>
                    <td><?php echo $res[1]; ?></td>
                    <td><input type="button" style="width: 50px !important; color: white !important;" value="X " onclick="deleteRow(this ,<?php echo $rss->id ?>)"></td>
                  </tr>                 
                <?php } ?>
                </tbody>
              </table>
           </center> 
          <br>
           <hr>
          <br>

   <div class="">
     
        <?php $nbcomm=0;?>

          <div class="row">
          <center> <label><h3>Créez une nouvelle règle pour offrir un service ou des produits supplémentaires</h3></label></center><br><br>
          <div class="col-md-5 com_wrapper" style="border-right-style: solid;">          
         <center> <label><h3>Addition des services</h3></label></center><br>
      <?php if($nbcomm<3){?>
       <div class="row">
             <div class="col-md-10">

              <?php  $services_pres=Service::where('user',$user->id )->get(['id','nom']);?>
       
            <select name="cars" class="cars">
            <option value=""></option>
              @foreach ($services_pres as $sp)
            <option value="{{$sp->nom}}">{{$sp->nom}}</option>
            @endforeach
            </select>

          </div>

            <div class="col-md-2"> <a href="javascript:void(0);" class="com_button" title="Ajouter un champs"><?php if($nbcomm<=1){ ?><img width="26" height="26" src="{{ asset('public/img/add.png') }}" style="float:left"/> <br><?php } ?></a> </div>
      </div> 
    <?php } ?>
    </div>
    <?php  $produits_pres=Produit::where('user',$user->id )->get(['id','nom_produit']);
     
    ?>
    <div class="col-xs-1" style="width: 5px !important;" >
    </div>
     <div class="col-md-6" style="border-style: dotted; ">
      <center> <label><h3>Résultat pour l'addition des services</h3></label></center><br>
      <div class="row">
        <div class="col-md-3" >
      <center><label>Service ou produit offert (résultat): </label></center>
      </div>
      <div class="col-md-6" >
    <center> <select name="cars" id="resser1" class="Resservice" style="width:100%;">
    <option value=""></option>
     @foreach($services_pres as $sp)
     <option value="{{$sp->nom}}">{{$sp->nom}}</option>
     @endforeach
     @foreach($produits_pres as $sp)
     <option value="{{$sp->nom_produit}}">{{$sp->nom_produit}}</option>
     @endforeach

    </select></center><br>
     </div>
      <div class="col-md-1" style="          margin-top: -34px;" >
       Quantité 
     </div>
      <div class="col-md-2 qtybotn" >
      <input id="qteres1" type="number" value="1" min="1" max="10">
     </div>
    </div>

     <div class="row">
        <div class="col-md-3" >
      <center><label>Service ou produit offert (résultat): </label></center>
      </div>
      <div class="col-md-6" >
    <center> <select name="cars" id="resser2" class="Resservice" style="width:100%;"><option value=""></option>  @foreach($services_pres as $sp)
     <option value="{{$sp->nom}}">{{$sp->nom}}</option>
     @endforeach
     @foreach($produits_pres as $sp)
     <option value="{{$sp->nom_produit}}">{{$sp->nom_produit}}</option>
     @endforeach</select></center><br>
     </div>
     <div class="col-md-1" style="       margin-top: -34px;" >
       Quantité 
     </div>
      <div class="col-md-2 qtybotn" >
      <input id="qteres2" type="number" value="1" min="1" max="10">
     </div>
    </div>

     <div class="row">
        <div class="col-md-3" >
      <center><label>Service ou produit offert (résultat): </label></center>
      </div>
      <div class="col-md-6" >
    <center> <select name="cars" id="resser3" class="Resservice" style="width:100%;"><option value=""></option> @foreach($services_pres as $sp)
     <option value="{{$sp->nom}}">{{$sp->nom}}</option>
     @endforeach
     @foreach($produits_pres as $sp)
     <option value="{{$sp->nom_produit}}">{{$sp->nom_produit}}</option>
     @endforeach</select></center><br>
     </div>
     <div class="col-md-1" style="        margin-top: -34px;" >
       Quantité 
     </div>
      <div class="col-md-2 qtybotn" >
      <input id="qteres3" type="number" value="1" min="1" max="10">
     </div>
    </div>
      </div> 
      </div>
      <div class="row">
       <br>
      <center> <a onclick='ecrire_formule()' href="javascript:void(0)" class="button">Valider</a> </center>
       <br>
      </div> 
      <div class="row"> 
       <form method="post" action="{{route('regle_service_suppls')}}" >  
       @csrf
       <input type="hidden"  value="{{$user->id}}" name="prestataire">  
        <hr>
        <br>
       <center>
        <label>Règle totale obtenue: </label>
        <input autocomplete="off"  type="text"  size="80" style="width:80% ; " id="restotal"  name="regle" value=""/> 
      </center>
    
      </div>
      <div class="row">
       <br>
      <center> <input type="submit" class="button" value="Enregistrer" style="color:black"> </center>
       <br>
      </div> 
      </form>
   </div> 
     </div> 
 
        </div>
<!-- Content end
    ================================================== -->
</div>
</div></div></div></div></div></div></div>
<script>

  function ecrire_formule() {  
  var inputs = $(".cars");
  var formule='';
       for(var i = 0; i < inputs.length; i++){
          if($(inputs[i]).find(":selected").text())
          {
            if(i!=0)
            {
            formule+=' + '+$(inputs[i]).find(":selected").text();
            }
            else
            {
            formule+=$(inputs[i]).find(":selected").text();
            }
          }
        } 

        //alert(formule);  

        var res1=$("#resser1").find(":selected").text();
        var qteres1=$("#qteres1").val();
        var res2=$("#resser2").find(":selected").text();
        var qteres2=$("#qteres2").val();
        var res3=$("#resser3").find(":selected").text();
        var qteres3=$("#qteres3").val();

        if(!res1 && !res2 && !res3 || !formule)
        {
          if(!res1 && !res2 && !res3)
          {
            swal("Vous devez saisir au moins un service ou un produit à offrir !");
          }
           else{
            swal("Vous devez saisir au moins un service dans la section Addition des services !");
          }
        }
        else
        {
          if(res1)
          {
            formule+=' = '+qteres1+' '+res1;
          }
          if(res2)
          {
             if(!res1)
             {
              formule+=' = '+qteres2+' '+res2;
             }
             else
             {
              formule+=' + '+qteres2+' '+res2;
             }
          }

          if(res3)
          {
             if(!res2 && !res1)
             {
              formule+=' = '+qteres3+' '+res3;
             }
             else
             {
              formule+=' + '+qteres3+' '+res3;
             }
          }

         $('#restotal').val(formule);

        }

                
 //myWindow=window.open('lead_data.php?leadid=1','myWin','width=400,height=650')
}

function deleteRow(r,id) {
  var i = r.parentNode.parentNode.rowIndex;
  document.getElementById("table_serv_supp").deleteRow(i);

  //var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ url('/') }}"+"/supprimer_serv_suppl/"+id,
            method:"get",
            data:{id:id},
            success:function(data){
             // alert(data);
              swal("Règle supprimée avec succès");
            }
        });


}
</script>

@endsection('content')