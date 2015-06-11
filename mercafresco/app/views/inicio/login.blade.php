  <br>
  <div class="container">
         <!-- Page Content -->
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel ">
                    <div class="panel-heading">
                        <h2 class="panel-title text-center">Ingresa a tu cuenta</h2>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <a href='login/loguearporfacebook' class="btn btn-lg btn-primary btn-block"><span class="fa fa-facebook-square"></span> Ingresar con Facebook</a>
                                <!--<a href="login/loguearporgoogle" class="btn btn-lg btn-danger btn-block"><span class="fa  fa-google"></span>       Ingresar con Google</a>-->
                                <p class="text-center btn-block">O si estás registrado</p>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Correo Electrónico" name="username" type="text" autofocus ng-model='loginData.usuario' ng-keyup="$event.keyCode == 13 && loginSubmit()">
                                </div>
                                <div class="form-group">
                                      <input class="form-control" placeholder="Contraseña" name="password" type="password" ng-model='loginData.clave' ng-keyup="$event.keyCode == 13 && loginSubmit()">
                                </div>

                                 <div class="form-group" ng-show='result.show'>
                                    <div class="alert alert-{{ result.alert }}" role="alert">
                                    <button class="close" aria-hidden="true" ng-click='result.show=false' type="button">×</button>
                                    <strong>{{result.msg}} </strong>
                                     <!--<a ng-show='result.alert=="success"' ui-sref="productos" class="alert-link">Ir a Inicio</a>-->
                                    </div>
                                 </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <a href="" class="btn btn-lg btn-success btn-block" ng-click='loginSubmit()'>Entrar</a>
                                <p class="text-center btn-block">¿No tienes Cuenta? <a ui-sref="registrar" role="button">Registrarte</a></p>
                                <p class="text-center btn-block">
                                <a class="" href="" data-toggle="modal" data-target="#modalRecuperarClave" role="button">Recuperar contraseña</a></p>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
         <!-- /#page-content-wrapper -->
</div>



<div id='modalRecuperarClave' class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Recuparar contraseña</h4>
      </div>
        <div class="modal-body">

             <div class="form-group">                    
                 <input class="form-control" placeholder="Correo Electrónico" type="text" autofocus ng-model='correo'>
                 <p>(*) Ingrese su correo electrónico</p>   
             </div>

              <div class="form-group" ng-show='result2.show'>
                 <div class="alert alert-{{ result2.alert }}" role="alert">
                 <button class="close" aria-hidden="true" ng-click='result2.show=false' type="button">×</button>
                 <strong>{{result2.msg}} </strong>                 
                 </div>
              </div>

        </div>
          <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
           <button type="button" class="btn btn-default btn-primary" ng-click='recuperar_clave()'>Recuperar</button>
          </div>
    </div>
  </div>
</div>



