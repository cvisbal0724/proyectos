<section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a ui-sref="home.inicio" class="logo"><b>Inicio</b></a>
            <!--logo end-->
          <?php 
          //@include('layouts.menu-header');
          ?>
            <div class="top-menu">
              <ul class="nav pull-right top-menu">
                    <li><a class="logout" ng-click="desloguear()" href="">Salir</a></li>
              </ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      @include('layouts.menu')
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          <!--<ui-view name="titulo"></ui-view>-->
          <ui-view name="nombre-proyecto"></ui-view>

            <!--<ol class="breadcrumb">
              <li><a href="../home.php"><i class="icon-dashboard"></i> Inicio</a></li>
              <li class="active"><i class="icon-dashboard"></i>Registrar</li>
              <li><a href="consultar.php"><i class="icon-dashboard"></i> Consultar</a></li>              
            </ol>-->

              <div class="row">
                               
                <ui-view name="contenedor"></ui-view>
            
             
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                 <!--Notificaciones--> 
                 <ui-view name="notificaciones"></ui-view>
                 <!--fin Notificaciones--> 
             </div><! --/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              Elecciones - 2015
              <a href="" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

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

    

  <script type="text/javascript">
        //$(document).ready(function () {
        //var unique_id = $.gritter.add({
        //    // (string | mandatory) the heading of the notification
        //    title: 'Welcome to Dashgum!',
        //    // (string | mandatory) the text inside the notification
        //    text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo. Free version for <a href="http://blacktie.co" target="_blank" style="color:#ffd777">BlackTie.co</a>.',
        //    // (string | optional) the image to display on the left
        //    image: 'app_cliente/img/ui-sam.jpg',
        //    // (bool | optional) if you want it to fade out on its own or just sit there
        //    sticky: true,
        //    // (int | optional) the time you want it to be alive for before fading out
        //    time: '',
        //    // (string | optional) the class name you want to apply to that specific message
        //    class_name: 'my-sticky-class'
        //});
//
        //return false;
        //});
  </script>
  
  <script type="application/javascript">
        //$(document).ready(function () {
        //    $("#date-popover").popover({html: true, trigger: "manual"});
        //    $("#date-popover").hide();
        //    $("#date-popover").click(function (e) {
        //        $(this).hide();
        //    });
        //
        //    $("#my-calendar").zabuto_calendar({
        //        action: function () {
        //            return myDateFunction(this.id, false);
        //        },
        //        action_nav: function () {
        //            return myNavFunction(this.id);
        //        },
        //        ajax: {
        //            url: "show_data.php?action=1",
        //            modal: true
        //        },
        //        legend: [
        //            {type: "text", label: "Special event", badge: "00"},
        //            {type: "block", label: "Regular event", }
        //        ]
        //    });
        //});
        //
        //
        //function myNavFunction(id) {
        //    $("#date-popover").hide();
        //    var nav = $("#" + id).data("navigation");
        //    var to = $("#" + id).data("to");
        //    console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        //}
    </script>

    <script type="text/javascript">
     $('.backstretch').remove();
    </script>
    
<!--<script src="app_cliente/js/charts/highcharts.js"></script>
<script src="app_cliente/js/charts/modules/exporting.js"></script> -->

    <!-- Modal -->
            <div class="modal fade" id="modalPersona" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Persona</h4>
                  </div>
                  <div class="modal-body">
                    <ui-view name="persona"></ui-view>
                  </div>
                  <!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>-->
                </div>
              </div>
            </div>        