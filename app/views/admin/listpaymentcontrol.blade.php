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
		
								<h2><i class="icol32-money-bag"></i>{{ 'Payment Controller'}}</h2>
								<p style="text-align:justify">
										
									{{ 'Payment Controller' }}
									
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
                    	<span><i class="icon-book"></i>Payment Controller</span>
                    </div>
                    <div class="mws-panel-body no-padding">
		                    
							{{ Form::open(array('url' => array('admin/paymentcontrol'),'method'=>'post','class'=>'mws-form','id'=>'control_form')) }}
							
                    		<div class="mws-form-inline">
                    			
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Status</label>
                    				<div class="mws-form-item">
                    					
                    					<select name="payment_enable" id="payment_enable"  class="required">

					                        <option <?php echo ($paymentcontrol->payment_enable =='1' ? 'selected="selected"': '' );?> value="1">Enable</option>
					                        <option <?php echo ($paymentcontrol->payment_enable =='0' ? 'selected="selected"': '');?> value="0">Disable</option>
					
					                    </select>
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
				
										
