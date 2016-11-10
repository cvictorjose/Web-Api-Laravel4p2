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
                                    <a class="btn mws-login-button" href="#" onclick="return registersmartcard();">{{ trans('userlistcards.register_a_smart_card') }}</a>
                                    <a class="btn mws-login-button" href="#" onclick="return buysmartcard();">{{ trans('userlistcards.buy_a_smart_card') }}</a>
									

								</p>
								@include('layouts.user-message')
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
						@foreach($cards as $card)
						<div class="mws-panel grid_4">
								<!-- Panel Header -->
								<div class="mws-panel-header">
									
									<span><i class="icon-book"></i>{{ '#'.$card->card_number }}</span>
								</div>
								<div class="mws-panel-body">
									<!--<h3>{{ trans('userlistcards.your_cards') }}</h3>-->
									   <ul class="mws-summary clearfix">
									   	
				                            <li class='clearfix'>
				                            	
				                                <span class="key"><img src="{{ asset('images/cards/'.$card->card_color.'.png') }}"  /></span>
				                                <span class="val">
                                                	<?php 
														$bgfontcolor	=	'color:red';
														if($card->flightnumbers > 0)
															$bgfontcolor	=	'color:green';
													?>
				                                    <span class="text-nowrap">{{ $card->card_number }}</span><br/>
				                                    <span class="text-nowrap">{{ trans('userlistcards.travel_left').':&nbsp;<b style="'.$bgfontcolor.'">'.$card->flightnumbers.'</b>' }}</span>
				                                </span>
				                            </li>
				                            
				                        
				                        </ul>
									<a class="btn mws-login-button"  href="#" onclick="return rechargecard('{{ $card->card_id }}');">{{ trans('userlistcards.recharge_a_new_card') }}</a>
                                    <a class="btn mws-login-button" href="#" onclick="return deletecard('{{ $card->card_id }}');">{{ trans('userlistcards.delete_card') }}</a>
									<!--<a class="btn mws-login-button" href="{{ URL::to('users/rechargecard') }}">{{ trans('userlistcards.recharge_a_new_card') }}</a>
                                    <a class="btn mws-login-button" href="{{ URL::to('users/deletecard') }}">{{ trans('userlistcards.delete_card') }}</a>-->

								</div>
							</div>	
                        @endforeach  
                        
                       
                        
                       
                <!-- Panels End -->

   
   
            </div>
            <!-- Inner Container End -->
            <div id="mws-form-dialog" title="{{ trans('userlistcards.register_a_smart_card') }}">                    
                    {{ Form::open(array('url'=>'users/addcard', 'class'=>'form-signup', 'id'=>'addcardform', 'enctype'=>'multipart/form-data' )) }}
                        <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                        <div id="errordiv">
                         
                         </div>
                        <div class="mws-form-inline">
                            <div class="mws-form-row">
                            	<label class="mws-form-label"><?php echo trans('userlistcards.card_number');?></label>
                                <div class="mws-form-item">                            	   
                                {{ Form::text('card_number', null, array('class'=>'form-control required', 'id'=>'card_number', 'placeholder'=>trans('userlistcards.card_number'), 'required' => '')) }}  
                                </div>    
                            </div>                            
                            
                            
                        </div>
                        {{ Form::submit( trans('frontend.update'), array('class'=>'btn btn-lg btn-primary btn-block','onclick'=>'return submitform()'))}}
                    {{ Form::close() }}
                </div>
                
                <div id="paymentdiv" title="{{ trans('userlistcards.recharge_a_new_card') }}">                    
                    {{ Form::open(array('url'=>'client/rechargecard', 'class'=>'form-signup', 'id'=>'rechargeform', 'enctype'=>'multipart/form-data' )) }}
                        <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                        <div id="errordiv">
                         
                         </div>
                        <div class="mws-form-inline">
                            <div class="mws-form-row">
                            {{ Form::hidden('card_id', null, array('class'=>'form-control required', 'id'=>'card_id')) }}
                            	<label class="mws-form-label"><?php //echo trans('userlistcards.card_number');?> {{ trans('userlistcards.choose_package') }}</label>
                                <div class="mws-form-item"> 
                                <?php 
								$currencyarray	=	Clients::getPaypalcurrencies(Session::get('cc'));
								$i =1 ?>
                                @foreach ($packages as $package)
                                	<?php 
										$value	=	false;
										if($i==1)
											$value	=	true;
											
										$i++;
										
										$rates_ac_to_products = Exchange::where('currency_code','=',$package->currency)->first();
										$currency_code  =  Session::get('cc');
										
										switch($currency_code){
											case 'EUR' : $exrate = $rates_ac_to_products->exrate_EUR; break;
											case 'USD' : $exrate = $rates_ac_to_products->exrate_USD; break;
											case 'CHF' : $exrate = $rates_ac_to_products->exrate_CHF; break;
											case 'BRL' : $exrate = $rates_ac_to_products->exrate_BRL; break;
											case 'RUB' : $exrate = $rates_ac_to_products->exrate_RUB; break;
											case 'MXN' : $exrate = $rates_ac_to_products->exrate_MXN; break;
											case 'GBP' : $exrate = $rates_ac_to_products->exrate_GBP; break;
										}
										
										if($currency_code == $package->currency){
											$price   = (float)$package->price * (float)$exrate;
										}else{
											$price   = (float)$package->price * (float)$exrate * floatval('1.10');
										}
									?>
                                    {{ Form::radio('package_id', $package->package_id, $value, array('class'=>'form-control required', 'id'=>'package_id', 'required' => '')) }}  {{ $package->numflights}} {{ trans('userlistcards.travel_package') }} {{ $currencyarray['symbol'] }}{{ number_format(round($price, 1), 2); }}
                                    
                                    <br />
                                @endforeach                         	   
                                
                                </div>    
                            </div>                            
                            
                            
                        </div>
                        {{ Form::submit( trans('frontend.update'), array('class'=>'btn btn-lg btn-primary btn-block'))}}
                    {{ Form::close() }}
                </div>
                {{ Form::open(array('url'=>'users/deletecard', 'class'=>'form-signup', 'id'=>'deletecardform', 'enctype'=>'multipart/form-data' )) }}
                	{{ Form::hidden('card_id', null, array('class'=>'form-control required', 'id'=>'card_id')) }}
                {{ Form::close() }}
                <div id="dialog-confirm" title="{{ trans('userlistcards.delete_card') }}">
                  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{{ trans('userlistcards.conform_message') }}</p>
                </div>
                
                <div id="buycarddiv" title="{{ trans('userlistcards.buy_a_smart_card') }}">
                	<!--payment form-->
                   
                        
                     {{ Form::open(array('url'=>'client/buycard', 'class'=>'form-signup', 'id'=>'payment-form', 'name'=>'payment-form' )) }}
					 	<div id="mws-validate-error-buy" class="mws-form-message error" style="display:none;"></div>
                        <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label"><?php echo trans('frontend.select_quantity');?>:</label>
                                 	<div class="mws-form-item">
					
                    					{{ Form::select('qty', $qtyList, null, array('id'=>'qty', 'class' => 'form-control', 'style'=>'width:130px;margin-bottom:0;', 'required' => '')) }}
					 
			            	
                            		</div>
                               	</div>
			            	
								<div class="mws-form-row">
                            		<label class="mws-form-label"><?php echo trans('frontend.select_your_colors');?>:</label>
                                    <div class="mws-form-item">
                       
					{{ Form::hidden('colour', null ,array('id'=>'colour')) }}
            <select id="picdropdown">
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

						<input type="submit" value="<?php echo trans('frontend.pay_with_paypal');?>"><i class="fa fa-spin fa-circle-o-notch fa-form-wait" style="display: none;"></i>
                        </div>
					{{ Form::close() }}
                
                </div>
                       
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
});

