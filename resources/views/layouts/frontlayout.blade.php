<!DOCTYPE html>
<html lang="fr">
<head>
    @include('layouts.head')
    <?php    setlocale(LC_ALL, "fr_FR.UTF-8");    ?>
</head>
<body>
<!-- Wrapper -->
<div id="main_wrapper">

 @include('layouts.top')
  
  <?php 
   if ($view_name == 'pricing'){
  Session::put('url', '/pricing'); 
   }else{
  Session::put('url', ''); 
   
   }  ?>

 
       @if ($errors->any())
             <div class="alert alert-danger">
                 <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div><br />
         @endif

    @if (!empty( Session::get('success') ))
           <div class="notification success closeable margin-bottom-30">
            <p>{{ Session::get('success') }}</p>
            <a class="close" href="#"></a> 
		  </div>

    @endif
 
 @yield('content')
 
  <div id="bottom_backto_top"><a href="#"></a></div>
</div>				
@include('layouts.footer')
@include('layouts.footer-scripts')
</body>
</html> 