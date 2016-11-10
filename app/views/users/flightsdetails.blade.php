<!--  Navigation -->
{{ HTML::style('packages/css/jquery.ibutton.css')}}
@include('layouts.user-nav')
<!--content view starts -->
<!-- Main Container Start -->
<?php 
$despath	=	Claimsbag::getSavepath();
$savedpath	=	Claimsbag::getSavedpath();
?>
@if(!empty($flights))
        
		@foreach($flights as $key=>$value)
<?php 
									$date_expiration	=	$flights[$key]['date_expiration'];
									$isexpried			=	true;
									
									if($date_expiration != 0 && $date_expiration <= time()){
										$isexpried	=	false;
									}
									
									if($isexpried){
										//echo $date_expiration.' '.time();
									}
								?>		
<div id="mws-container" class="clearfix" style="margin-left: 0px;">
<div style="background: #F5F5F5;margin-top:80px;margin-bottom:20px;">
<div class="container" style="width: 90%;margin-left: 0;margin-right: 0;padding-left: 5%;padding-right: 5%;padding-bottom: 15px;padding-top: 0px;">

	

		<!-- Intro Content -->
		<!--<div class="content_wrap intro_bg">
			<div class="content clearfix">
				<div class="col100">

					
					<p style="text-align:justify">
						{{ trans('userlistflights.description') }}
						<br/>
						<a class="btn mws-login-button" id="active_click" href="#">{{ trans('userlistflights.active_status') }}</a>
						<a class="btn mws-login-button" id="expired_click" href="#">{{ trans('userlistflights.expired_status') }}</a>
						<a class="btn mws-login-button" id="lost_click" href="#">{{ trans('userlistflights.lost_status') }}</a>
						<p id="loading" style="display: none;"><img src="{{ asset('images/loading.gif') }}"   />&nbsp;&nbsp;{{ trans('userlistflights.loading_message') }}</p>
					</p>

				</div>
			</div>
		</div>-->

		<!-- Statistics Button Container -->
		<div class="mws-stat-container clearfix" style="padding-top: 10px;margin-bottom:0px">

		<div class="row">

				<div class="grid_8">
				<h2 class="robotitle" style="font-size:25px;font-weight: 600;margin-bottom: -10px;">{{ $flights[$key]['depdate'] .',&nbsp;'.$flights[$key]['depport'] .'&nbsp>&nbsp;'.$flights[$key]['arrport'] }}</h2>
				<p style="font-size: 18px;line-height: 25px;margin-bottom: 20px;">
				<?php if($isexpried)
						echo trans('activatesmarttrack.smart_track_expires');
					  else
					  	echo trans('activatesmarttrack.smart_track_expires');
			 ?> <?php 
								//if($flights[$key]['date_expiration'] != 0)
									echo date('d-m-Y',($flights[$key]['date_expiration']));
								
							?>{{ trans('userlistflights.description2') }}</p>
							<div style="float: left;margin-right: 10px;">
							<?php if($isexpried){ ?>
								
								@if($flights[$key]['flag_status'] == '1')	
									<a href="#" class="disabledibutton"><input type="checkbox" name="status" class="ibutton" disabled="disabled"  value="0" checked="checked"> </a>
								@elseif($flights[$key]['flag_status'] == '0' &&  $flights[$key]['status']=='act')
									<!--<input type="hidden" id="idbag_{{ $flights[$key]['idbag'] }}"  value="{{ $flights[$key]['idbag'] }}" />-->
									<input type="hidden" id="airlinetag_{{ $flights[$key]['idbag'] }}" value="{{ $flights[$key]['tag_image'] }}" />
									<input type="hidden" id="_token" value="{{ csrf_token() }}" />
									<input type="checkbox" name="status_{{ $flights[$key]['idbag'] }}" class="ibutton" value="actlost" checked="checked">
								@elseif($flights[$key]['flag_status'] == '0' &&  $flights[$key]['status']=='actlost')
									<!--<input type="hidden" id="idbag_{{ $flights[$key]['idbag'] }}"  value="{{ $flights[$key]['idbag'] }}" />-->
									<input type="hidden" id="airlinetag_{{ $flights[$key]['idbag'] }}" value="{{ $flights[$key]['tag_image'] }}" />
									<input type="hidden" id="_token" value="{{ csrf_token() }}" />
									<input type="checkbox" name="status_{{ $flights[$key]['idbag'] }}" class="ibutton" value="act">	
								@endif	
                                
                                @if($flights[$key]['idclaim'] == '0')	
									<button class="btn mws-login-button"  style="margin-top: -24px;margin-left: 6px;text-transform: none;"onclick="return openclaim({{ $flights[$key]['idbag'] }});">{{ trans('userlistflights.refund_request') }}</button>
                                @endif	
                                <?php }
								else{
								?>	<?php /*?><button class="btn-primary">{{ trans('userlistflights.expired_status') }}</button><?php */?>
                                	<?php /*?>{{ $flights[$key]['flag_status'] }}
                                    {{ $flights[$key]['status'] }}<?php */?>
                                	@if($flights[$key]['flag_status'] == '1')	
                                    	<img src="{{ asset('images/delivered.png') }}"   />
                                    @elseif($flights[$key]['flag_status'] == '0' &&  $flights[$key]['status']=='exp')
                                    	<img src="{{ asset('images/delivered.png') }}"   />
                                    @elseif($flights[$key]['flag_status'] == '0' &&  $flights[$key]['status']=='explost')
										<img src="{{ asset('images/not-delivered.png') }}"   />
                                    @endif	
                                  <?php
								}?>
                                <p id="deliveredloadingdiv" style="display: none;"><img src="{{ asset('images/loading.gif') }}"   />&nbsp;&nbsp;{{ trans('userlistflights.loading_message') }}</p>
							</div>
							<div style="float:left;">
							<a class="btn mws-login-button" href="{{ URL::to('users/listflights') }}">{{ trans('userlistflights.back') }}</a>
							</div>
							<div style="float:left;">
							</div>
							<div style="clear:both"></div>
				<p id="loading" style="display: none;"><img src="{{ asset('images/loading.gif') }}"   />&nbsp;&nbsp;{{ trans('userlistflights.loading_message') }}</p>
				</div>

				
				
				


				<!--<div id="lost_click" onclick="window.location='#';" class="grid_1" style="float:right;cursor:pointer;">
					<div class="iconColWrap">
						<i class="fa fa-binoculars" style="margin-bottom:0;cursor:pointer"></i>
						<h2 style="margin-bottom:0">{{ trans('userlistflights.lost_status') }}</h2>
						<p style="margin:0">{{ trans('userlistflights.lost_status') }}</p>

					</div>				
				</div>
				
				<div id="expired_click" onclick="window.location='#';" class="grid_1" style="float:right;cursor:pointer;">
					<div class="iconColWrap">
						<i class="fa fa-clock-o" style="margin-bottom:0;cursor:pointer"></i>
						<h2 style="margin-bottom:0">{{ trans('userlistflights.expired_status') }}</h2>
						<p style="margin:0">{{ trans('userlistflights.expired_status') }}</p>
					</div>				
				</div>
				
				<div id="active_click" onclick="window.location='#';" class="grid_1" style="float:right;cursor:pointer;">
					<div class="iconColWrap">
						<i class="fa fa-check" style="margin-bottom:0;cursor:pointer"></i>
						<h2 style="margin-bottom:0">{{ trans('userlistflights.active_status') }}</h2>
						<p style="margin:0">{{ trans('userlistflights.active_status') }}</p>
					</div>
				</div>
				<div onclick="return activatesmarttrack();" class="grid_1" style="float:right;cursor:pointer;">
					<div class="iconColWrap">
						<i class="fa fa-check-circle-o" style="margin-bottom:0;cursor:pointer"></i>
						<h2 style="margin-bottom:0">{{ trans('userdashboard.activate') }}</h2>
						<p style="margin:0">Smart Track</p>

					</div>				
				</div>
				
				<div onclick="return registersmartcard();" class="grid_1" style="float:right;cursor:pointer;">
					<div class="iconColWrap">
						<i class="fa fa-pencil-square-o" style="margin-bottom:0;cursor:pointer"></i>
						<h2 style="margin-bottom:0">{{ trans('userdashboard.register_a_smart_card') }}</h2>
						<p style="margin:0">{{ trans('userdashboard.register_a_smart_card_2') }}</p>
					</div>				
				</div>
				
				<div onclick="return buysmartcard();" class="grid_1" style="float:right;cursor:pointer;">
					<div class="iconColWrap">
						<i class="fa fa-shopping-cart" style="margin-bottom:0;cursor:pointer"></i>
						<h2 style="margin-bottom:0">{{ trans('userdashboard.buy_a_smart_card') }}</h2>
						<p style="margin:0">{{ trans('userdashboard.buy_a_smart_card_2') }}</p>
					</div>
				</div>-->

				<div class="clear"></div>
			</div>
		</div>
		</div><div style="clear:both"></div>
