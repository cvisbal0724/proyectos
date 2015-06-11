 <div class='login-panel panel panel-default'>
          <div class="panel-heading">
        <h3 class="panel-title">PSE</h3>
      </div>
        <div class='panel-body'>
	         	<fieldset>
	         		  
                 <div class="form-group">
                 <label>Banco</label>
                       <select class="form-control" placeholder="" type="text">
                       <option value="0">[Bancos]</option>
                       @foreach($banks as $row)
                       <option value="[[$row->pseCode]]">[[$row->description]]</option>
                       @endforeach
                       </select>
                        <p></p>
                   </div>

                 <div class="form-group">
                 <label>Nombre del Comprador</label>
                       <input class="form-control" placeholder="" type="text" autofocus/>
                       <p></p>
                   </div>
                   <div class="form-group">
	         		   <label>Cédula</label>
                       <input class="form-control" placeholder="" type="text"/>
                       <p></p>
                   </div>
                   <div class="form-group">
	         		   <label>Teléfono</label>
                       <input class="form-control" placeholder="" type="text"/>
                       <p></p>
                   </div>

                   <div class="form-group">
                   <input type="button" class="btn btn-danger btn-lg pull-left" value="Comprar">
                  </div>                   
				</fieldset>
        </div>
		