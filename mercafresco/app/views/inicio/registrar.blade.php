 <div class="container">
      <!-- Page Content -->
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="login-panel panel">
            <div class="panel-heading">
              <h2 class=" panel-title  text-center">Crea tu cuenta</h2>
            </div>
            <div class="panel-body">
              <form role="form" name="myForm">
                <fieldset>
                  <div class="row">
                    <div class="col-md-12">
                    <a href='login/loguearporfacebook' class="btn btn-lg btn-primary btn-block">
                    <span class="fa fa-facebook-square"></span> Ingresar con Facebook</a>
                    </div>
                    <!--<div class="col-md-6"><a href="" class="btn btn-lg btn-danger btn-block"><span class="fa  fa-google"></span>       Ingresar con Google</a></div>-->
                  </div>
                  <h4 class="text-center btn-block">Ó regístrate con email</h4>
                  <!--<h4 class="text-warning btn-block">Datos personales</h4>-->

                 
                      <div class="form-group">
                        <label>Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" ng-model='cuenta.correo' placeholder="ejemplo@dominio.com" autofocus>
                        <p>(*) Ingrese su correo</p> 

                      </div>
                   
                      <div class="form-group">
                        <label>Número Documento</label>
                        <input class="form-control" ng-model='cuenta.no_identificacion'>
                        <p>(*) Ingrese su documento de identidad</p>                        
                      </div>
                   
                 
                
                      <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" placeholder="Nombre" ng-model='cuenta.nombres'>
                        <p>(*) Ingrese su nombre</p>                        
                      </div>
                   
                      <!-- <div class="form-group">
                        <label>Apellido</label>
                        <input class="form-control" placeholder="Apellidos" ng-model='cuenta.apellidos'>
                        <p>(*) Ingrese su apellido</p>                        
                      </div>
                  

                 
                     <div class="form-group">
                        <label>Telefono Movil</label>
                        <input class="form-control" ng-model='cuenta.celular'>
                        <p>(*) Ingrese un numero de celular</p>                        
                      </div>-->
                   
                      <div class="form-group">
                        <label>Teléfono</label>
                        <input class="form-control" placeholder="" name="email" type="text" ng-model='cuenta.telefono'>
                        <p>(*) Ingrese un numero de telefono</p>                        
                      </div>
                  
                                   
                
                      <div class="form-group">
                        <label>Contraseña</label>
                        <input type='password' class="form-control" ng-model='cuenta.clave'>
                        <p>(*) Ingrese la contraseña</p>                        
                      </div>
                  
                      <div class="form-group">
                        <label>Valida Contraseña</label>
                        <input type='password' class="form-control" ng-model='cuenta.conf_clave' >
                        <p>(*) Confirme su contraseña</p>                        
                      </div>
                   

                  <div class="col-md-12" ng-show='result.show'>
                    <div  class="alert alert-{{ result.alert }}" role="alert">
                    <button class="close" aria-hidden="true" ng-click='result.show=false' type="button">×</button>
                    <strong>{{result.msg}} </strong>                                 
                    </div>
                  </div>

                 
                  <hr>
                  <div class="row">
                    <div class="col-md-12"><a href="" class="btn btn-lg btn-success btn-block" ng-click='crearcuenta()'>Registrarse</a></div>                    
                  </div>
                    <br>
                   <div class="row">                    
                    <div class="col-md-12"><a class="btn btn-default btn-lg btn-block" ui-sref="login" role="button">Ya tengo Cuenta</a></div>
                  </div>

                </fieldset>

              </form>
            </div>
          </div>
        </div>
      </div>
       <!--<ng-include src="'app/views/layouts/footer.html'"></ng-include>-->
      </div>

<div class="modal fade" id="modalRegistrar" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <a ng-if='result2.openHome' class="close" ui-sref="login"><span aria-hidden="true">&times;</span></a> 
            <button ng-if='!result2.openHome' type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Cuenta</h4>
          </div>
          <div class="modal-body">
           
             <div class="alert alert-{{ result2.alert }}" role="alert">
                   
                    <strong>{{ result2.msg }}</strong>
                                
             </div>

          </div>
          <div class="modal-footer">
            <a ng-if='result2.openHome' class="btn btn-default" ui-sref="login">Cerrar</a> 
            <button ng-if='!result2.openHome' type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
          </div>
        </div>       
      </div>      
    </div>

      <script src="app_cliente/js/min/moment.min.js"></script>
 <script src="app_cliente/js/locale/es.js"></script>
 <script src="app_cliente/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
     $(function () {
     $('#datetimepicker1').datetimepicker({
         locale: 'es',
         format: 'DD-MM-YYYY'
     });

     $("#datetimepicker1").on("dp.change",function (e) {
     //$('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
     });

    });
</script>