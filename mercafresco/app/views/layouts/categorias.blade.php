    
    <div id="sidebar-wrapper-categorias" class="" ng-controller='CategoriaController' ng-init='obtenerTodos()'>
        <ul class="sidebar-nav">          
          <li role="presentation" ng-repeat='item in listaCategoria'>
          <a href="" ng-click='buscarporcategoria(item)'><span data-hover="Frutas y verduras">
          {{ item.NOMBRE.toLowerCase().capitalizeFirstLetter()}}</span></a></li></li>
        </ul>
    </div>
      <div id="back-fondo" ng-controller='ConfiguracionController' ng-click='abrirCategorias()' class='background-categorias'></div>