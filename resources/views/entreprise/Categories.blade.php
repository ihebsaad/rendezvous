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
<form method="post" action="{{ route('changeCategories') }}" name="changeCategories" >
                        @csrf
                        <input type="hidden" name="id" id="iduser" value="{{ $user->id }}" >
                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-tag"></i>Catégories</h3>
                        </div>
                        <!-- Checkboxes -->
                        <div class="checkboxes in-row margin-bottom-20 ">

                            <?php foreach($categories as $categ)
                            {
                                $cats_user = $categories_user->toArray();
                                $idcat= $categ->id;
                                if( in_array($idcat,$cats_user) ){
                                    $check='checked';
                                }else{
                                $check='';
                                }
                         echo ' <div  class="col-lg-4 margin-bottom-20 ">
                                    <input id="cat-'.$categ->id.'" type="checkbox" name="check" '.$check.' onchange="changefunction(this)"   >
                                    <label for="cat-'.$categ->id.'"   >'.$categ->nom.' </label>
                                </div>';                  
                                
                            }
                            
                            ?> 

<script type="text/javascript">
    function changefunction(a){
        idelemt = a.id;
        cat= idelemt.slice(4);
        var user = $('#iduser').val();
                 var _token = $('input[name="_token"]').val();
                    var checked=false;
                    if($(a).prop("checked") == true){
              checked=true;
            }
            else{

                if($(this).prop("checked") == false){
                       checked=false;
                   }

                }
        //alert(checked);
        if( checked ){
                    $.ajax({
                        url:"{{ route('categories.insert') }}",
                        method:"POST",
                        data:{user:user,categorie:cat, _token:_token},
                        success:function(data){
                          //alert(checked);  
                            
                     $.notify({
                    message: 'Catégorie ajoutée avec succès',
                    icon: 'glyphicon glyphicon-check'
                    },{
                    type: 'success',
                    delay: 3000,
                    timer: 1000,    
                    placement: {
                        from: "bottom",
                        align: "right"
                        },                  
                    }); 
                        }
                        
                    });
                  
                    }else{
                      $.ajax({
                        url:"{{ route('categories.removecatuser') }}",
                        method:"POST",
                        data:{user:user,categorie:cat, _token:_token},
                        success:function(data){
                           
                    
                    $.notify({
                    message: 'Catégorie supprimée avec succès',
                    icon: 'glyphicon glyphicon-check'
                    },{
                    type: 'success',
                    delay: 3000,
                    timer: 1000,    
                    placement: {
                        from: "bottom",
                        align: "right"
                        },                  
                    });     
                        }
                        
                    });
                     

                    }
              
                  //    


             
    }
</script>                            
                            
                    
                        </div>
                        <!-- Checkboxes / End -->

                        
                        

                        

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
<script type="text/javascript">
    
    $(document).ready(function() {
            

            
            // $('.categories').click(function(event ){
                $(document).on('change', '.categories', function() {
                    alert("");
                        idelemt = (this).id;
                cat= idelemt.slice(3);
            ///here
               var checked =document.getElementById('cat-'+cat).checked  ;
              // var checked =$(this).prop("checked");
               var user = $('#user').val();
                 var _token = $('input[name="_token"]').val();
                    var loading=false;
                    if($(this).prop("checked") == true){
              checked=true;
            }
            else{

                if($(this).prop("checked") == false){
                       checked=false;
                   }

                }
             // alert(checked);
                if( checked ){
                    $.ajax({
                        url:"{{ route('categories.insert') }}",
                        method:"POST",
                        data:{user:user,categorie:cat, _token:_token},
                        success:function(data){
                            changed=true;
                            
                     $.notify({
                    message: 'Catégorie ajoutée avec succès',
                    icon: 'glyphicon glyphicon-check'
                    },{
                    type: 'success',
                    delay: 3000,
                    timer: 1000,    
                    placement: {
                        from: "bottom",
                        align: "right"
                        },                  
                    }); 
                        }
                        
                    });
                  
                    }else{
                      $.ajax({
                        url:"{{ route('categories.removecatuser') }}",
                        method:"POST",
                        data:{user:user,categorie:cat, _token:_token},
                        success:function(data){
                            changed=true;
                    
                    $.notify({
                    message: 'Catégorie supprimée avec succès',
                    icon: 'glyphicon glyphicon-check'
                    },{
                    type: 'success',
                    delay: 3000,
                    timer: 1000,    
                    placement: {
                        from: "bottom",
                        align: "right"
                        },                  
                    });     
                        }
                        
                    });
                     

                    }
              
                  //    


             });
</script>
@endsection('content')