@extends('layouts.votreespacelayout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;
use \App\Http\Controllers\CategoriesController;
  ?>
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
                    <h2>Catégories</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Catégories</li>
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
                    <div  class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <a href="{{ route('AddCategory') }}" class="button" style="float: right; font-size:  30px">+</a>
                            <h3> Catégories </h3>
                        </div>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                        <table id="myTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Icone</th>
                <th>Catégorie mère</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
             @foreach($categories as $categorie)
            
            <tr>
                <td><img  src="<?php echo  URL::asset('storage/categories/'.$categorie->image);?>" style="max-width:80px" /></td>
                <td id="n{{ $categorie->id}}"> {{$categorie->nom  }}</td>
                <td id="i{{ $categorie->id}}"> {{$categorie->icone  }} </td>
                    
                   <td id="l{{ $categorie->id}}" attr="{{$categorie->parent}}"><?php echo CategoriesController::champById('nom',$categorie->parent);?> </td>
                   <td><a  class="delete fm-close "  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('CategoriesController@remove', $categorie->id)}}"><i class="fa fa-remove"></i></a> <a  id="t{{ $categorie->id}}"  href="#small-dialog" onclick="functionEdit(this)" class="pull-right  popup-with-zoom-anim edit"  ><i class="fa fa-edit"></i></a></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Icone</th>
                <th>Catégorie mère</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
                    </div>
                    <!-- Section / End -->

                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
</div>
</div>
<div id="small-dialog" class=" zoom-anim-dialog mfp-hide">
          <div class="small-dialog-header">
            <h3>Modifier la catégorie</h3>
          </div>
         <div class="utf_signin_form style_one">
            <form  action="{{url('/')}}/categories/Edit" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

            <div class="fm-input ">
                <label>Laissez-le vide si vous ne voulez pas le modifier</label>
                              <input type="file" id="image" name="imageEdit" />
                            </div>
            
         <div class="fm-input ">
            <input type="" name="id_categorie" hidden="hidden" id="id_categorie" value="">
            <label>Nom</label>
                              <input type="text" placeholder="nom *" name="nomEdit" id="nomEdit">
         </div>
         <div class="fm-input ">
            <label>Icone</label>
            <p style="font-size:12px">Copier le nom de l'icone à partir de <a href="https://fliphome.mx/icons-list/">cette page</a></p>
            <input type="text" placeholder="Icone *" name="iconeEdit" id="iconeEdit">
         </div>
                            <div class="fm-input  ">
                                <label>Description</label>
                              <input type="text"   placeholder="description"  id="descriptionEdit" name="descriptionEdit">
                            </div>

                         <div class="fm-input  "> 
                             <label>Catégorie mère</label>
                                <select type="text" value="" id="parentEdit" name="parentEdit"  >
                              <option></option>
                              <?php foreach ($categories as $cat){ 
                               echo '<option value="'.$cat->id.'">'.$cat->nom.'</option>';

                                }?>
                              </select>
                            </div><br>
                            <input type="submit" value="Enregistrer" name="" >
    </form>
         </div>       
         </div> 
<script type="text/javascript">
    function functionEdit(a){
        var idwd=$(a).attr("id");
idwd=idwd.substring(1) ;
     
      var n = $('#n'.concat(idwd)).text();
      var i = $('#i'.concat(idwd)).text();
      var p = $('#p'.concat(idwd)).text();
      var l = $('#l'+idwd+'').attr('attr');

     $('#id_categorie').val(idwd);
      $('#nomEdit').val(n);
      $('#iconeEdit').val(i);
      $('#descriptionEdit').val(p);
      if (l != "")
      {$('#parentEdit option[value='+l+']').attr('selected','selected');}
    }
       
</script>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
@endsection('content')