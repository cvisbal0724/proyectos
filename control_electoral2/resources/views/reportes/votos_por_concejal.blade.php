<div class="col-lg-12" ng-init='obtener_votos_por_concejales()'>
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Votos por concejales
   </h4>

      
        
        <div class="panel-body">
  
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
                   <th>Concejal</th>
                   <th>Total Votos</th>
                   <th>Por Votar</th>
                   <th>Votos registrados</th>                                                    
                       
               </tr>
           </thead>
           <tbody>
             <tr ng-repeat='item in listaVotosConcejales'>
                
                <td><img width="50" src="app_cliente/logos_partido/{{item.logo}}"/></td>
                <td style="font-weight:bold;">{{item.concejal}}</td>
                <td style="font-weight:bold;">{{item.partido}}</td>
                <td style="text-align:center;font-weight:bold;"><a href="">{{item.total_votos}}</a></td>                
                <td style="text-align:center;font-weight:bold;"><a href="">{{item.por_votar}}</a></td>
                <td style="text-align:center;font-weight:bold;"> <a href="">{{item.votos_registrados}}</a></td> 
                              
             </tr>
           </tbody>
           <tfoot>
             <th colspan="3" style="text-align:right;">
               Totales:
             </th>
             <th style="text-align:center;font-weight:bold;">
               {{listaVotosConcejales | sumByKey:'total_votos'}}
             </th>
              <th style="text-align:center;font-weight:bold;">
               {{listaVotosConcejales | sumByKey:'por_votar'}}
             </th>
              <th style="text-align:center;font-weight:bold;">
               {{listaVotosConcejales | sumByKey:'votos_registrados'}}
             </th>
           </tfoot>
         </table>

    
    
        
      
       

  </div>
          
   </div>
          </div>
      </div>

