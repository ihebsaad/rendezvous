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
                            <li>Codes promo</li>
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
                            <h3><i class="sl sl-icon-diamond"></i>Code promo</h3>
                           
                        </div>

                        <!-- Switcher ON-OFF Content -->
                        <div class="">

                            <div class="row">
                                <div class="col-md-12">
                                    <table id="pricing-list-container">
                                        
                                            <?php foreach($serviceWithCode as $Scode){ ?>
                                            <?php $ser =  $services->find($Scode->id_service); if($ser) {?>
                                         <tr class="pricing-list-item pattern">
                                            <td>
                                                <div class="fm-move " style="margin: 25px"><i class="sl sl-icon-cursor-move"></i></div>
                                                <div class="col-md-2"  style="margin-top: 15px">
                                                    <img src="<?php echo  URL::asset('storage/images/'.$ser->thumb);?>"  style="max-width:100px"  />
                                                </div>

                                                <div class="col-md-2" style="margin-top: 25px" >
                                                    <label><b>Nom :</b> </label>
                <output >{{$ser->nom}} </output>
            </div>
            <div class="col-md-2"  style="margin-top: 25px">
                                                   <label><b>Code promo :</b></label>
                <output >{{$Scode->code}} </output>
            </div>
                                                <div class="fm-input pricing-price"  style="margin-top: 25px"><input type="number" value="{{ $Scode->reduction }}" placeholder="" data-unit="%" max="100" min="1" onchange="changeReductionCode(this)" id="p{{ $Scode->id }}" />
                                                </div>
                                            <div class="fm-close"  style="margin-top: 25px">
                                                <a class="" onclick="return confirm('Êtes-vous sûrs ?')" href="{{url('services/remove_CodePromo/'.$Scode->id)}}"><i class="fa fa-remove"></i></a>

                                                </div>
                                            </td>
                                        </tr>
                                        <?php } }?>
                                    </table>
                                    <a href="#small-dialog" class="button popup-with-zoom-anim">Ajouter</a>
                                   
                                </div>
                            </div>

                        </div>
                        <!-- Switcher ON-OFF Content / End -->

                    </div>
                    <!-- Section / End -->


                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
    <!---------------------------------------------------------------------------------------------------->


          <div id="small-dialog" class="small-dialog zoom-anim-dialog mfp-hide">
             <div class="small-dialog-header">
                        <h3>Ajouter un code promo </h3>
                    </div>
         
      <form  method="post" enctype="multipart/form-data"   action="{{ route('services.CodePromo') }}"  >
      {{ csrf_field() }}
      
     <div class="utf_signin_form style_one">
      <input type="hidden" name="user" value="{{$user->id}}"  >
       
       <div class="fm-input ">
                <label for="myServices">Services :</label>
       <select onchange="myFunctionSelect()" name="myServices">
        <?php foreach($services as $service){ ?>
                  <option value="{{$service->id}}">{{$service->nom}}</option>
                <?php } ?>
                  
                </select> 
    </div><br>
    <div class="fm-input ">
            <label>Pourcentage de réduction :</label>
            <div >
          <input   type="number" min="1" max="99" value="1" name="redu">
          </div>
        </div>
              <div class="fm-input ">
                <label>code promo :</label>
                <input type="test"  placeholder="Exemple: sc445sd7ff" id="nbrService"  name="code"  required="required">
              </div>
              <br>
            <input type="submit" id="add" style="text-align:center;color:white;" value="Ajouter"></input>

      </form>       
    <!-- <a class="button" id="add" style="text-align:center">Ajouter</a>-->
     </div>     
     </div> 


              
             
        <!-- fin modal pour ajouter une eveé -->    

</div>
</div>
<script type="text/javascript">
     function changeReductionCode(x){
      var id = $(x).attr('id');
      id=id.substring(1) ;
     // alert(id);
      var valchange = $(x).val();
     // alert(valchange);
      var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('services.reduction_CodePromo') }}",
                        method:"POST",
            data:{valchange:valchange, _token:_token, id:id},
                        success:function(data){
                         // alert("ok");
                        }
                    });

    }
</script>
@endsection('content')