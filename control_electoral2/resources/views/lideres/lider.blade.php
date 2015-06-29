<div class="col-lg-12">
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Registrar Lider
   </h4>

       <div class="panel-body">
      	<div class="col-lg-6">

        <div class="panel panel-default">
       <div class="panel-heading">
          Informacion del lider 
       </div>  

       <div class="panel-body"> 

          <div class="form-group">
                <label>Encargado:</label>
                <span>[[$usuario->persona->nombre_completo()]]</span>
            </div>   
            
         <div class="form-group">
              <label>Meta</label>
              <input type="text" class="form-control" ng-model="liderVO.meta" numeric-only>
              <p></p>
            </div>  
          <div class="form-group">
                <label>Foto</label>
                <input class="form-control" type='file' file-model='liderVO.foto'>
                <p class="help-block">(*)Ingrese el partido</p>
            </div>
             
        </div>   
       </div>     
            

      	</div>

        <div class="col-lg-6">
          
            <div class="panel panel-default">
       <div class="panel-heading">
          Informacion de la persona 
       </div>  

       <div class="panel-body">  
        <a href="" data-toggle="modal" data-target="#modalPersona" title="Agregar Persona">
         <i class="fa fa-plus fa-2x"></i>
       </a>       
        <div class="form-group">

            <div class="form-group input-group">
                <input type="text" class="form-control" placeholder="Buscar Persona" ng-model="criterio"
                ng-keyup="$event.keyCode == 13 && consultar_persona_por_criterios()">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search" ng-click="consultar_persona_por_criterios()"></i>
                    </button>
                </span>
             </div>
             <select multiple="" class="form-control" ng-model="liderVO.id_persona" ng-multiple="true">
                 <option ng-repeat="item in listaPersonas" value="{{item.id}}">{{item.cedula+' / ' + item.nombre + ' ' + item.apellido }}</option>
             </select>
              <p class="help-block">(*)Seleccione una persona</p>
        </div>
       </div>

       </div>

        </div>

        <div class="col-lg-12">
          
           <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
             </div>
            
       <button ng-if='liderVO.id==0' type="button" class="btn btn-warning" ng-click='crear()'>Registrar</button>  
       <button ng-if='liderVO.id>0' type="button" class="btn btn-warning" ng-click='actualizar()'>Actualizar</button>  
       <button type="button" class="btn btn-danger" ng-click='nuevo()'>Limpiar</button>           

        </div>
      </div>

 </div>
</div>
