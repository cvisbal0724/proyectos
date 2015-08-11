<div class="col-lg-12">
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Registrar Voto
   </h4>

		<div class="panel-body">

			<div class="row">

			 <div class="col-lg-6">
	        	 <div class="panel panel-default">
			       <div class="panel-heading">
			          Informacion del votante 
			       </div>

			        <div class="panel-body"> 

			        	<div class="form-group">
			                <label>Cedula:</label>	
			                <span>{{votanteVO.persona.cedula}}</span>		                
			            </div>
			        	<div class="form-group">
			                <label>Votante:</label>	
			                <span>{{votanteVO.persona.nombre + ' ' + votanteVO.persona.apellido}}</span>		                
			            </div>
		        		<div class="form-group">
			                <label>Lider:</label>	
			                <span>{{votanteVO.lider.persona.nombre + ' ' + votanteVO.lider.persona.apellido}}</span>		                
			            </div>

			             <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
             			</div>

			            <button type="button" class="btn btn-warning" >Registrar Voto</button>  
			        </div>

			      </div>   
	        </div>  


			</div>
			
		</div>

	</div>
</div>   