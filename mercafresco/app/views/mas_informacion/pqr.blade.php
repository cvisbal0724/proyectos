 <div class="container">
      <div class="row">
        
         <div class="col-md-6 col-md-offset-3">

         <div class='login-panel panel panel-default'>
            <div class="panel-heading">
                <h3 class="panel-title">PQR-Formulario de Sugerencias</h3>
            </div>
                <div class='panel-body'>

                <fieldset>
                   
                   <div class="form-group">
                       <label>Nombres</label>
                       <input class="form-control" placeholder="Nombres" type="text" autofocus ng-model='pqr.nombres'/>
                       <p>(*) Ingrese sus nombres</p>
                   </div>
                   <div class="form-group">
                       <label>Apellidos</label>
                       <input class="form-control" placeholder="Apellidos" type="text" ng-model='pqr.apellidos'/>                       
                   </div>

                    <div class="form-group">
                       <label>Correo</label>
                       <input class="form-control" placeholder="Correo" type="text" 
                                              ng-model='pqr.email'/>
                        <p>(*) Ingrese su correo</p>
                   </div>

                    <div class="form-group">
                       <label>Telefono</label>
                       <input class="form-control" placeholder="Telefono" type="text" ng-model='pqr.telefono'/>
                       
                   </div>

                    <div class="form-group">
                       <label>Sugerencia</label>
                       <select class="form-control" type="text" 
                       ng-model='pqr.id_tipo_pqr'>
                       <option value="">[Seleccionar...]</option>
                       @foreach(TipoPQR::all() as $row)
                        <option value="[[$row->ID]]">[[$row->NOMBRE]]</option>
                       @endforeach
                       </select>
                        <p>(*) Seleccione el tipo de sugerencia</p>
                   </div>
                        
                   <div class="form-group">
                   <label>Comentario</label>
                     <textarea required="" rows="5" cols="55" class="form-control" ng-model='pqr.comentario'></textarea>
                     <p>(*) Ingrese su comentario</p>
                   </div>           

                  <div class="form-group">
                   <input type='button' class="btn btn-primary" value='Enviar' ng-click='guardarPQR()'/>
                  </div>

                  <div class="form-group">
                    <div ng-show='result.show' class="alert alert-{{ result.alert }}" role="alert">
                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                    <strong>{{result.msg}} </strong>
                     <a ng-show='result.alert=="success"' ui-sref="productos" class="alert-link">Ir a Inicio</a>              
                    </div>
                  </div>

                </fieldset>
            </div>
         </div>
             
        </div>
     </div>
     <ng-include src="'layouts/footer'"></ng-include>
</div>

 