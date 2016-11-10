<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">-->
<style>
.pagination{display:inline-block;padding-left:0;margin:20px 0;border-radius:4px}.pagination>li{display:inline}.pagination>li>a,.pagination>li>span{position:relative;float:left;padding:6px 12px;margin-left:-1px;line-height:1.42857143;color:#428bca;text-decoration:none;background-color:#fff;border:1px solid #ddd}.pagination>li:first-child>a,.pagination>li:first-child>span{margin-left:0;border-top-left-radius:4px;border-bottom-left-radius:4px}.pagination>li:last-child>a,.pagination>li:last-child>span{border-top-right-radius:4px;border-bottom-right-radius:4px}.pagination>li>a:hover,.pagination>li>span:hover,.pagination>li>a:focus,.pagination>li>span:focus{color:#2a6496;background-color:#eee;border-color:#ddd}.pagination>.active>a,.pagination>.active>span,.pagination>.active>a:hover,.pagination>.active>span:hover,.pagination>.active>a:focus,.pagination>.active>span:focus{z-index:2;color:#fff;cursor:default;background-color:#428bca;border-color:#428bca}.pagination>.disabled>span,.pagination>.disabled>span:hover,.pagination>.disabled>span:focus,.pagination>.disabled>a,.pagination>.disabled>a:hover,.pagination>.disabled>a:focus{color:#777;cursor:not-allowed;background-color:#fff;border-color:#ddd}.pagination-lg>li>a,.pagination-lg>li>span{padding:10px 16px;font-size:18px}.pagination-lg>li:first-child>a,.pagination-lg>li:first-child>span{border-top-left-radius:6px;border-bottom-left-radius:6px}.pagination-lg>li:last-child>a,.pagination-lg>li:last-child>span{border-top-right-radius:6px;border-bottom-right-radius:6px}.pagination-sm>li>a,.pagination-sm>li>span{padding:5px 10px;font-size:12px}.pagination-sm>li:first-child>a,.pagination-sm>li:first-child>span{border-top-left-radius:3px;border-bottom-left-radius:3px}.pagination-sm>li:last-child>a,.pagination-sm>li:last-child>span{border-top-right-radius:3px;border-bottom-right-radius:3px}
</style>
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
		
								<h2><i class="icol32-application-view-tile"></i>{{ 'Cards management' }}</h2>
								<p style="text-align:justify">
									{{ 'Admin can manage inserted cards' }}
									
								</p>
								@include('layouts.admin-message')
							</div>
						</div>
					</div>
            	
            	<!--Panel start -->
					<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> {{ 'Cards management' }}</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table" id="tbl_cards">
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
                            	 @foreach ($cards as $card)
   			 							
   			 							<tr>
		                                    <td>{{ $card->card_number }}</td>
		                                    <td>{{ $colors[$card->card_color] }}</td>
		                                    <td>{{ $card->idclient }}</td>
		                                    <td style="{{ isset($card->cardstatus) && $card->cardstatus  == 1 ? 'color:DarkGreen' : 'color:red' }}" ><strong>{{{ isset($card->cardstatus) && $card->cardstatus == 1 ? 'Active' : 'Inactive' }}}</strong> </td>
		                                    <td>
		                                    	<input type="button" class="btn-primary" onclick="location.href='{{ url('admin/suspendcard', $parameters = array('card_id'=> $card->card_id,'status'=> $card->cardstatus ), $secure = null) }}'" value='Suspend'>
		                                    	<input type="button" class="btn-danger" onclick="areyousure('{{ url('admin/deletecard', $parameters = array('card_id'=> $card->card_id ), $secure = null) }}')" value='Delete'>
		                                    </td>
		                                </tr>
		    					 @endforeach
                                
                                
                            </tbody>	
                        </table>
                       
                    </div>
                </div>
                 <?php echo $cards->links(); ?>
                <!-- Panels End -->

   

   

   
            </div>
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            @include('layouts.admin-foot')
            
            
        </div>
        <!-- Main Container End -->
        
    </div>
		
										
