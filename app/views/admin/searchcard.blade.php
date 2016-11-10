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
		
								<h2><i class="icol32-cart"></i>{{ 'Card Management' }}</h2>
								<p style="text-align:justify">
									{{'Search Results'}}
									
								</p>
								@include('layouts.admin-message')
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
					<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-book"></i>{{ 'Search Result' }} </span>
                    </div>
                    <div class="mws-panel-body no-padding">
                       <table class="mws-datatable-fn mws-table" >
                            <thead>
                                <tr>
                                    <th>{{ 'Card number' }}</th>
                                    <th>{{ 'Color' }}</th>
                                    <th>{{ 'Client Id' }}</th>
                                    <th>{{ 'Status' }}</th>
                                     <th>{{ 'Actions' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            	 
   			 							
   			 							<tr>
		                                    <td>{{ $card->card_number }}</td>
		                                    <td>{{ $colors[$card->card_color] }}</td>
		                                    <td>{{ $card->idclient }}</td>
		                                    <td style="{{ isset($card->cardstatus) && $card->cardstatus  == 1 ? 'color:DarkGreen' : 'color:red' }}" ><strong>{{{ isset($card->cardstatus) && $card->cardstatus == 1 ? 'Active' : 'Inactive' }}}</strong> </td>
		                                    <td>
		                                    	<input type="button" class="btn-primary" onclick="location.href='{{ url('admin/suspendcard', $parameters = array('card_id'=> $card->card_id,'status'=> $card->cardstatus ), $secure = null) }}'" value='Suspend'>
		                                    	<input type="button" class="btn-danger" onclick="location.href='{{ url('admin/deletecard', $parameters = array('card_id'=> $card->card_id ), $secure = null) }}'" value='Delete'>
		                                    </td>
		                                </tr>
		    					
                                
                                
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
				
										
