<!DOCTYPE html>
<html lang="en" ng-app='App' ng-controller="AppController" style='overflow:auto;'>
   <head>
     <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title></title>
      
      <link href="app_cliente/css/fonts.css" rel="stylesheet"/>
      <link href="app_cliente/css/bootstrap.min.css" rel="stylesheet"/>
      <link href="app_cliente/css/carousel.css" rel="stylesheet"/>
      <link href="app_cliente/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <link href='app_cliente/css/sb-admin-2.css'  rel="stylesheet" type="text/css"></link>
      <link href='app_cliente/css/bootstrap-datetimepicker.min.css' rel="stylesheet" type="text/css"></link>

      <style type="text/css">

      .pop-fondo{
         background:white;
         opacity: 0.5;
         z-index: 10000000;
         left: 0;
         top: 0;
         position: fixed;
         width: 100%;
         height: 100%;
      }

      .pop-imagen{         
         z-index: 10000001;
         left: 0;
         top: 0;
         position: fixed;
         width: 35px;
         height: 35px;
         margin-left: -17.5px;
         margin-top: -17.5px;
         left: 50%;
         top: 50%;
      }

      .background-categorias{
         background-color:black;
         opacity:0.5;
         width:100%;
         height:100%;
         position:fixed;
         left:0;
         top:0;
         display:none;
         z-index:1000;
      }

      </style>

       <!-- jQuery -->
      <script src="app/js/jquery.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="app/js/bootstrap.min.js"></script>
      <script src="app/lib/angular/angular.min.js"></script>   
      <script src="app/lib/angular/angular-ui-router.js"></script>  
      <script src="app/lib/angular/angular-route.min.js"></script>  
      
      <script src="app/lib/angular/angular-sanitize.min.js"></script>    
      <script src="app/controllers/app.js"></script>  

     

      <!-- Menu Toggle Script -->
      

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

   </head> 
<body>
<header class="header-principal">

<ng-include src="'app/views/layouts/encabezadoInicio.html'"></ng-include>

<ng-include ng-if="renderPath[0]=='productos'" src="'app/views/layouts/masInformacion.html?v=1'"></ng-include>

</header>


<div class='secondary-nav visible-xs-block' style="text-align:left;margin-left:30px;">
   <hr>                  
   <a href="" ng-click='backPage()' style='color:#004415'>
      <i class='fa fa-angle-left fa-2x'></i>
   </a>
   <hr>
</div>

<div id="wrapper" ng-if="renderPath[0]=='productos'" class="toggled">
 
 <ng-include src="'app/views/layouts/categorias.html'"></ng-include>  
 
 <ng-view></ng-view>

</div>

<ng-view ng-if="renderPath[0]!='productos'"></ng-view>

      <script src="app/controllers/ProductoProveedor.js?v=1?v=1"></script> 
      <script src="app/controllers/Categoria.js?v=1"></script>       
      <script src="app/controllers/Configuraciones.js?v=1"></script>     
      <script src="app/controllers/Login.js?v=1"></script> 
      <script src="app/controllers/Direcciones.js?v=1"></script>    
      <script src="app/controllers/Tiempos.js?v=1" ng-if="renderPath[0]=='tiempos'"></script>         
      <script src="app/controllers/OrdenServicio.js?v=1"></script> 
      <script src="app/controllers/Finalizar.js?v=1" ng-if="renderPath[0]=='finalizar'"></script>  
      <script src="app/controllers/Cuenta.js?v=1" ng-if="renderPath[0]=='cuenta'"></script>  
      <script src="app/controllers/Historial.js?v=1" ng-if="renderPath[0]=='historial'"></script>  
       <script src="app/controllers/ActivarCuenta.js?v=1" ng-if="renderPath[0]=='activar'"></script>  
      <script src='app/funciones/capitalizeFirstLetter.js?v=1' type="text/javascript"></script>    
    
    

   <div id='loading' loading-indicator>
   
   </div>   

</body>

  <!-- /#wrapper -->
     

</html>