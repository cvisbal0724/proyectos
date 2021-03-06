<!DOCTYPE html>
<html lang="en" ng-app='App'>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="app_cliente/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="app_cliente/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="app_cliente/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="app_cliente/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="app_cliente/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="app_cliente/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="app_cliente/css/treeview.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

     <!-- jQuery -->
    <script src="app_cliente/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="app_cliente/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="app_cliente/bower_components/metisMenu/dist/metisMenu.min.js"></script>

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

</head>

<body>

   <ui-view></ui-view>

   

    <!-- Morris Charts JavaScript 
    <script src="app_cliente/bower_components/raphael/raphael-min.js"></script>
    <script src="app_cliente/bower_components/morrisjs/morris.min.js"></script>
    <script src="app_cliente/js/morris-data.js"></script>-->

    

    <script type="text/javascript" src="app_cliente/lib/angular/angular.min.js"></script>
    <script type="text/javascript" src="app_cliente/lib/angular/angular-ui-router.min.js"></script>
    <script type="text/javascript" src="app_cliente/lib/angular/angular-route.min.js"></script>
    <script type="text/javascript" src="app_cliente/lib/angular/angular-sanitize.min.js"></script>
    <script type="text/javascript" src="app_cliente/lib/angular/angular.treeview.js"></script>
    <script type="text/javascript" src="app_cliente/app.js"></script>
    <script type="text/javascript" src="app_cliente/controles.js"></script>
    <!--<script type="text/javascript" src="app_cliente/run.js"></script>-->
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
