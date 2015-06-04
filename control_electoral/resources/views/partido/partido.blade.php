<div class="col-lg-12">
 <div class="panel panel-default">
 	 <div class="panel-heading">
         Registrar Partido
      </div>

      <div class="panel-body">
      	<div class="col-lg-6">

      		<div class="form-group">
                <label>Partido</label>
                <input class="form-control" type='text' ng-model='partidoVO.nombre'>
                <p class="help-block">(*)Ingrese el partido</p>
            </div>
			 <button type="button" class="btn btn-primary" ng-click='guardar()'>Registrar</button>           
      	</div>
      </div>
 </div>
</div>