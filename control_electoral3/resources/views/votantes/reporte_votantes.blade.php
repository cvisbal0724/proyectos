<div class="col-lg-12">
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Exportar PDF
   </h4>

       <div class="panel-body" ng-init="consultarconcejalylider()">

      	

         <div class="col-lg-6">
   <div class="panel panel-default">
       <div class="panel-heading">
           Concejales
       </div>

        <div class="panel-body">
         <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" >
           <thead>
               <tr>
                  <th></th>
                   <th>Nombre</th> 
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in concejales'>
                <td>
                 <input type="checkbox" ng-model="item.procesar" ng-click="agregar_id_concejal(item)">
               </td>
               <td class="center">
                {{item.concejal}}
               </td>
             </tr>
           </tbody>
         </table>
         </div>
         </div>

   </div>
</div>

 <div class="col-lg-6">
   <div class="panel panel-default">
       <div class="panel-heading">
           Lideres
       </div>

        <div class="panel-body">
         <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" >
           <thead>
               <tr>
                    <th></th>
                   <th>Nombre</th> 
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in lideres'>
               <td>
                 <input type="checkbox" ng-model="item.procesar" ng-click="agregar_id_lider(item)">
               </td>
               <td class="center">
                {{item.lider}}
               </td>
             </tr>
           </tbody>
         </table>
         </div>
         </div>

   </div>
</div>

 <div class="col-lg-12">
          
           <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
               {{result.msg}}
          </div>
            
       <button type="button" class="btn btn-warning" ng-click='exportar_votantes()'>Exportar PDF</button> 
       
        </div>

 </div>

</div>
</div>

