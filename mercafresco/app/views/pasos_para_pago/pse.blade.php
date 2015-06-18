<div class='panel metodo-vista'>
<div class="panel-heading">
   <h3 class="panel-title">PSE</h3>
</div>
<div class='panel-body'>
   <fieldset>
        <div class="form-group">
            <label>Banco</label>
              <select class="form-control" placeholder="" type="text" ng-model="pago_pse.id_banco">
              <option value="0">[Bancos]</option>
              @foreach($banks as $row)
              <option value="[[$row->pseCode]]">[[$row->description]]</option>
              @endforeach
              </select>
               <p>(*)Seleccione el banco</p>
         </div>

      <div class="form-group">
      <label>Nombre del Comprador</label>
            <input class="form-control" placeholder="" type="text" ng-model="pago_pse.nombre"/>
            <p>(*)Ingrese el nombre del comprador</p>
        </div>

      <div class="form-group">
         <label>Cédula</label>
           <input class="form-control" placeholder="" type="text" ng-model="pago_pse.cedula"/>
           <p>(*)Ingrese la cédula</p>
       </div>

        <div class="form-group">
          <label>Teléfono</label>
            <input class="form-control" placeholder="" type="text" ng-model="pago_pse.telefono"/>
            <p>(*)Ingrese el teléfono</p>
        </div>

   </fieldset>
   <fieldset class="mt-20">
      <div class="form-group">
         <a class="btn btn-primary btn-lg pull-left" ui-sref='tiempos'>Atrás</a>
         <input type="button" class="btn btn-danger btn-lg pull-right" ng-click="pago_con_pse()" value="Comprar">
      </div>
   </fieldset>
</div>
</div>

<div class="modal fade" id="modalMetodoPagoPSE">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Mensaje</h4>
          </div>
          <div class="modal-body">
           <div class="alert alert-warning" role="alert">
           <i class="fa fa-exclamation-triangle fa-4"></i>
            <strong>{{ mensaje }}</strong>
           </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>       
      </div>      
    </div>        
		