<!DOCTYPE html>
<html lang="en" ng-app='App'>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <meta name="_token" content="[[csrf_token()]]">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap core CSS -->
    <link href="app_cliente/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="app_cliente/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="app_cliente/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="app_cliente/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="app_cliente/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="app_cliente/css/style.css" rel="stylesheet">
    <link href="app_cliente/css/style-responsive.css" rel="stylesheet">

    <script src="app_cliente/js/chart-master/Chart.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="app_cliente/css/treeview.css" rel="stylesheet">


    <style type="text/css">

    .center{
        text-align: center;
    }

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


    </style>

    <script src="app_cliente/js/jquery.js"></script>
    <script src="app_cliente/js/jquery-1.8.3.min.js"></script>
    <script src="app_cliente/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="app_cliente/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="app_cliente/js/jquery.scrollTo.min.js"></script>
    <script src="app_cliente/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="app_cliente/js/jquery.sparkline.js"></script>

      <!--common script for all pages-->
    <script src="app_cliente/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="app_cliente/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="app_cliente/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="app_cliente/js/sparkline-chart.js"></script>    
    <script src="app_cliente/js/zabuto_calendar.js"></script>    

</head>

<body>

   <ui-view></ui-view>

   

       

    <script type="text/javascript" src="app_cliente/lib/angular/angular.min.js"></script>
    <script type="text/javascript" src="app_cliente/lib/angular/angular-ui-router.min.js"></script>
    <script type="text/javascript" src="app_cliente/lib/angular/angular-route.min.js"></script>
    <script type="text/javascript" src="app_cliente/lib/angular/angular-sanitize.min.js"></script>
    <script type="text/javascript" src="app_cliente/lib/angular/angular.treeview.js"></script>
    <script type="text/javascript" src="app_cliente/app.js"></script>
    <script type="text/javascript" src="app_cliente/controles.js"></script>
    <!--<script type="text/javascript" src="app_cliente/run.js"></script>-->
    <script type="text/javascript" src="app_cliente/controllers/Home.js"></script>
    <script type="text/javascript" src="app_cliente/controllers/Login.js"></script>
    <script type="text/javascript" src="app_cliente/controllers/Partido.js"></script>
    <script type="text/javascript" src="app_cliente/controllers/Alcalde.js"></script>
    <script type="text/javascript" src="app_cliente/controllers/Persona.js"></script>
    <script type="text/javascript" src="app_cliente/controllers/Perfiles.js"></script>
    <script type="text/javascript" src="app_cliente/controllers/Modulos.js"></script>
    <script type="text/javascript" src="app_cliente/controllers/Menu.js"></script>
    <script type="text/javascript" src="app_cliente/controllers/Usuario.js"></script>
    <script type="text/javascript" src="app_cliente/controllers/Concejal.js"></script>
    <script type="text/javascript" src="app_cliente/controllers/Lider.js"></script>
    <script type="text/javascript" src="app_cliente/controllers/Votante.js"></script>

 <div id='loading' loading-indicator>
   
   </div>   



</body>

</html>
