 <div class='login-panel panel panel-default' >
          <div class="panel-heading">
        <h3 class="panel-title">Contra entrega</h3>
      </div>
        <div class='panel-body'>
            <fieldset>
              
               <div class="form-group">
                <label>Pide en linea y paga contra entrega a nuestro mensajero.</label>
                       
               </div>
                   

                <div class="form-group">
                   <input type="button" class="btn btn-danger btn-lg pull-left" value="Comprar" ng-click='crear_ordenservicio()'>
                  </div>              
        </fieldset>
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
            <button type="button" class="btn btn-primary btn-lg pull-left" data-dismiss="modal">Cerrar</button>
          </div>
        </div>       
      </div>      
    </div>
   