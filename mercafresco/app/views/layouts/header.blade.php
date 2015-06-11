<header class="header-principal">

<!--<ng-include src="'layouts/encabezadoinicio'"></ng-include>
<ng-include src="'layouts/masinformacion'"></ng-include>-->

@include('layouts.encabezadoInicio')
@include('layouts.barra')

</header>

<div class='secondary-nav visible-xs-block' 
style="text-align:left;margin-left:30px;">
   <hr>                  
   <a href="" ng-click='backPage()' style='color:#004415'>
      <i class='fa fa-angle-left fa-2x'></i>
   </a>
   <hr>
</div>