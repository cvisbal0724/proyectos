<div class="col-lg-12">
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Registrar Votante
   </h4>

       <div class="panel-body">
      	<div class="col-lg-6">

        <div class="panel panel-default">
       <div class="panel-heading">
          Informacion del votante 
       </div>  

       <div class="panel-body"> 

          <div class="form-group">
                <label>Votar por</label>
                <select class="form-control" ng-model='votanteVO.id_categoria_votacion'>
                  <option value="0">[Seleccione..]</option>
                  @foreach($categoriaVotacion as $item)
                  <option value="[[$item->id]]">[[$item->nombre]]</option>
                  @endforeach
                </select>
                <p class="help-block">(*)Seleccion por quién va a votar</p>
            </div>

          <div class="form-group">
                <label>Tipo Voto</label>
                <select class="form-control" ng-model='votanteVO.id_tipo_voto'>
                  <option value="0">[Seleccione..]</option>
                  @foreach($tipovoto as $item)
                  <option value="[[$item->id]]">[[$item->nombre]]</option>
                  @endforeach
                </select>
                <p class="help-block">(*)Seleccione el tipo de voto</p>
            </div>

             <div class="form-group" ng-show="votanteVO.id_tipo_voto==2">
                <label>Comentario</label>
                <textarea rows="3" cols="50" class="form-control" ng-model='votanteVO.comentario'></textarea>
                <p class="help-block">(*)Ingrese un comentario</p>
            </div>

      		<div class="form-group">
                <label>Concejal</label>
                <select class="form-control" ng-model='votanteVO.id_concejal'>
                  <option value="0">N/A</option>
                  @foreach($concejales as $item)
                  <option value="[[$item->id]]">[[$item->concejal]]</option>
                  @endforeach
                </select>
                <p class="help-block"></p>
            </div>

             <div class="form-group">
                <label>Zona</label>
                <select class="form-control" ng-model='id_zona' ng-change="obtener_lugares_votacion()">
                  <option value="0">[Seleccione..]</option>
                  @foreach($zonas as $item)
                  <option value="[[$item->id]]">[[$item->nombre]]</option>
                  @endforeach
                </select>
                <p class="help-block"></p>
            </div>

            <div class="form-group">
                <label>Lugar de votación</label>
                <select class="form-control" ng-model='votanteVO.id_lugar_de_votacion'>
                  <option value="0">[Seleccione..]</option>
                 
                  <option ng-repeat="item in listaVotacion" value="{{item.id}}">{{item.nombre}}</option>
                  
                </select>
                <p class="help-block"></p>
            </div>

            <div class="form-group">
                <label>Numero de la mesa</label>
                <input type="text" class="form-control" ng-model='votanteVO.numero_mesa'>
                <p class="help-block"></p>
            </div>
            
        
        
        </div>   
       </div>     
            

      	</div>

        <div class="col-lg-6">
          
            <div class="panel panel-default">
       <div class="panel-heading">
          Informacion de la persona 
       </div> 
      
       <div class="panel-body">   

       <a href="" data-toggle="modal" data-target="#modalPersona" title="Agregar Persona">
         <i class="fa fa-plus fa-2x"></i>
       </a>
       
        <div class="form-group">

            <div class="form-group input-group">
                <input type="text" class="form-control" placeholder="Buscar Persona" ng-model="criterio"
                ng-keyup="$event.keyCode == 13 && consultar_persona_por_criterios()">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search" ng-click="consultar_persona_por_criterios()"></i>
                    </button>
                </span>
             </div>
             <select multiple="" class="form-control" ng-model="votanteVO.id_persona" ng-multiple="true" ng-change="test(1)">
                 <option ng-repeat="item in listaPersonas" value="{{item.id}}">{{item.cedula+' / ' + item.nombre + ' ' + item.apellido }}</option>
             </select>
              <p class="help-block">(*)Seleccione una persona</p>
        </div>
       </div>

       </div>

        </div>

        <div class="col-lg-12">
          
           <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
             </div>
            
       <button ng-if='votanteVO.id==0' type="button" class="btn btn-warning" ng-click='crear()'>Registrar</button>  
       <button ng-if='votanteVO.id>0' type="button" class="btn btn-warning" ng-click='actualizar()'>Actualizar</button>  
       <button type="button" class="btn btn-danger" ng-click='nuevo()'>Limpiar</button>           

        </div>
      </div>

 </div>
</div>

