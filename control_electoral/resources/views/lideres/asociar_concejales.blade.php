<div class="col-lg-12">
 <div class="panel panel-default">
 	 <div class="panel-heading">
         Perfil Modulos
      </div>

      <div class="panel-body">
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
                 </tr>
             </thead>
             <tbody>
               <tr ng-repeat='item in listaConcejales.data'>
                 <td><input type='checkbox' ng-model="item.procesar"></td>
                 <td>{{item.concejal}}</td> 
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


