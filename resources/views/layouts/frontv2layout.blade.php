<!DOCTYPE html>
<html lang="fr">
<head>
    @include('layouts.headv2')
    <?php    setlocale(LC_ALL, "fr_FR.UTF-8");    ?>
</head>
<body>
<!-- Wrapper -->
<div id="wrapper">

 @include('layouts.topv2')
  
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
 
    <div id="backtotop"><a href="#"></a></div>
</div>	

@include('layouts.footerv2')
@include('layouts.footerv2-scripts')
</html> 