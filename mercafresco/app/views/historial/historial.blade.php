 
 <div class="container-admin" ng-init='consultarlosultimostres()'>
      <!-- Page Content -->
      <div class="row">
       
        <div class="col-md-9 col-md-offset-2">
          <h2>Historial de Compra</h2>
          <nav class="navbar navbar-default navbar-admin">
            <div class="container-fluid">
              <!-- <ul class="nav navbar-nav">
                <li><a href=""><i class="fa fa-download fa-1x"></i>  Exportar historial</a></li>
                
              </ul>-->
              <div class="header-right">
                <form class="navbar-form navbar-right" role="search">
                  <div class="form-group">                 
                    <!--<select class="form-control" name="anhio" ng-model='filtro.ano' ng-change='consultar_por_mer_ano()'>                      
                      <option value="0">[Año...]</option>
                      <option ng-repeat="n in vectorAnos" value="{{$index+2014}}">{{$index+2014}}</option>
                    </select>-->
                     <select class="form-control" ng-change='consultar()' ng-model='filtro.opcion'>                      
                      <option value="0">[Opciones de busquedas...]</option>
                      <option value="1">Último mes</option>
                      <option value="2">Últimos 3 meses</option>
                      <option value="3">Últimos 6 meses</option>
                      <option ng-repeat="n in vectorAnos" value="{{$index+2014}}">{{$index+2014}}</option>
                      <option value="4">Todas</option>
                    </select>
                  </div>
                  <!--<div class="form-group">
                    <select class="form-control" name="mes" ng-model='filtro.mes' ng-change='consultar_por_mer_ano()'>
                      <option value="0">[Seleccione mes...]</option>
                      <option value="1">Enero</option>
                      <option value="2">Febero</option>
                      <option value="3">Marzo</option>
                      <option value="4">Abril</option>
                      <option value="5">Mayo</option>
                      <option value="6">Junio</option>
                      <option value="7">Julio</option>
                      <option value="8">Agosto</option>
                      <option value="9">Septiembre</option>
                      <option value="10">Octubre</option>
                      <option value="11">Noviembre</option>
                      <option value="12">Diciembre</option>
                    </select>
                  </div>-->
                </form>
              </div>
            </div>
            <!-- /.container-fluid -->
          </nav>
          <div class="row orden" ng-repeat-start='item in OrdenesServicio'>

            <div class="panel panel-default col-md-3 col-xs-5" >
              <div class="panel-heading">
                <h3 class="panel-title">Orden No</h3>
              </div>
              <div class="panel-body">
                <p>{{item.id}}</p>
              </div>
            </div>
            <div class="panel panel-default col-md-4 col-xs-7">
              <div class="panel-heading">
                <h3 class="panel-title">Fecha de la orden</h3>
              </div>
              <div class="panel-body">
                <p>{{item.fecha_orden}}</p>
              </div>
            </div>
            <div class="panel panel-default col-md-2 col-xs-6">
              <div class="panel-heading">
                <h3 class="panel-title">Estado</h3>
              </div>
              <div class="panel-body">
                <p>{{item.estado.toLowerCase().capitalizeFirstLetter() }}</p>
              </div>
            </div>
            <div class="panel panel-default col-md-3 col-xs-6" >
              <div class="panel-heading">
                <h3 class="panel-title">Valor total</h3>
              </div>
              <div class="panel-body">
                <p>{{item.total | currency:'$':0}}</p>
              </div>
            </div>
          </div>

         
          <div class="left-column"  style='width:100%;' ng-repeat-end>
            <table class="table table-bordered" style='background-color:white;'>
              <tbody>
                <tr ng-repeat='obj in item.detalle' class="tr-class-1 ng-scope">
                  <td>                          
                    <img src="{{obj.imagen}}" alt="Generic placeholder image" class="card-item-img">                       
                  </td>
                  <td class="ng-binding">{{obj.producto}}</td>
                  <td class="ng-binding">
                    <a class="btn btn-default " href="" role="button" ng-click='agregarCanasta(obj)'><span class="glyphicon glyphicon-shopping-cart"></span> Agregar</a>
                  </td>
                </tr>                
              </tbody>
            </table>

            <div class="right-column"  >
            <button type="button" class="btn btn-default navbar-right" ng-click='agregarCanastaLista(item)'>Agregar lista</button>
          </div>

          </div>
           
        </div>
      </div>
       @include('layouts.footer')
      <!-- /#page-content-wrapper -->
    </div>