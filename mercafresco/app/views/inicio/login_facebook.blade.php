

  <div class="modal fade bs-example-modal-sm" id="modalRegistrarFacebook" 
  tabindex="-1" role="dialog" ng-init='cargar_datos_facebook()' data-backdrop="static">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" aria-label="Close" ng-click='desloguear_facebook()'><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Cuenta</h4>
          </div>
          <div class="modal-body">
           
            <form role="form" name="myForm">
                <fieldset>
                 
                  
                  <h4 class="text-warning btn-block">Datos de facebook</h4>

                     <div class="col-md-12">
                      <div class="form-group">
                        <label>Correo Electronico</label>
                        <input type="email" name="email" class="form-control" ng-model='cuenta.correo' placeholder="example@example.com" disabled="disabled">
                        <p></p>
                      </div>
                    </div>
                  
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Numero Documento</label>
                        <input class="form-control" ng-model='cuenta.no_identificacion' placeholder='Cedula'>
                        <p>(*) Ingrese su documento de identidad</p>                        
                      </div>
                    </div>
                   
                 
               
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" placeholder="Nombre" ng-model='cuenta.nombres'>
                        <p>(*) Ingrese su nombre</p>                        
                      </div>
                    </div>

                    <!--<div class="col-md-12">
                      <div class="form-group">
                        <label>Apellido</label>
                        <input class="form-control" placeholder="Apellidos" ng-model='cuenta.apellidos'>
                        <p>(*) Ingrese su apellido</p>                        
                      </div>
                    </div>-->
                 
                         
                   <!-- <div class="col-md-12">
                      <div class="form-group">
                        <label>Telefono Movil</label>
                        <input class="form-control" ng-model='cuenta.celular' placeholder='Celular'>
                       
                      </div>
                    </div>-->
                     
                     <div class="col-md-12">
                      <div class="form-group">
                        <label>Teléfono</label>
                        <input class="form-control" placeholder="Telfono" name="email" type="text" autofocus ng-model='cuenta.telefono'>
                        <p>(*) Ingrse un numero de teléfono</p>
                      </div>
                    </div>

                
                                   
                 
                  <div class="col-md-12" ng-show='result.show'>
                    <div  class="alert alert-{{ result.alert }}" role="alert">
                    <button class="close" aria-hidden="true" ng-click='result.show=false' type="button">×</button>
                    <strong>{{result.msg}} </strong>                     
                    </div>
                  </div>
                
                </div>
                </fieldset>

              </form>

        
          <div class="modal-footer">
           <button type="button" class="btn btn-default" ng-click='desloguear_facebook()'>Cerrar</button>
            <button type="button" class="btn btn-default btn-primary" ng-click='crearcuenta_con_facebook_o_google()'>Continuar</button>
          </div>
        </div>       
      </div>      
    </div>    


  

    <script type="text/javascript">

    $(document).ready(function(){

        //$('#modalRegistrarFacebook').modal('show');


    });

    </script>