
                  <div class="col-lg-9 main-chart">
                   <h4 class="mb"><i class="fa fa-angle-right"></i> 
                     Inicio
                     </h4>

                     @if(count($concejales)>0)
                     <div class="row mtbox">
                      @foreach($concejales as $key=>$item)
                              @if($key==0)
                              <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                                    <div class="box1">
                                                <i class="fa fa-male fa-5x" style="color:#ec971f"></i>
                                                <h3>[[$item->votos]]</h3>
                                                <h6>Concejal, [[$item->concejal]]</h6>
                                    </div>
                                                 <p>Cantidad de votos</p>
                              </div>
                              @endif
                              @if($key>0)
                               <div class="col-md-2 col-sm-2 box0">
                                    <div class="box1">
                                                <i class="fa fa-male fa-5x" style="color:#ec971f"></i>
                                                <h3>[[$item->votos]]</h3>
                                                <h6>Concejal, [[$item->concejal]]</h6>
                                    </div>
                                                <p>Cantidad de votos</p>
                              </div>
                              @endif
                              @endforeach
                     </div>
                     @endif
                     @if(count($lideres)>0)
                  	<div class="row mtbox">
                  		                  	
                              @foreach($lideres as $key=>$item)
                              @if($key==0)
                              <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                                    <div class="box1">
                                                <i class="fa fa-user-plus fa-5x" style="color:#ec971f"></i>
                                                <h3>[[$item->votos]]</h3>
                                                <h6>Lider, [[$item->lider]]</h6>
                                    </div>
                                                 <p>Cantidad de votos</p>
                              </div>
                              @endif
                              @if($key>0)
                               <div class="col-md-2 col-sm-2 box0">
                                    <div class="box1">
                                                <i class="fa fa-user-plus fa-5x" style="color:#ec971f"></i>
                                                <h3>[[$item->votos]]</h3>
                                                <h6>Lider, [[$item->lider]]</h6>
                                    </div>
                                                <p>Cantidad de votos</p>
                              </div>
                              @endif
                              @endforeach


                  	</div><!-- /row mt -->	
                      @endif

                      </div>  