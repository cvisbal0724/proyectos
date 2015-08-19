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
       <button type="button" class="btn btn-warning" ng-click="guardar_entregas()">{{ concejal_entregadoVO.id >0 ? 'Actualizar' : 'Registrar'}}</button>  
       <button type="button" class="btn btn-danger" ng-click='nueva_entrega()'>Limpiar</button>           
      
      </div>

           <div class="col-lg-6" ng-init="obtener_entregas()">
   <div class="panel panel-default">
       <div class="panel-heading">
           Lista
       </div>

        <div class="panel-body">
         <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" >
           <thead>
               <tr>
                   <th>Concejal</th>
                   <th>Observación</th>
                   <th>Valor</th>  
                   <th colspan="2">Opciones</th>                    
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in listaEntregas'>
               <td>{{item.concejal.persona.nombre + ' ' + item.concejal.persona.apellido}}</td>
               <td>
                 {{item.observacion}}
               </td>
               <td>{{item.valor | currency:'$':0 }}</td>
               <td>
                 <a href="" ng-click='obtener_entregas_por_codigo(item)'>
                   <i class='fa fa-pencil fa-2x'></i>
                 </a>
               </td>
               <td>
                 <a href="" ng-click="eliminar_entrega(item)">
                   <i class='fa fa-trash fa-2x'></i>
                 </a>
               </td>
             </tr>
           </tbody>
           <tfoot>
             <tr>
               <th colspan="2" style="text-align:right;">
                 Total:
               </th>
               <th>
                 {{(listaEntregas | sumByKey:'valor') | currency:'$':0}}
               </th>
               <th colspan="2"></th>
             </tr>
           </tfoot>
         </table>
         </div>
         </div>

   </div>
</div>


      </div>


 </div>

 

</div>


