 <div class="container">
      <div class="row">
        
         <div class="col-md-6 col-md-offset-3">
         <div class='panel-body'>
           
           <h3 class="text-center btn-block">PEDIDO REALIZADO CORRECTAMENTE!!!</h3>
           <br>           
           <h4 class="text-center btn-block">Te hemos enviado un email a {{ OrdenServicio.email }} Con los detalles de tu pedido</h4>
           <br>
            <table class="table table-hover">

            <tr>
              <td>
               <label>Cliente:</label>
              </td>
              <td>{{OrdenServicio.cliente}}</td>
            </tr>

             <tr>
              <td>
               <label>Celular:</label>
              </td>
              <td>{{OrdenServicio.celular}}</td>
            </tr>

            <tr>
              <td>
               <label>Dirección:</label>
              </td>
              <td>{{OrdenServicio.direccion}}</td>
            </tr>

             <tr>
              <td>
               <label>Barrio:</label>
              </td>
              <td>{{OrdenServicio.barrio}}</td>
            </tr>

             <tr>
              <td>
               <label>Pedido Número:</label>
              </td>
              <td>{{OrdenServicio.id}}</td>
            </tr>

            <tr ng-if="OrdenServicio.convenio > 0 || OrdenServicio.descuentobono > 0">
              <td>
              <label>Sub Total:</label>
              </td>
              <td>{{OrdenServicio.total | currency:'$':0}}</td>
            </tr>

            <tr ng-if="OrdenServicio.convenio > 0">
              <td>
              <label>Descuento por convenio:</label>
              </td>
              <td>{{OrdenServicio.convenio | currency:'$':0}}</td>
            </tr>

             <tr ng-if="OrdenServicio.descuentobono > 0">
              <td>
              <label>Descuento por cupón:</label>
              </td>
              <td>{{OrdenServicio.descuentobono | currency:'$':0}}</td>
            </tr>

              <tr>
              <td>
              <label>Total a pagar:</label>
              </td>
              <td>{{(OrdenServicio.total - (OrdenServicio.convenio + OrdenServicio.descuentobono)) | currency:'$':0}}</td>
            </tr>


            <tr>
              <td>
                 <label>Fecha y Hora de entrega:</label>
              </td>
              <td>{{OrdenServicio.dia + ' / ' + OrdenServicio.hora}}</td>
            </tr>

             <tr>
              <td>
                 <label>Forma de pago:</label>
              </td>
              <td>{{OrdenServicio.formapago}}</td>
            </tr> 
                 
            </table>   
             <div class="panel-body"> 
               <a ui-sref="productos" class="btn btn-primary btn-lg pull-left">Ir a Inicio</a>    
                <a ng-click="enviar_correo()" class="btn btn-success btn-lg pull-right">
                <!--<i class="fa fa-print fa-5x"></i>-->
                Enviar al correo
                </a>  

              </div>
             
               <div class="panel-body" ng-show='result.show'>
                 <div class="alert alert-{{ result.alert }}" role="alert">
                 <button class="close" aria-hidden="true" ng-click='result.show=false' type="button">×</button>
                 <strong>{{result.msg}} </strong>                 
                 </div>
              </div>
           


         </div>

         </div>

      </div>
       @include('layouts.footer')
    </div>

