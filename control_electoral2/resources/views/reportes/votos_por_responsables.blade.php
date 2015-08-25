<div class="col-lg-12">
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Consultar votos por responsables 
   </h4>

   	  
        
        <div class="panel-body">
        
 		<div class="row">
	        <div class="col-lg-6">
	        	<div class="form-group">
                <label>Opción</label>
                <select class="form-control ng-valid ng-dirty ng-touched" ng-model="id_opcion" ng-change="obtener_concejales_y_lideres()">

                  <option value="0">[Seleccione..]</option>   
                  @if($id_perfil==1 || $id_perfil==2)               
                  <option value="1">Concejales</option>      
                  @endif
                  <option value="2">Lideres</option>                                   
                  </select>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label>Responsables</label>
                <select class="form-control ng-valid ng-dirty ng-touched" ng-model="id_encargado" ng-change="obtener_votos_por_responsables(id_encargado)">

                  <option value="0">[Seleccione..]</option>   
                  <option ng-repeat="item in listaLideresConcejales" value="{{item.id}}">{{item.nombre}}</option>
                  <option value="200">Todos</option>                               
                  </select>
                <p class="help-block"></p>
            </div>
	        </div>    
        </div>	
        <div class="row">
        	<div class="col-lg-6">
 				<div class="dataTables_info" role="status" aria-live="polite">Mostrando 1 a {{listaVotantes.per_page}} de {{listaVotantes.total}} registros</div>
 			</div>
        </div>
        <div class="table-responsive">
        
        <table class="table table-striped table-bordered table-hover" >
           <thead>
               <tr>
               	   <th>Responsable</th>
                   <th>Tipo</th>
               	   <th>Total Votos</th>
               	   <th>Por Votar</th>
                   <th>Votos registrados</th> 
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in listaVotosResponsables'>
              	
              	<td style="font-weight:bold;">{{item.responsable}}</td>
                <td style="font-weight:bold;">{{item.tipo}}</td>
        				<td style="text-align:center;font-weight:bold;"><a href="">{{item.total_votos}}</a></td>        				
        				<td style="text-align:center;font-weight:bold;"><a href="">{{item.por_votar}}</a></td>
                <td style="text-align:center;font-weight:bold;"><a href="">{{item.votos_registrados}}</a></td>	
                              
             </tr>
           </tbody>
           <tfoot>
             <th colspan="2" style="text-align:right;font-weight:bold;">
               Totales:
             </th>
             <th style="text-align:center;font-weight:bold;">
               {{listaVotosResponsables | sumByKey:'total_votos'}}
             </th>
              <th style="text-align:center;font-weight:bold;">
               {{listaVotosResponsables | sumByKey:'por_votar'}}
             </th>
              <th style="text-align:center;font-weight:bold;">
               {{listaVotosResponsables | sumByKey:'votos_registrados'}}
             </th>
           </tfoot>
         </table>

 		
 		
         <!--<div class="dataTables_paginate paging_simple_numbers">
              <ul class="pagination">
              <li tabindex="0" aria-controls="dataTables-example" class="paginate_button previous {{listaVotantes.current_page==1 ? 'disabled' : ''}}">
                <a href="" ng-if='listaVotantes.current_page > 1' ng-click="consultar(1)">Inicio</a>
                <span ng-if='listaVotantes.current_page==1'>Inicio</span>
              </li>
              <li tabindex="0" aria-controls="dataTables-example" class="paginate_button previous {{listaVotantes.current_page==1 ? 'disabled' : ''}}">
                <a ng-if='listaVotantes.current_page > 1' href="" ng-click="consultar(listaVotantes.current_page-1)">Anterior</a>
                <span ng-if='listaVotantes.current_page==1'>Anterior</span>
              </li> 
            
              <li ng-repeat="n in paginas" class="paginate_button {{listaVotantes.current_page==n ? 'active' : ''}}">
                <a href="" ng-click="consultar(n)">{{n}}</a>
              </li>
             
              <li tabindex="0" aria-controls="dataTables-example" class="paginate_button previous {{listaVotantes.current_page==listaVotantes.last_page ? 'disabled' : ''}}">
                <a ng-if='listaVotantes.current_page < listaVotantes.last_page' href="" ng-click="consultar(listaVotantes.current_page+1)">Siguiente</a>
                 <span ng-if='listaVotantes.current_page==listaVotantes.last_page'>Siguiente</span>
              </li> 
              <li tabindex="0" aria-controls="dataTables-example" 
              class="paginate_button previous {{listaVotantes.current_page==listaVotantes.last_page ? 'disabled' : ''}}">
                <a href="" ng-if='listaVotantes.current_page < listaVotantes.last_page' ng-click="consultar(listaVotantes.last_page)">Fin</a>
                 <span ng-if='listaVotantes.current_page==listaVotantes.last_page'>Fin</span>
               </li>
               
              </ul>
              </div>-->
			
       

 	</div>
          
   </div>
	      	</div>
   		</div>

