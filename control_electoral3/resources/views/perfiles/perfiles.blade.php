<div class="col-lg-12">
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Registrar Perfil
   </h4>

      <div class="panel-body">
      	<div class="col-lg-6">

      		<div class="form-group">
                <label>Nombre del perfil</label>
                <input class="form-control" type='text' ng-model='perfilesVO.nombre'>
                <p class="help-block">(*)Ingrese el perfil</p>
            </div>
            
            <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
             </div>
            
			 <button ng-if='perfilesVO.id==0' type="button" class="btn btn-warning" ng-click='guardar()'>Registrar</button>  
       <button ng-if='perfilesVO.id>0' type="button" class="btn btn-warning" ng-click='guardar()'>Actualizar</button>  
       <button type="button" class="btn btn-danger" ng-click='nuevo()'>Limpiar</button>           
      
      </div>

   <div class="col-lg-6" ng-init='consultar()'>
   <div class="panel panel-default">
       <div class="panel-heading">
           Lista de perfiles
       </div>

        <div class="panel-body">
         <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" >
           <thead>
               <tr>
                   <th>Nombre</th>                  
                   <th></th> 
                   <th></th>        
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in listaPerfiles'>
               <td>{{item.nombre}}</td>               
               <td>
                 <a href="" ng-click='consultar_por_codigo(item)'>
                   <i class='fa fa-pencil fa-2x'></i>
                 </a>
               </td>
               <td class="center">
                 <a href="" ui-sref="home.perfil_modulos({id_perfil:item.id})" title='Ver modulos'>
                   <i class='fa fa-eye fa-2x'></i>
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


