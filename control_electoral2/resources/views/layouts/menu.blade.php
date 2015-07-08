
<aside>
 <div id="sidebar" class="nav-collapse ">
    <ul class="sidebar-menu" id="nav-accordion">
        <p class="centered">
            <a ui-sref='home.inicio'>
                @if($foto=='')
                <img src="app_cliente/img/ui-sam.jpg" class="img-circle" width="60">              
                @endif
                 @if($foto!='')
                <img src="[[$foto]]" class="img-circle" width="60">
                @endif
            </a>
        </p>
        <h5 class="centered">[[$nombre]]</h5>

        <li class="mt">
            <a class="active" ui-sref='home.inicio' href="/home">
                <i class="fa fa-dashboard"></i>
                <span>Inicio</span>
            </a>
        </li>

        @foreach($menu as $key=>$item)
             @if(count($item['hijos'])>0)
                <li class="sub-menu">
                  <a href="">
                    <i class="fa fa-bar-chart-o fa-fw"></i> 
                    <span>[[ $item['etiqueta'] ]]</span>                    
                  </a>
                
                <ul class="sub">
                   @foreach($item['hijos'] as $hijo)
                      
                        <li>
                            <a ui-sref='[[ $hijo["url"] ]]'>[[ $hijo['etiqueta'] ]]</a>
                        </li>
                      
                    @endforeach 
                </ul>

                </li>                      

            @endif
            @if(count($item['hijos'])==0)
            <li class="sub-menu">
            <a ui-sref='[[ $item["url"] ]]' href="/home">
                <i class="fa fa-dashboard fa-fw"></i> 
                <span>[[ $item['etiqueta'] ]]</span>
                </a>
            </li>
             @endif
        @endforeach

    </ul>
 </div>
</aside>
