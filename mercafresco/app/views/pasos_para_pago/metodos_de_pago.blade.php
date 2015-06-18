<div class="container">
      <div class="row">
      <div class="panel-body">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default  metodos-pagos">
            <div class="panel-heading">
              <h2>Métodos de pago.</h2>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <!--<p>Seleccione su metodo de pago.</p>-->
              <div class="row">
               
                <!--<hr>-->
                <!--<div class="col-lg-12 metodos-pago" >
                    <img src="[[ asset('app_cliente/img/PEPSized_Bitcoin01.png') ]]" alt="Efectivo">  
                    <img src="[[ asset('app_cliente/img/PEPSized_PayU.png') ]]" alt="PayU Latam">
                    <img src="[[ asset('app_cliente/img/PEPSized_Visa.png') ]]" alt="Visa">
                    <img src="[[ asset('app_cliente/img/PEPSized_Mastercard.png') ]]" alt="Master Card">
                    <img src="[[ asset('app_cliente/img/PEPSized_DinersClub02.png') ]]" alt="Diners Club">
                    <img src="[[ asset('app_cliente/img/PEPSized_AmericanExpress02.png') ]]" alt="American Express"> 
                </div>-->
                <div class="col-lg-12" ng-init='color="rgba(79, 157, 63, 1)"'>
                  
                  <table class="table table-condensed metodos">
                    <tr >
                      <td ng-class='metodo_seleccionado=="1" ? "metodo-seleccionado" :""'>
                      <label style='width:100%;'>
                         <input name='metodopago' type="radio" ng-model='metodo_seleccionado' value='1'
                         ng-click='vermetodosdepago()'> 
                        Paga en Efectivo
                      </label>                       
                      </td>
                      <td ng-class='metodo_seleccionado=="3" ? "metodo-seleccionado" :""'>
                      <label>                       
                        <input ng-model='metodo_seleccionado' name='metodopago' type="radio" value='3' 
                        ng-click='vermetodosdepago()'> 
                         Tarjeta de Crédito 
                      </label>                       
                      </td>
                      <td ng-class='metodo_seleccionado=="4" ? "metodo-seleccionado" :""'>
                        <label style='width:100%;'>
                        <input name='metodopago' type="radio" ng-model='metodo_seleccionado' value='4'
                        ng-click='vermetodosdepago()'> 
                        PSE / Tarjetas Débito
                      </label>   
                      </td>
                    </tr>
                  </table>
                 <ui-view></ui-view>
                </div>
              </div>
            </div>
          </div>
          <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        </div>
      </div>
        @include('layouts.footer')
    </div>

    <div class="modal fade" id="modalMetodoPago">
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
   