<!--  Navigation -->
		@include('layouts.admin-nav')
		<!--content view starts -->
				<!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        
        	<!-- Inner Container Start -->
            <div class="container">
            
            	<!-- Intro Content -->
					<div class="content_wrap intro_bg">
						<div class="content clearfix">
							<div class="col100">
		
								<h2><i class="icol32-routing-go-right"></i>{{ 'Airport Risk Manager' }}</h2>
								<p style="text-align:justify">
									{{ 'Admin can manage airports with ranks here' }}
									<!--<input type="button" class="btn btn-primary pull-right" onclick="location.href='{{ url('admin/addpackage', $secure = null) }}'" value='Add a new package'>-->
									
									
									
								</p>
								@include('layouts.admin-message')
								
								
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
					<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> {{ 'Airport Management' }}</span>
                    </div>
                    <div class="mws-panel-toolbar">
                        <div class="btn-toolbar">
                            <div class="btn-group">
                                <a href="#" class="btn" id="massedit"><i class="icol-accept"></i>&nbsp;&nbsp; Edit</a>
                            </div>
                             <div class="btn-group pull-right">
                                		<a href="javascript:void(0);" id="clearFilters"  class="btn mws-login-button">{{ 'All' }}</a>
										<a href="javascript:void(0);" id="filterByRank1" class="btn mws-login-button">{{ 'Rank1' }}</a>
										<a href="javascript:void(0);" id="filterByRank2" class="btn mws-login-button">{{ 'Rank2' }}</a>
										<a href="javascript:void(0);" id="filterByRank3" class="btn mws-login-button">{{ 'Rank3' }}</a>
						
                            </div>
                        </div>
                        
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table" id="tpl_airports">
                            <thead>
                                <tr>
                                	<th class="checkbox-column">
                                        <input type="checkbox" id="checkbox-main-header">
                                    </th>
                                    <th>{{ 'IATA code' }}</th>
                                    <th>{{ 'City' }}</th>
                                    <th>{{ 'Status' }}</th>
                                    <th>{{ 'Rank#' }}</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            	 @foreach ($airports as $airport)
   			 							
   			 							<tr>
   			 								<td class="checkbox-column">
                                        		<input type="checkbox" class="checkbox-tr" name="id" value="{{ $airport->id }}">
                                    		</td>
		                                    <td>{{ $airport->iata }}</td>
		                                    <td>{{ $airport->city }}</td>
		                                    <td style="{{ isset($airport->stato) && $airport->stato  == 1 ? 'color:DarkGreen' : 'color:red' }}" ><strong>{{{ isset($airport->stato) && $airport->stato == 1 ? 'Active' : 'Suspended' }}}</strong> </td>
		                                    <td>{{ $airport->smart_rank }}</td>
		                                   
		                                </tr>
		    					 @endforeach
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                
                
                <div class="clear"></div>
                
            	<div class="mws-panel grid_4">
                	<!--<div class="mws-panel-header">
                    	<span><i class="icon-warning-sign"></i> jQuery-UI Dialog</span>
                   </div>-->
                    <div class="mws-panel-body" style="text-align: center;display: none;">
                    	<div class="mws-panel-content">
                        	<!--<input type="button" id="mws-jui-dialog-btn" class="btn btn-danger" value="Show Dialog">
                        	<input type="button" id="mws-jui-dialog-mdl-btn" class="btn btn-primary" value="Show Modal Dialog">
                        	<input type="button" id="mws-form-dialog-mdl-btn" class="btn btn-success" value="Show Modal Form">
                            
                            <div id="mws-jui-dialog">
                        		<div class="mws-dialog-inner">
                            		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi tellus, faucibus tristique faucibus sit amet, lacinia at velit. Proin pretium vulputate orci, nec luctus odio volutpat ac. Curabitur semper adipiscing tellus sed venenatis. Integer vitae diam dui. Ut ut quam ac ante eleifend aliquam. Cras tincidunt pulvinar sollicitudin. Nullam mattis justo nec nisl adipiscing ullamcorper. Curabitur fermentum egestas massa, eu dictum ligula accumsan id. Duis elit arcu, adipiscing vel consectetur ac, fermentum ac nisl. Quisque varius ipsum vitae mauris cursus eu tristique velit dapibus. Cras eu viverra neque.</p>
                                </div>
                            </div>-->
                            
                            <div id="mws-form-dialog">
                                {{ Form::open(array('url' => array('admin/updatemassrank'),'class'=>'mws-form','id'=>'mws-validate')) }}
                                    <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                                    <div class="mws-form-inline">
                                        
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Select Rank</label>
                                            <div class="mws-form-item">
                                                <select class="required" name="smart_rank">
                                                	
                                                	<option value='0'>Rank 0</option>
                                                    <option value='1'>Rank 1</option>
                                                    <option value='2'>Rank 2</option>
                                                    <option value='3'>Rank 3</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>    	
                </div>
                
                <div class="clear"></div>
                <div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> {{ 'Price Manager' }}</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table" >
                            <thead>
                                <tr>
                                    <th>{{ 'Rank' }}</th>
                                    <th>{{ 'Price' }}</th>
                                    <th>{{ 'Currency' }}</th>
                                    <th>{{ 'Action' }}</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            	 @foreach ($ranks as $rank)
   			 							
   			 							<tr>
		                                    <td>{{ $rank->rank_id }}</td>
		                                    <td>{{ $rank->price }}</td>
		                                    <td>{{ $rank->currency }} </td>
		                                    <td>
		                                    	<!--<input type="button" class="btn-primary" onclick="location.href='{{ url('admin/updaterank', $parameters = array('rank_id'=> $rank->rank_id), $secure = null) }}'" value='Edit'>-->
		                                    	<input type="button" class="btn-primary edit-rank" id="edit-<?php echo $rank->rank_id; ?>" value='Edit'>
											</td>
		                                   
		                                </tr>
		    					 @endforeach
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Panels End -->

   				@foreach ($ranks as $rank)
				<div class="clear"></div>
                 
            	<div class="mws-panel grid_4">
                	
                    <div class="mws-panel-body" style="text-align: center;display: none;">
                    	<div class="mws-panel-content">
                        	
                            
                            <div id="mws-form-dialog-addupdaterank-<?php echo $rank->rank_id;?>">
                            		
                            	   <form method="post" action="updaterank/<?php echo $rank->rank_id;?>"	 class="mws-form" id="updaterankform" >
								   {{ Form::token() }}
								   {{ Form::hidden('rank_id',$rank->rank_id) }}
									
		                    		<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
		                    		<div class="mws-form-inline">
                    			
		                    			<div class="mws-form-row">
		                    				<label class="mws-form-label">Price</label>
		                    				<div class="mws-form-item">
		                    					
		                    					{{ Form::text('price', $rank->price) }}
		                    				</div>
		                    			</div>
		                    			<div class="mws-form-row">
		                    				<label class="mws-form-label">Currency</label>
		                    				<div class="mws-form-item">
		                    					{{ Form::select('currency', array('EUR'=>'EUR','CHF'=>'CHF','USD'=>'USD','BRL'=>'BRL','RUB'=>'RUB','MXN'=>'MXN','GBP'=>'GBP'), $rank->currency) }}
		                    				</div>
		                    			</div>
		                    			
		                    		</div>
		                    		
		                    	{{ Form::close() }}
                            </div>
                            
                        </div>
                    </div>    	
                </div>
    			@endforeach

   

   
            </div>
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            @include('layouts.admin-foot')
            
            
        </div>
        <!-- Main Container End -->
        
    </div>
				
										
