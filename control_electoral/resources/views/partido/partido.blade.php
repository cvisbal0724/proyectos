<div class="col-lg-12">
 <div class="panel panel-default">
 	 <div class="panel-heading">
         Registrar Partido
      </div>

      <div class="panel-body">
      	<div class="col-lg-6">

      		<div class="form-group">
                <label>Partido</label>
                <input class="form-control" type='text' ng-model='partidoVO.nombre'>
                <p class="help-block">(*)Ingrese el partido</p>
            </div>
            <div class="form-group">
                <label>Logo</label>
                <input class="form-control" type='file' ng-model='partidoVO.logo' file-model="partidoVO.logo">
                <p class="help-block">(*)Ingrese el partido</p>
            </div>
            <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
             </div>
            
			 <button ng-if='partidoVO.id==0' type="button" class="btn btn-primary" ng-click='guardar()'>Registrar</button>  
       <button ng-if='partidoVO.id>0' type="button" class="btn btn-primary" ng-click='guardar()'>Actualizar</button>  
       <button type="button" class="btn btn-primary" ng-click='nuevo()'>Limpiar</button>           
      
      </div>

   <div class="col-lg-6" ng-init='consultar()'>
   <div class="panel panel-default">
       <div class="panel-heading">
           Lista de partidos
       </div>

        <div class="panel-body">
         <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" >
           <thead>
               <tr>
                   <th>Nombre</th>
                   <th>Logo</th>  
                   <th colspan="2">Opciones</th>                    
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in listaPartidos'>
               <td>{{item.nombre}}</td>
               <td>
                 <img style='width:28px;' ng-if="item.logo!=''" src="app_cliente/logos_partido/{{item.logo}}">
                 <span style='color:red;' ng-if="item.logo==''">Pendiente</span>
               </td>
               <td>
                 <a href="" ng-click='consultar_por_codigo(item)'>
                   <i class='fa fa-pencil fa-2x'></i>
                 </a>
               </td>
               <td>
                 <a href="" ng-click='eliminar(item)'>
                   <i class='fa fa-trash fa-2x'></i>
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


