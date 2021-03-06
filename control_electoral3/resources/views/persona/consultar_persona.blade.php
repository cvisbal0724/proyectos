<div class="col-lg-12" ng-init='consultar()'>
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Consultar Persona
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
 				<div class="dataTables_info" role="status" aria-live="polite">Mostrando 1 a {{listaPersonas.per_page}} de {{listaPersonas.total}} registros</div>
 			</div>
        </div>
        <div class="table-responsive">
        
        <table class="table table-striped table-bordered table-hover" >
           <thead>
               <tr>
               	   <th>Cedula</th>
               	   <th>Nombre</th>
               	   <th>Apellido</th>
               	   <th>Teléfono</th>               	  
               	   <th>Alcalde</th>
                   <th></th>         
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in listaPersonas.data'>
              	
              	<td>{{item.cedula}}</td>
        				<td>{{item.nombre}}</td>
        				<td>{{item.apellido}}</td>
        				<td>{{item.telefono}}</td>				
        				<td>{{item.alcalde.nombre}}</td>
               <td>
                 <a href="" ng-click='consultar_por_codigo(item)'>
                   <i ui-sref="home.editar_personas({id:item.id})" class='fa fa-pencil fa-2x'></i>
                 </a>
               </td>
             </tr>
           </tbody>
         </table>

 		
 		
         <div class="dataTables_paginate paging_simple_numbers">
              <ul class="pagination">
              <li tabindex="0" aria-controls="dataTables-example" class="paginate_button previous ">
                <a href="" ng-click="consultar(1)">Inicio</a>
              </li>
              <li tabindex="0" aria-controls="dataTables-example" class="paginate_button previous {{listaPersonas.current_page==1 ? 'disabled' : ''}}">
                <a ng-if='listaPersonas.current_page > 1' href="" ng-click="consultar(listaPersonas.current_page-1)">Anterior</a>
                <span ng-if='listaPersonas.current_page==1'>Anterior</span>
              </li> 
            
              <li ng-repeat="n in paginas" class="paginate_button {{listaPersonas.current_page==n ? 'active' : ''}}">
                <a href="" ng-click="consultar(n)">{{n}}</a>
              </li>
             
              <li tabindex="0" aria-controls="dataTables-example" class="paginate_button previous {{listaPersonas.current_page==listaPersonas.last_page ? 'disabled' : ''}}">
                <a ng-if='listaPersonas.current_page < listaPersonas.last_page' href="" ng-click="consultar(listaPersonas.current_page+1)">Siguiente</a>
                 <span ng-if='listaPersonas.current_page==listaPersonas.last_page'>Siguiente</span>
              </li> 
              <li tabindex="0" aria-controls="dataTables-example" 
              class="paginate_button previous {{listaPersonas.current_page==listaPersonas.last_page ? 'disabled' : ''}}">
                <a href="" ng-click="consultar(listaPersonas.last_page)">Fin</a>
               </li>
               
              </ul>
              </div>
			
       

 	</div>
        </div> 
    
   </div>
	      	</div>
   		</div>

