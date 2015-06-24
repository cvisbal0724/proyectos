<div class="container">
      <div class="row">
      <div class="panel-body">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-default  resumen-canasta">
            <div class="panel-heading">
              <h2>Direcciones</h2>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <h4>¿Donde desea que le entreguemos su pedido?</h4>
              <div class="row">
                <hr>
                <div class="col-md-4" ng-repeat='item in listaDirecciones'>
                  <div class="panel panel-{{ direccionseleccionada==item.ID ? 'red' : 'green' }}">
                    <a href="" ng-click='seleccionarDireccion(item)'>
                      <div class="panel-heading clearfix">
                      <h4 class="pull-left">{{ item.NOMBRE_SITIO.toLowerCase().capitalizeFirstLetter()}}</h4>
                      <h4 class="btn btn-danger pull-right" ng-click='seleccionarDireccion(item)'>Confirmar</h4>
                      </div>
                      <div class="panel-body">
                        <address>
                          <strong>{{ item.barrio.NOMBRE.toLowerCase().capitalizeFirstLetter() }}</strong>
                          <br>{{ item.barrio.municipio.departamento.NOMBRE.toLowerCase().capitalizeFirstLetter() + ', ' + item.barrio.municipio.NOMBRE.toLowerCase().capitalizeFirstLetter()}}
                          <br>Colombia
                          <br>Telefono: {{ item.TELEFONO }}
                          <br>Quien recibe: {{ item.QUIEN_RECIBE }}
                                                   
                        </address>
                      </div>
                    </a>
                    <div class="panel-footer">
                      <a href="" ng-click='obtenerDireccion(item)'><span class="fa fa-edit"></span> Editar</a>
                      <a href="" ng-click='abrirPegunta(item)' class="pull-right"><span class="fa fa-trash-o"></span> Quitar</a>
                    </div>
                  </div>                 
                </div>

              <!-- <div class="col-md-4">
                  <div class="panel panel-green">
                    <a href="">
                      <div class="panel-heading clearfix">
                        <h4 class="pull-left">Casa</h4>
                        <h4 class="pull-right">[ seleccionar ]</h4>
                      </div>
                      <div class="panel-body">
                        <address>
                          <strong>Twitter, Inc.</strong>
                          <br>795 Folsom Ave, Suite 600
                          <br>San Francisco, CA 94107
                          <br>
                          <abbr title="Phone">P:</abbr>(123) 456-7890
                        </address>
                      </div>
                    </a>
                    <div class="panel-footer">
                      <a href="" ><span class="fa fa-edit"></span> Editar</a>
                      <a href="" class="pull-right"><span class="fa fa-trash-o"></span> Quitar</a>
                    </div>
                  </div>
                 
                </div>

                <div class="col-md-4">
                  <div class="panel panel-yellow">
                    <a href="">
                      <div class="panel-heading clearfix">
                        <h4 class="pull-left">Empresa</h4>
                        <h4 class="pull-right">[ seleccionar ]</h4>
                      </div>
                      <div class="panel-body">
                        <address>
                          <strong>Twitter, Inc.</strong>
                          <br>795 Folsom Ave, Suite 600
                          <br>San Francisco, CA 94107
                          <br>
                          <abbr title="Phone">P:</abbr>(123) 456-7890
                        </address>
                      </div>
                    </a>
                    <div class="panel-footer">
                      <a href="" ><span class="fa fa-edit"></span> Editar</a>
                      <a href="" class="pull-right"><span class="fa fa-trash-o"></span> Quitar</a>
                    </div>
                  </div>
                 
                </div>-->
              </div>
              <!-- /.row -->
              <hr>
              <p>
              <a class="btn btn-primary btn-lg pull-left" ui-sref='productos'>Atrás</a>
                <a class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#modalDireccion">Crear Dirección</a>
              </p>
            </div>
          </div>
          <!-- /.panel-body -->
        </div>
        </div>
        <!-- /.panel -->
      </div>
        @include('layouts.footer')
    </div>

        <!-- Modal -->
    <div class="modal fade" id="modalDireccion">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Crear o editar</h4>
          </div>
          <div class="modal-body">
            <form role="form">
              <fieldset>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input class="form-control" placeholder="Casa, Apartamento o Empresa" type="text" ng-model='direccionPersona.nombre_sitio' autofocus>
                      <p>(*) Ingrese el nombre</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" placeholder="Dirección" type="text" ng-model='direccionPersona.direccion' autofocus/>
                      <p>(*) Ingrese la dirección</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <select id="barrio" name="barrio" class="form-control" ng-model='direccionPersona.id_barrio'>
                      <option value="0">[Seleccione...]</option>
                      <option ng-repeat='item in listaBarrios' value="{{ item.id }}">{{item.nombre}}</option>
                      </select>
                      <p>(*) Seleccione el barrio</p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" placeholder="Telefono" type="text" ng-model='direccionPersona.telefono' autofocus/>
                      <p>(*) Ingrese el teléfono</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" placeholder="Quien Recibe.." ng-model='direccionPersona.quien_recibe' type="text" autofocus/>
                      <p>(*) Ingrese el quién recibe</p>
                    </div>
                  </div>
                </div>
              
                <div class="form-group">
                    <div ng-show='result.show' class="alert alert-{{ result.alert }}" role="alert">
                    <!--<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>-->
                    <strong>{{result.msg}} </strong>
                     <a ng-show='result.alert=="success"' ui-sref="productos" class="alert-link">Ir a Inicio</a>              
                    </div>
                  </div>
             
              </fieldset>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" ng-click='crearDireccion()'>{{ direccionPersona.id > 0 ? 'Actualizar' : 'Crear' }}</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


     <!-- Modal -->
    <div class="modal fade" id="modalPregunta">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>           
            <h4 class="modal-title">Confirmar</h4>
          </div>
          <div class="modal-body">

           <div class="alert alert-success" role="alert">
           <i class="fa fa-exclamation-triangle fa-4"></i>
           <strong>Desea quitar temporalmete la direccion {{ direccion.NOMBRE_SITIO.toLowerCase().capitalizeFirstLetter() + ', ' + direccion.DIRECCION }}</strong>
            </div>
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary" ng-click='quitarDireccion()'>Quitar</button>      
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->