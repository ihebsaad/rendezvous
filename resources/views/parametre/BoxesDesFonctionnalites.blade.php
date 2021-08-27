@extends('layouts.votreespacelayout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;
   $parametres=DB::table('parametres')->where('id', 1)->first();

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
                            <li>Boxes des fonctionnalités</li>
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
                            <h3><i class="sl sl-icon-folder-alt"></i> Textes du vidéo d'accueil</h3>
                        </div>
                        <div class="row">

          <div class="col-md-12">
            <label>Texte :</label>           
            <input id="idtext" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "106" value="{{$parametres->hometext}}" />
          </div>
          
          </div>
          
          
           <div class="row">
          
          <div class="col-md-4">
            <label>Textes animés :</label>           
            <input id="texta1" name="texta1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "106" value="{{$parametres->texta1}}" />
          </div>                    
          <div class="col-md-4">
            <label> </label>
            <input id="texta2" name="texta2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "106" value="{{$parametres->texta2}}" />          
          </div>                   
          <div class="col-md-4">
            <label> </label>
            <input id="texta3" name="texta3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "106" value="{{$parametres->texta3}}" />          
          </div>                   
          <div class="col-md-4">
            <label> </label>
            <input id="texta4" name="texta4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "106" value="{{$parametres->texta4}}" />          
          </div>                   
          <div class="col-md-4">
            <label> </label>
            <input id="texta5" name="texta5" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "106" value="{{$parametres->texta5}}" />          
          </div>
          
          </div>

           <div class="row">
           
           <div class="col-md-12">
            <input type="submit" onclick="savetext()" style="text-align:center;color:white;" value="Enregistrer"></input>
          </div>         
          
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
                            <h3><i class="sl sl-icon-screen-desktop"></i>Comment ça marche</h3>
                        </div>
                        
                        <div class="row">

          <div class="col-md-3">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <br>
            <!-- <h5 class="card-title text-muted text-uppercase text-center">Free</h5> -->
            <center><span  style="color:#006ED2" ><i class="fa  fa-search fa-5x"></i></span></center>
            <!-- <h6 class="card-price text-center">$0<span class="period">/month</span></h6> -->
            <br>
            <br>
            <center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "106" id="Box1a" style="font-size:130%;">{{$parametres->Box1a}}</textarea></center><center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "50" id="Box1b" style="color:grey; height: 50px!imoptant ;min-height: 120px;">{{$parametres->Box1b}}</textarea></center>
            <!-- <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a> -->
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <br>
            <!-- <h5 class="card-title text-muted text-uppercase text-center">Free</h5> -->
            <center><span  style="color:#006ED2"><i class="fa fa-check fa-5x"></i></span></center>
            <!-- <h6 class="card-price text-center">$0<span class="period">/month</span></h6> -->
            <br>
            <br>
            <center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "106" id="Box2a" style="font-size:130%;padding-bottom: 25px">{{$parametres->Box2a}}</textarea><center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "50" id="Box2b" style="color:grey; height: 50px!imoptant ;min-height: 120px;">{{$parametres->Box2b}}</textarea></center><br>
            <br>    </center>
            <!-- <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a> -->
         
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <br>
            <!-- <h5 class="card-title text-muted text-uppercase text-center">Free</h5> -->
            <center><span style="color:#006ED2" ><i class="fa fa-calendar fa-5x"></i></span></center>
            <!-- <h6 class="card-price text-center">$0<span class="period">/month</span></h6> -->
            <br>
            <br>
            <center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "106" id="Box3a" style="font-size:130%;padding-bottom: 23px">{{$parametres->Box3a}}</textarea></center><center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "50" id="Box3b" style="color:grey; height: 50px!imoptant ;min-height: 120px;">{{$parametres->Box3b}}</textarea></center> <br>
            <!-- <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a> -->
         </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <br>
            <!-- <h5 class="card-title text-muted text-uppercase text-center">Free</h5> -->
            <center><span  style="color:#006ED2"><i class="fa fa-credit-card fa-5x"></i></span></center>
            <!-- <h6 class="card-price text-center">$0<span class="period">/month</span></h6> -->
            <br>
            <br>
            <center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "106" id="Box4a" style="font-size:130%;">{{$parametres->Box4a}}</textarea></center>
            <center><textarea oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "50" id="Box4b" style="color:grey; height: 50px!imoptant ;min-height: 120px;">{{$parametres->Box4b}}</textarea></center>
            <!-- <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a> -->
          </div>
        </div>
      </div>
          <div class="col-md-12">
            <input type="submit" onclick="ChangeBoxes()"  value="Enregistrer"></input>
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
     function ChangeBoxes(){
    //alert("okko");
     var Box1a = document.getElementById("Box1a").value;
    var Box1b = document.getElementById("Box1b").value;

    var Box2a = document.getElementById("Box2a").value;
    var Box2b = document.getElementById("Box2b").value;

    var Box3a = document.getElementById("Box3a").value;
    var Box3b = document.getElementById("Box3b").value;

    var Box4a = document.getElementById("Box4a").value;
    var Box4b = document.getElementById("Box4b").value;
     //alert(Box1a);
    var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('users.ChangeBoxes') }}",
                    method: "get",
                    data: {Box1a: Box1a,Box1b: Box1b,Box2a: Box2a,Box2b: Box2b,Box3a: Box3a,Box3b: Box3b, Box4a: Box4a,Box4b: Box4b, _token: _token},
                    success: function (data) {
                                     
                    swal({
                        type: 'success',
                        title: 'Modifié ...',
                        text: 'Contenu modifié avec succès'
          //  icon: "success",
                    }); 
          
                     }
          
                });
  }
   function savetext(){
   
    var val = document.getElementById("idtext").value;
    var valta1 = document.getElementById("texta1").value;
    var valta2 = document.getElementById("texta2").value;
    var valta3 = document.getElementById("texta3").value;
    var valta4 = document.getElementById("texta4").value;
    var valta5 = document.getElementById("texta5").value;
     //alert(val);
    var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('users.changehometext') }}",
                    method: "get",
                    data: {val: val,valta1: valta1,valta2: valta2,valta3: valta3,valta4: valta4,valta5: valta5, _token: _token},
                    success: function (data) {
                                     
                    swal({
                        type: 'success',
                        title: 'Modifié ...',
                        text: 'Contenu modifié avec succès'
          //  icon: "success",
                    }); 
          
                     }
          
                });
  }
</script>
@endsection('content')