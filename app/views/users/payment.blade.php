{{ HTML::script('minisite/js/jquery.ddslick.min.js'); }}
<!--  Navigation -->
		@include('layouts.user-nav')
		<!--content view starts -->
				<!-- Main Container Start -->
        <div id="mws-container" class="clearfix" style="margin-left: 0px;">
        
        	<!-- Inner Container Start -->
            <div class="container">
            
            	<!-- Intro Content -->
					<div class="content_wrap intro_bg">
						<div class="content clearfix">
							<div class="col100">
		
								<h2><i class="icol32-application-view-tile"></i>{{ trans('userlistcards.your_cards') }}</h2>
								<p style="text-align:justify">
                                <?php echo Session::get('cc');?>
									{{ trans('userlistcards.description') }} 
									<br/><!--<a class="btn mws-login-button" href="{{ URL::to('users/addcard') }}">{{ trans('userlistcards.register_a_smart_card') }}</a>
									<a class="btn mws-login-button" href="{{ URL::to('users/buycard') }}">{{ trans('userlistcards.buy_a_smart_card') }}</a>-->
                                    <!--<a class="btn mws-login-button" href="#" onclick="return registersmartcard();">{{ trans('userlistcards.register_a_smart_card') }}</a>
                                    <a class="btn mws-login-button" href="#" onclick="return buysmartcard();">{{ trans('userlistcards.buy_a_smart_card') }}</a>-->
									

								</p>
								@include('layouts.user-message')
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
                 {{ Form::open(array('url'=>'client/buycard', 'class'=>'form-signup', 'id'=>'payment-form', 'name'=>'payment-form' )) }}
					<div class="mws-panel grid_3">
                    <div class="mws-panel-header">
                        <span>{{ trans('userlistcards.buy_a_smart_card') }}</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                       
					 	<div id="mws-validate-error-buy" class="mws-form-message error" style="display:none;"></div>
                        <div class="mws-form-block">
                                <div class="mws-form-row">
                                    <label class="mws-form-label"><?php echo trans('frontend.select_quantity');?>:</label>
                                 	<div class="mws-form-item">
					
                    					{{ Form::select('qty', $qtyList, null, array('id'=>'qty', 'class' => 'form-control', 'style'=>'width:130px;margin-bottom:0;', 'required' => '')) }}
					 
			            	
                            		</div>
                               	</div>
			            	
								<div class="mws-form-row">
                            		<label class="mws-form-label"><?php echo trans('frontend.select_your_colors');?>:</label>
                                    <div class="mws-form-item">
                       
					<div id="colorsdropdowndiv">   
					{{ Form::hidden('colour[1]', null ,array('id'=>'colour')) }}
                   
            <select id="picdropdown_1">
                <option value="1" selected="selected"  data-imagesrc="{{ asset('minisite/img/cards/1-blue-34.png') }}"
                    data-description="Color: Blue">Smart Track Card</option>
                <option value="2" data-imagesrc="{{ asset('minisite/img/cards/2-black-34.png') }}"
                    data-description="Color: black">Smart Track Card</option>
                <option value="3" data-imagesrc="{{ asset('minisite/img/cards/3-violet-34.png') }}"
                    data-description="Color: violet">Smart Track Card</option>
                <option value="4" data-imagesrc="{{ asset('minisite/img/cards/4-pink-34.png') }}"
                    data-description="Color: pink">Smart Track Card</option>
                <option value="5" data-imagesrc="{{ asset('minisite/img/cards/5-darkblue-34.png') }}"
                    data-description="Color: dark blue">Smart Track Card</option>
                <option value="6" data-imagesrc="{{ asset('minisite/img/cards/5-orange-34.png') }}"
                    data-description="Color: yellow">Smart Track Card</option>                
                <option value="7" data-imagesrc="{{ asset('minisite/img/cards/6-green-34.png') }}"
                    data-description="Color: green">Smart Track Card</option>
                <option value="8" data-imagesrc="{{ asset('minisite/img/cards/7-darkgreen-34.png') }}"
                    data-description="Color: dark green">Smart Track Card</option>
    		</select>
            		</div>
    								</div>
                                  </div>
    							

						</div>
					                         
                                
                    </div>      
                </div>	
                
                <div class="mws-panel grid_3">
                    <div class="mws-panel-header">
                        <span>{{ trans('userlistcards.buy_a_smart_card') }}</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<div class="mws-form-row">
                            <label class="mws-form-label"> <?php echo trans('frontend.confirm_and_pay');?></label>
                            <div class="mws-form-item">

                                <h2><?php echo trans('frontend.subtotal');?>: <span id="subtotal">€9.90</span></h2>
                                <br>
                                <h2><?php echo trans('frontend.tax');?> 22%:  <span id="taxtotal">€9.90</span></h2>
                                <br>
                                <h2><?php echo trans('frontend.total');?>:    <span id="total">€9.90</span></h2>
                             </div>
                         </div>
                     
                    <div class="mws-button-row">
                    			<input type="submit" value="<?php echo trans('frontend.pay_with_paypal');?>" class="btn btn-danger">
                    			
                    		</div>  
                    <!--<div class="mws-button-row">
						<input type="submit" value="<?php //echo trans('frontend.pay_with_paypal');?>"><i class="fa fa-spin fa-circle-o-notch fa-form-wait" style="display: none;"></i>
                    </div>-->     
                    </div>            
               	</div>
                 {{ Form::close() }}          
                       
                <!-- Panels End -->

   
   
            </div>
            <!-- Inner Container End -->
            
                
                
                
                
                       
            <!-- Footer -->
            @include('layouts.admin-foot')
            
            
        </div>
        <!-- Main Container End -->
        
    </div>
				
										



<script>


$('#picdropdown').change(function() {
	calculateprice();
});
$('#qty').change(function() {
	calculateprice();
	colorsdropdowndiv();
	
});

$('#updatprice').click(function() {
	calculateprice();
});

$( document ).ready(function() {
   calculateprice();
   colorsdropdowndiv();
   $('.dd-options').click(function() {
		calculateprice();
	});
});

function updateshipaddress(){
	//window.location.href ="{{ URL::to('client/updateshipaddress') }}	";
	$("#viewshipaddress").hide();
	$("#editshipaddress").show();
	
	return false;
}

function colorsdropdowndiv(){
	//$("#colour").val($('.dd-selected-value').val());
	url	=	"{{ URL::to('client/ajaxcolorsdropdown') }}";
	data	=	$( "#payment-form" ).serializeArray();
	$.ajax({
		type: 'post',
		url: url,
		dataType: 'html',
		data: data,
		success: function(data) {
			$("#colorsdropdowndiv").html(data);
			
			//alert(data.message);
			
		}
	});
}

function calculateprice(){
	$("#colour").val($('.dd-selected-value').val());
	url	=	"{{ URL::to('client/ajaxcalculateprice') }}";
	data	=	$( "#payment-form" ).serializeArray();
	$.ajax({
		type: 'post',
		url: url,
		dataType: 'json',
		data: data,
		success: function(data) {
			if(data.redirect){
				window.location.href ="{{ URL::to('/') }}	";
			}
			if(data.fail) {
			  
			} 
			if(data.success){
				$("#subtotal").html(data.symbol+'  '+data.amount);
				$("#taxtotal").html(data.symbol+'  '+data.tax);
				$("#total").html(data.symbol+'  '+data.totalamount);
			}
			//alert(data.message);
			
		}
	});
}

//Make it slick!
$('#picdropdown').ddslick({
    onSelected: function(selectedData){
        //callback function: do something with selectedData;
    }   
});
</script>