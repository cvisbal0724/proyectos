<!DOCTYPE html>
<html lang="en" ng-app='App'>
   <head>
     <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title></title>
      
      [[ HTML::style('app_cliente/css/sb-admin-2.css') ]]
      [[ HTML::style('app_cliente/css/fonts.css') ]]
      [[ HTML::style('app_cliente/css/bootstrap.min.css') ]]
      [[ HTML::style('app_cliente/css/carousel.css') ]]
      [[ HTML::style('app_cliente/css/font-awesome.min.css') ]]
      [[ HTML::style('app_cliente/css/sb-admin-2.css') ]]
      [[ HTML::style('app_cliente/css/bootstrap-datetimepicker.min.css') ]]

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

       [[ HTML::script('app_cliente/js/jquery.js') ]]
       [[ HTML::script('app_cliente/js/jquery.js') ]]
       [[ HTML::script('app_cliente/js/bootstrap.min.js') ]]
       [[ HTML::script('app_cliente/lib/angular/angular.min.js') ]]
       [[ HTML::script('app_cliente/lib/angular/angular-ui-router.min.js') ]]
       [[ HTML::script('app_cliente/lib/angular/angular-route.min.js') ]]
       [[ HTML::script('app_cliente/lib/angular/angular-sanitize.min.js') ]]
       [[ HTML::script('app_cliente/controllers/app.js') ]]
       
   </head>
   <body>
 
    @include('layouts.encabezadoVistas')

<!-- categorias -->
        
        
         <!-- Page Content -->
        
            @yield('content')
        
         <!-- /#page-content-wrapper -->
      </div>
     
      

   </body>
   </html>