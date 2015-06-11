<!--<ng-include src="'layouts/header'"></ng-include>-->

<header class="header-principal">

<!--<ng-include src="'layouts/encabezadoinicio'"></ng-include>
<ng-include src="'layouts/masinformacion'"></ng-include>-->
@include('layouts.encabezadoInicio')
@include('layouts.masInformacion')
</header>

@include('layouts.boton_atras')

<div id="wrapper" class="toggled">
 
 <!--<ng-include src="'layouts/categorias'"></ng-include>  -->
<!--<ng-include src="'layouts/canasta'"></ng-include>-->
@include('layouts.encabezadoInicio')
@include('layouts.masInformacion')

<div id="page-content-wrapper">
<div class="marketing">

            
               <div class="ruler with-header" ng-repeat-start='prod in listaProductos'>
                  <header class="">
                     <h2 class="pull-left"><a href="" ng-click='buscarporcategoria_2(prod.id_categoria,prod.categoria)'>{{ prod.categoria.toLowerCase().capitalizeFirstLetter() }}</a></h2>
                      
                       <a ng-if='!idcategoria > 0' class="btn btn-default pull-right" ng-click='buscarporcategoria_2(prod.id_categoria,prod.categoria)' role="button">Ver más</a>
                    
                  </header>
               </div>
               <!-- 4 Columnas de productos-->
               <div class="row" ng-repeat-end>
                  
                  <div class="item" ng-repeat='obj in prod.productos'>
                     <div class="wrapper">
                        <div class="item-select" ng-show='buscarenJsonporid(obj.id,listaCanasta)[0].cantidad > 0'>
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        {{ buscarenJsonporid(obj.id,listaCanasta)[0].cantidad || 0 | setDecimal:2 }}                       
                        </div>
                        <a href="" data-toggle="modal" ng-click='modalProducto(obj)' class="clearfix">
                           <div class="item-image"> 
                              <img class="" src="productos/{{obj.imagen}}" alt="Generic placeholder image" >
                           </div>
                        </a>   
                        <div class="item-caption">
                           <div class="btn-card hidden-xs">
                              <a class="btn btn-default" role="button" ng-click="agregarCantidades(obj,'-',false)">-</a>
                              <input type="text"  ng-model='obj.cantidad' numeric-only ng-keypress="keydown($event)"/>
                              <a class="btn btn-default" role="button" ng-click="agregarCantidades(obj,'+',false)">+ </a>
                              <a ng-show='!buscarenJsonporid(obj.id,listaCanasta)[0].cantidad > 0' class="btn btn-default" role="button" ng-click='agregarCanasta(obj)'><span class="glyphicon glyphicon-shopping-cart"></span> Agregar</a>
                               <a ng-show='buscarenJsonporid(obj.id,listaCanasta)[0].cantidad > 0' class="btn btn-default" role="button" ng-click='agregarCanasta(obj)'><span class="glyphicon glyphicon-shopping-cart"></span> Editar</a>
                           </div>
                              <h2> {{ obj.productos_ofrecidos + ' ' + obj.unidad.toLowerCase().capitalizeFirstLetter() + ' ' + obj.nombre }}</h2>
                              <p>{{ obj.descripcion }}</p>
                              <span class="item-price">{{ obj.precio | currency:'$':0 }}</span>
                        </div>
                     </div>
                  </div>

               </div>
            

               <!-- START THE FEATURETTES -->
               <hr class="featurette-divider"/>
               <!-- /END THE FEATURETTES -->
               <!-- FOOTER --> 

               <!--<ng-include src="'layouts/footer'"></ng-include>-->

               @include('layouts.footer')

            </div>
 </div>           

   <!-- Modal -->
    <div class="modal fade" id="modalValidarProducto">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>           
            <h4 class="modal-title">Información</h4>
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
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

     <!-- Modal -->
    <div class="modal fade" id="modalProductos" tabindex="-1" role="dialog" aria-labelledby="modalProductos" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" aria-label="Close" style="margin-top:-9px;" ng-click='cerrarModalProducto()'><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
           <div class="item-select" ng-show='buscarenJsonporid(producto.id,listaCanasta)[0].cantidad > 0' style="font-size:25px;">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        {{ buscarenJsonporid(producto.id,listaCanasta)[0].cantidad || 0 | setDecimal:2 }}                       
                        </div>
            <img class="" src="productos/{{producto.imagen}}" alt="Generic placeholder image" height="150px">
            <h2>{{ producto.productos_ofrecidos + ' ' + producto.unidad.toLowerCase().capitalizeFirstLetter() + ' ' + producto.nombre }}</h2>
            <p>{{ producto.descripcion }}</p>
            <span class="item-price">{{ producto.precio | currency:'$':0 }}</span>
          </div>
          <div class="modal-footer">
            <div class="btn-card">
              <a class="btn btn-default " href="" role="button" ng-click="agregarCantidades(producto,'-',false)">-</a>
              <input type="text" ng-model='producto.cantidad' numeric-only ng-keypress="keydown($event)"/>
               <a class="btn btn-default" href="" role="button" ng-click="agregarCantidades(producto,'+',false)">+</a>
              <a class="btn btn-default" href="" role="button" ng-click='agregarCanasta(producto)' ng-show='!buscarenJsonporid(producto.id,listaCanasta)[0].cantidad > 0'><span class="glyphicon glyphicon-shopping-cart"></span> Agregar</a>
              <a class="btn btn-default" href="" role="button" ng-click='agregarCanasta(producto)' ng-show='buscarenJsonporid(producto.id,listaCanasta)[0].cantidad > 0'><span class="glyphicon glyphicon-shopping-cart"></span> Editar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>