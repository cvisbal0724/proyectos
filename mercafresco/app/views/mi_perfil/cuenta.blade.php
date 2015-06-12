 <div class="container" data-ng-init='cargarcuenta()'>
      <div class="row">
        <div class="panel-body">
         <div class="col-md-6 col-md-offset-3">

         <div class='login-panel panel panel-default'>
         	<div class="panel-heading">
				<h3 class="panel-title">Cuenta</h3>
			</div>
				<div class='panel-body'>

	         	<fieldset>
	         		<div class="form-group">
	         		   <label>Fecha de Registro</label>
                       <input class="form-control" placeholder="Fecha de Registro" type="text" 
                        ng-model='cuenta.fecha_registro' disabled='disabled'/>                        
                   </div>
                   <div class="form-group">
	         		   <label>Usuario</label>
                       <input class="form-control" placeholder="Usuario" type="text"
                       ng-model='cuenta.usuario' disabled='disabled'/>
                   </div>
                   <div class="form-group">
	         		      <label>Cortesia</label>                       
                    <select class="form-control" ng-model='cuenta.cortesia'>
                       <option value='0'>[Seleccional..]</option>
                       <option value='1'>Sr</option>
                       <option value='2'>Sra</option>
                    </select>
                    <p>(*) Seleccione la cortesia</p>
                   </div>
                   <div class="form-group">
  	         		    <label>Tipo de identificación</label>
                    <select class="form-control" ng-model='cuenta.id_tipo_identificacion'>
                    <option value='0'>[Seleccional..]</option>
                    <!--<option ng-repeat='item in tipoIdentificacion' value='{{item.ID}}'>{{item.NOMBRE}}</option>-->
                    @foreach($tiposIdentificacion as $item)
                      <option value='[[$item->ID]]'>[[$item->NOMBRE]]</option>
                    @endforeach
                    </select>
                    <p>(*) Seleccione el tipo identificación</p>
                   </div>
                    <div class="form-group">
                 <label>Identificación</label>
                       <input class="form-control" placeholder="No. Identificación" type="text"
                       ng-model='cuenta.no_identificacion'/>
                       <p>(*) Ingrese su numero de identificación</p>
                   </div>
                   <div class="form-group">
	         		   <label>Nombres</label>
                       <input class="form-control" placeholder="Nombres" type="text" autofocus
                       ng-model='cuenta.nombres'/>
                       <p>(*) Ingrese sus nombres</p>
                   </div>
                   <div class="form-group">
	         		   <label>Apellidos</label>
                       <input class="form-control" placeholder="Apellidos" type="text"
                       ng-model='cuenta.apellidos'/>
                       <p>(*) Ingrese sus apellidos</p>
                   </div>

                    <div class="form-group">
	         		   <label>Correo</label>
                       <input class="form-control" placeholder="Correo" type="text"
                       ng-model='cuenta.correo'/>
                        <p>(*) Ingrese su correo</p>
                   </div>

                    <div class="form-group">
	         		   <label>Telefono</label>
                       <input class="form-control" placeholder="Telefono" type="text"
                       ng-model='cuenta.telefono'/>
                        <p>(*) Ingrese su telefono</p>
                   </div>

                    <div class="form-group">
	         		   <label>Celular</label>
                       <input class="form-control" placeholder="Celular" type="text"
                       ng-model='cuenta.celular'/>
                        <p>(*) Ingrese su celular</p>
                   </div>
                  
                  <!-- <div class="form-group">
                     <label>Fecha de Nacimiento</label>
                     <div class='input-group date' id='datetimepicker1'>                                               
                      <input type='text' class="form-control" placeholder='DD-MM-AAAA' ng-model='cuenta.fecha_nacimiento'/>
                      <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                     </div>
                      <p>(*) Ingrese su fecha de nacimiento</p>
                   </div>-->
	         	 
                  <hr>
                <h4 class="text-warning btn-block">Cambiar Contraseña</h4>
                   <div class="form-group">
                    <label>Nueva Contraseña</label>
                       <input class="form-control" placeholder="Nueva Contraseña" type="password"
                       ng-model='cuenta.clave'/>                       
                   </div>

                    <div class="form-group">
                        <label>Confirmar Contraseña</label>
                       <input class="form-control" placeholder="Confirmar Contraseña" type="password"
                       ng-model='cuenta.conf_clave'/>                       
                   </div>

                  <div class="form-group">
                   <input type='button' class="btn btn-primary" value='Actualizar' ng-click='modifcarUsuario()'/>
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
	 </div>
     @include('layouts.footer')
</div>

 <script src="app_cliente/js/min/moment.min.js"></script>
 <script src="app_cliente/js/locale/es.js"></script>
 <script src="app_cliente/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
     $(function () {
     $('#datetimepicker1').datetimepicker({
         locale: 'es',
         format: 'DD-MM-YYYY'
     });

     $("#datetimepicker1").on("dp.change",function (e) {
        //$('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
     });

     });
</script>