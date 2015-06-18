<div class="container">
      <div class="row">
      <div class="panel-body">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default  resumen-canasta">
            <div class="panel-heading">
              <h2>Respuesta de transacción</h2>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              
              <div class="row">
               <div class="panel-body">
               	<h4>[[$respuestabanco['msg'] ]]</h4>
               </div>         
              </div>
              <hr>
              <p>
               	
               	<a class="btn btn-primary btn-lg pull-left" href="" ng-click="terminar_proceso_de_pago_bancario()">Terminar</a>
                <a class="btn btn-danger btn-lg pull-right" href="" ng-click="reintentar_pago()">Reintentar</a>

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