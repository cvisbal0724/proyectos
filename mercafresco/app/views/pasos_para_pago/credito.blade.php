<div class='panel metodo-vista' >
<div class="panel-heading">
   <h3 class="panel-title">Tarjeta de Crédito</h3>
</div>
<div class='panel-body'>
   <fieldset>
      <div class="form-group">
         <label>Nombre (tal como aparece en tu tarjeta)</label>
         <input class="form-control" placeholder="" type="text" autofocus ng-model='pago_credito.nombre'/>
         <p></p>
      </div>
      <div class="form-group">
         <label>Número de tarjeta</label>
         <input class="form-control" placeholder="" type="text" ng-model='pago_credito.tarjeta'/>
         <p></p>
      </div>
      <div class="form-group">
         <label>Código de seguridad</label>
         <input class="form-control" placeholder="" type="text" ng-model='pago_credito.codigo_seguridad'/>
         <p></p>
      </div>
      <div class="form-group">
         <label>Fecha de expiración</label>
         <div class='row'>

          <div class='col-xs-5'>
               <select class="form-control" placeholder="" type="text" ng-model='pago_credito.mes'>
                  <option value='0'>[Mes Expiración]</option>
                  @for($i=1; $i <= 12; $i++)
                  <option value='[[$i < 10 ? "0".$i : $i ]]'>[[$i < 10 ? "0".$i : $i ]]</option>
                  @endfor
               </select>
            </div>
            <div class='col-xs-7'>
               <select class="form-control" placeholder="" type="text" ng-model='pago_credito.ano'>
                  <option value='0'>[Año Expiración]</option>
                  @for($i=2014; $i <= 2034; $i++)
                  <option value='[[$i]]'>[[$i]]</option>
                  @endfor
               </select>
            </div>
           
         </div>
      </div>
      <div class="form-group">
         <label>Número de cuotas</label>
         <select class="form-control" placeholder="" type="text" ng-model='pago_credito.numero_cuotas'>
            <option value="0">[Cuotas]</option>
            @for($i=1; $i <= 12; $i++)
            <option value='[[$i]]'>[[$i]]</option>
            @endfor
         </select>
         <p></p>
      </div>
   </fieldset>
   <fieldset class="mt-20">
      <div class="form-group">
         <a class="btn btn-primary btn-lg pull-left" ui-sref='tiempos'>Atrás</a>
         <input type="button" class="btn btn-danger btn-lg pull-right" value="Comprar" ng-click='pago_con_tarjeta_credito()'>
      </div>
   </fieldset>
</div>

<div class="modal fade" id="modalMetodoPagoCredito">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Mensaje</h4>
         </div>
         <div class="modal-body">
            <div class="alert alert-warning" role="alert">
               <i class="fa fa-exclamation-triangle fa-4"></i>
               <strong>{{ mensaje }}</strong>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
   </div>
</div>