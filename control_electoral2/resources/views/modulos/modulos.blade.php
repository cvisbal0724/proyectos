<div class="col-lg-12">
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Registrar Modulo
   </h4>

      <div class="panel-body">
      	<div class="col-lg-6">

      		<div class="form-group">
                <label>Nombre del modulo</label>
                <input class="form-control" type='text' ng-model='modulosVO.nombre'>
                <p class="help-block">(*)Ingrese el perfil</p>
            </div>
            
            <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
             </div>
            
			 <button ng-if='modulosVO.id==0' type="button" class="btn btn-warning" ng-click='guardar()'>Registrar</button>  
       <button ng-if='modulosVO.id>0' type="button" class="btn btn-warning" ng-click='guardar()'>Actualizar</button>  
       <button type="button" class="btn btn-danger" ng-click='nuevo()'>Limpiar</button>           
      
      </div>

   <div class="col-lg-6" ng-init='consultar()'>
   <div class="panel panel-default">
       <div class="panel-heading">
           Lista de modulos
       </div>

        <div class="panel-body">
         <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" >
           <thead>
               <tr>
                   <th>Nombre</th>                  
                   <th colspan="3" class="center">Opciones</th>                         
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in listaModulos'>
               <td>{{item.nombre}}</td>               
               <td class="center">
                 <a href="" ng-click='consultar_por_codigo(item)'>
                   <i class='fa fa-pencil fa-2x'></i>
                 </a>
               </td>
               <td class="center">
                 <a href="" ng-click="eliminar_modulo(item)" title='Eliminar'>
                   <i class='fa fa-trash fa-2x'></i>
                 </a>
               </td>
               <td class="center">
                 <a href="" ui-sref="home.registrar_menus({id_modulo:item.id})" title='Agregar Menus'>
                   <i class='fa fa-plus-circle fa-2x'></i>
                 </a>
               </td>
             </tr>
           </tbody>
         </table>
         </div>
         </div>

   </div>
</div>

      </div>


 </div>

 

</div>


