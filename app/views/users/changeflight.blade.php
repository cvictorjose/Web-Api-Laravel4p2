@if(!empty($flights))
{{ HTML::style('packages/css/jquery.ibutton.css')}}
<?php /*?>
{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'); }}

{{ HTML::script('packages/js/libs/jquery-1.8.3.min.js'); }}
{{ HTML::script('packages/js/core/mws.js'); }}
{{ HTML::script('packages/js/libs/jquery.ibutton.min.js'); }}

{{ HTML::script('packages/bootstrap/js/bootstrap.min.js'); }}<?php */?>

<!-- JS Includes -->

		{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'); }}

		{{ HTML::script('packages/js/libs/jquery-1.8.3.min.js'); }}
        {{ HTML::script('packages/js/core/mws.js'); }}
        {{ HTML::script('packages/js/libs/jquery.ibutton.min.js'); }}
		<?php /*?>{{ HTML::script('packages/custom-plugins/fileinput.js'); }}
		<!-- jQuery-UI Dependent Scripts -->
		{{ HTML::script('packages/jui/js/jquery-ui-effects.min.js'); }}
		<!-- Plugin Scripts -->
		{{ HTML::script('packages/plugins/validate/jquery.validate-min.js'); }}
		<!-- Login Script -->
		{{ HTML::script('packages/js/core/login.js'); }}
		{{ HTML::script('minisite/js/jquery.blockUI.js'); }}
		<!-- JavaScript Plugins -->
		{{ HTML::script('packages/js/libs/jquery.mousewheel.min.js'); }}
		{{ HTML::script('packages/js/libs/jquery.placeholder.min.js'); }}

		<!--wizard  -->
		{{ HTML::script('packages/custom-plugins/wizard/wizard.min.js'); }}<?php */?>
		{{ HTML::script('packages/custom-plugins/wizard/jquery.form.min.js'); }}

		<!-- jQuery-UI Dependent Scripts -->
		{{ HTML::script('packages/jui/js/jquery-ui-1.9.2.min.js'); }}
		<?php /*?>{{ HTML::script('packages/jui/jquery-ui.custom.min.js'); }}
		{{ HTML::script('packages/jui/js/jquery.ui.touch-punch.js'); }}
		{{ HTML::script('packages/jui/js/globalize/globalize.js'); }}
		{{ HTML::script('packages/jui/js/globalize/cultures/globalize.culture.en-US.js'); }}

		<!-- Plugin Scripts -->
		{{ HTML::script('packages/plugins/datatables/jquery.dataTables.min.js'); }}
		{{ HTML::script('packages/plugins/colorpicker/colorpicker-min.js'); }}

		<!-- i button -->
		

		<!-- Core Script -->
		{{ HTML::script('packages/bootstrap/js/bootstrap.min.js'); }}
		

		<!-- CKeditor-->
		{{ HTML::script('packages/plugins/ckeditor/ckeditor.js'); }}<?php */?>
		
<script>

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
		alert( '{{ trans("userlistflights.status_update_message_1") }}' );
		return false;
	});
});
		$(function() {

	@if(Request::segment('2')=='changeflight')
	if( $.fn.iButton ) {
	$('.ibutton').iButton({
	change : function($input){
	var domName = $($input).attr('name');
	var domValue = $($input).attr('value');
	var idbag   = domName.replace('status_','');
	var status  = domValue;
	//alert(idbag);
	if($('#airlinetag_'+idbag).val()!=''){

	//console.log($($input).attr('name'));

	//$(".ibutton").iButton("disable");
	$.ajax({
	type: "POST",
	url: "{{ URL::to('users/changestatus') }}",
	data: { '_token': $('#_token').val(), 'status': status, 'idbag' : idbag  },
	dataType: 'json',
	success : function(data){
			if(data.flag_status == 0)
				alert('{{ trans("userlistflights.status_update_message_1") }}');
		  	else
				alert('{{ trans("userlistflights.status_update_message_2") }}');
		//alert( '{{ trans("userlistflights.status_update_message") }}');
	location.reload()
	}
	});

	}else{
	alert('{{ trans("userlistflights.airlinetag_empty_message") }}');
	return false;
	}

	}

	});
	}

	//airline tag udpate dialog
	$(".editairlinetag").bind("click", function (event) {

	var idbag_data = $(this).attr('id');
	var idbag = idbag_data.replace('idbag_','');

	$("#airlinetag_dialog_"+idbag).dialog({
	modal: true,
	width : 400,
	height : 200

	}).dialog("open");
	event.preventDefault();

	});

	@endif

	});</script>

