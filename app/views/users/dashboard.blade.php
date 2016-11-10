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

					<h2>{{ trans('userdashboard.welcome', array('name' => ucwords(Session::get('name')))) }}</h2>
					<p style="text-align:justify">

					</p>
					@include('layouts.user-message')
				</div>
			</div>
		</div>

		<!-- Statistics Button Container -->
		<div class="mws-stat-container clearfix">

			<!-- Statistic Item -->
			<a class="mws-stat" href="#" onclick="return registersmartcard();"> <span class="mws-stat-icon icol32-textfield-add"></span> <span class="mws-stat-content"> 
			<span class="mws-stat-value">{{ trans('userdashboard.register_a_smart_card') }}</span>
			<span class="mws-stat-title">{{ trans('userdashboard.register_a_smart_card_2') }}</span> 
			</span> 
			</a>
			<p id="or">{{ trans('userdashboard.register_a_smart_card_or') }}</p>
			<a class="mws-stat" href="#" onclick="return buysmartcard();"> 
			<span class="mws-stat-icon icol32-cart-add"></span> 
			<span class="mws-stat-content"> 
			<span class="mws-stat-value">{{ trans('userdashboard.buy_a_smart_card') }}</span> 
			<span class="mws-stat-title">{{ trans('userdashboard.buy_a_smart_card_2') }}</span> 
			</span> 
			</a>
		</div>
		
		<div class="mws-panel grid_4">
								<!-- Panel Header -->
								<div class="mws-panel-header">
									<!-- Panel Title -->
									<span><i class="icon-user"></i>{{ trans('userdashboard.your_cards') }}</span>
								</div>

								<!-- Panel Body -->
								<div class="mws-panel-body no-padding" style="padding-top: 10px;">
									<h3 class="dashtitle">{{ trans('userdashboard.your_cards') }}</h3>
									<div class="dashcontainer">
									   <ul class="mws-summary clearfix">
									   	@foreach($cards as $card)
				                            <li class='clearfix'>
				                            	
				                                <span class="key"><img class="roundpic" src="{{ asset('images/cards/'.$card->card_color.'.png') }}"  /></span>
				                                <span class="val">
                                                	<?php 
														$bgfontcolor	=	'color:red';
														if($card->flightnumbers > 0)
															$bgfontcolor	=	'color:green';
													?>
				                                    <span class="text-nowrap">{{ $card->card_number }}</span><br/>
				                                    <span class="text-nowrap">{{ trans('userdashboard.travel_left').':&nbsp;<b style="'.$bgfontcolor.'">'.$card->flightnumbers.'</b>' }}</span>
				                                </span>
				                            </li>
				                            
				                         @endforeach  
				                        </ul>
										</div>
									<div class="mws-button-row">	
									<a class="btn btn btn-primary" href="#" onclick="return registersmartcard();">{{ trans('userdashboard.add_a_new_card') }}</a>
									<a class="btn btn btn-primary" href="{{ URL::to('users/listcards') }}">{{ trans('userdashboard.manage_card') }}</a>
									</div>
								</div>
								
		</div>
		
		<div class="mws-panel grid_4">
								<!-- Panel Header -->
								<div class="mws-panel-header">
									<!-- Panel Title -->
									<span><i class="icon-user"></i>{{ trans('userdashboard.your_bags') }}</span>
								</div>

								<!-- Panel Body -->
								<div class="mws-panel-body no-padding" style="padding-top: 10px;">
									<h3 class="dashtitle">{{ trans('userdashboard.your_bags') }}</h3>
									<div class="dashcontainer">
									 <ul class="mws-summary clearfix">
									   	@foreach($bags as $bag)
				                            <li class='clearfix'>
				                            	
				                                <span class="key">@if($bag->picture1 != '' && file_exists(('uploads/'.$bag->picture1)))<img class="roundpic" src="{{ asset('uploads/'.$bag->picture1) }}" />@endif</span>
				                                <span class="val">
				                                    <span class="text-nowrap">{{ $bag->name }}</span><br/>
				                               		<span class="text-nowrap">{{ trans('userdashboard.bagcolor').':&nbsp;'.$bag->color }}</span><br/>
				                                    <span class="text-nowrap">{{ trans('userdashboard.bagbrand').':&nbsp;'.$bag->brand }}</span>
				                                    
				                                </span>
				                            </li>
				                            
				                         @endforeach  
				                      </ul>
									  </div>
									  <div class="mws-button-row">
									<a class="btn btn btn-primary" href="{{ URL::to('users/listbags') }}">{{ trans('userdashboard.manage_bag') }}</a>
									<!--<a class="btn btn btn-primary" href="{{ URL::to('admin/listcards') }}">{{ 'Manage Cards' }}</a>-->
									</div>
								</div>
							</div>
		<div class="mws-panel grid_4">
								<!-- Panel Header -->
								<div class="mws-panel-header">
									<!-- Panel Title -->
									<span><i class="icon-user"></i>{{ trans('userdashboard.your_flights') }}</span>
								</div>

								<!-- Panel Body -->
								<div class="mws-panel-body no-padding" style="padding-top: 10px;">
									<h3 class="dashtitle">{{ trans('userdashboard.your_flights') }}</h3>
									<div class="dashcontainer">
									 <ul class="mws-summary clearfix">
									   	@foreach($flights as $flight)
				                            <li class='clearfix'>
				                            	
				                                <span class="key"><img class="roundpic" src="{{ asset('images/departure.jpg') }}" /></span>
				                                <span class="val">
				                                    <span class="text-nowrap"><b>{{ date('d/m/Y', $flight->depdate) }}</b></span><br/>
                                                    <span class="text-nowrap">
                                                    @if($flight->flightstatus == 'exp')
                                                    	{{ trans('userlistflights.expired_status') }} -
                                                        {{ trans('userlistflights.smart_track_expired') }}
                                                    	{{ date('d/m/Y', $flight->date_expiration) }}
                                                    @else
                                                    	{{ trans('userlistflights.active_status') }} - 
                                                        {{ trans('userlistflights.smart_track_active') }}
                                                    	{{ date('d/m/Y', $flight->date_expiration) }}
                                                    @endif
                                                    </span><br />
				                               		<span class="text-nowrap">
                                                    
                                                    {{ $airportslist[$flight->depport] }}
                                                    @if($flight->scalo1 != '')
                                                    	> {{ $airportslist[$flight->scalo1] }} 
                                                    @endif
                                                    @if($flight->scalo2 != '')
                                                    	> {{ $airportslist[$flight->scalo2] }} 
                                                    @endif
                                                    @if($flight->scalo3 != '')
                                                    	> {{ $airportslist[$flight->scalo3] }} 
                                                    @endif
                                                    	> 
                                                    {{ $airportslist[$flight->arrport] }}
                                                    </span>
				                                    
				                                    
				                                </span>
				                            </li>
				                            
				                         @endforeach  
				                      </ul>
									  </div>
									  <div class="mws-button-row">
									<a class="btn btn btn-primary" href="{{ URL::to('users/listflights') }}">{{ trans('userdashboard.manage_flight') }}</a>
									<!--<a class="btn btn btn-primary" href="{{ URL::to('admin/listcards') }}">{{ 'Manage Cards' }}</a>-->
									</div>
								</div>
							</div>
			<div class="mws-panel grid_4">
								<!-- Panel Header -->
								<div class="mws-panel-header">
									<!-- Panel Title -->
									<span><i class="icon-user"></i>{{ trans('userdashboard.your_cliams') }}</span>
								</div>

								<!-- Panel Body -->
								<div class="mws-panel-body no-padding" style="padding-top: 10px;">
									<h3 class="dashtitle">{{ trans('userdashboard.your_cliams') }}</h3>
									<div class="dashcontainer">
									<ul class="mws-summary clearfix">
									   	@foreach($claims as $claim)
				                            <li class='clearfix'>
				                            	
				                                <span class="key"><img class="roundpic" src="{{ asset('images/departure.jpg') }}" /></span>
				                                <span class="val">
                                                	<span class="text-nowrap"><b>{{ date('d/m/Y', $claim->depdate) }}</b></span><br/>
                                                    <span class="text-nowrap">
                                                    @if($claim->flightstatus == 'exp')
                                                    	{{ trans('userlistflights.expired_status') }} -
                                                        {{ trans('userlistflights.smart_track_expired') }}
                                                    	{{ date('d/m/Y', $claim->date_expiration) }}
                                                    @else
                                                    	{{ trans('userlistflights.active_status') }} - 
                                                        {{ trans('userlistflights.smart_track_active') }}
                                                    	{{ date('d/m/Y', $claim->date_expiration) }}
                                                    @endif
                                                    </span><br />
				                               		<span class="text-nowrap">
                                                    
                                                    {{ $airportslist[$claim->depport] }}
                                                    @if($claim->scalo1 != '')
                                                    	> {{ $airportslist[$claim->scalo1] }} 
                                                    @endif
                                                    @if($claim->scalo2 != '')
                                                    	> {{ $airportslist[$claim->scalo2] }} 
                                                    @endif
                                                    @if($claim->scalo3 != '')
                                                    	> {{ $airportslist[$claim->scalo3] }} 
                                                    @endif
                                                    	> 
                                                    {{ $airportslist[$claim->arrport] }}
                                                    </span>
				                                    <?php /*?><span class="text-nowrap">{{ date('d/m/Y', $claim->depdate) }}</span><br/>
				                               		<span class="text-nowrap">{{ $claim->depport }}</span><br/>
				                                    <span class="text-nowrap">{{ ucwords($claim->flightstatus) }}</span><?php */?>
				                                    
				                                </span>
				                            </li>
				                            
				                         @endforeach  
				                      </ul>
									  </div>
									  <div class="mws-button-row">
									<a class="btn btn btn-primary" href="{{ URL::to('users/listclaims') }}">{{ trans('userdashboard.manage_claim') }}</a>
									<!--<a class="btn btn btn-primary" href="{{ URL::to('admin/listcards') }}">{{ 'Manage Cards' }}</a>-->
									</div>
								</div>
							</div>				
		<!-- Panel orders -->
		<div class="mws-panel grid_8 mws-collapsible">
			<!-- Panel Header -->
			<div class="mws-panel-header">
				<!-- Panel Title -->
				<span><i class="icon-user"></i>{{ trans('userdashboard.manage_orders') }}</span>
			</div>
			
			<!-- Panel Body -->
			<div class="mws-panel-body no-padding">
				<table class="mws-datatable-fn mws-table" id="bagorders">
					<thead>
						<tr>
							<th>{{ trans('userdashboard.date') }}</th>
							<th>{{ trans('userdashboard.order_id') }}</th>
							<th>{{ trans('userdashboard.address') }}</th>
							<th>{{ trans('userdashboard.city') }}</th>
							<th>{{ trans('userdashboard.status') }}</th>
							<!--<th>{{ 'Actions' }}</th>-->
						</tr>
					</thead>
					<tbody>
						@foreach ($orders as $order)

						<tr>
							<td>{{ date('d-m-Y H:i:s',$order->payment_date) }}</td>
							<td>{{ $order->transaction_id }}</td>
							<td>{{ $order->address_1 }}</td>
							<td>{{ $order->city }}</td>
							<td>{{ $order->orderstatus  }}</td>
							<!--<td><a href="{{ url('admin/orders', $parameters = array('transaction_id'=> $order->transaction_id ), $secure = null) }}"><i class="icon-search"></i> {{ 'View' }}</a></td>-->
						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
        
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
                    data-description="Color: Blue">Smart Tracking Card</option>
                <option value="2" data-imagesrc="{{ asset('minisite/img/cards/2-black-34.png') }}"
                    data-description="Color: black">Smart Tracking Card</option>
                <option value="3" data-imagesrc="{{ asset('minisite/img/cards/3-violet-34.png') }}"
                    data-description="Color: violet">Smart Tracking Card</option>
                <option value="4" data-imagesrc="{{ asset('minisite/img/cards/4-pink-34.png') }}"
                    data-description="Color: pink">Smart Tracking Card</option>
                <?php /*?><option value="5" data-imagesrc="{{ asset('minisite/img/cards/5-darkblue-34.png') }}"
                    data-description="Color: dark blue">Smart Tracking Card</option>
                <option value="6" data-imagesrc="{{ asset('minisite/img/cards/5-orange-34.png') }}"
                    data-description="Color: yellow">Smart Tracking Card</option>                
                <option value="7" data-imagesrc="{{ asset('minisite/img/cards/6-green-34.png') }}"
                    data-description="Color: green">Smart Tracking Card</option>
                <option value="8" data-imagesrc="{{ asset('minisite/img/cards/7-darkgreen-34.png') }}"
                    data-description="Color: dark green">Smart Tracking Card</option><?php */?>
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

	</div>
	<!-- Inner Container End -->

	<!-- Footer -->

</	div>
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

$( "#buycarddiv" ).dialog({
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
					 /* $('html, body').animate({
							scrollTop: $("#errordiv").offset().top
						}, 800);	*/		  		           
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
		  /*$('html, body').animate({
				scrollTop: $("#errordiv").offset().top

			}, 800);*/			  		           
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