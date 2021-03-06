<div class="col-lg-12" ng-init='consultar()'>
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Consultar Votante
   </h4>

   	  
        
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
 				<div class="dataTables_info" role="status" aria-live="polite">Mostrando 1 a {{listaVotantes.per_page}} de {{listaVotantes.total}} registros</div>
 			</div>
        </div>
        <div class="table-responsive">
        
        <table class="table table-striped table-bordered table-hover" >
           <thead>
               <tr>
               	   <th>Votante</th>
               	   <th>Lider</th>
               	   <th>Concejal</th>
                   <th>Votar Por</th>
               	   <th>Tipo Voto</th> 
                   <th>Voto?</th>               	                 	   
                   <th colspan="3">Opciones</th>         
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in listaVotantes.data'>
              	
              	<td>{{item.votante}}</td>
        				<td>{{item.lider}}</td>
        				<td>{{item.concejal}}</td>
        				<td>{{item.votar_por}}</td>
                <td>{{item.tipo_voto}}</td>	
                <td ng-if="item.voto > 0" style="color:blue;font-size:13px;font-weight:bold;text-align:center;">SI</td>
                <td ng-if="!(item.voto > 0)" style="color:red;font-size:13px;font-weight:bold;text-align:center;">NO</td>
               <td>
                 <a href="" ui-sref="home.editar_votantes({id:item.id})" title="Editar">
                   <i class='fa fa-pencil fa-2x'></i>
                 </a>
               </td>
                <td>
                 <a href="" ui-sref="home.dar_de_baja({id:item.id})" title="Dar de baja" style="color:rgb(182, 23, 23)">
                   <i class='fa fa-thumbs-o-down fa-2x'></i>
                 </a>
               </td>
               <td>
                  <a ui-sref="home.registrar_voto({id:item.id})" title="Registrar Voto" style="color:rgb(9, 136, 39)">
                   <i class='fa fa-hand-peace-o fa-2x'></i>
                 </a>
               </td>
             </tr>
           </tbody>
         </table>

 		
 		
         <div class="dataTables_paginate paging_simple_numbers">
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
              </div>
			
       

 	</div>
          
   </div>
	      	</div>
   		</div>