<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-table"></i> {{ trans('userlistflights.your_flights') }}</span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-table">
            <thead>
                <tr>  
                    <th>{{ trans('userclaims.depating_airport') }}<!--Aeroporto Arrivo--></th>
                    <th>{{ trans('userclaims.destination_airport') }}<!--Aeroporto Partenza--></th>                            <th>{{ trans('userlistflights.date') }}<!--Data Partenza--></th>
                    <th>{{ trans('userlistflights.expiration_date') }}<!--Data Arrivo--></th>
                    <th>{{ trans('userclaims.status') }}<!--Aerolinea--></th>                                    
                    <th>{{ trans('userclaims.action') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($flights as $key=>$value)
                <tr>  
                    <td>{{ $flights[$key]['arrport'] }}</td>
                    <td>{{ $flights[$key]['depport'] }}</td>
                    <td>{{ $flights[$key]['depdate'] }}</th>
                    <td>
                    <?php 
                        //if($flights[$key]['date_expiration'] != 0)
                            echo date('d-m-Y',($flights[$key]['date_expiration']));
                        
                    ?>
                    </td>
                    <td>
                        <?php 
                        $date_expiration	=	$flights[$key]['date_expiration'];
                        $isexpried			=	true;
                            
                        if($date_expiration != 0 && $date_expiration <= time()){
                            $isexpried	=	false;
                        }
                        if($isexpried){ ?>
                        @if($flights[$key]['status'] == 'actlost')
                            <button class="btn-primary">{{ trans('userlistflights.active_status') }}</button> 
                            <button class="btn-primary">{{ trans('userlistflights.lost_status') }}</button>	 
                        @elseif($flights[$key]['status']=='exp' || $flights[$key]['status']=='explost')
                            <button class="btn-primary">{{ trans('userlistflights.expired_status') }}</button>
                        @else
                            <button class="btn-primary">{{ trans('userlistflights.active_status') }}</button> 
                        @endif
                        <?php }else{ ?>
                            <button class="btn-primary">{{ trans('userlistflights.expired_status') }}</button>
                        <?php } ?>
                    </td>                                    
                    <td> 
                        <a class="btn mws-login-button" href="{{ URL::to('users/flightsdetails/'.$flights[$key]['idbag']) }}" >{{ trans('userlistflights.details') }}</a> &nbsp;&nbsp;
                        <?php 
                        if($isexpried){ ?>
                        @if($flights[$key]['idclaim'] == '0')	
                            <button class="btn mws-login-button"  onclick="return openclaim({{ $flights[$key]['idbag'] }});">{{ trans('userclaims.open_claim') }}</button>
                        @endif
                        <?php }?>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<?php /*?>@foreach($flights as $key=>$value)
<div class="mws-panel grid_8 mws-collapsible" >

			<div class="mws-panel-header">

				<span><i class="icon-book"></i>{{ 'To'.'&nbsp;:&nbsp;'.$flights[$key]['depport'] .'&nbsp;&nbsp;&nbsp;'.$flights[$key]['depdate'] }}</span>
			</div>
			<div class="mws-panel-body no-padding" >
				<!--<h3>{{ trans('userlistflights.your_flights') }}</h3>-->

				<table class="mws-table">
					<thead>

					</thead>
					<tbody>
						<tr>
							<td>
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
								{{ trans('userlistflights.status') }}: 
								<?php if($isexpried){ ?>
								@if($flights[$key]['status'] == 'actlost')
									<button class="btn-primary">{{ trans('userlistflights.active_status') }}</button> 
									<button class="btn-primary">{{ trans('userlistflights.lost_status') }}</button>	 
								@elseif($flights[$key]['status']=='exp' || $flights[$key]['status']=='explost')
									<button class="btn-primary">{{ trans('userlistflights.expired_status') }}</button>
								@else
									<button class="btn-primary">{{ trans('userlistflights.active_status') }}</button> 
								@endif
                                <?php }else{ ?>
                                	<button class="btn-primary">{{ trans('userlistflights.expired_status') }}</button>
                                <?php } ?>
							</td>
							<td>
                            	<?php if($isexpried){ ?>
								{{ trans('userlistflights.lost_luggage') }} 
								@if($flights[$key]['flag_status'] == '1')	
									<a href="#" class="disabledibutton"><input type="checkbox" name="status" class="ibutton" disabled="disabled"  value="0"> </a>
								@elseif($flights[$key]['flag_status'] == '0' &&  $flights[$key]['status']=='act')
									<!--<input type="hidden" id="idbag_{{ $flights[$key]['idbag'] }}"  value="{{ $flights[$key]['idbag'] }}" />-->
									<input type="hidden" id="airlinetag_{{ $flights[$key]['idbag'] }}" value="{{ $flights[$key]['tag_image'] }}" />
									<input type="hidden" id="_token" value="{{ csrf_token() }}" />
									<input type="checkbox" name="status_{{ $flights[$key]['idbag'] }}" class="ibutton" value="actlost">
								@elseif($flights[$key]['flag_status'] == '0' &&  $flights[$key]['status']=='actlost')
									<!--<input type="hidden" id="idbag_{{ $flights[$key]['idbag'] }}"  value="{{ $flights[$key]['idbag'] }}" />-->
									<input type="hidden" id="airlinetag_{{ $flights[$key]['idbag'] }}" value="{{ $flights[$key]['tag_image'] }}" />
									<input type="hidden" id="_token" value="{{ csrf_token() }}" />
									<input type="checkbox" name="status_{{ $flights[$key]['idbag'] }}" class="ibutton" value="act">	
								@endif	
                                
                                @if($flights[$key]['idclaim'] == '0')	
									<button class="btn-danger pull-right"  onclick="return openclaim({{ $flights[$key]['idbag'] }});">{{ trans('userlistflights.refund_request') }}</button>
                                @endif	
                                <?php } ?>
							</td>
						</tr>
						<tr>
							<td>
							<ul class="mws-summary clearfix">

								<li class='clearfix'>

									<span class="key"><img src="{{ asset('images/cards/'.$flights[$key]['card_color'].'.png') }}"  /></span>
									<span class="val">
				                                    <span class="text-nowrap">{{ $flights[$key]['smartcardcode'] }}</span><br/>
				                               		
				                      </span>
								</li>
								<li class='clearfix'>

									<span class="key"><img src="{{ asset('uploads/'.$flights[$key]['picture1']) }}" width="70px" height="70px"  /></span>
									 <span class="val">
				                                    <span class="text-nowrap">{{ $flights[$key]['name'] }}</span><br/>
				                               		<span class="text-nowrap">{{ trans('userdashboard.bagcolor').':&nbsp;'.$flights[$key]['color'] }}</span><br/>
				                                    <span class="text-nowrap">{{ trans('userdashboard.bagbrand').':&nbsp;'.$flights[$key]['brand'] }}</span>
				                                    
				                      </span>
								</li>
								
								
								<li class='clearfix'>

									<span class="key">
                                    @if($flights[$key]['tag_image']=='')
                                    	<img src="{{ asset('images/airline-tag.jpg') }}"  />
                                    @else
                                    	<?php 
											$url	=	"uploads/airlinetag/".$flights[$key]['idclient'].'-'.$flights[$key]['tag_image'];
										?>
                                    	<img src="{{ asset($url) }}"  width="150px" />
                                    @endif    
                                    </span>
									 <span class="val">
				                                    <span class="text-nowrap">{{ $flights[$key]['airlinetag'] }}</span>
                                                    <?php if($isexpried){ ?>
				                                    @if($flights[$key]['tag_image']=='')
				                                    	<span class="text-nowrap pull-right"><button class="editairlinetag" id="idbag_{{$flights[$key]['idbag']}}">{{ trans('userlistflights.edit_button') }}</button></span>
				                                    @endif
                                                    <?php } ?>
				                                    <div id="airlinetag_dialog_{{ $flights[$key]['idbag'] }}" style="display: none;">
						                        		<div class="mws-dialog-inner">
						                            			{{ Form::open(array('url' => array('users/updateairlinetag'),'class'=>'mws-form','method'=>'post', 'id'=>'airlinetag_form_'.$flights[$key]['idbag'])) }}
						                            			<div id="mws-validate-error1" class="mws-form-message error" style="display:none;"></div>
                                                                <div id="errordiv1">
                                                                 
                                                                 </div>
										                            <div class="mws-form-inline">
										                                <div class="mws-form-row">
										                                    <label class="mws-form-label">{{ trans('userlistflights.label_airlineimage') }}</label>
										                                    <div class="mws-form-item">
										                                          {{ Form::file('tag_image') }}
										                                          {{ Form::hidden('idbag', $flights[$key]['idbag']) }}
										                                         
										                                    </div>
										                                </div>
										                            </div>
										                            <div class="mws-button-row">
										                    			<input type="submit" value="{{ trans('userlistflights.submit_button') }}" class="btn btn-danger" onclick="return tagimagesubmit({{ $flights[$key]['idbag'] }});">
										                    			<input type="reset" value="{{ trans('userlistflights.reset_button') }}" class="btn ">
										                    		</div>
										                    	  	
										                         {{ Form::close() }}  
										                      
						                                </div>
						                            </div>
				                               		
				                      </span>
								</li>
								
							</ul></td>
							<td>
							<ul class="mws-summary clearfix">

								<li class='clearfix'>{{ trans('userlistflights.date') }} :  {{ $flights[$key]['depdate'] }} </li>
								<li class='clearfix'>
									<?php /*?>{{ trans('userlistflights.from') }} :<?php * /?>
                                    <img src="{{ asset('images/landing.png') }}"   />&nbsp;&nbsp; {{ $flights[$key]['depport'] }}
								 </li>
                                <li class='clearfix'><?php /*?>{{ trans('userlistflights.passthrough1') }} :<?php * /?> 
                                    <img src="{{ asset('images/designBtn.png') }}"   />&nbsp;&nbsp; {{ $flights[$key]['scalo1'] }} </li>
                                <?php 
									if($flights[$key]['scalo2'] != ''){
								?>
								<li class='clearfix'><?php /*?>{{ trans('userlistflights.passthrough2') }} :<?php * /?>
                                    <img src="{{ asset('images/designBtn.png') }}"   />&nbsp;&nbsp;  {{ $flights[$key]['scalo2'] }} </li>
                                 <?php } ?>
                                 <?php 
									if($flights[$key]['scalo3'] != ''){
								?>
								<li class='clearfix'><?php /*?>{{ trans('userlistflights.passthrough3') }} :<?php * /?>
                                    <img src="{{ asset('images/designBtn.png') }}"   />&nbsp;&nbsp;  {{ $flights[$key]['scalo3'] }} </li>
                                    <?php } ?>
								<li class='clearfix'><?php /*?>{{ trans('userlistflights.to') }}	  : <?php * /?>
                                    <img src="{{ asset('images/takeOf.png') }}"   />&nbsp;&nbsp; {{ $flights[$key]['arrport'] }} </li>								
								<li class='clearfix'>{{ trans('userlistflights.travel_id') }} :  {{ $flights[$key]['idbag'] }} </li>
								<li class='clearfix'>{{ trans('userlistflights.payment_date') }} :  {{ $flights[$key]['payment_date'] }} </li>
								
							</ul></td>
							

						</tr>
						

					</tbody>
				</table>

			</div>

		</div>
@endforeach
<?php */?>
@endif