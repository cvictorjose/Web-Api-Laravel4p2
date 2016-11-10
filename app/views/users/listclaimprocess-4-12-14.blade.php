 
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
 <div class="mws-panel grid_6">
                    <div class="mws-tabs">

                        <ul>
                            <li><a href="#tab-1">{{ trans('userclaims.management') }}</a></li>
                            <li><a href="#tab-2">{{ trans('userclaims.refund_details') }}</a></li>
                            <li><a href="#tab-3">{{ trans('userclaims.documents_collection') }}Documents Collection</a></li>
                            <li><a href="#tab-4">{{ trans('userclaims.refund_release_form_colloection') }}</a></li>
                        </ul>
                        
                        

                        <div id="tab-1">
                             <p>
                            	  
                            	<h3></h3>
                            	<h6>{{ trans('userclaims.refund_management') }}.&nbsp;&nbsp;&nbsp;{{ trans('userclaims.refund_detail') }}:{{ $claimsbags[0]->claimcode }}&nbsp;&nbsp;&nbsp;{{ trans('userclaims.depating_airport') }}:{{ $airportslist[$claimsbags[0]->depport] }}&nbsp;&nbsp;&nbsp;{{ trans('userclaims.destination_airport') }}:{{ $airportslist[$claimsbags[0]->arrport] }}</h6>
                                
                            	<table class="mws-table">
                            <thead>
                                <tr>
                                   
                                    <th>{{ trans('userclaims.steps') }}</th>
                                    <th>{{ trans('userclaims.description') }}</th>
                                    <th>{{ trans('userclaims.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                	
                                    <td>1</td>
                                    <td>
                                    	<p>{{ trans('userclaims.description_1') }}</p>
                                    </td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                   
                                </tr>
                                 <tr>
                                	
                                    <td>2</td>
                                    <td>
                                    	<p>{{ trans('userclaims.description_2') }}</p>
                                    </td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                   
                                </tr>
                                 <tr>
                                	
                                    <td>3</td>
                                    <td>
                                    	<p>{{ trans('userclaims.description_3') }}</p>
                                    </td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                   
                                </tr>
                                 <tr>
                                	
                                    <td>4</td>
                                    <td>
                                    	<p>{{ trans('userclaims.description_4') }}</p>
                                    </td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                   
                                </tr>
                                 <tr>
                                	
                                    <td>5</td>
                                    <td>
                                    	<p>{{ trans('userclaims.description_5') }}</p>
                                    </td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                   
                                </tr>
                                 <tr>
                                	
                                    <td>6</td>
                                    <td>
                                    	<p>{{ trans('userclaims.description_6') }}</p>
                                    </td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                   
                                </tr>
                                
                            </tbody>
                        </table>
                          
                            </p>
                        </div>

                        <div id="tab-2">
                        	<h3></h3>
                            <hr />
                            <p>
                            <table class="mws-table">
                            	<thead>
                            	<tr>
                                	<th colspan="4">{{ trans('userclaims.flight_detail') }}<br /></th>
                                </tr>
                                </thead>
                                <tbody>
                            	<tr>
                                    <td><b>{{ trans('userclaims.depating_airport') }}</b><br />{{ $airportslist[$claimsbags[0]->depport] }}</td>
                                    <td><b>{{ trans('userclaims.depature') }}</b><br />{{ date('d/m/Y', $claimsbags[0]->depdate) }}</td>
                                    <td><b>{{ trans('userclaims.airline') }}</b><br />{{ $airportslist[$claimsbags[0]->iata] }}</td>
                                    <td><b>{{ trans('userclaims.stopover_airport2') }}</b><br />
                                    <?php if($claimsbags[0]->scalo2!=''){
										echo $airportslist[$claimsbags[0]->scalo2]; 
										//echo $claimsbags->scalo2; 
										
										}?>
                                    
                                    
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td><b>{{ trans('userclaims.destination_airport') }}</b><br />{{ $airportslist[$claimsbags[0]->arrport] }}</td>
                                    <td><b>{{ trans('userclaims.arrival') }}</b><br />{{ date('d/m/Y', $claimsbags[0]->arrdate) }}</td>
                                    <td><b>{{ trans('userclaims.stopover_airport1') }}</b><br /><?php if($claimsbags[0]->scalo1!=''){echo $airportslist[$claimsbags[0]->scalo1]; }?></td>
                                    <td><b>{{ trans('userclaims.stopover_airport3') }}</b><br /><?php if($claimsbags[0]->scalo3!=''){echo $airportslist[$claimsbags[0]->scalo3]; }?></td>
                                   
                                </tr>
                                </tbody>
                                
                            </table>
                           
                            <table class="mws-table">
                            	<thead>
                            	<tr>
                                	<th colspan="2">{{ trans('userclaims.refund_detail') }}<br />{{ $claimsbags[0]->claimcode }}</th>
                                </tr>
                                </thead>
                                <tbody>
                            	<tr>
                                    <td><b>{{ trans('userclaims.ref_no') }}</b><br /></td>
                                    <td rowspan="5"><b>{{ trans('userclaims.note') }}</b><br /><textarea readonly="readonly">{{ $claimsbags[0]->notes }}</textarea></td>
                                </tr>
                                <tr>
                                    <td><b>{{ trans('userclaims.reporting_date') }}</b><br />{{ date('d/m/Y', $claimsbags[0]->sigdate) }}</td>
                                </tr>
                                <tr><?php $languagelist	=	array('en'=>'English','it'=>'Italian');?>
                                    <td><b>{{ trans('userclaims.refund_language') }}</b><br /><?php  
									if($claimsbags[0]->lingua_sinistro != '')
									echo $languagelist[$claimsbags[0]->lingua_sinistro]; ?></td>
                                </tr>
                                <tr>
                                
                                <?php 
									$requstmade	=	array('0'=>'Web Site','1'=>'Tele Phone');
								?>
                                    <td rowspan="2"><b>{{ trans('userclaims.refund_request_made_through') }}</b><br /><?php echo $requstmade[$claimsbags[0]->sigby] ?></td>
                                </tr>
                                
                                </tbody>
                                
                            </table>
                             
                            <table class="mws-table">
                            	<thead>
                            	<tr>
                                	<th colspan="2">{{ trans('userclaims.losr_or_damage_bags') }}<br /></th>
                                </tr>
                                </thead>
                                <tbody>
                            	<tr>
                                    <td>{{ trans('userclaims.safe_bag_code') }}<br /></td>
                                    <!--<td>{{ trans('userclaims.bage_arrived_without_damage') }}<br /></td>-->
                                    <td><b>{{ trans('userclaims.bag_lost') }}</b><br />{{ trans('userclaims.during_the_flight') }}</td>
                                    
                                    
                                </tr>
                                <tr>
                                    <td>{{ $claimsbags[0]->smartcardcode }}</td>
                                  
                                    <td><input type="radio" checked="checked" /></td>
                                    
                                   
                                </tr>
                                </tbody>
                                
                            </table>
                            
                            
                            	<?php /*?><?php
                            	echo "<pre>"; 
                            	print_r($claimsbags);
								echo "</pre>";
                            	?><?php */?>
                            </p>
                        </div>

                        <div id="tab-3">
                            <p>
                            	<h3>{{ trans('userclaims.flight_and_personal_information') }}</h3>
                            	<h6>{{ trans('userclaims.description_7') }}</h6>
                                <div id="errordiv"></div>
                            	<table class="mws-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ trans('userclaims.find') }}</th>
                                    <th>{{ trans('userclaims.load') }}</th>
                                    <th>{{ trans('userclaims.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="safebag_receipt_tr">
                                	
                                    <td>{{ trans('userclaims.safe_bag_receipt') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref1_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('safebag_receipt') }}
                                        
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref1">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                    
                                </tr>
                                <tr id="airticket_tr">
                                    
                                    <td>{{ trans('userclaims.description_8') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref10_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('airticket') }}
                                        {{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    	
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref10">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                    
                                  
                                </tr>
                                <tr id="pir_tr">
                                    
                                    <td>{{ trans('userclaims.description_9') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref2_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('pir') }}
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref2">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                    
                                  
                                </tr>
                                 <tr id="leaflet_tr">
                                   
                                    <td>{{ trans('userclaims.valid_id') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref3_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('leaflet') }}
                                        {{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                    	{{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref3">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                    
                                  
                                </tr>
                                <tr id="claim_airline_tr">
                                    
                                    <td>{{ trans('userclaims.description_10') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref4_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('claim_airline') }}
                                    	
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref4">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                  
                                </tr>
                            </tbody>
                        </table>
                            </p>
                            
                            <p>
                            	<h3>{{ trans('userclaims.compensation_of_the_airline') }}</h3>
                            	<h6>{{ trans('userclaims.description_11') }}</h6>
                            	<table class="mws-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ trans('userclaims.find') }}</th>
                                    <th>{{ trans('userclaims.load') }}</th>
                                    <th>{{ trans('userclaims.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="claim_airline2_transfer_tr">
                                	
                                    <td>{{ trans('userclaims.airline_reimbursement_receipt') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref5_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('claim_airline2_transfer') }}
                                    	
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref5">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                </tr>
                                <tr id="police_complaint_tr">
                                    
                                    <td>{{ trans('userclaims.description_12') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref6_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('police_complaint') }}
                                    	
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref6">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                  
                                </tr>
                                
                            </tbody>
                        </table>
                            </p>
                            
                            
                            <p>
                            	<h3>{{ trans('userclaims.details_on_delayed_baggage') }}</h3>
                            	<h6>{{ trans('userclaims.description_13') }}</h6>
                            	<table class="mws-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ trans('userclaims.find') }}</th>
                                    <th>{{ trans('userclaims.load') }}</th>
                                    <th>{{ trans('userclaims.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="bag_receipt_tr">
                                	
                                    <td>{{ trans('userclaims.description_14') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref7_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('bag_receipt') }}
                                    	
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref7">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                </tr>
                                <tr id="cost_reparations_tr">
                                    
                                    <td>{{ trans('userclaims.description_15') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref8_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('cost_reparations') }}
                                    	
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref8">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                  
                                </tr>
                                
                            </tbody>
                        </table>
                            </p>
                        </div>
                          <div id="tab-4">
                             <p>
                             	  <p>
                            	<h3>{{ trans('userclaims.refund_release_form') }}</h3>
                            	<h6>{{ trans('userclaims.description_16') }}</h6>
                            	<table class="mws-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ trans('userclaims.find') }}</th>
                                    <th>{{ trans('userclaims.load') }}</th>
                                    <th>{{ trans('userclaims.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="photo_tr">
                                	
                                    <td>{{ trans('userclaims.refund_release_form') }}REFUND RELEASE FORM</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref9_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('photo') }}
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref9">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                    
                                </tr>
                                
                                
                            </tbody>
                        </table>
                             </p>
                          </div>
                    </div>
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
  <script>
            // jQuery-UI Tabs
    $.fn.tabs && $(".mws-tabs").tabs();
	$( document ).ready(function() {
	//console.log( "ready!" );
	<?php
	if(!empty($claimsdoc)){ 
		unset($claimsdoc['iddoc']);
		unset($claimsdoc['idclaim']);
		unset($claimsdoc['date']);
		unset($claimsdoc['date_end']);
	}
	else{
		$claimsdoc	=array();	
	}
	?>
		climsdoct	=	'<?php echo json_encode($claimsdoc); ?>';
		var parsed = JSON.parse(climsdoct);
		if(parsed != null){ 
			$.each(parsed, function( index, value ) {
				//alert(value);
				row		='#'+index+'_tr';	
				rowid	=	'#'+index+'_tr >td > button';
				$(rowid).html("{{ trans('userclaims.upload') }}");
				if(value == 1){
					//alert(value);
					$(row).find('td:last').html("{{ trans('userclaims.process') }}");
					//$(rowid).html("{{ trans('userclaims.process') }}");	
					//rowid	=	'#'+index+'_tr';	
					//($(rowid).html());
					//$(rowid).attr('disabled','disabled');
				}
				if(value == 2){
					$(rowid).attr('disabled','disabled');
					$(row).find('td:last').html("{{ trans('userclaims.finished') }}");
					//$(rowid).html("Upload");
				}
				if(value == 0){
					$(row).find('td:last').html("{{ trans('userclaims.pending') }}");
				}
				
				//alert( index + ": " + value );
			});
		}
		//alert(climsdoct);
	});
		  
	function ajaxupload(val){
		//alert();
		$(val).html("<img src="+"{{ asset('images/loading.gif') }}"+"   />&nbsp;&nbsp;"+"{{ trans('userlistflights.loading_message') }}");
		var	idclaim	=	'<?php echo $claimsbags[0]->idclaim;?>';
		$("#errordiv").html('');
		id	=	'#'+val.id+'_form'		;
		url	=	$( id ).attr( "action" );
		form	=	$( id );
		data	=	$( id ).serializeArray();
		$(id ).ajaxForm(function(result) {
			data	=	result;
			$(val).html("{{ trans('userclaims.upload') }}");
			
			
			if(data.redirect){
				window.location.href ="{{ URL::to('users/dashboard') }}	";
			}
			if(data.fail) {
				
			  $.each(data.errors, function( index, value ) {
				 // alert(value);
				  $( "#errordiv" ).append( '<div class="alert alert-danger">'+value+'</div>' );
				   //$( "#mws-validate-error" ).show();
				   $("#"+val.id).parent('td').parent('tr').find('td:last').html("{{ trans('userclaims.pending') }}")
				   //$(val).html("Upload{{ trans('userclaims.your_claims') }}");
				   
				/*var errorDiv = '#'+index+'_error';
				$(errorDiv).addClass('required');
				$(errorDiv).empty().append(value);*/
			  });
			  			  		           
			} 
			if(data.success){
				//$(val).html("{{ trans('userclaims.process') }}");
				//$(val).attr('disabled','disabled');
				$("#"+val.id).parent('td').parent('tr').find('td:last').html("{{ trans('userclaims.process') }}")
				$( id ).get(0).reset();
				//location.reload();
				//window.location.href ="{{ URL::to('users/listbags') }}	";
			}
			
			
			 
		}).submit();
		//var token = $('#search > input[name="_token"]').val();
		//data.splice('_token', 1);
		
		return false;
	}
  </script>