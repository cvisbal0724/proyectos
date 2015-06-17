
<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu" metismenu>
                       
                       <li>
                            <a ui-sref='home' href="/home">
                                <i class="fa fa-dashboard fa-fw"></i> 
                                Inicio
                            </a>
                        </li>


                         @foreach($menu as $key=>$item)
                             @if(count($item['hijos'])>0)
                                <li>
                                  <a ui-sref='home' href="morris.html">
                                    <i class="fa fa-bar-chart-o fa-fw"></i> 
                                    [[ $item['etiqueta'] ]]
                                    <span class="fa arrow"></span>
                                  </a>
                                
                                <ul class="nav nav-second-level">
                                   @foreach($item['hijos'] as $hijo)
                                      
                                        <li>
                                            <a ui-sref='[[ $hijo["url"] ]]' href="/home">[[ $hijo['etiqueta'] ]]</a>
                                        </li>
                                      
                                    @endforeach 
                                </ul>

                                </li>                      

                            @endif
                            @if(count($item['hijos'])==0)
                            <li>
                            <a ui-sref='[[ $item["url"] ]]' href="/home">
                                <i class="fa fa-dashboard fa-fw"></i> 
                                [[ $item['etiqueta'] ]]
                                </a>
                            </li>
                             @endif
                        @endforeach

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->



