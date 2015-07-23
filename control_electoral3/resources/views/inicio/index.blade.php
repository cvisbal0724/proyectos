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
    
    <!--external css-->
    <link href="app_cliente/font-awesome/css/font-awesome.css" rel="stylesheet" />
    
    <!-- Bootstrap 3.3.4 -->
    <link href="app_cliente/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="app_cliente/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="app_cliente/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="app_cliente/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="app_cliente/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="app_cliente/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="app_cliente/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="app_cliente/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="app_cliente/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <link href="app_cliente/css/treeview.css" rel="stylesheet">
    <link rel="stylesheet" href="app_cliente/css/sweetalert.css">

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

   
     <!-- This is what you need -->



</head>

<body class="login-page">

   <ui-view></ui-view>

   
    <!-- jQuery 2.1.4 -->
    <script src="app_cliente/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>


    <!-- Bootstrap 3.3.2 JS -->
    <script src="app_cliente/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
     
    <!-- Sparkline -->
    <script src="app_cliente/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="app_cliente/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="app_cliente/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="app_cliente/plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="app_cliente/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="app_cliente/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="app_cliente/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="app_cliente/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='app_cliente/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="app_cliente/dist/js/app.min.js" type="text/javascript"></script>    
    
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="app_cliente/dist/js/pages/dashboard.js" type="text/javascript"></script>    
    
    <!-- AdminLTE for demo purposes -->
    <script src="app_cliente/dist/js/demo.js" type="text/javascript"></script>

   <script src="app_cliente/plugins/iCheck/icheck.min.js" type="text/javascript"></script>


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
  
    <!-- <script type="text/javascript" src="app_cliente/controllers/Graficos.js"></script>-->

   
 <div id='loading' loading-indicator>
   
   </div>   



</body>

</html>
