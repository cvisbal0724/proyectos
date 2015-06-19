           
              
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
               Fecha de pago: [[$fechapago]] 
              
               <br>
               Barrio: [[$barrio]]                
              
               <br>
               Dirección: [[$direccion]]                
              
                <br>
                Recibe: [[$recibe]]                
              
               <br>
               Cantidad de productos: [[$productos]]                
              
                <br>
                Valor del domicilio: $[[$domicilio]]            
           
              
                <br>
                Valor a pagar: $[[$total]]         
           
            <?php if ($convenio > 0): ?>           
              
                <br>
                Descuento por convenio: $[[$convenio]]            
            <?php endif ?>


            <?php if ($descuentobono > 0): ?>            
              
                <br>
                Descuento por cupon: $[[$descuentobono]]            
            <?php endif ?>

           
            <?php if ($convenio > 0): ?>              
              
                <br>
                Total a pagar: $[[$total - $convenio]]           
            <?php endif ?>