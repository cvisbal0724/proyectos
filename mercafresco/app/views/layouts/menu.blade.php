 <ul class="dropdown-menu dropdown-user">
     <li><a><i class="fa fa-male fa-fw"></i>Hola, {{ nombre.toLowerCase().capitalizeFirstLetter() }}</a></li>
     <li class="divider"></li>
     <li><a ui-sref="cuenta"><i class="fa fa-user fa-fw"></i>Editar mi perfil</a></li>
     <li><a ui-sref="historial"><i class="fa fa-list fa-fw"></i>Historial</a></li>     
     <li><a ui-sref='mis_direcciones' data-toggle="modal"><i class="fa fa-sitemap fa-fw"></i>Mis Direcciones</a></li>
     <li class="divider"></li>
     <li><a href="" data-toggle="modal" data-target="#cupon"><i class="fa fa-gift fa-fw"></i>Codigo Promocinal</a></li>
     <li class="divider"></li>
     <li><a href="" ng-click='logout()'><i class="fa fa-sign-out fa-fw"></i>Cerrar Sesión</a>
     </li>
 </ul>