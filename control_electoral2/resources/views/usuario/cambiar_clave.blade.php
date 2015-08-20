<div class="col-lg-12">
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Cambiar contraseña
   </h4>

       <div class="panel-body">
      	<div class="col-lg-6">

      		 <div class="form-group">
                <label>Contraseña Actual</label>
                <input class="form-control" type='password' ng-model='cambiar_claveVO.clave_actual'>
                <p class="help-block">(*)Ingrese su contraseña actual</p>
            </div>
            <div class="form-group">
                <label>NUeva Contraseña</label>
                <input class="form-control" type='password' ng-model='cambiar_claveVO.clave_nueva'>
                <p class="help-block">(*)Ingrese su nueva contraseña</p>
            </div>
            <div class="form-group">
                <label>Confirmar Contraseña</label>
                <input class="form-control" type='password' ng-model='cambiar_claveVO.confirmar'>
                <p class="help-block">(*)Confirme su contraseña</p>
            </div>
                        
             <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
             </div>
            
			 <button type="button" class="btn btn-warning" ng-click='cambiar_clave()'>Cambiar</button>         
       <button type="button" class="btn btn-danger" ng-click='nuevo()'>Limpiar</button>           

      	</div>
      </div>

 </div>
</div>
