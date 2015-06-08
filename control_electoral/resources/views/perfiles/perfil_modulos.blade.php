<div class="col-lg-12">
 <div class="panel panel-default">
 	 <div class="panel-heading">
         Perfil Modulos
      </div>

      <div class="panel-body">
      	<div class="col-lg-5" ng-init='consultar_modulos()'>

              <div class="panel panel-default">
       <div class="panel-heading">
           Lista de módulos
       </div>

        <div class="panel-body">
           <div class="table-responsive">
           <table class="table table-striped table-bordered table-hover" >
             <thead>
                 <tr>                               
                     <th><input type='checkbox' ng-model="seleccionarModulo" ng-click="selecionar_modulos(seleccionarModulo)"></th>   
                      <th>Nombre</th>                         
                 </tr>
             </thead>
             <tbody>
               <tr ng-repeat='item in listaModulos'>
                 <td><input type='checkbox' ng-model="item.procesar"></td>
                 <td>{{item.nombre}}</td> 
               </tr>
             </tbody>
           </table>
           </div>
         </div>

   </div>  	     
      
       </div>
    <div class="col-lg-1">      
     <button type="button" class="btn btn-info btn-circle btn-lg" ng-click="agregar_modulos()">
     <i class="fa fa-angle-right"></i>
     </button>
    </div>  

   <div class="col-lg-6" ng-init='consultar_perfil_modulos()'>
   <div class="panel panel-default">
       <div class="panel-heading">
           Perfil Modulos
       </div>

        <div class="panel-body">
         <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" >
           <thead>
               <tr>
                   <th>Perfil</th>                  
                   <th>Modulo</th> 
                   <th></th>                   
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in listaPerfilModulos'>              
               <td>{{item.perfil.nombre}}</td>  
               <td>{{item.modulo.nombre}}</td>               
               <td>
                 <a href="" ng-click="eliminar_perfil_modulo(item)">
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