$('#updatprice').click(function() {
	calculateprice();
});

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
$( document ).ready(function() {
   calculateprice();
   
   $('.dd-options').click(function() {
		calculateprice();
	});
});

$(function() {
$( "#mws-form-dialog" ).dialog({
autoOpen: false,
left:'15%',
//width: '50%',
modal: true,
});

$( "#paymentdiv" ).dialog({
autoOpen: false,
left:'15%',
//width: '50%',
modal: true,
});

$( "#buycarddiv" ).dialog({
autoOpen: false,
left:'15%',
//width: '50%',
modal: true,
});

$( "#dialog-confirm" ).dialog({
	autoOpen: false,
	left:'15%',
	//width: '50%',
	modal: true,
});



 

});

function rechargecard(id){
	$( "#paymentdiv" ).dialog( "open" );
	$("#rechargeform #card_id").val(id);
	return false;	
}

function deletecard(id){
	$("#deletecardform #card_id").val(id);
	//$( "#dialog-confirm" ).dialog( "open" );
	$( "#dialog-confirm" ).dialog({
		  resizable: false,
		  modal: true,
		  buttons: {
			"{{ trans('userlistcards.delete_card') }}": function() {
			 // $( this ).dialog( "close" );
				$('#deletecardform').ajaxForm(function(result) {
					data	=	result;
					if(data.redirect){
						window.location.href ="{{ URL::to('users/dashboard') }}	";
					}
					if(data.fail) {
					  $.each(data.errors, function( index, value ) {
						 // alert(value);
						  $( "#mws-validate-error" ).append( '<div class="alert alert-danger">'+value+'</div>' );
						   $( "#mws-validate-error" ).show();
						/*var errorDiv = '#'+index+'_error';
						$(errorDiv).addClass('required');
						$(errorDiv).empty().append(value);*/
					  });
					  $('html, body').animate({
							scrollTop: $("#errordiv").offset().top
						}, 800);			  		           
					} 
					if(data.success){
						location.reload();
						//window.location.href ="{{ URL::to('users/listbags') }}	";
					}
					
				}).submit();
			},
			"{{ trans('userlistbags.cancel') }}": function() {
			  $( this ).dialog( "close" );
			}
		  }
		});
		
		$( "#dialog-confirm" ).dialog( "open" );
	
	return false;
}