</div> 
		<!-- Inner Container Start -->

	<!-- Inner Container Start -->
	<div class="container">

		<!-- Intro Content -->

		<!--Panel start -->
        
		<div id="changeflight">
		
		<div class="mws-panel grid_8" >

			<!--<div class="mws-panel-header">

				<span><i class="icon-book"></i>{{ 'To'.'&nbsp;:&nbsp;'.$flights[$key]['depport'] .'&nbsp;&nbsp;&nbsp;'.$flights[$key]['depdate'] }}</span>
			</div>-->
			<div class="no-padding" >
				<!--<h3>{{ trans('userlistflights.your_flights') }}</h3>-->
                

				
							<div class="mws-panel grid_4">
							
							<div class="mws-panel-body">
							<h2>{{ trans('userlistflights.title1') }}</h2>
								<div>

									<img style="width: 190px;float: left;margin-right: 10px;"src="{{ asset('images/cards/'.$flights[$key]['card_color'].'.png') }}"  />
									
				                                    <h3>{{ $flights[$key]['smartcardcode'] }}</h3>
				                               		
				                   
								</div>
								<div style="clear:both;"></div>
								<div>

									<div class="placehold" style="width: 183px;height: 120px;margin-top: 10px;float:left;margin-right: 10px;">
                                    	@if($flights[$key]['picture1']!='' && $flights[$key]['picture1']!=NULL)
                                        	<img style="width:100%;background:white" src="{{ ($savedpath.'uploads/bags/'.$flights[$key]['idclient'].'-'.$flights[$key]['picture1']) }}" width="70px" height="70px"  />
                                         @endif 
                                        
                                        </div>
									 <div style="padding-top: 1px;">
				                                    <h3>{{ $flights[$key]['name'] }}</h3>
				                               		<p style="font-size: 18px;line-height: 25px;">{{ $flights[$key]['brand'] }} - {{ $flights[$key]['color'] }}</p>
				                                    
				                      </div>
									  
								</div>
								
								<div style="clear:both;"></div>
								<div>

									<span class="key">
                                    @if($flights[$key]['tag_image']=='')
									<div class="placehold" style="width: 183px;height: 120px;margin-top: 10px;float:left;margin-right: 10px;">
                                    	<img style="width:100%;background:white" src="{{ asset('images/airline-tag.jpg') }}"  />
										</div>
                                    @else
                                    	<?php 
											$url	=	$savedpath."uploads/airlinetag/".$flights[$key]['idclient'].'-'.$flights[$key]['tag_image'];
										?>
										<div class="placehold" style="width: 183px;height: 120px;margin-top: 10px;float:left;margin-right: 10px;">
                                    	<img src="{{ asset($url) }}"  width="150px" />
										</div>
                                    @endif    
                                    </span>
									 <div style="padding-top: 1px;">
									 <h3>Airline Tag</h3>
				                                    <span class="text-nowrap">{{ $flights[$key]['airlinetag'] }}</span>
                                                    
                                                    <?php if($isexpried){ ?>
				                                    @if($flights[$key]['tag_image']=='')
				                                    	<button class="editairlinetag" id="idbag_{{$flights[$key]['idbag']}}">{{ trans('userlistflights.edit_button') }}</button>
				                                    @endif
                                                    <?php } ?>
                                                    
				                                    <div id="airlinetag_dialog_{{ $flights[$key]['idbag'] }}" style="display: none;">
						                        		<div class="mws-dialog-inner">
						                            			{{ Form::open(array('url' => array('http://safe-bag.com/stws/public/index.php/api/v1/updateairlinetag'),'class'=>'mws-form','method'=>'post', 'id'=>'airlinetag_form_'.$flights[$key]['idbag'])) }}
						                            			<div id="mws-validate-error1" class="mws-form-message error" style="display:none;"></div>
                                                                <div id="errordiv1">
                                                                 
                                                                 </div>
										                            <div class="mws-form-inline">
																	<!--<p>{{ trans('userlistflights.label_airlineimage') }}</p>-->
										                                <div class="mws-form-row">
										                                    
										                                    
										                                          {{ Form::file('tag_image') }}
										                                          {{ Form::hidden('idbag', $flights[$key]['idbag']) }}<p id="airlinetagloadingdiv" style="display: none;"><img src="{{ asset('images/loading.gif') }}"   />&nbsp;&nbsp;{{ trans('userlistflights.loading_message') }}</p>
										                                         
										                                    
										                                </div>
										                            </div>
																	
																	
					
																	<div class="ui-dialog-buttonset" style="text-align:center">
										                    			<input style="width:auto" type="submit" value="{{ trans('userlistflights.submit_button') }}" class="popupbutton" onclick="return tagimagesubmit({{ $flights[$key]['idbag'] }});">
										                    			<input style="width:auto" type="reset" value="{{ trans('userlistflights.reset_button') }}" class="popupbutton">
                                                                        
										                    		</div>
					
																	</div>
										                    	  	
										                         {{ Form::close() }}  
										                      
						                                </div>
						                            </div>
				                               		
				                      </div>
								</div>
								
							</div>
							</div>
							<div class="mws-panel grid_4">
							<div class="mws-panel-body">
							<h2>{{ trans('userlistflights.title2') }}</h2>
							<ul class="mws-summary clearfix">
							
								<li class='clearfix'><p style="font-size: 18px;line-height: 25px;">{{ trans('userlistflights.payment_date') }}:  {{ $flights[$key]['payment_date'] }} </p></li>
								<!--<li class='clearfix'>{{ trans('userlistflights.date') }} :  {{ $flights[$key]['depdate'] }},
                                <?php 
									//if($date_expiration != 0 && $date_expiration <= time())
									if($isexpried){
										$isexpried	=	false;
										echo 'Smart Track expires '.date('d-m-Y',$date_expiration);
									}
									else{
										echo 'Smart Track expired '.date('d-m-Y',$date_expiration);
									}
								?>
                                
                                </li>-->
								<li class='clearfix'>
									<?php /*?>{{ trans('userlistflights.from') }} :<?php */?>
                                    <p style="font-size: 18px;line-height: 25px;"><img src="{{ asset('images/landing.png') }}"   />&nbsp;&nbsp; {{ $flights[$key]['depport'] }}</p>
								 </li>
                                 <?php 
									if($flights[$key]['scalo1'] != ''){
								?>
                                <li class='clearfix'><?php /*?>{{ trans('userlistflights.passthrough1') }} :<?php */?> 
                                    <p style="font-size: 18px;line-height: 25px;"><img src="{{ asset('images/designBtn.png') }}"   />&nbsp;&nbsp; {{ $flights[$key]['scalo1'] }} </p></li>
                                    <?php } ?>
                                <?php 
									if($flights[$key]['scalo2'] != ''){
								?>
								<li class='clearfix'><?php /*?>{{ trans('userlistflights.passthrough2') }} :<?php */?>
                                    <p style="font-size: 18px;line-height: 25px;"><img src="{{ asset('images/designBtn.png') }}"   />&nbsp;&nbsp;  {{ $flights[$key]['scalo2'] }} </p></li>
                                 <?php } ?>
                                 <?php 
									if($flights[$key]['scalo3'] != ''){
								?>
								<li class='clearfix'><?php /*?>{{ trans('userlistflights.passthrough3') }} :<?php */?>
                                    <p style="font-size: 18px;line-height: 25px;"><img src="{{ asset('images/designBtn.png') }}"   />&nbsp;&nbsp;  {{ $flights[$key]['scalo3'] }} </p></li>
                                    <?php } ?>
								<li class='clearfix'><?php /*?>{{ trans('userlistflights.to') }}	  : <?php */?>
                                    <p style="font-size: 18px;line-height: 25px;"><img src="{{ asset('images/takeOf.png') }}"   />&nbsp;&nbsp; {{ $flights[$key]['arrport'] }} </p></li>								
								<?php $airportsall	=	Airlines::lists('name_airline','idairline');?>
								<li class='clearfix'><p style="font-size: 18px;line-height: 25px;">{{ trans('userlistflights.airline') }}:  {{ $airportsall[$flights[$key]['airline']] }} </p></li>
								
								
							</ul>
							</div>
							</div>

						

			</div>

		</div>
		@endforeach
		@endif
        	<div id="mws-form-dialog" title="{{ trans('userclaims.add_claims') }}" style="width:auto">                    
                {{ Form::open(array('url'=>'users/addclaims', 'class'=>'form-signup', 'id'=>'addclaimsform', 'enctype'=>'multipart/form-data' )) }}
                    <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                    <div id="errordiv">
                     
                     </div>
                    <div class="mws-form-inline">
                        
                        
                        
                            <p><img src="/images/check-icon.png" style="width:20px;vertical-align:middle"> <?php echo trans('userclaims.lost');?></p>
							<p><img src="/images/clock-icon.png" style="width:20px;vertical-align:middle"> <?php echo trans('userclaims.lost2');?> <?php echo date('d-m-Y');?>
                            <div class="mws-form-item" style="display:none">
                            {{ Form::radio('lost',1, true,array('id'=>'lost')) }}   
                            </div>   
                        
                        
                        <div class="mws-form-row" style="display:none">
                            <label class="mws-form-label"><?php echo trans('userclaims.sigdate');?></label>
                            <div class="mws-form-item">
                            {{ Form::hidden('idbag', null, array('class'=>'form-control required', 'id'=>'idbag')) }}      
                            {{ Form::text('sigdate', date('d-m-Y'), array('class'=>'form-control required', 'id'=>'sigdate', 'readonly' => true)) }}  
                            </div>    
                        </div>
                        
                        <div class="mws-form-row">
                            <p><?php echo trans('userclaims.notes_des');?></p>
                            <div class="mws-form-item">
                            {{ Form::textarea('notes', null, array('class'=>'form-control required', 'id'=>'notes', 'placeholder'=>trans('userclaims.description_1'), 'required' => '', 'style'=>'height: 110px;border-radius: 15px;width: 400px;')) }}    
                            </div>  
                        </div>                            
                        
                    </div>
                    {{ Form::submit( trans('frontend.update'), array('class'=>'btn btn-lg btn-primary btn-block','style'=>'width: 400px;', 'onclick'=>'return submitform()'))}}
                    <p id="loadingrefund" style="display: none;"><img src="{{ asset('images/loading.gif') }}"   />&nbsp;&nbsp;{{ trans('userlistflights.loading_message') }}</p>
                {{ Form::close() }}
            </div>
        	<?php /*?><div id="mws-form-dialog" title="{{ trans('userclaims.add_claims') }}">                    
                {{ Form::open(array('url'=>'users/addclaims', 'class'=>'form-signup', 'id'=>'addclaimsform', 'enctype'=>'multipart/form-data' )) }}
                    <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                    <div id="errordiv">
                     
                     </div>
                    <div class="mws-form-inline">
                        
                        
                        <?php /*?><div class="mws-form-row">
                            <label class="mws-form-label"><?php echo trans('userclaims.lost');?></label>
                            <div class="mws-form-item">
                            {{ Form::radio('lost',1, true,array('id'=>'lost')) }}   
                            </div>   
                        </div><?php * /?>
                        <p><img src="/images/check-icon.png" style="width:20px;vertical-align:middle"> <?php echo trans('userclaims.lost');?></p>
                        <p><img src="/images/clock-icon.png" style="width:20px;vertical-align:middle"> <?php echo trans('userclaims.lost2');?> <?php echo date('d-m-Y');?>
                        <div class="mws-form-item" style="display:none">
                        {{ Form::radio('lost',1, true,array('id'=>'lost')) }}   
                        </div>   
                        
                        <div class="mws-form-row">
                            <label class="mws-form-label"><?php echo trans('userclaims.sigdate');?></label>
                            <div class="mws-form-item">
                            {{ Form::hidden('idbag', null, array('class'=>'form-control required', 'id'=>'idbag')) }}      
                            {{ Form::text('sigdate', date('d-m-Y'), array('class'=>'form-control required', 'id'=>'sigdate', 'readonly' => true)) }}  
                            </div>    
                        </div>
                        
                        <div class="mws-form-row">
                            <label class="mws-form-label"><?php echo trans('userclaims.notes_des');?></label>
                            <div class="mws-form-item">
                            {{ Form::textarea('notes', null, array('class'=>'form-control required', 'id'=>'notes', 'placeholder'=>trans('userclaims.description_1'), 'required' => '', 'style'=>'height:50px;')) }}    
                            </div>  
                        </div>                            
                        
                    </div>
                    {{ Form::submit( trans('frontend.update'), array('class'=>'btn btn-lg btn-primary btn-block','onclick'=>'return submitform()'))}}
                    <p id="loadingrefund" style="display: none;"><img src="{{ asset('images/loading.gif') }}"   />&nbsp;&nbsp;{{ trans('userlistflights.loading_message') }}</p>
                {{ Form::close() }}
            </div><?php */?>
            <div id="dialog-confirm">
              <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{{ trans('userlistcards.update_your_profile') }}</p>
            </div>
            
            <!--<div id="dialogconfirmlost">
              <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{{ trans('userlistflights.conform_lost_message') }}</p>
            </div>-->
            
            
		</div>
        		
		<!-- Panels End -->

	</div>
	<!-- Inner Container End -->

	<!-- Footer -->
	@include('layouts.admin-foot')

