<div class="col-lg-12">
 <div class="panel panel-default">
   <div class="panel-heading">
         Registrar Modulo
      </div>

      <div class="panel-body">
        <div class="col-lg-6" ng-init="consultar_por_modulo()">


         <!-- <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu" metismenu>
                       
                      

                                <li ng-repeat="item in listaMenu" ng-if="item.hijos.length > 0">
                                  <a href="">
                                    <i class="fa fa-bar-chart-o fa-fw"></i>                                    
                                    <span>{{item.etiqueta}}</span>
                                    <span class="fa arrow"></span>
                                  </a>
                                
                                <ul class="nav nav-second-level">                                  
                                      
                                  <li ng-repeat="hijo in item.hijos">
                                      <a href="">{{hijo.etiqueta}}</a>
                                  </li>                                      
                                   
                                </ul>

                                </li> 


                                 <li ng-repeat="item in listaMenu" ng-if="item.hijos.length == 0">
                                    <a href="">
                                        <i class="fa fa-dashboard fa-fw"></i> 
                                        <span>{{item.etiqueta}}</span>
                                    </a>
                                </li>                    

                           

                    </ul>
                </div>-->

                <div
      data-angular-treeview="true"
      data-tree-model="listaMenu"
      data-node-id="id"
      data-node-label="etiqueta"
      data-node-children="hijos" >
    </div>
      
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
                 <a href="" ui-sref="home.perfil_modulos({id_perfil:item.id})" title='Agregar Menus'>
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


