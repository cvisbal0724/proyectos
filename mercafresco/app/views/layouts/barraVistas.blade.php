<nav class="navbar navbar-default categorias" ng-controller='ConfiguracionController'>
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a ui-sref="productos" class="home-icon"> <span class="glyphicon glyphicon-home"></span></a></li>
            
           @include('layouts.masInformacion')
          </ul>
         
        <!-- /.container-fluid -->
        
      </div>

        <script type="text/javascript">

          $("#menu-toggle").click(function(e) {
                 e.preventDefault();
                 $("#wrapper").toggleClass("toggled");
                });

            /* $("#categoria-toggle").click(function(e) {
                 e.preventDefault();
                 $("#sidebar-wrapper-categorias").toggleClass("show");
             });*/
             
        </script> 

      </nav>