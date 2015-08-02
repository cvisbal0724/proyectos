
                  <div class="col-lg-9 main-chart">
                   <h4 class="mb"><i class="fa fa-angle-right"></i> 
                     Inicio
                     </h4>

                     @if(count($concejales)>0)
                     <div class="row">
                           
                      @foreach($concejales as $key=>$item)
                              
                              <!--<div class="col-md-2 col-sm-2 box0">
                                    <div class="box1">
                                       @if($item->foto!='')
                                       <div class="thumb">
                                         <img class="img-circle" src="app_cliente/fotos_concejal/[[$item->foto]]" width="70px" height="70px" align="">
                                       </div>
                                       @endif
                                       @if($item->foto=='')
                                       <i class="fa fa-male fa-5x" style="color:#ec971f"></i>
                                       @endif
                                       <h3>[[$item->votos]]</h3>
                                       <h6>Concejal, [[$item->concejal]]</h6>
                                    </div>
                                   <p>Cantidad de votos</p>
                              </div>-->

                                <div class="col-lg-3 col-xs-6">
                                  <!-- small box -->
                                  <div class="small-box bg-yellow">
                                    <div class="inner">
                                      <h3>[[$item->votos]]</h3>
                                      <p>Concejal, [[$item->concejal]]</p>
                                    </div>
                                    <div class="icon">
                                      
                                      <i class="ion ion-person-add"></i>
                                     
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                  </div>
                                </div><!-- ./col -->
                                                  
                              @endforeach
                              </div>
                     </div>
                     @endif
                     @if(count($lideres)>0)
                  	<div class="row mtbox">
                  		              <div class="panel-body">     	
                              @foreach($lideres as $key=>$item)
                             
                              <div class="col-md-2 col-sm-2 box0">
                                    <div class="box1">
                                     @if($item->foto!='')
                                       <div class="thumb">
                                         <img class="img-circle" src="app_cliente/fotos_concejal/[[$item->foto]]" width="70px" height="70px" align="">
                                       </div>
                                       @endif
                                      @if($item->foto=='')
                                        <i class="fa fa-user-plus fa-5x" style="color:#ec971f"></i>
                                      @endif
                                               
                                                <h3>[[$item->votos]]</h3>
                                                <h6>Lider, [[$item->lider]]</h6>
                                    </div>
                                                 <p>Cantidad de votos</p>
                              </div>
                             
                              
                              @endforeach


                  	</div><!-- /row mt -->	
                      @endif
                        </div>
                   