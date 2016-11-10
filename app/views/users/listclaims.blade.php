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
		
								<h2><i class="icol32-application-view-tile"></i>{{ trans('userclaims.your_claims') }}</h2>
								<p style="text-align:justify">
                               
									

								</p>
								@include('layouts.user-message')
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
                <div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> {{ trans('userclaims.your_claims') }}</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>                                    
                                    <th>{{ trans('userclaims.destination_airport') }}<!--Aeroporto Partenza--></th>
                                    <th>{{ trans('userclaims.depating_airport') }}<!--Aeroporto Arrivo--></th>
                                    <th>{{ trans('userclaims.depature') }}<!--Data Partenza--></th>
                                    <th>{{ trans('userclaims.arrival') }}<!--Data Arrivo--></th>
                                    <th>{{ trans('userclaims.airline') }}<!--Aerolinea--></th>
                                    <th>{{ trans('userclaims.stopover_airport1') }}</th>
                                    <th>{{ trans('userclaims.stopover_airport2') }}</th>
                                    <th>{{ trans('userclaims.stopover_airport3') }}</th>
                                    <th>{{ trans('userclaims.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($claimsbags as $claimsbag)
                                <tr>                                   
                                    <td>{{ $airportslist[$claimsbag->depport] }}</td>
                                    <td>{{ $airportslist[$claimsbag->arrport] }}</td>
                                    <td>{{ date('d/m/Y', $claimsbag->depdate) }}</td>
                                    <td>{{ date('d/m/Y', $claimsbag->arrdate) }}</td>
                                    <td><?php // var_dump($claimsbag->airlines);?>{{ ucwords($claimsbag->airlines->city) }}</td>
                                    <td><?php if($claimsbag->scalo1!=''){echo $airportslist[$claimsbag->scalo1]; }?></td>
                                    <td><?php if($claimsbag->scalo2!=''){echo $airportslist[$claimsbag->scalo2]; }?></td>
                                    <td><?php if($claimsbag->scalo3!=''){echo $airportslist[$claimsbag->scalo3]; }?></td>
                                    <td>
                                    	<!--<a class="btn mws-login-button"  href="#" onclick="return viewdetail('{{ $claimsbag->idbag }}');">View Details</a>-->
                                        <?php 
										$date_expiration	=	$claimsbag->date_expiration;
										$isexpried			=	true;
										
										if($date_expiration != 0 && $date_expiration <= time()){
											$isexpried	=	false;
										}
										
										if($isexpried){
									?>
                                        &nbsp;&nbsp;
										<?php 
										if(empty($claimsbag->claims)){
											echo '<a class="btn mws-login-button"  href="#" onclick="return openclaim('.$claimsbag->idbag.');">'.trans('userclaims.open_claim').'</a>';
										}
										else{ 
											//echo trans('userclaims.claims_under_process');
											?>
											
											<a class="btn mws-login-button"  href="{{ URL::to('users/listclaimprocess/'.$claimsbag->idbag) }}" >{{ trans('userclaims.claims_management') }} </a>
										<?php }	
										}
										else{
										?>
                                        	<button class="btn mws-login-button">{{ trans('userlistflights.expired_status') }}</button>
                                        <?php	
										}
										?>
									<?php /*?>{{ $claimsbag->idbag }}<?php */?></td>
                                </tr>
                             @endforeach     
                            </tbody>
                        </table>
                    </div>
                </div>
                
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
                            	{{ Form::hidden('idbag', '', array('class'=>'form-control required', 'id'=>'idbag')) }}      
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
function viewdetail(idbag){
	return false;	
}

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
	
});
$( document ).ready(function() {
	
	$( "#sigdate" ).datepicker({ dateFormat: 'dd/mm/yy' });
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