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
		
								<h2><i class="icol32-money-bag"></i>{{ 'Add/Edit Terms'}}</h2>
								<p style="text-align:justify">
										
									{{ 'Add/Edit Terms' }}
									
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
                    	<span><i class="icon-book"></i>Add/Edit Terms</span>
                    </div>
                    <div class="mws-panel-body no-padding">
		                    @if(isset($term))
							    {{ Form::model($term, array('url' => array('admin/updateterm/{$term->term_id}'),'class'=>'mws-form', 'method' => 'post','id'=>'terms_form')) }}
							    {{ Form::hidden('term_id',$term->term_id) }}
							@else
							    {{ Form::open(array('url' => array('admin/addterm'),'class'=>'mws-form','id'=>'terms_form')) }}
							@endif
                    		
                    
                    		<div class="mws-form-inline">
                    			
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Title</label>
                    				<div class="mws-form-item">
                    					
                    					{{ Form::text('title',Input::old('title'), $attributes = array('id'=>'title')) }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Description</label>
                    				<div class="mws-form-item">
                    					{{ Form::textarea('description',Input::old('description'), $attributes = array('id'=>'description')) }}
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
				
										
