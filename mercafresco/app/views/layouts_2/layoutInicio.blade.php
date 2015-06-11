<!DOCTYPE html>
<html lang="en" ng-app='App'>
   <head>
     <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title></title>
      
      @include('layouts_2.style')
      @include('layouts_2.script')
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

   </head>
   <body>
 
    @include('layouts_2.encabezadoInicio')

<!-- categorias -->
      @include('layouts_2.masInformacion')
      <div id="wrapper" ng-controller='ProductoProveedorController'>
         <!-- Sidebar -->
         @include('layouts_2.categorias')

         @include('layouts_2.canasta')
         <!-- /#sidebar-wrapper -->
         <!-- Page Content -->
         <div id="page-content-wrapper">
            @yield('content')
         </div>
         <!-- /#page-content-wrapper -->
      </div>
      <!-- Modal -->
      @include('layouts_2.modalProductos')
      <!-- /#wrapper -->
      <!-- jQuery --> 
      
 <script>
         $("#menu-toggle").click(function(e) {
             e.preventDefault();
             $("#wrapper").toggleClass("toggled");
         });
         $("#menu-toggle2").click(function(e) {
             e.preventDefault();
             $("#wrapper").toggleClass("toggled");
         });
         $("#categoria-toggle").click(function(e) {
             e.preventDefault();
             $("#sidebar-wrapper-categorias").toggleClass("show");
         });

         String.prototype.capitalizeFirstLetter = function() {
             return this.charAt(0).toUpperCase() + this.slice(1);
         }
         
      </script>
   </body>
   </html>