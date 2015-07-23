<div class="col-lg-12">
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Registrar Menu
   </h4>

      <div class="panel-body">
        <div class="col-lg-6" ng-init="consultar_por_modulo()">

        
<div class="panel panel-default">
       <div class="panel-heading">
          Menu 
       </div>                
<div class="panel-body">
     <div
      data-angular-treeview="true"
      data-tree-model="listaMenu"
      data-node-id="id"
      data-node-label="etiqueta"
      data-node-children="hijos" 
      data-node-class='imagen'>
    </div>
<br>
<button ng-show="currentNode.id > 0" type="button" class="btn btn-default" ng-click="consultar_por_codigo()">Editar</button>

<button ng-show="currentNode.id > 0" type="button" class="btn btn-danger"  ng-click="eliminar()">Eliminar</button>
    
  </div> 

 </div>   
      
      </div>

   <div class="col-lg-6" ng-show="currentNode.id_modulo > 0">
   <div class="panel panel-default">
       <div class="panel-heading">
          <span ng-if="menuVO.id==0">Agregar Menú para {{ currentNode.etiqueta }}</span>
          <span ng-if="menuVO.id > 0">Editar Menú</span>
       </div>

        <div class="panel-body">
        
            <div class="form-group">
                <label>Etiqueta</label>
                <input class="form-control" type='text' ng-model='menuVO.etiqueta'>
                <p class="help-block">(*)Ingrese la etiqueta</p>
            </div>

            <div class="form-group">
                <label>Url</label>
                <input class="form-control" type='text' ng-model='menuVO.url'>
                <p class="help-block">(*)Ingrese la url</p>
            </div>

            <div class="form-group">
                <label>Orden</label>
                <input class="form-control" type='text' ng-model='menuVO.orden' numeric-only>
                <p class="help-block">(*)Ingrese el orden</p>
            </div>

            <div class="form-group">
                <label>Imagen</label>
                <input class="form-control" type='text' ng-model='menuVO.imagen'>
                <p class="help-block">(*)Ingrese la imagen</p>
            </div>

            <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
             </div>

             <button ng-if="menuVO.id == 0" type="button" class="btn btn-warning" ng-click='crear()'>Registrar</button>  
              <button ng-if="menuVO.id > 0" type="button" class="btn btn-warning" ng-click='actualizar()'>Actualizar</button>  
              <button type="button" class="btn btn-danger" ng-click='nuevo()'>Limpiar</button>  
         </div>

   </div>
</div>

      </div>


 </div>

 

</div>


