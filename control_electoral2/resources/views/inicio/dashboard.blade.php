
                  <div class="col-lg-9 main-chart">
                   <h4 class="mb"><i class="fa fa-angle-right"></i> 
                     Inicio
                     </h4>
                  	<div class="row mtbox">
                  		<!--<div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                  			<div class="box1">
					  			
                                                <i class="fa fa-user-plus fa-5x"></i>
					  			<h3>933</h3>
                  			</div>
					  			<p>933 People liked your page the last 24hs. Whoohoo!</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_cloud"></span>
					  			<h3>+48</h3>
                  			</div>
					  			<p>48 New files were added in your cloud storage.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_stack"></span>
					  			<h3>23</h3>
                  			</div>
					  			<p>You have 23 unread messages in your inbox.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_news"></span>
					  			<h3>+10</h3>
                  			</div>
					  			<p>More than 10 news were added in your reader.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_data"></span>
					  			<h3>OK!</h3>
                  			</div>
					  			<p>Your server is working perfectly. Relax & enjoy.</p>
                  		</div>-->
                  	
                              @foreach($lista as $key=>$item)
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

                      </div>  