 <div class="container">
      <div class="row">
      <div class="panel-body">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default  resumen-canasta">
            <div class="panel-heading">
              <h2>Fecha de Entrega</h2>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <h4>¿Cuando desea que le entreguemos su pedido?</h4>
              <div class="row">
                <!--<div class="col-xs-6">
                <a class="btn btn-primary btn-lg pull-left" >Fecha Ant..</a>
              </div>-->
                <!--<div class="col-xs-6"><a class="btn btn-danger btn-lg pull-right" >Fecha Sig..</a></div>-->
                <hr>

                <!--<div class="panel panel-default dia" ng-repeat='item in listaTiempos' ng-init='indexParent=$index'>
                  <div class="panel-heading">
                    <h3 class="panel-title">{{ item.encabezado }}</h3>
                  </div>
                  <div class="panel-body">
                      <div class="radio radio-success" ng-repeat='h in item.horas' style='text-align:left;'>
                          <input type="radio" name="radio2" ng-attr-id="radio{{indexParent}}{{$index}}" ng-checked='h.chequeado' value="option1" ng-disabled='!h.mostrar' ng-click='seleccionar_tiempo($event,e.id,h)'/>
                          <label ng-attr-for="radio{{indexParent}}{{$index}}" style='font-size:13px;'>{{h.estimado}}</label>
                      </div>                      
                  </div>
                </div>-->

                @foreach($listaTiempos as $key=>$item)
                <div class="panel panel-default dia">
                  <div class="panel-heading">

                    <h3 class="panel-title">[[ $semana[date('w',strtotime($item['encabezado']))-1].' '.date('d',strtotime($item['encabezado'])) ]]</h3>
                  </div>
                  <div class="panel-body">
                    @foreach($item['horas'] as $key2=> $h)
                      <div class="radio radio-success" style='text-align:left;'>
                          <input type="radio" name="radio2" id="radio[[$key.''.$key2]]" [[$h["chequeado"]==true ? 'checked' : '' ]] value="option1" [[$h["mostrar"]!=true ? 'disabled' : ''  ]] ng-click='seleccionar_tiempo($event,e.id,"[[$h["hora"] ]]","[[$h["fecha"] ]]")'/>
                          <label for="radio[[$key . '' . $key2]]" checked="[[$h['chequeado'] ]]" style='font-size:13px;'>[[ $h["mostrar"]!=true ? ' ' : $h['estimado'] ]]</label>
                      </div>   
                       @endforeach                   
                  </div>
                </div>
                @endforeach
               
              </div>
              <hr>
              <p>
                <a class="btn btn-primary btn-lg pull-left" ui-sref='direcciones'>Atrás</a>
                <!--<a class="btn btn-danger btn-lg pull-right" ng-controller='OrdenServicioController' ng-click='crear_ordenservicio()'>Pon tu orden aquí</a>-->
                <a class="btn btn-danger btn-lg pull-right" ng-click='irMetodos_de_pago()'>Siguiente</a>

              </p>
            </div>
          </div>
          <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        </div>
      </div>
        @include('layouts.footer')
    </div>

   <div class="modal fade" id="modalTiempos">
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
   