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
		
								<h2><i class="icol32-money-bag"></i>{{ 'Package Manager' }}</h2>
								<p style="text-align:justify">
									{{ 'Admin can manage packages here' }}
									
									
								</p>
								@include('layouts.admin-message')
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
					<div class="mws-panel grid_8">
						
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> {{ 'Packages Management' }}</span>
                    	
                    </div>
                    <div class="mws-panel-toolbar">
                        <div class="btn-toolbar">
                            
                             <div class="btn-group pull-right">
                                	<!--<input type="button" id="addnewpackage" class="btn btn-primary pull-right" onclick="location.href='{{ url('admin/addpackage', $secure = null) }}'" value='Add a new package'>-->
                                	<a href="#" class="btn" id="addnewpackage"><i class="icol-add"></i>&nbsp;&nbsp; Add a new package</a>
                             </div>
                        </div>
                        
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<div class="table-responsive">
                        <table class="mws-datatable-fn mws-table" id="bagorders">
                            <thead>
                                <tr>
                                    <th>{{ 'Package' }}</th>
                                    <th>{{ 'Flights' }}</th>
                                    <th>{{ 'Price' }}</th>
                                    <th>{{ 'Currency' }}</th>
                                    <th>{{ 'Status' }}</th>
                                    <th>{{ 'Action' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            	 @foreach ($packages as $package)
   			 							
   			 							<tr>
		                                    <td>{{ $package->package_id }}</td>
		                                    <td>{{ $package->numflights }}</td>
		                                    <td>{{ $package->price }}</td>
		                                    <td>{{ $package->currency }}</td>
		                                    <td style="{{ isset($package->status) && $package->status  == 1 ? 'color:DarkGreen' : 'color:red' }}" ><strong>{{{ isset($package->status) && $package->status == 1 ? 'ON' : 'OFF' }}}</strong> </td>
		                                    <td>
		                                    	<!--<input type="button" class="btn-primary" onclick="location.href='{{ url('admin/updatepackage', $parameters = array('package_id'=> $package->package_id), $secure = null) }}'" value='Edit'>-->
		                                    	<input type="button" class="btn-primary edit-package" id="edit-<?php echo $package->package_id; ?>" value='Edit'>
		                                    </td>
		                                </tr>
		    					 @endforeach
                                
                                
                            </tbody>
                        </table>
                       </div>
                    </div>
                </div>
                
                <!-- Panels End -->
                @foreach ($packages as $package)
				<div class="clear"></div>
                 
            	<div class="mws-panel grid_4">
                	
                    <div class="mws-panel-body" style="text-align: center;display: none;">
                    	<div class="mws-panel-content">
                        	
                            
                            <div id="mws-form-dialog-addupdatepackage-<?php echo $package->package_id;?>">
                            		
                            	   <form method="post" action="updatepackage/<?php echo $package->package_id;?>"	 class="mws-form" id="updatepackageform" >
								   {{ Form::token() }}
								   {{ Form::hidden('package_id',$package->package_id) }}
									
		                    		<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
		                    		<div class="mws-form-inline">
		                    			
		                    			<div class="mws-form-row">
		                    				<label class="mws-form-label">Price</label>
		                    				<div class="mws-form-item">
		                    					
		                    					{{ Form::text('price',$package->price,array('id' => 'price')) }}
		                    				</div>
		                    			</div>
		                    			<div class="mws-form-row">
		                    				<label class="mws-form-label">Currency</label>
		                    				<div class="mws-form-item">
		                    					{{ Form::select('currency', array('EUR'=>'EUR','CHF'=>'CHF','USD'=>'USD','BRL'=>'BRL','RUB'=>'RUB','MXN'=>'MXN','GBP'=>'GBP'), $package->currency) }}
		                    				</div>
		                    			</div>
		                    			<div class="mws-form-row">
		                    				<label class="mws-form-label">Number of flights</label>
		                    				<div class="mws-form-item">
		                    					{{ Form::text('numflights',$package->numflights,array('id' => 'numflights')) }}
		                    				</div>
		                    			</div>
		                    			<div class="mws-form-row">
		                    				<label class="mws-form-label">Status</label>
		                    				<div class="mws-form-item">
		                    					{{ Form::select('status', array('1'=>'ON','0'=>'OFF'), $package->status) }}
		                    				</div>
		                    			</div>
		                    			
		                    		</div>
		                    		<!--<div class="mws-button-row">
		                    			<input type="submit" value="Submit" class="btn btn-danger">
		                    			<input type="reset" value="Reset" class="btn ">
		                    		</div>-->
		                    	{{ Form::close() }}
                            </div>
                            
                        </div>
                    </div>    	
                </div>
    			@endforeach
    			
				<div class="clear"></div>
                
            	<div class="mws-panel grid_4">
                	
                    <div class="mws-panel-body" style="text-align: center;display: none;">
                    	<div class="mws-panel-content">
                        	
                            
                            <div id="mws-form-dialog-addupdatepackage">
                            		
                                	{{ Form::open(array('url' => array('admin/addpackage'),'class'=>'mws-form','id'=>'addpackageform')) }}
									
		                    		
		                    		<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
		                    		<div class="mws-form-inline">
		                    			
		                    			<div class="mws-form-row">
		                    				<label class="mws-form-label">Price</label>
		                    				<div class="mws-form-item">
		                    					
		                    					{{ Form::text('price',Input::old('price'),array('id' => 'price')) }}
		                    				</div>
		                    			</div>
		                    			<div class="mws-form-row">
		                    				<label class="mws-form-label">Currency</label>
		                    				<div class="mws-form-item">
		                    					{{ Form::select('currency', array('EUR'=>'EUR','CHF'=>'CHF','USD'=>'USD','BRL'=>'BRL','RUB'=>'RUB','MXN'=>'MXN','GBP'=>'GBP'), Input::old('currency')) }}
		                    				</div>
		                    			</div>
		                    			<div class="mws-form-row">
		                    				<label class="mws-form-label">Number of flights</label>
		                    				<div class="mws-form-item">
		                    					{{ Form::text('numflights',Input::old('numflights'),array('id' => 'numflights')) }}
		                    				</div>
		                    			</div>
		                    			<div class="mws-form-row">
		                    				<label class="mws-form-label">Status</label>
		                    				<div class="mws-form-item">
		                    					{{ Form::select('status', array('1'=>'ON','0'=>'OFF'), Input::old('status')) }}
		                    				</div>
		                    			</div>
		                    			
		                    		</div>
		                    		<!--<div class="mws-button-row">
		                    			<input type="submit" value="Submit" class="btn btn-danger">
		                    			<input type="reset" value="Reset" class="btn ">
		                    		</div>-->
		                    	{{ Form::close() }}
                            </div>
                        </div>
                    </div>    	
                </div>
   

   
            </div>
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            @include('layouts.admin-foot')
            
            
        </div>
        <!-- Main Container End -->
        
    </div>
				
										
