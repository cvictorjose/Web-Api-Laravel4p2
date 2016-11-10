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
		
								<h2><i class="icol32-cart"></i>{{ 'Order Detail#'.$order->transaction_id }}</h2>
								<p style="text-align:justify">
									{{ 'Order status : '. $order->orderstatus }}
									{{ Form::model($order, array('url' => array('admin/orders', $order->transaction_id))) }}
										{{ Form::label('orderstatus', 'Order status: '), array('class' => '') }}
										{{ Form::select('orderstatus', array('awaiting shipping' => 'Awaiting shipping', 'shipped' => 'Shipped', 'lost shipping' => 'Lost shipping'), 'awaiting shipping'); }}
										{{ Form::submit('Update') }}
									{{ Form::close() }}
									
								</p>
								@include('layouts.admin-message')
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
					<div class="mws-panel grid_4">
                	<div class="mws-panel-header">
                    	<span><i class="icon-book"></i> User Details</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <ul class="mws-summary clearfix">
                            <li>
                                <span class="key"><i class="icon-support"></i> Support Tickets</span>
                                <span class="val">
                                    <span class="text-nowrap">332</span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-certificate"></i> Commision</span>
                                <span class="val">
                                    <span class="text-nowrap">71% <i class="up icon-arrow-up"></i></span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-shopping-cart"></i> This Week Sales</span>
                                <span class="val">
                                    <span class="text-nowrap">144 <i class="down icon-arrow-down"></i></span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-install"></i> Cash Deposit</span>
                                <span class="val">
                                    <span class="text-nowrap">$6,421</span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-key"></i> Last Sign In</span>
                                <span class="val">
                                    <span class="text-nowrap">September 21, 2012</span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-windows"></i> Operating System</span>
                                <span class="val">
                                    <span class="text-nowrap">Debian Linux</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mws-panel grid_3">
                	<div class="mws-panel-header">
                    	<span><i class="icon-book"></i> Order Details</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <ul class="mws-summary clearfix">
                            <li>
                                <span class="key"><i class="icon-support"></i> Support Tickets</span>
                                <span class="val">
                                    <span class="text-nowrap">332</span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-certificate"></i> Commision</span>
                                <span class="val">
                                    <span class="text-nowrap">71% <i class="up icon-arrow-up"></i></span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-shopping-cart"></i> This Week Sales</span>
                                <span class="val">
                                    <span class="text-nowrap">144 <i class="down icon-arrow-down"></i></span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-install"></i> Cash Deposit</span>
                                <span class="val">
                                    <span class="text-nowrap">$6,421</span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-key"></i> Last Sign In</span>
                                <span class="val">
                                    <span class="text-nowrap">September 21, 2012</span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-windows"></i> Operating System</span>
                                <span class="val">
                                    <span class="text-nowrap">Debian Linux</span>
                                </span>
                            </li>
                        </ul>
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
				
										
