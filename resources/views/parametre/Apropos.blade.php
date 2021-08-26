@extends('layouts.votreespacelayout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;
   $parametres=DB::table('parametres')->where('id', 1)->first();

  ?>
  <style type="text/css">
      figure {
  border: 1px #cccccc solid;
  padding: 4px;
  margin: 4px;
}

figcaption {
  background-color: black;
  color: white;
  font-style: italic;
  padding: 2px;
  text-align: center;
}
    </style>
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
                            <h3><i class="fa fa-info"></i> Titre & Description</h3>
                        </div>
                        <div class="row">

          <div class="col-md-12">
            <input id="apropos1a" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "106" value="{{$parametres->apropos1a}}" />

            <textarea id="apropos1b" style="">{{$parametres->apropos1b}}</textarea>
          </div>
          <div class="col-md-6">
            <input id="apropos2a" type="text" name="" value="{{$parametres->apropos2a}}">
            <textarea id="apropos2b" style="height: 560px">{{$parametres->apropos2b}}</textarea>
          </div>
          <div class="col-md-6">
            <div class="row">

              <div class="col-md-12">
                <input id="apropos3a" type="text" value="{{$parametres->apropos3a}}" name="">
              </div>
              <div class="col-md-4" style="margin-top: 20px;">
                <figure style="max-height: 250px" class="float-left">
                  <center><img src="<?php echo  URL::asset('public/images/david.jpg');?>" alt="Mr MAXIME David Martiniquais" style="max-height: 200px"></center>
                  <figcaption>Mr MAXIME David</figcaption>
                 </figure>
              </div>
              <div class="col-md-8">
                <br>
                <textarea id="apropos3b" style="height: 200px">{{$parametres->apropos3b}}</textarea>
              </div>
              <div class="col-md-12">
                <textarea id="apropos3c" style="height: 300px">{{$parametres->apropos3c}}</textarea>
              </div>
              
            </div>
            
            
            
          </div>
          <div class="col-md-6">
            <input  type="submit" onclick="saveApropos()" style="text-align:center;color:white;" value="Enregistrer"></input>
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
    function saveApropos(){
    //alert("okko");
     var apropos1a = document.getElementById("apropos1a").value;
    var apropos1b = document.getElementById("apropos1b").value;

    var apropos2a = document.getElementById("apropos2a").value;
    var apropos2b = document.getElementById("apropos2b").value;

    var apropos3a = document.getElementById("apropos3a").value;
    var apropos3b = document.getElementById("apropos3b").value;
    var apropos3c = document.getElementById("apropos3c").value;

     //alert(apropos3c);
    var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('users.ChangeApropos') }}",
                    method: "get",
                    data: {apropos1a: apropos1a,apropos1b: apropos1b,apropos2a: apropos2a,apropos2b: apropos2b,apropos3a: apropos3a,apropos3b: apropos3b,apropos3c:apropos3c , _token: _token},
                    success: function (data) {
                        // alert("okko");            
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