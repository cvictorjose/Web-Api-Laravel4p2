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
		
								<h2><i class="icol32-cart"></i>{{ 'Orders History' }}</h2>
								<p style="text-align:justify">
									{{ 'Admin can manage orders history' }}
									
								</p>
								@include('layouts.admin-message')
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
					<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> {{ 'Orders History' }}</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table" id="bagorders">
                            <thead>
                                <tr>
                                    <th>{{ 'Date' }}</th>
                                    <th>{{ 'Username' }}</th>
                                    <th>{{ 'Order Id' }}</th>
                                    <th>{{ 'Country' }}</th>
                                    <th>{{ 'Status' }}</th>
                                     <th>{{ 'Actions' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            	 @foreach ($orders as $order)
   			 							
   			 							<tr>
		                                    <td>{{ $order->payment_date }}</td>
		                                    <td>{{ $order->idclient }}</td>
		                                    <td>{{ $order->transaction_id }}</td>
		                                    <td>{{ 'country' }}</td>
		                                    <td>{{ $order->orderstatus  }}</td>
		                                    <td><a href="{{ url('admin/orders', $parameters = array('transaction_id'=> $order->transaction_id ), $secure = null) }}"><i class="icon-search"></i> {{ 'View' }}</a></td>
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
				
										
