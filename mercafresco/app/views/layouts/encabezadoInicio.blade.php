
    <div class="navbar-wrapper nav-principal">
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <a class="navbar-brand" ui-sref="productos"><img  class=" hidden-xs" src="app_cliente/img/logo-a.png"><img class="visible-xs" src="app_cliente/img/logo-phone.png" width="auto" height="80px"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="wrapp" id="">              
              <ul class="nav navbar-top-links pull-right" ng-controller='AppController'>
                <li class="hidden-xs soy-cliente-nuevo"><a ui-sref="registrar" ng-if='!estaLogueado'>Soy Cliente Nuevo</a></li>
                <li class="hidden-xs ya-soy-cliente"><a ui-sref="login" ng-if='!estaLogueado'>Ya Soy Cliente</a></li>                       
                <li class="dropdown" ng-if='estaLogueado'>                
                    <a class="dropdown-toggle" data-toggle="dropdown" href="">
                       <img src="app_cliente/img/sign-in.png" alt="Accounts" height="40px" width="auto"> 
                         <span class="hidden-xs">{{ nombre.toLowerCase().capitalizeFirstLetter() }}</span>                    
                        <i class="fa fa-caret-down"></i>
                    </a>
                    @include('layouts.menu')
                </li> 
              </ul>
              <form class="navbar-form" role="search">
                <div class="input-group">
                <input class="form-control" placeholder="Buscar" name="txtbuscar" id='txtbuscar' 
                ng-model='buscar.criterioBuscar' ng-keyup="$event.keyCode == 13 && buscarProducto()">
                <span class="input-group-btn">
                 <button class="btn btn-default" type="button" ng-click='buscarProducto()'><img src="app_cliente/css/search2.png" width="60%" height="auto" alt="Buscar"></button>
                </span>
              </div><!-- /input-group -->  
              </form>
            </div>
            <!-- /.navbar-collapse -->
          </div>
          <!-- /.container-fluid -->
        </nav>
      </div>