</div>
<!-- Main Container End -->

</div>

<script type="text/javascript">


function checkprofileupdate(idbag){
	url	=	"{{ URL::to('users/ajaxcheckprofile') }}";
	data	=	$( "#addclaimsform" ).serializeArray();
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
				
			  	$( "#dialog-confirm" ).dialog({
				  resizable: false,
				  modal: true,
				  buttons: {
					"{{ trans('userlistcards.update_profile') }}": function() {
						window.location.href ="{{ URL::to('users/viewprofile') }}	";
					},
					"{{ trans('userlistbags.cancel') }}": function() {
					  $( this ).dialog( "close" );
					}
				  }
				});
				$( "#dialog-confirm" ).dialog( "open" );
			} 
			if(data.success){
				$("#addclaimsform #idbag").val(idbag);
				$( "#mws-form-dialog" ).dialog( "open" );
			}
			//alert(data.message);
			
		}
	});
	//return false;	
}

function openclaim(idbag){
	
	checkprofile=checkprofileupdate(idbag);
	/*//alert(checkprofile)
	if(checkprofileupdate() == true){
		$("#addclaimsform #idbag").val(idbag);
		$( "#mws-form-dialog" ).dialog( "open" );
	}
	else{
		$( "#dialog-confirm" ).dialog({
		  resizable: false,
		  modal: true,
		  buttons: {
			"{{ trans('userlistcards.update_profile') }}": function() {
				window.location.href ="{{ URL::to('users/viewprofile') }}	";
			},
			"{{ trans('userlistbags.cancel') }}": function() {
			  $( this ).dialog( "close" );
			}
		  }
		});
		//$( "#dialog-confirm" ).dialog( "open" );
	}*/
	//$("#ui-datepicker-div").hide();
	return false;	
}


