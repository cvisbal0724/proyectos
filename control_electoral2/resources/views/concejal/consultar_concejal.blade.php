<div class="col-lg-12" ng-init='consultar()'>
 <div class="form-panel">
  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Consultar Concejal
   </h4>

   	      	
        <div class="panel-body">

       
        
        <div class="panel-body">
        
 		<div class="row">
	        <div class="col-lg-6">
	        	<div class="form-group input-group">
	                <input type="text" class="form-control" ng-model='criterios.criterio'
	                ng-keyup="$event.keyCode == 13 && consultar(1)">
	                <span class="input-group-btn">
	                    <button ng-click='consultar()' class="btn btn-success" type="button"><i class="fa fa-search"></i>
	                    </button>
	                </span>
	            </div>
	        </div>    
        </div>	
        <div class="row">
        	<div class="col-lg-6">
 				<div class="dataTables_info" role="status" aria-live="polite">Mostrando 1 a {{listaConcejales.per_page}} de {{listaConcejales.total}} registros</div>
 			</div>
        </div>
        <div class="table-responsive">
        
        <table class="table table-striped table-bordered table-hover" >
           <thead>
               <tr>
               	   <th>Nombre</th>
               	   <th>Numero</th>
               	   <th>Partido</th>
               	   <th>Alcalde</th>               	                 	   
                   <th></th>         
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in listaConcejales.data'>
              	
              	<td>{{item.concejal}}</td>
        				<td>{{item.numero}}</td>
        				<td>{{item.partido}}</td>
        				<td>{{item.alcalde}}</td>	
               <td>
                 <a href="" ng-click='consultar_por_codigo(item)'>
                   <i ui-sref="home.editar_concejales({id:item.id})" class='fa fa-pencil fa-2x'></i>
                 </a>
               </td>
             </tr>
           </tbody>
         </table>

 		
 		
         <div class="dataTables_paginate paging_simple_numbers">
              <ul class="pagination">
              <li tabindex="0" aria-controls="dataTables-example" class="paginate_button previous {{listaConcejales.current_page==1 ? 'disabled' : ''}}">
                <a href="" ng-if='listaConcejales.current_page > 1' ng-click="consultar(1)">Inicio</a>
                <span ng-if='listaConcejales.current_page==1'>Inicio</span>
              </li>
              <li tabindex="0" aria-controls="dataTables-example" class="paginate_button previous {{listaConcejales.current_page==1 ? 'disabled' : ''}}">
                <a ng-if='listaConcejales.current_page > 1' href="" ng-click="consultar(listaConcejales.current_page-1)">Anterior</a>
                <span ng-if='listaConcejales.current_page==1'>Anterior</span>
              </li> 
            
              <li ng-repeat="n in paginas" class="paginate_button {{listaConcejales.current_page==n ? 'active' : ''}}">
                <a href="" ng-click="consultar(n)">{{n}}</a>
              </li>
             
              <li tabindex="0" aria-controls="dataTables-example" class="paginate_button previous {{listaConcejales.current_page==listaConcejales.last_page ? 'disabled' : ''}}">
                <a ng-if='listaConcejales.current_page < listaConcejales.last_page' href="" ng-click="consultar(listaConcejales.current_page+1)">Siguiente</a>
                 <span ng-if='listaConcejales.current_page==listaConcejales.last_page'>Siguiente</span>
              </li> 
              <li tabindex="0" aria-controls="dataTables-example" 
              class="paginate_button previous {{listaConcejales.current_page==listaConcejales.last_page ? 'disabled' : ''}}">
                <a href="" ng-if='listaConcejales.current_page < listaConcejales.last_page' ng-click="consultar(listaConcejales.last_page)">Fin</a>
                 <span ng-if='listaConcejales.current_page==listaConcejales.last_page'>Fin</span>
               </li>
               
              </ul>
              </div>
			
       

 	</div>
        </div> 
    
   </div>
	      	</div>
   		</div>

