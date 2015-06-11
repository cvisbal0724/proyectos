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
                    <label>Hola, [[ $nombres ]],</label>
                   </div>
                   <br>
                    <div class="form-group">
                    <p>Usted ha solicitado recordar su contraseña. </p>
                   </div>

                   <br>
                    
                    <div class="form-group">
                    <p>Para continuar y restablecer su contraseña haga <label><a href="[[$key]]" target="_blank">Click Aqui</a></label>.</p>                  
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