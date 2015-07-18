 <!-- Modal codigo promocional -->
    <div class="modal fade bs-example-modal-sm" id="cupon" tabindex="-1" role="dialog" 
    aria-labelledby="myModalLabel" aria-hidden="true" data-target=".bs-example-modal-sm"
    ng-if='estaLogueado' ng-controller='OrdenServicioController'>
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">¿Tienes un cupón?</h4>
          </div>
          <div class="modal-body">
               
                  <div class="form-group">
                    <input id="txtcupon2" type="text" class="form-control" 
                    placeholder="Ingresa tu cupon aquí" ng-model='codigo' autofocus>
                  </div>                  
                  
                   
                   <div class="form-group" ng-show='result.show'>
                     <div class="alert alert-{{result.alert}}" role="alert">
                     <button class="close" aria-hidden="true" ng-click='result.show=false' type="button">×</button>
                     <strong>{{result.msg}} </strong>                 
                   </div>
                   </div>
                            
          </div>
           <div class="modal-footer">
                <button type="submit" class="btn btn-success" ng-click='guardar_bono()'>Aplicar</button>
          </div>
        </div>
      </div>
    </div>


    <script type="text/javascript">

function abrirModal(){
     
     $('#cupon').modal('show');
     $('#txtcupon2').focus();

}

 </script>
