@extends('layouts_2.layoutVistas')

@section('content')


<div class="row">
	
	<br>

<div class="col-md-8 col-md-offset-2">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-align:center;">Merca Fresco</h3>
 					</div>
	 			</div>

	 			 <div class="panel-body">
                    <div class="form-group">
                    <label>[[ $nombres ]],</label>
                   </div>
                   <br>
                    <div class="form-group">
                    <p>Le informamos que su egistro en la plataforma se ha realizado exitosamente, sus datos de ingreso son los siguientes: </p>
                   </div>

                   <br>

                    <div class="form-group">
                    <label>Usuario: </label>
                   	[[$usuario]]
                   </div>

                    <div class="form-group">
                    <label>Contraseña: </label>
                    [[$clave]]
                    </div>

                    <div class="form-group">
                    <p>Para poder acceder a la plataforma debe activar su cuenta. Para activar la cuenta presione <label><a href="[[$key]]" target="_blank">Clic Aqui</a></label>.</p>                  
                    </div>
                    <br>
                    <div>
                    	<p>
                    		Cordialmente,
                    	</p>
                    	<br>
                    	<label>
                    		Merca Fresco
                    	</label>
                    </div>

                 </div>
  </div>
</div>



@stop