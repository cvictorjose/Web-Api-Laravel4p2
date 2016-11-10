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
		
								<h2><i class="icol32-speedometer"></i>{{ 'Admin Dashboard' }}</h2>
								<p style="text-align:justify">
									{{ 'Admin can manage the orders, smart cards and airport risk management' }}
									
								</p>
								@include('layouts.admin-message')
							</div>
						</div>
					</div>
            
			<!-- Statistics Button Container -->
            	<div class="mws-stat-container clearfix">
                	
                	
                	
                    <!-- Statistic Item -->
                	<!--<a class="mws-stat" href="#">
                    	
                    	<span class="mws-stat-icon icol32-building"></span>
                        
                        
                        <span class="mws-stat-content">
                        	<span class="mws-stat-title">Floors Climbed</span>
                            <span class="mws-stat-value">324</span>
                        </span>
                 </a>-->

                	
                </div>
<!-- Panel orders -->
							<!--<div class="mws-panel grid_4 mws-collapsible">
								
								<div class="mws-panel-header">
									
									<span><i class="icon-user"></i>{{ 'Manage Orders' }}</span>
								</div>

								
								<div class="mws-panel-body">
									<h3>{{ 'Manage Orders' }}</h3>
									<p>
										{{ 'Here admin can manage the orders' }}
									</p>

									<a class="btn mws-login-button" href="{{ URL::to('admin/listorders') }}">{{ 'Manage Orders' }}</a>

								</div>
							</div>-->
   <!-- orders End -->
   
   						<!-- Panel orders -->
							<div class="mws-panel grid_4 mws-collapsible">
								<!-- Panel Header -->
								<div class="mws-panel-header">
									<!-- Panel Title -->
									<span><i class="icon-user"></i>{{ 'Manage Cards' }}</span>
								</div>

								<!-- Panel Body -->
								<div class="mws-panel-body">
									<h3>{{ 'Manage Cards' }}</h3>
									<p>
										{{ 'Here admin can manage the cards' }}
									</p>
									<a class="btn mws-login-button" href="{{ URL::to('admin/addcard') }}">{{ 'Add Card' }}</a>
									<!--<a class="btn mws-login-button" href="{{ URL::to('admin/listcards') }}">{{ 'Manage Cards' }}</a>-->

								</div>
							</div>

   
   						<!-- Panel orders -->
							<div class="mws-panel grid_4 mws-collapsible">
								<!-- Panel Header -->
								<div class="mws-panel-header">
									<!-- Panel Title -->
									<span><i class="icon-user"></i>{{ 'Manage Packages' }}</span>
								</div>

								<!-- Panel Body -->
								<div class="mws-panel-body">
									<h3>{{ 'Manage Packages' }}</h3>
									<p>
										{{ 'Here admin can manage the packages' }}
									</p>
									<!--<a class="btn mws-login-button" href="{{ URL::to('admin/addpackage') }}">{{ 'Add Package' }}</a>-->
									<a class="btn mws-login-button" href="{{ URL::to('admin/listpackages') }}">{{ 'Manage Packages' }}</a>

								</div>
							</div>
							
							<div class="mws-panel grid_4 mws-collapsible">
								<!-- Panel Header -->
								<div class="mws-panel-header">
									<!-- Panel Title -->
									<span><i class="icon-user"></i>{{ 'Risk Manager' }}</span>
								</div>

								<!-- Panel Body -->
								<div class="mws-panel-body">
									<h3>{{ 'Risk Manager' }}</h3>
									<p>
										{{ 'Here admin can manage the risks of ariports' }}
									</p>
									<a class="btn mws-login-button" href="{{ URL::to('admin/listriskairports') }}">{{ 'List Airports' }}</a>
									
								</div>
							</div>

   
            </div>
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            
            @include('layouts.admin-foot')
            
        </	div>
        <!-- Main Container End -->
        
    </div>
				
											
