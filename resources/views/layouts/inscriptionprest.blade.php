<!DOCTYPE html>
<html lang="fr">
<head>
    @include('layouts.headv2')
    <?php    setlocale(LC_ALL, "fr_FR.UTF-8");    ?>
    <style type="text/css">
        .dashboard-list-box .row {
            padding: 5px;
            margin: 0;
            background-color: #fff;
        }
        .dashboard-list-box h4 {
            color: #000;
            background-color: #ffd700;
            border-radius: 40px 40px 0 0;
            font-size: 20px;
            font-weight: 800;
            text-align: center;
            padding: 15px 30px;
        }
        .dashboard-list-box .sform {
            border-radius: 0 0 40px 40px;
            padding-bottom: 15px;
        }

        .dashboard-list-box input {
            margin-bottom: 0px;
        }

    </style>
</head>
<body>
<!-- Wrapper -->
<div id="wrapper" class="mm-page mm-slideout">

 @include('layouts.toppro')
  
 
 @yield('content')
 
    <div id="backtotop"><a href="#"></a></div>
</div>	

@include('layouts.footerv2')
@include('layouts.footerv2-scripts')
</html> 