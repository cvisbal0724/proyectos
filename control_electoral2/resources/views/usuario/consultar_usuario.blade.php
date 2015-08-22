<div class="col-lg-12" ng-init='consultar()'>
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Consultar Usuario
   </h4>

   	      	
        <div class="panel-body">

       
        
        <div class="panel-body">
        
 		<div class="row">
	        <div class="col-lg-6">
	        	<div class="form-group input-group">
	                <input type="text" class="form-control" ng-model='criterios.criterio'
	                ng-keyup="$event.keyCode == 13 && consultar(1)">
	                <span class="input-group-btn">
	                    <button ng-click='consultar(1)' class="btn btn-success" type="button"><i class="fa fa-search"></i>
	                    </button>
	                </span>
	            </div>
	        </div>    
        </div>	
        <div class="row">
        	<div class="col-lg-6">
 				<div class="dataTables_info" role="status" aria-live="polite">Mostrando 1 a {{listaUsuarios.per_page}} de {{listaUsuarios.total}} registros</div>
 			</div>
        </div>
        <div class="table-responsive">
        
        <table class="table table-striped table-bordered table-hover" >
           <thead>
               <tr>
               	   <th>Usuario</th>
               	   <th>Nombre</th>
               	   <th>Apellido</th>
               	   <th>Perfil</th>               	                 	   
                   <th colspan="2" style="text-align:center;">Opciones</th>         
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in listaUsuarios.data'>
              	
              	<td>{{item.usuario}}</td>
        				<td>{{item.nombre}}</td>
        				<td>{{item.apellido}}</td>
        				<td>{{item.perfil}}</td>	
               <td style="text-align:center;">
                 <a href="" ng-click='consultar_por_codigo(item)'>
                   <i ui-sref="home.editar_usuarios({id:item.id})" class='fa fa-pencil fa-2x'></i>
                 </a>
               </td>
               <td style="text-align:center;">
                 <a ng-if="item.bloqueado==0" href="" title="Bloquear usuario" ng-click="bloquear_usuario(item)">
                   <i class="fa fa-thumbs-o-down fa-2x" style="color:red;"></i>
                 </a>

                 <a ng-if="item.bloqueado==1" href="" title="Desbloquear usuario" ng-click="desbloquear_usuario(item)">
                   <i class="fa fa-thumbs-o-up fa-2x"></i>
                 </a>

               </td>
             </tr>
           </tbody>
         </table>

 		
 		
         <div class="dataTables_paginate paging_simple_numbers">
              <ul class="pagination">
              <li tabindex="0" aria-controls="dataTables-example" class="paginate_button previous {{listaUsuarios.current_page==1 ? 'disabled' : ''}}">
                <a href="" ng-if='listaUsuarios.current_page > 1' ng-click="consultar(1)">Inicio</a>
                <span ng-if='listaUsuarios.current_page==1'>Inicio</span>
              </li>
              <li tabindex="0" aria-controls="dataTables-example" class="paginate_button previous {{listaUsuarios.current_page==1 ? 'disabled' : ''}}">
                <a ng-if='listaUsuarios.current_page > 1' href="" ng-click="consultar(listaUsuarios.current_page-1)">Anterior</a>
                <span ng-if='listaUsuarios.current_page==1'>Anterior</span>
              </li> 
            
              <li ng-repeat="n in paginas" class="paginate_button {{listaUsuarios.current_page==n ? 'active' : ''}}">
                <a href="" ng-click="consultar(n)">{{n}}</a>
              </li>
             
              <li tabindex="0" aria-controls="dataTables-example" class="paginate_button previous {{listaUsuarios.current_page==listaUsuarios.last_page ? 'disabled' : ''}}">
                <a ng-if='listaUsuarios.current_page < listaUsuarios.last_page' href="" ng-click="consultar(listaUsuarios.current_page+1)">Siguiente</a>
                 <span ng-if='listaUsuarios.current_page==listaUsuarios.last_page'>Siguiente</span>
              </li> 
              <li tabindex="0" aria-controls="dataTables-example" 
              class="paginate_button previous {{listaUsuarios.current_page==listaUsuarios.last_page ? 'disabled' : ''}}">
                <a href="" ng-if='listaUsuarios.current_page < listaUsuarios.last_page' ng-click="consultar(listaUsuarios.last_page)">Fin</a>
                 <span ng-if='listaUsuarios.current_page==listaUsuarios.last_page'>Fin</span>
               </li>
               
              </ul>
              </div>
			
       

 	</div>
        </div> 
    
   </div>
	      	</div>
   		</div>

