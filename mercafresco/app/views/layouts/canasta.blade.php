
   <div id="sidebar-wrapper" id='dvcanasta'>
        <div class="wrapp">
          <ul class="sidebar-nav">
            <li class="sidebar-brand">
              Carrito de Compra <a href="" id="menu-toggle2" class="pull-right">×</a>
            </li>
            <li class="sidebar-brand">
              <a href="">
              <span class="pull-right"><span class="label label-warning">{{ totalCanasta | currency:'$':0 }}</span></span>
              <span class="pull-left"><span class="label label-warning">{{totalUnidades}}</span> artículos</span>
              </a>
            </li>
            <table class="table table-hover" data-height="299" ng-init='total=item.precio'>
              <tbody>
                <!-- ngRepeat: item in listaCanasta -->
                <tr ng-repeat="item in listaCanasta" class="tr-class-1 ng-scope">
                  <td style="width:20%">
                    <table>
                      <tbody>
                        <tr>
                          <td style="text-align:center">
                            <a href="" ng-click="agregarCantidades(item,'+',true)" style="cursor:pointer">
                            <i class="fa fa-caret-up fa-2x"></i>
                            </a>
                            <div>
                              <!--<input  ng-model="item.cantidad" style="text-align:center;width:80%" class="ng-pristine ng-untouched ng-valid">-->
                              <span>{{item.cantidad | setDecimal:2 }}</span>
                            </div>
                            <a href="" ng-click="agregarCantidades(item,'-',true)" style="cursor:pointer">
                            <i class="fa fa-sort-desc fa-2x"></i>
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td>                          
                    <img ng-click='buscarProductoporid(item)' style="cursor:pointer;" src="{{ item.imagen }}" alt="Generic placeholder image" class="card-item-img">                       
                  </td>
                  <td class="ng-binding"><a href="" ng-click='buscarProductoporid(item)'>{{ item.nombre }} </a></td>
                  <td class="ng-binding">{{ (item.cantidad * item.precio) | currency:'$':0  }}</td>
                  <td>
                    <div class="pull-right" style="cursor:pointer">
                      <a ng-click="removerCanasta(item)"><span class="glyphicon glyphicon-remove"></span></a>
                    </div>
                  </td>
                </tr>                
              </tbody>
            </table>
            <div class="card-resumen">
              <p class="text-right">Total productos: <b>{{ totalCanasta | currency:'$':0 }}</b></p>
              <p class="text-right">Transporte: <b>$0</b></p>
              <p class="text-right">Total incluído transporte: <b>{{ (totalCanasta) | currency:'$':0 }}</b></p>
          </div>
          </ul>
          <div class="checkout">
            <button type="button" class="btn btn-danger btn-lg btn-block" ng-click='checkout()'>Siguiente</button>
          </div>
        </div>

          
      </div>


        <script type="text/javascript">


             $("#menu-toggle2").click(function(e) {
                 e.preventDefault();
                 $("#wrapper").toggleClass("toggled");
             });

            </script>