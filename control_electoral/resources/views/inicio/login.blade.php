<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" type="text" ng-model='loginVO.usuario' autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Clave" name="password" type="password" ng-model='loginVO.clave'>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input id='hd_token' type='hidden' value='[[csrf_token()]]'>
                                <a href="" class="btn btn-lg btn-success btn-block" ng-click='loguear()'>Entrar</a>
                            </fieldset>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>