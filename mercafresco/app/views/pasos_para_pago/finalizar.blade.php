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
               <label>Direccion:</label>
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
               <label>Pedido Numero:</label>
              </td>
              <td>{{OrdenServicio.id}}</td>
            </tr>

              <tr>
              <td>
               <label>Valor:</label>
              </td>
              <td>{{OrdenServicio.total | currency:'$':0}}</td>
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
             <div class="col-md-12"> 
               <a ui-sref="productos" class="btn btn-primary btn-lg pull-left">Ir a Inicio</a>      
             </div>

         </div>

         </div>

      </div>
       @include('layouts.footer')
    </div>
