<br>
  <div class="container">
         <!-- Page Content -->
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel ">
                    <div class="panel-heading">
                        <h2 class="panel-title text-center">Cambiar Contraseña</h2>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>                               
                               
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="username" type="password" autofocus ng-model='cuenta.clave' ng-keyup="$event.keyCode == 13 && true">
                                </div>
                                <div class="form-group">
                                      <input class="form-control" placeholder="Confirmar Contraseña" name="password" type="password" ng-model='cuenta.conf_clave' ng-keyup="$event.keyCode == 13 && true">
                                </div>

                                 <div class="form-group" ng-show='result.show'>
                                    <div class="alert alert-{{ result.alert }}" role="alert">
                                    <button class="close" aria-hidden="true" ng-click='result.show=false' type="button">×</button>
                                    <strong>{{result.msg}}                               		
                                    <a ng-if='result.alert=="success"' ui-sref='login'> Login</a>
                                    </strong>
                                     <!--<a ng-show='result.alert=="success"' ui-sref="productos" class="alert-link">Ir a Inicio</a>-->
                                    </div>
                                 </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <a href="" class="btn btn-lg btn-success btn-block" ng-click='cambiar_clave()'>Cambiar</a>
                               
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
         <!-- /#page-content-wrapper -->
</div>



 