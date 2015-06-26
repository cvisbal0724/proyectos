<!DOCTYPE html>
<html lang="en" ng-app='App' ng-controller="AppController" style='overflow:auto;'>
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Merca Fresco</title>
      

      [[ HTML::style('app_cliente/css/sb-admin-2.css') ]]
      [[ HTML::style('app_cliente/css/fonts.css') ]]
      [[ HTML::style('app_cliente/css/bootstrap.min.css') ]]
      [[ HTML::style('app_cliente/css/carousel.css?v=2') ]]
      [[ HTML::style('app_cliente/css/font-awesome.min.css') ]]
      [[ HTML::style('app_cliente/css/sb-admin-2.css') ]]
      [[ HTML::style('app_cliente/css/bootstrap-datetimepicker.min.css') ]]
      [[ HTML::style('app_cliente/css/style.css') ]]

      <style type="text/css">

      

      </style>
  
       [[ HTML::script('app_cliente/js/jquery.js') ]]
       [[ HTML::script('app_cliente/js/jquery.js') ]]
       [[ HTML::script('app_cliente/js/bootstrap.min.js') ]]
       [[ HTML::script('app_cliente/lib/angular/angular.min.js') ]]
       [[ HTML::script('app_cliente/lib/angular/angular-ui-router.min.js') ]]
       [[ HTML::script('app_cliente/lib/angular/angular-route.min.js') ]]
       [[ HTML::script('app_cliente/lib/angular/angular-sanitize.min.js') ]]
       [[ HTML::script('app_cliente/controllers/app.js') ]]

      <!-- Menu Toggle Script -->
      

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

   </head> 
<body>

<ui-view name='header'></ui-view>


<ui-view></ui-view>

<ui-view name='contenedor'></ui-view>

      [[ HTML::script("app_cliente/controllers/ProductoProveedor.js?v=1?v=1") ]] 
      [[ HTML::script("app_cliente/controllers/Categoria.js?v=1") ]]       
      [[ HTML::script("app_cliente/controllers/Configuraciones.js?v=1") ]]     
      [[ HTML::script("app_cliente/controllers/Login.js?v=1") ]] 
      [[ HTML::script("app_cliente/controllers/Direcciones.js?v=1") ]]    
      [[ HTML::script("app_cliente/controllers/Tiempos.js?v=1") ]]         
      [[ HTML::script("app_cliente/controllers/OrdenServicio.js?v=1") ]] 
      [[ HTML::script("app_cliente/controllers/Finalizar.js?v=1") ]]  
      [[ HTML::script("app_cliente/controllers/Cuenta.js?v=1") ]]  
      [[ HTML::script("app_cliente/controllers/Historial.js?v=1") ]]  
      [[ HTML::script("app_cliente/controllers/ActivarCuenta.js?v=2") ]]  
      [[ HTML::script("app_cliente/controllers/MasInformacion.js") ]]  
      [[ HTML::script("app_cliente/funciones/capitalizeFirstLetter.js?v=1") ]]

   <div id='loading' loading-indicator>
   
   </div>   

<span id="siteseal">
        <script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=etzfCu8l1WRRWnfSPxh3ICRPGMZElLi5DiH48GH32F7IsYkqzXcuHKMpKRiJ"></script>
 </span>

</body>

  <!-- /#wrapper -->
     

</html>