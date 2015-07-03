<div class='panel metodo-vista' >
<div class="panel-heading">
   <h3 class="panel-title">Contra entrega</h3>
</div>
<div class='panel-body'>
   <p>Pide en linea y paga contra entrega a nuestro mensajero.</p>
   <fieldset class="mt-20">
      <div class="form-group">
         <a class="btn btn-primary btn-lg pull-left" ui-sref='tiempos'>Atrás</a>
         <input type="button" class="btn btn-danger btn-lg pull-right" value="Comprar" ng-click='crear_ordenservicio()'>
      </div>
   </fieldset>
</div>
</div>
<div class="modal fade" id="modalMetodoPagoContEnt">
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
