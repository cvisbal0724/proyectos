@extends('layouts_2.layoutVistas')

@section('content')

 <div class="container">
      <div class="row">
        
         <div class="col-md-6 col-md-offset-3">
         <div class='panel-body'>
           
           <h3 class="text-center btn-block">Estimado cliente, Gracias por su compra y por confiar en nosotros</h3>
           <br>
           <br>
           <h4 class="text-center btn-block">Información del su pedido</h4>
           <br>
            <div class="table-responsive">
            <table class="table table-hover">
            <tr>
              <td>
               <label>No. Orden:</label>
              </td>
              <td>[[$id]]</td>
            </tr> 
            <tr>
              <td>
               <label>Cliente:</label>
              </td>
              <td>[[$cliente]]</td>
            </tr> 
            <tr>
              <td>
               <label>Celular:</label>
              </td>
              <td>[[$celular]]</td>
            </tr>
             <tr>
              <td>
               <label>Telefono:</label>
              </td>
              <td>[[$telefono]]</td>
            </tr>               

             <tr>
              <td>
               <label>Forma de pago:</label>
              </td>
              <td>[[$formapago]]</td>
            </tr>

            <tr>
              <td>
               <label>Fecha de pago:</label>
              </td>
              <td>[[$fechapago]]</td>
            </tr>            
            <tr>
              <td>
               <label>Barrio:</label>
              </td>
              <td>[[$barrio]]</td>
            </tr>
            <tr>
              <td>
               <label>Dirección:</label>
              </td>
              <td>[[$direccion]]</td>
            </tr>
            <tr>
              <td>
                <label>Recibe:</label>
              </td>
              <td>[[$recibe]]</td>
            </tr>
            <tr>
              <td>
               <label>Cantidad de productos:</label>
              </td>
              <td>[[$productos]]</td>
            </tr>
            <tr>
              <td>
                <label>Valor del domicilio:</label>
              </td>
              <td>$[[$domicilio]]</td>
            </tr>    
            <tr>
              <td>
                <label>Valor a pagar:</label>
              </td>
              <td>$[[$total]]</td>
            </tr> 
           
            <?php if ($convenio > 0): ?>
             <tr>
              <td>
                <label>Descuento por convenio:</label>
              </td>
              <td>$[[$convenio]]</td>
            </tr>    
            <?php endif ?>
           
            <?php if ($convenio > 0): ?>
               <tr>
              <td>
                <label>Total a pagar:</label>
              </td>
              <td>$[[$total - $convenio]]</td>
            </tr>   
            <?php endif ?>
                   
            </table>   
          </div>
         </div>

            <br>
            <div>
              <p>
                Cordialmente,
              </p>
              <br>
              <label>
                <a href="http://mercafresco.co/">Merca Fresco</a>
              </label>
            </div>

         </div>

      </div>
      
    </div>

@stop