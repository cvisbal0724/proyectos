<div class="col-lg-12">
  <div class="form-panel">
  
 	 <h4 class="mb"><i class="fa fa-angle-right"></i> Registrar entraga al concejal</h4>

      <div class="panel-body">
      	<div class="col-lg-6">

      		<div class="form-group">
                <label>Nombre:</label>
               <span>{{concejalVO.persona.nombre + ' ' + concejalVO.persona.apellido}}</span>
            </div>
            
            <div class="form-group">
                <label>Partido:</label>
               <span>{{concejalVO.partido.nombre}}</span>
            </div>

            <div class="form-group">
                <label>Numero:</label>
               <span>{{concejalVO.numero}}</span>
            </div>
           
 			<div class="form-group">
                <label>Valor:</label>
               <input class="form-control" type="text" ng-model="concejal_entregadoVO.valor" numeric-only>	 
               <p>(*)Ingrese el valor entregado</p>                  
            </div>

             <div class="form-group">
                <label>Observación:</label>
              <textarea class="form-control" rows="5" cols="3" ng-model="concejal_entregadoVO.observacion"></textarea>
            </div>

            <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
             </div>
            
			 <button ng-if='alcaldeVO.id==0' type="button" class="btn btn-warning" ng-click='guardar()'>Registrar</button>  
       <button type="button" class="btn btn-warning" ng-click="registrar_entregas()">Registrar</button>  
       <button type="button" class="btn btn-danger" ng-click='nuevo()'>Limpiar</button>           
      
      </div>


      </div>


 </div>

 

</div>


