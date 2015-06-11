


<div class="container">
      <div class="row">
		<div class="col-md-8 col-md-offset-2">
         	<div class='panel-body'>
					<h3 class="text-center btn-block color-texto">DONDE NOS LOCALIZAMOS</h3>
					<br>
					<br>
					<br>
	            <div class="row">
	            <div class="col-xs-3">
	            <div class="table-responsive" style="height:530px;">
	            <table class="table table-hover">
	            	<th><label>Barrios</label></th>
	            	@foreach(BarrioProveedor::groupBy('id_barrio')->get() as $item)
	            		<tr><td>[[$item->barrio->NOMBRE]]</td></tr>
	            	@endforeach
	            </table>
	            </div>
			 </div> 					
			 <div class="col-xs-6">
	            		<iframe src="mas_informacion/mapa" width="750" height="530" style="border:0;"></iframe>
					</div>	            
	          	</div>
         	 </div>
		</div>
      </div>
</div>

