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
		
								<h2><i class="icol32-application-view-tile"></i>{{ 'Cards management'}}</h2>
								<p style="text-align:justify">
										
									{{ 'Insert smart cards' }}
									
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
            		<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Search Cards</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	 {{ Form::open(array('url' => array('admin/searchcard'),'class'=>'mws-form')) }}
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Card Number</label>
                                    <div class="mws-form-item">
                                        <div class="mws-form-cols">
                                        	
                                            <div class="mws-form-col-2-8">
                                               {{ Form::text('card_number','') }}
                                            </div>
                                            <div class="mws-form-col-2-8">
                                                <input type="submit" value="Submit" class="btn btn-danger">
                    							
                                            </div>
                                           <div class="mws-form-col-2-8">
                                               
                    							<input type="reset" value="Reset" class="btn ">
                                            </div>
                                        </div>
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
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	
					<div class="mws-panel grid_4">
                	<div class="mws-panel-header">
                    	<span><i class="icon-book"></i>Insert range of cards</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    {{ Form::open(array('url' => array('admin/addcard'),'class'=>'mws-form')) }}
                    
                    		
                    
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Prefix</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('prefix', 'SAFE', $attributes = array('readonly'=>'readonly')) }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Start Number</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('start_range','') }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">End number</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('end_range','') }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Suffix (Max 2 Char)</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('suffix', '') }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Card color</label>
                    				<div class="mws-form-item">
                    					{{ Form::select('card_color', array('1' => 'Blue', '2' => 'Orange', '3' => 'Red', '4' => 'Green')); }}
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
                
                
                <div class="mws-panel grid_4">
                	<div class="mws-panel-header">
                    	<span><i class="icon-book"></i> Insert Single Card </span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        {{ Form::open(array('url' => array('admin/addcardsingle'),'class'=>'mws-form')) }}
                    		
                    		
                    
                    		<div class="mws-form-inline">
                    			<!--<div class="mws-form-row">
                    				<label class="mws-form-label">Prefix</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('prefix', 'SAFE', $attributes = array('readonly'=>'readonly')) }}
                    				</div>
                    			</div>-->
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Card Number</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('card_number','') }}
                    				</div>
                    			</div>
                    			<!--<div class="mws-form-row">
                    				<label class="mws-form-label">Suffix (Max 2 Char)</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('suffix', '') }}
                    				</div>
                    			</div>-->
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Card color</label>
                    				<div class="mws-form-item">
                    					{{ Form::select('card_color', array('1' => 'Blue', '2' => 'Orange', '3' => 'Red', '4' => 'Green')); }}
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
				
										
