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
		
								<h2><i class="icol32-routing-go-right"></i>{{ 'Terms Manager' }}</h2>
								<p style="text-align:justify">
									{{ 'Admin can manage terms' }}
									
								</p>
								@include('layouts.admin-message')
								
								
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
					<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> {{ 'Terms  Management' }}</span>
                    </div>
                     <div class="mws-panel-toolbar">
                        <div class="btn-toolbar">
                            
                             <div class="btn-group pull-right">
                                	<input type="button" class="btn btn-primary pull-right" onclick="location.href='{{ url('admin/addterm', $secure = null) }}'" value='Add a new term'>
                             </div>
                        </div>
                        
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table" id="tpl_terms">
                            <thead>
                                <tr>
                                	
                                    <th>{{ 'Title' }}</th>
                                    <th>{{ 'Actions' }}</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            	 @foreach ($terms as $term)
   			 							
   			 							<tr>
   			 								
		                                   
		                                    <td>{{ $term->title }}</td>
		                                    
		                                    <td>
		                                    	<input type="button" class="btn-primary" onclick="location.href='{{ url('admin/updateterm', $parameters = array('term_id'=> $term->term_id), $secure = null) }}'" value='Edit'>
		                                    	<input type="button" class="btn-danger" onclick="areyousure('{{ url('admin/deleteterm', $parameters = array('term_id'=> $term->term_id ), $secure = null) }}')" value='Delete'>
		                                    </td>
		                                   
		                                </tr>
		    					 @endforeach
                                
                                
                            </tbody>
                        </table>
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
				
										
