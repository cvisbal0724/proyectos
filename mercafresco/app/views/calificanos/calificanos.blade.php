<style type="text/css">
  
  .resaltar{
     font-weight: bold;
  }

</style>
<div class="container" ng-init="obtener_por_codigo()">
      <div class="row">
      <div class="panel-body">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2>Califica tu compra</h2>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
             
              <div class="row">
               
               <div class="col-lg-12">
                 
                 <div class="col-lg-6">
                  <div class="login-panel panel panel-default">
                   <div class="panel-heading">
                    <h3 class="panel-title">Información del pedido</h3>
                  </div>
                  <div class="panel-body">
                   <div class="form-group">
                     <label>No. Orden: </label>
                     <span>{{ordenServicio.id}}</span>
                   </div>

                   <div class="form-group">
                     <label>Estado de entrega: </label>
                     <span>{{ordenServicio.estado}}</span>
                   </div>

                   <div class="form-group">
                     <label>Dirección de entrega: </label>
                     <span>{{ordenServicio.direccion}}</span>
                   </div>

                   <div class="form-group">
                     <label>Fecha de compra: </label>
                     <span>{{ordenServicio.fecha_compra}}</span>
                   </div>

                   <div class="form-group">
                     <label>Fecha entrega: </label>
                     <span>{{ordenServicio.fecha_entrega}}</span>
                   </div>
                  </div>
                 </div> 
                 </div>

                 <div class="col-lg-6">
                   
  <div class="login-panel panel panel-default">
                   <div class="panel-heading">
                    <h3 class="panel-title">Califica tu compra</h3>
                  </div>
                  <div class="panel-body">

                    <div class="panel-body">
                       <div class="radio radio-success" style="text-align:left;">
                          <input id="radio40" type="radio" name="radio2" ng-model="calificar.puntuacion" value="4">
                          <label for="radio40" >Excelente</label>
                      </div>   
                       <div class="radio radio-success" style="text-align:left;">
                          <input id="radio41" type="radio" name="radio2" ng-model="calificar.puntuacion" value="3">
                          <label for="radio41" >Bueno</label>
                      </div>   
                      <div class="radio radio-success" style="text-align:left;">
                          <input id="radio42" type="radio" name="radio2" ng-model="calificar.puntuacion" value="2">
                          <label for="radio42" >Regular</label>
                      </div>   
                      <div class="radio radio-success" style="text-align:left;">
                          <input id="radio43" type="radio" name="radio2" ng-model="calificar.puntuacion" value="1">
                          <label for="radio43" >Malo</label>
                      </div>   
                                                                                      
                  </div>

                  <div class="form-group">
                    
                    <label>Comentario</label>
                    <textarea rows="5" class="form-control" ng-model="calificar.comentario"></textarea>

                  </div>

                  <div class="form-group" ng-show='result.show'>
                      <div class="alert alert-{{ result.alert }}" role="alert">
                      <button class="close" aria-hidden="true" ng-click='result.show=false' type="button">×</button>
                      <strong>{{result.msg}} </strong>
                       <!--<a ng-show='result.alert=="success"' ui-sref="productos" class="alert-link">Ir a Inicio</a>-->
                      </div>
                   </div>

                  <a class="btn btn-danger btn-lg pull-rigth" ng-click="guardar()">Calificar</a>

                  

                 </div>

               </div>
              </div>

              <div class="col-lg-12">
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Orden No.</th>
                    <th class="hidden-xs">Fecha Entrega</th>
                    <th>Producto</th>
                    <th class="hidden-xs">Unidades</th>
                    <th class="hidden-xs">Proveedor</th>
                    <th>Cantidad</th>
                    <th>Valor</th>                    
                  </tr>                    
                  </thead>  
                  <tbody>
                    <tr ng-repeat="item in ordenServicio.detalle">                      
                     <td>{{item.id_orden_servicio}}</td>
                     <td class="hidden-xs">{{item.fecha}}</td>
                     <td>{{item.producto}}</td>
                     <td class="hidden-xs">{{item.unidades}}</td>
                     <td class="hidden-xs">{{item.proveedor}}</td>
                     <td>{{item.cantidad}}</td>
                     <td>{{item.valor}}</td>
                     <!--<td>total</td>
                     <td>convenio</td>
                     <td>descuentobono</td>-->
                    </tr>
                  </tbody> 
                  <tfoot>
                    <tr>
                      <td colspan="5" class="hidden-xs"></td>
                      <td colspan="2" class="visible-xs"></td>
                      <td class="resaltar">Sub Total</td>
                      <td class="resaltar">{{ ordenServicio.total | currency:'$':0}}</td>
                    </tr>
                    <tr>
                       <td colspan="5" class="hidden-xs"></td>
                      <td colspan="2" class="visible-xs"></td>
                      <td class="resaltar">Valor del domicilio</td>
                      <td class="resaltar">{{ordenServicio.domicilio | currency:'$':0}}</td>
                    </tr>
                    <tr ng-if="ordenServicio.convenio > 0">
                       <td colspan="5" class="hidden-xs"></td>
                      <td colspan="2" class="visible-xs"></td>
                      <td class="resaltar">Descuento por convenio</td>
                      <td class="resaltar">{{ordenServicio.convenio | currency:'$':0}}</td>
                    </tr>
                    <tr ng-if="ordenServicio.descuentobono > 0">
                       <td colspan="5" class="hidden-xs"></td>
                      <td colspan="2" class="visible-xs"></td>
                      <td class="resaltar">Descuento por cupon</td>
                      <td class="resaltar">{{ordenServicio.descuentobono | currency:'$':0}}</td>
                    </tr>
                     <tr>
                       <td colspan="5" class="hidden-xs"></td>
                      <td colspan="2" class="visible-xs"></td>
                      <td class="resaltar">Valor pagado</td>
                      <td class="resaltar">{{(ordenServicio.convenio + ordenServicio.total) - (ordenServicio.convenio + ordenServicio.descuentobono) | currency:'$':0}}</td>
                    </tr>
                  </tfoot>               
                </table>
              </div>
              </div>
              </div>
              <!-- /.row -->
              <hr>
              <p>
              <!--<a class="btn btn-primary btn-lg pull-left" ui-sref='productos'>Inicio</a>-->
                
              </p>
            </div>
          </div>
          <!-- /.panel-body -->
        </div>
        </div>
        <!-- /.panel -->
      </div>
      </div>
        @include('layouts.footer')
    </div>

   
