<nav class="navbar navbar-default categorias" ng-controller='ConfiguracionController'>
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a ui-sref="productos" class="home-icon"> <span class="glyphicon glyphicon-home"></span></a></li>
            <li><a href="" id="categoria-toggle" ng-click='abrirCategorias()'> Categorías<span class="sr-only">(current)</span></a></li>
           @include('layouts.masInformacion')
          </ul>
          <div class="pull-right">
            <div class="header-basket" id="minicart">
              <a href="" class="top-link-basket" id="menu-toggle" >
              <img src="app_cliente/img/basket450.png" height="35px" width="auto">
                <span class="badge visible-xs-block">{{totalUnidades}}</span>
              <span class="count hidden-xs soy-cliente-nuevo">
              PEDIR {{ totalCanasta | currency:'$':0 }} ({{totalUnidades}})              
              </span>
              </a>                            
            </div>
          </div>
          <div class="pull-right hidden-xs">
            <!--<div class="header-basket" id="minicart">
              <a href="" class="top-link-basket" id="menu-toggle" title="productos guardados">
              <img src="app_cliente/img/basket460.png" height="40px" width="auto">
              </a>                            
            </div>
          </div>-->
        </div>
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