<div class="col-lg-12" >
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Consultar votos por partidos 
   </h4>

   	  
        
        <div class="panel-body">
        
 		<div class="row">
	        <div class="col-lg-6">
	        	<div class="form-group">
                <label>Partidos</label>
                <select class="form-control ng-valid ng-dirty ng-touched" ng-model="id_partido" ng-change="obtener_votos_por_partidos()">

                  <option value="0">[Seleccione..]</option>
                  @foreach($partidos as $item)
                  <option value="[[$item->id]]">[[$item->nombre]]</option>
                  @endforeach 
                  <option value="200">Todos</option>                                   
                  </select>
                <p class="help-block"></p>
            </div>

            <div class="form-group">
              <a href="votante/exportarreporteporpartidos" target="_blank" title="Imprimir resultado">
                <i class="fa fa-print fa-3x"></i>
              </a>
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
                  <th></th>
               	   <th>Partido</th>
               	   <th>Total Votos</th>
               	   <th>Por Votar</th>
                   <th>Votos registrados</th>               	            	                 	   
                    <th></th>   
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in listaVotosPartidos'>
              	
                <td><img width="50" src="app_cliente/logos_partido/{{item.logo}}"/></td>
              	<td style="font-weight:bold;">{{item.partido}}</td>
        				<td style="text-align:center;font-weight:bold;">{{item.total_votos}}</td>        				
        				<td style="text-align:center;font-weight:bold;">{{item.por_votar}}</td>
                <td style="text-align:center;font-weight:bold;">{{item.votos_registrados}}</td>	
                <td style="text-align:center;">
                  <a title="Ver concejales" ui-sref="home.votos_por_concejal({id_partido:item.id_partido})">
                    <i class="fa fa-eye fa-2x"></i>
                  </a>
                </td>              
             </tr>
           </tbody>
           <tfoot>
             <th colspan="2" style="text-align:right;">
               Totales:
             </th>
             <th style="text-align:center;font-weight:bold;">
               {{listaVotosPartidos | sumByKey:'total_votos'}}
             </th>
              <th style="text-align:center;font-weight:bold;">
               {{listaVotosPartidos | sumByKey:'por_votar'}}
             </th>
              <th style="text-align:center;font-weight:bold;">
               {{listaVotosPartidos | sumByKey:'votos_registrados'}}
             </th>
             <th></th>
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