function buysmartcard(){
	window.location.href ="{{ URL::to('users/payment') }}	";
	/*$( "#buycarddiv" ).dialog( "open" );
	$( "#mws-validate-error-buy" ).html("");
	$( "#mws-validate-error-buy" ).hide();*/
	return false;
}

function registersmartcard(){
	$('#addcardform')[0].reset();
	$( "#mws-form-dialog" ).dialog( "open" );
	$( "#mws-validate-error" ).html("");
	$( "#mws-validate-error" ).hide();
	return false;
}
function submitform(){ 
 $( "#mws-validate-error" ).html("");
 $( "#mws-validate-error" ).hide();
 	var myRegxp = /^([A-Z]{4}[0-9]{8}[A-Z]{2})$/;
	value	=	 $('#addcardform #card_number').val();
	//alert(value);
	if(myRegxp.test(value) == false)
	{
		alert("{{ trans('userlistcards.smart_card_invalid') }} ");
		return false;
	}
	
    $('#addcardform').ajaxForm(function(result) {
		data	=	result;
		if(data.redirect){
			window.location.href ="{{ URL::to('users/dashboard') }}	";
		}
		if(data.fail) {
		  $.each(data.errors, function( index, value ) {
			 // alert(value);
			  $( "#mws-validate-error" ).append( '<div class="alert alert-danger">'+value+'</div>' );
			   $( "#mws-validate-error" ).show();
			/*var errorDiv = '#'+index+'_error';
			$(errorDiv).addClass('required');
			$(errorDiv).empty().append(value);*/
		  });
		 /* $('html, body').animate({
				scrollTop: $("#errordiv").offset().top
			}, 800);	*/		  		           
		} 
		if(data.success){
			$( "#mws-form-dialog" ).dialog( "close" );
			location.reload();
			//window.location.href ="{{ URL::to('users/listbags') }}	";
		}
		
	}).submit();
	
	return false;	
}
</script>