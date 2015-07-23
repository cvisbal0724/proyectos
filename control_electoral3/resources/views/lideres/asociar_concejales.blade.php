<div class="col-lg-12">
  <div class="form-panel">
  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Asociar Concejales
   </h4>
 	 

      <div class="panel-body">

      <div class="col-lg-12">
        
        <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
             </div>

      </div>

      	<div class="col-lg-5" ng-init='consultar_modulos()'>

      <div class="panel panel-default">
       <div class="panel-heading">
           Lista de concejales
       </div>

        <div class="panel-body">

          <div class="form-group input-group">
                  <input type="text" class="form-control ng-pristine ng-valid ng-touched" placeholder="Buscar concejal" ng-model="criterios.criterio" ng-keyup="$event.keyCode == 13 && consultar_concejal(1)">
                  <span class="input-group-btn">
                      <button ng-click="consultar_concejal(1)" class="btn btn-default" type="button"><i class="fa fa-search"></i>
                      </button>
                  </span>
              </div>

           <div class="table-responsive">
           <table class="table table-striped table-bordered table-hover" >
             <thead>
                 <tr>                               
                     <th><input type='checkbox' ng-model="seleccionarModulo" ng-click="selecionar_modulos(seleccionarModulo)"></th>   
                      <th>Nombre</th> 
                      <th>Meta</th>                        
                 </tr>
             </thead>
             <tbody>
               <tr ng-repeat='item in listaConcejales.data'>
                 <td><input type='checkbox' ng-model="item.procesar"></td>
                 <td>{{item.concejal}}</td> 
                 <td>
                 <input type="text" style="width:70px;" ng-init="item.meta=0" ng-model="item.meta" numeric-only
                 class="center">

                 </td>
               </tr>
             </tbody>
           </table>
           </div>
         </div>

   </div>  	     
      
       </div>
    <div class="col-lg-1">      
     <button type="button" class="btn btn-info btn-circle btn-lg" ng-click="agregar_lider_concejales()">
     <i class="fa fa-angle-right"></i>
     </button>
    </div>  

   <div class="col-lg-6" ng-init='consultar_lider_concejales()'>
   <div class="panel panel-default">
       <div class="panel-heading">
           Concejales asociados
       </div>

        <div class="panel-body">
         <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" >
           <thead>
               <tr>
                   <th>Lider</th>                  
                   <th>Concejal</th> 
                   <th></th>                   
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in listaLiderConcejales'>              
               <td>{{item.lider.persona.nombre + ' ' + item.lider.persona.apellido}}</td>  
               <td>{{item.concejal.persona.nombre + ' ' + item.concejal.persona.apellido }}</td>               
               <td>
                 <a href="" ng-click="eliminal_lider_concejales(item)">
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


