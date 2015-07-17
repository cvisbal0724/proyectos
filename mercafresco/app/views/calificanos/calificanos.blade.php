<div class="container" ng-init="obtener_por_codigo()">
      <div class="row">
      <div class="panel-body">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2>Calificar compra</h2>
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
                    <h3 class="panel-title">Calificar compra</h3>
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

   
