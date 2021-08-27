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
    <style type="text/css">
        @media (max-width: 700px){
.table thead {
display: none;
}
.table tr{
display: block;
margin-bottom: 40px;
}
.table td {
display: block;
text-align: right;
}
.table td:before {
content: attr(data-label);
float: left;
font-weight: bold;
}
}
    </style>
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
                            <li>Happy hours</li>
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
                    <div class="row">
            <div class="col-lg-12">

                <div id="add-listing">

                    <!-- Section -->
                    <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-present"></i>Happy hours </h3>
                        </div>

                        <!-- Title -->
                        <div class="row ">
                            <div class="col-md-12">
                             <div class="sizeA" >
    <table class="table events-table" style="font-size: 150%; "  >
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Réduction</th>
      <th scope="col">Places</th>
      <th scope="col">Bénéficiaires</th>
      <th scope="col">Date</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php $x=0; foreach($happyhours as $happyhour){ $x=$x+1 ; ?>
    <tr>
      <th scope="row">{{$x}}</th>
      <td data-label="Réduction" >{{$happyhour->reduction}}%</td>
      <td data-label="Places">{{$happyhour->places}}</td>
      <td data-label="Bénéficiaires">{{$happyhour->Beneficiaries}}</td>
      <td data-label="Date:" width="50%"><b>De</b> <?php $dateDebut = new DateTime($happyhour->dateDebut); echo $dateDebut->format('d-m-Y H:i') ; ?> <b>à</b> <?php $dateFin = new DateTime($happyhour->dateFin); echo $dateFin->format('d-m-Y H:i') ; ?></td>
      <td><a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')" href="{{url('services/remove_happyhour/'.$happyhour->id)}}"><i class="fa fa-remove"></i></a></td>
    </tr>
  <?php } ?>
 
  </tbody>
</table></div>

                            </div>
                        </div>

                        <!-- Row -->
                        <div class="row ">

                          
                         <a href="#small-dialog" class="button popup-with-zoom-anim">Ajouter</a>
                        </div>
                        <!-- Row / End -->

                    </div>
                    <!-- Section / End -->

                   



                </div>
            </div>

          
        </div>
        </div>
<!-- Content end
    ================================================== -->
             <div id="small-dialog" class="small-dialog zoom-anim-dialog mfp-hide">
             <div class="small-dialog-header">
                        <h3>Ajouter une Happy hours </h3>
                    </div>
         
      <form  method="post"  action="{{ route('services.HappyHours') }}"  >
      {{ csrf_field() }}
      
     <div class="utf_signin_form style_one">
      <input name="id_user" value="{{$user->id}}" hidden>
       
       <div class="fm-input ">
                <label >Pourcentage de réduction:</label>
          <input type="number" placeholder="10"  data-unit="%" max="100" min="1" name="reduction"  required/>

    </div>
    

              <div class="fm-input ">
                <label>Date début:</label>
                <input type="datetime-local" name="date_debut" required="required">
              </div>
              <div class="fm-input ">
                <label>Date fin:</label>
                <input type="datetime-local" name="date_fin" required="required">
              </div>
              <div class="fm-input ">
                <label>Places:</label>
                <input placeholder="5" type="number" name="places" required="required">
              </div>
              <br>
            <input type="submit" id="add" style="text-align:center;color:white;" value="Ajouter"></input>

      </form>       
    <!-- <a class="button" id="add" style="text-align:center">Ajouter</a>-->
     </div>     
     </div> 


              
             
        <!-- fin modal pour ajouter une eveé -->  
    <script type="text/javascript">
        function changeReduction(x){
            //alert("ok");
        var valchange = $(x).val();
        //alert(valchange);
        var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('services.reduction') }}",
                        method:"get",
                        data:{valchange:valchange, _token:_token},
                        success:function(data){
                        //alert("ok");
                        }
                    });

    }
    </script>
</div>
</div>
@endsection('content')