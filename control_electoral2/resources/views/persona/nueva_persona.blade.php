
 <div class="form-panel">  
  
  <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Agregar nueva persona Persona
   </h4>

       <div class="panel-body">
      	
      		<div class="form-group">
                <label>Cedula</label>
                <input class="form-control" type='text' ng-model='personaVO.cedula'>
                <p class="help-block">(*)Ingrese la cedula</p>
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input class="form-control" type='text' ng-model='personaVO.nombre'>
                <p class="help-block">(*)Ingrese el nombre</p>
            </div>
            <div class="form-group">
                <label>Apellido</label>
                <input class="form-control" type='text' ng-model='personaVO.apellido'>
                <p class="help-block">(*)Ingrese el apellido</p>
            </div>
             <div class="form-group">
                <label>Barrio</label>
                <input class="form-control" type='text' ng-model='personaVO.barrio'>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input class="form-control" type='text' ng-model='personaVO.telefono'>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input class="form-control" type='text' ng-model='personaVO.direccion'>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label>Correo</label>
                <input class="form-control" type='text' ng-model='personaVO.correo'>
                <p class="help-block"></p>
            </div>
            
             <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
             </div>
            
			 <button ng-if='personaVO.id==0' type="button" class="btn btn-warning" ng-click='crear_nueva_persona()'>Registrar</button>  
       <button ng-if='personaVO.id>0' type="button" class="btn btn-warning" ng-click='actualizar_nueva_persona()'>Actualizar</button>  
       <button type="button" class="btn btn-danger" ng-click='nuevo()'>Limpiar</button>           
      
      </div>

 </div>

