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
		
								<h2><i class="icol32-money-bag"></i>{{ 'Add/Edit Packages'}}</h2>
								<p style="text-align:justify">
										
									{{ 'Add/Edit Packages' }}
									
								</p>
								
								@include('layouts.admin-message')
								@foreach($errors->all() as $error2)
           						<div class="mws-form-message error">
                            		{{ $error2 }}
                            	</div>
							   @endforeach
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
            		
					<div class="mws-panel grid_4">
                	<div class="mws-panel-header">
                    	<span><i class="icon-book"></i>Add/Edit Packages</span>
                    </div>
                    <div class="mws-panel-body no-padding">
		                    @if(isset($package))
							    {{ Form::model($package, array('url' => array('admin/updatepackage/{$package->package_id}'),'class'=>'mws-form', 'method' => 'post')) }}
							    {{ Form::hidden('package_id',$package->package_id) }}
							@else
							    {{ Form::open(array('url' => array('admin/addpackage'),'class'=>'mws-form')) }}
							@endif
                    		
                    
                    		<div class="mws-form-inline">
                    			
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Price</label>
                    				<div class="mws-form-item">
                    					
                    					{{ Form::text('price',Input::old('price')) }}
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
                    					{{ Form::text('numflights',Input::old('numflights')) }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Status</label>
                    				<div class="mws-form-item">
                    					{{ Form::select('status', array('1'=>'ON','0'=>'OFF'), Input::old('status')) }}
                    				</div>
                    			</div>
                    			
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Submit" class="btn btn-danger">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	{{ Form::close() }}
                    </div>    	
                </div>
                
                
               
                <!-- Panels End -->

   

   

   
            </div>
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            @include('layouts.admin-foot')
            
            
        </div>
        <!-- Main Container End -->
        
    </div>
				
										
