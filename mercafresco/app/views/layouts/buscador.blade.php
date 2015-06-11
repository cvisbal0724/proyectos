 <form class="navbar-form pull-right" role="search">
                <div class="input-group">
                <input class="form-control" placeholder="Buscar" name="txtbuscar" id='txtbuscar' 
                ng-model='buscar.criterioBuscar' ng-keyup="$event.keyCode == 13 && buscarProducto()">
                <span class="input-group-btn">
                 <button class="btn btn-default" type="button" ng-click='buscarProducto()'><img src="app_cliente/img/search2.png" alt="Accounts"></button>
                </span>
              </div><!-- /input-group -->  
              </form>