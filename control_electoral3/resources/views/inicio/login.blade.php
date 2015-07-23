

 <div class="login-box">
      <div class="login-logo">
        <a href=""><b>Control</b>LTE</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Usuario" ng-model='loginVO.usuario'
            ng-keyup="$event.keyCode == 13 && loguear()"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" ng-model='loginVO.clave'
            ng-keyup="$event.keyCode == 13 && loguear()"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <input type="hidden" id="hd_token" value="[[csrf_token()]]">
          </div>
         <div class="row">
           <!-- <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>                        
            </div>-->
            <div class="col-xs-4">
              <a href="" class="btn btn-primary btn-block btn-flat" ng-click="loguear()">Entrar</a>
            </div>                   

          </div>

                  <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
                    </div>

        </form>

      <!--  <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div>--><!-- /.social-auth-links -->

      <!--  <a href="">I forgot my password</a><br>
        <a href="" class="text-center">Register a new membership</a>-->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    

    <script>
      /*$(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });*/
    </script>