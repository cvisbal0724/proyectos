<div class="col-lg-12">
  <div class="form-panel">
  
 	 <h4 class="mb"><i class="fa fa-angle-right"></i> Registrar de Alcaldes</h4>

      <div class="panel-body">
      	<div class="col-lg-6">

      		<div class="form-group">
                <label>Nombre</label>
                <input class="form-control" type='text' ng-model='alcaldeVO.nombre'>
                <p class="help-block">(*)Ingrese el nombre</p>
            </div>
            <div class="form-group">
                <label>Partido</label>
                <select class="form-control" ng-model='alcaldeVO.id_partido'>
                  <option value='0'>[Seleccione..]</option>
                  @foreach($partidos as $item)
                  <option value="[[$item->id]]">[[$item->nombre]]</option>
                  @endforeach
                </select>
                <p class="help-block">(*)Seleccione el partido</p>
            </div>

            <div class="form-group">
                <label>Numero</label>
                <input class="form-control" type='text' ng-model='alcaldeVO.numero'>
                <p class="help-block">(*)Ingrese el partido</p>
            </div>

            <div class="form-group">
                <label>Foto</label>
                <input class="form-control" type='file' file-model='alcaldeVO.foto'>
                <p class="help-block">(*)Ingrese el partido</p>
            </div>

            <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
             </div>
            
			 <button ng-if='alcaldeVO.id==0' type="button" class="btn btn-warning" ng-click='guardar()'>Registrar</button>  
       <button ng-if='alcaldeVO.id>0' type="button" class="btn btn-warning" ng-click='guardar()'>Actualizar</button>  
       <button type="button" class="btn btn-danger" ng-click='nuevo()'>Limpiar</button>           
      
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
                   <th>Partido</th>  
                   <th>Numero</th>         
                   <th></th>
                   <th></th>
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in listaAlcaldes'>
               <td>{{item.nombre}}</td>
               <td>{{item.partido.nombre}}</td>
               <td>{{item.numero}}</td>
               <td>
               <img style='width:28px;' ng-if="item.foto!=''" src="app_cliente/fotos_alcalde/{{item.foto}}">
                 <span style='color:red;' ng-if="item.foto==''">Pendiente</span>
               <td>
                 <a href="" ng-click='consultar_por_codigo(item)'>
                   <i class='fa fa-pencil fa-2x'></i>
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


