
   <div id="login-page">
     
    <div class="container">
       <form class="form-login">
                <h2 class="form-login-heading">Entrar ahora</h2>
                <div class="login-wrap">
                    <input class="form-control" placeholder="Usuario" type="text" ng-model='loginVO.usuario' autofocus>
                    <br>
                   <input class="form-control" placeholder="Contraseña" name="password" type="password" ng-model='loginVO.clave'
                                    ng-keyup="$event.keyCode == 13 && loguear()">

                    <label class="checkbox">
                        <span class="pull-right">
                            <a data-toggle="modal" href="login.html#myModal"> Recordar Contraseña?</a>
            
                        </span>
                    </label>
                     <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
                    </div>
                     <input id='hd_token' type='hidden' value='<?php echo csrf_token(); ?>'>
                    <a class="btn btn-theme btn-block" href="" ng-click='loguear()'><i class="fa fa-lock"></i> ENTRAR</a>
                    
                    <!--<hr>
                    
                    <div class="login-social-link centered">
                    <p>or you can sign in via your social network</p>
                        <button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
                        <button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
                    </div>
                    <div class="registration">
                        Don't have an account yet?<br/>
                        <a class="" href="#">
                            Create an account
                        </a>
                    </div>-->
        
                </div>
        
                  <!-- Modal -->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title">Recordar Contraseña?</h4>
                              </div>
                              <div class="modal-body">
                                  <p>Enter your e-mail address below to reset your password.</p>
                                  <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
        
                              </div>
                              <div class="modal-footer">
                                  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                  <button class="btn btn-theme" type="button">Submit</button>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- modal -->
        
              </form>       
        </div>
        </div>

   <!-- js placed at the end of the document so the pages load faster -->
    <script src="app_cliente/js/jquery.js"></script>
    <script src="app_cliente/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="app_cliente/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("app_cliente/img/login-bg.jpg", {speed: 500});
    </script> 