function tagimagesubmit(value){
	id	=	'#airlinetag_form_'+value;
	modelid	=	'#airlinetag_dialog_'+value;
	$( id+" #mws-validate-error1" ).html("");
	$( id+" #mws-validate-error1" ).hide();
	$("#airlinetagloadingdiv").show();
	$(id).ajaxForm(function(result) {
		data	=	result;
		if(data.redirect){
			window.location.href ="{{ URL::to('users/dashboard') }}	";
		}
		if(data.fail) {
		  $.each(data.errors, function( index, value ) {
			 // alert(value);
			  $( id+" #mws-validate-error1" ).append( '<div class="alert alert-danger">'+value+'</div>' );
			   $( id+" #mws-validate-error1" ).show();
			/*var errorDiv = '#'+index+'_error';
			$(errorDiv).addClass('required');
			$(errorDiv).empty().append(value);*/
		  });
		 		  		           
		} 
		if(data.success){
			$( modelid ).dialog( "close" );
			location.reload();
			//window.location.href ="{{ URL::to('users/listbags') }}	";
		}
		$("#HiddenRowsa").hide();
		$('#table').prepend(result);
		$("#airlinetagloadingdiv").hide();
	}).submit();
	
	return false;
}

$(function() {
	$( "#mws-form-dialog" ).dialog({
	autoOpen: false,
	//left:'15%',
	width: '50%',
	modal: true,	
	
	});
	$( "#dialog-confirm" ).dialog({
		autoOpen: false,
		left:'15%',
		//width: '50%',
		modal: true,
	});
	/*$( "#dialogconfirmlost" ).dialog({
		autoOpen: false,
		left:'15%',
		//width: '50%',
		modal: true,
	});*/
	
});
$( document ).ready(function() {
	
	$( "#mws-form-dialog" ).dialog({
	autoOpen: false,
	//left:'15%',
	width: '50%',
	modal: true,	
	
	});
	$( "#dialog-confirm" ).dialog({
		autoOpen: false,
		left:'15%',
		//width: '50%',
		modal: true,
	});
	/*$( "#dialogconfirmlost" ).dialog({
		autoOpen: false,
		left:'15%',
		//width: '50%',
		modal: true,
	});*/
	
	$( "#sigdate" ).datepicker({ dateFormat: 'dd/mm/yy' });
	
	$( ".disabledibutton" ).click(function() {
		alert( "<?php echo trans("userlistflights.status_update_message_4"); ?>" );
		return false;
	});
});

function submitform(){ 
 $( "#mws-validate-error" ).html("");
 $( "#mws-validate-error" ).hide();
 	$("#loadingrefund").show();
    $('#addclaimsform').ajaxForm(function(result) {
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
		 		  		           
		} 
		if(data.success){
			$( "#mws-form-dialog" ).dialog( "close" );
			location.reload();
			//window.location.href ="{{ URL::to('users/listbags') }}	";
		}
		$("#HiddenRowsa").hide();
		$('#table').prepend(result);
		$("#loadingrefund").hide();
	}).submit();
	
	return false;	
}
    </script>
