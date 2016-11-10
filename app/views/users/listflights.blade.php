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

					<h2><i class="icol32-application-view-tile"></i>{{ trans('userlistflights.your_flights') }}</h2>
					<p style="text-align:justify">
						{{ trans('userlistflights.description') }}
						<br/>
						<a class="btn mws-login-button" id="active_click" href="#">{{ trans('userlistflights.active_status') }}</a>
						<a class="btn mws-login-button" id="expired_click" href="#">{{ trans('userlistflights.expired_status') }}</a>
						<a class="btn mws-login-button" id="lost_click" href="#">{{ trans('userlistflights.lost_status') }}</a>
						<p id="loading" style="display: none;"><img src="{{ asset('images/loading.gif') }}"   />&nbsp;&nbsp;{{ trans('userlistflights.loading_message') }}</p>
					</p>
					@include('layouts.user-message')
				</div>
			</div>
		</div>

		<!--Panel start -->
        
		<div id="changeflight">
		@if(!empty($flights))
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
                            	<?php 
									if($flights[$key]['idbag'] == '' || $flights[$key]['idbag'] == NULL )
										$flights[$key]['idbag']	=	0;
								?>
                            	<a class="btn mws-login-button" href="{{ URL::to('users/flightsdetails/'.$flights[$key]['idbag'].'/'.$flights[$key]['idclaim']) }}" >{{ trans('userlistflights.details') }}</a> &nbsp;&nbsp;
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
		
		@endif
        	<div id="mws-form-dialog" title="{{ trans('userclaims.add_claims') }}">                    
                {{ Form::open(array('url'=>'users/addclaims', 'class'=>'form-signup', 'id'=>'addclaimsform', 'enctype'=>'multipart/form-data' )) }}
                    <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                    <div id="errordiv">
                     
                     </div>
                    <div class="mws-form-inline">
                        
                        
                        <div class="mws-form-row">
                            <label class="mws-form-label"><?php echo trans('userclaims.lost');?></label>
                            <div class="mws-form-item">
                            {{ Form::radio('lost',1, true,array('id'=>'lost')) }}   
                            </div>   
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
                            {{ Form::textarea('notes', null, array('class'=>'form-control required', 'id'=>'notes', 'placeholder'=>trans('userclaims.description'), 'required' => '', 'style'=>'height:50px;')) }}    
                            </div>  
                        </div>                            
                        
                    </div>
                    {{ Form::submit( trans('frontend.update'), array('class'=>'btn btn-lg btn-primary btn-block','onclick'=>'return submitform()'))}}
                {{ Form::close() }}
            </div>
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
		alert( '{{ trans("userlistflights.status_update_message_1") }}' );
		return false;
	});
});

function submitform(){ 
 $( "#mws-validate-error" ).html("");
 $( "#mws-validate-error" ).hide();
 	
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
	}).submit();
	
	return false;	
}
    </script>
