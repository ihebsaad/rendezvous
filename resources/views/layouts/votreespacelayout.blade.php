<!DOCTYPE html>
<html lang="fr">
<head>
    @include('layouts.back.bhead')
    <?php    setlocale(LC_ALL, "fr_FR.UTF-8");    ?>
</head>
<body>
<!-- Wrapper -->
<div id="main_wrapper"> 
 @include('layouts.back.btop')
   
  
	
 @yield('content')
 
				
{{--@include('layouts.back.bfooter')--}}
@include('layouts.back.bfooter-scripts')
</body>
</html>
