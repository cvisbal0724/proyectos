           
              Información de su pedido
               <br>
               <br>
               No. Orden: [[$id]]         
           
              
               <br>
               Cliente: [[$cliente]]         
           
              
               <br>
               Celular: [[$celular]]                 
              
               <br>
               Telefono: [[$telefono]] 
              
               <br>
               Forma de pago: [[$formapago]]                 
              
               <br>
               Fecha y hora de envio: [[$hora_envio]] / [[$fecha_envio]] 
              
               <br>
               Barrio: [[$barrio]]                
              
               <br>
               Dirección: [[$direccion]]                
              
                <br>
                Recibe: [[$recibe]]                
              
               <br>
               Cantidad de productos: [[$productos]]                
              

              <?php if ($convenio > 0 || $descuentobono > 0): ?>           
              
                  <br>
                  Sub Total: $[[ number_format($total)]]            
              <?php endif ?>


                <br>
                Valor del domicilio: $[[number_format($domicilio)]]            
                          
           
            <?php if ($convenio > 0): ?>           
              
                <br>
                Descuento por convenio: $[[number_format($convenio)]]            
            <?php endif ?>


            <?php if ($descuentobono > 0): ?>            
              
                <br>
                Descuento por cupon: $[[number_format($descuentobono)]]            
            <?php endif ?>
           
                <br>
                Total a pagar: $[[number_format($total - ($convenio + $descuentobono))]]           
           