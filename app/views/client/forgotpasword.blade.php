{{ Form::open(array('url'=>'client/forgotpasword', 'class'=>'form-signup', 'id'=>'forgotpasword-form', 'name'=>'forgotpasword-form' )) }}
    <div style="height:82px;overflow:hidden;">
@if(Session::has('message') && Session::has('success') && Session::get('success') == '1')
					
					<div id="message" class="mws-form-message success"  >
						
						{{ Session::get('message') }}
					</div>
@endif
</div>				
    <input type="email" name="email" placeholder="<?php echo trans('frontend.your_email')?>..." required/>
    
    <br/><!--<span id="password-error"></span><br />-->
    
	<div id="errordivforgot">
     
     </div>	
    <input type="submit" value="<?php echo trans('frontend.send')?>" onclick="return forgotpasword();"> <i class="fa fa-spin fa-circle-o-notch fa-form-wait" style="display: none;"></i>
    <p id="loadingforgotpasword" style="display: none;"><img src="{{ asset('images/loading.gif') }}"   />&nbsp;&nbsp;{{ trans('userlistflights.loading_message') }}</p>
    <br />
    
{{ Form::close() }}
{{ HTML::script('minisite/js/jquery.blockUI.js'); }}
<script type="text/javascript">
	// unblock when ajax activity stops 
   // $(document).ajaxStop($.unblockUI);
   // $(document).ajaxStop($.unblockUI);
function forgotpasword(){
  //	$.blockUI(); 
  $("#loadingforgotpasword").show();
  $(".required").html("");  
	$( "#errordivforgot" ).html('');
	url	=	"{{ URL::to('client/forgotpasword') }}";
	data	=	$( "#forgotpasword-form" ).serializeArray();
	var token = $('#search > input[name="_token"]').val();
	//data.splice('_token', 1);
	$.ajax({
		type: 'post',
		url: url,
		dataType: 'json',
		data: data,
		success: function(data) {
			//$.unblockUI;
			if(data.redirect){
				window.location.href ="{{ URL::to('/') }}	";
			}
			if(data.fail) {
			  $.each(data.errors, function( index, value ) {
				  $( "#errordivforgot" ).append( '<div class="alert alert-danger">'+value+'</div>' );
				/*var errorDiv = '#login-form #'+index+'-error';
				$(errorDiv).addClass('required');
				$(errorDiv).empty().append(value);*/
			  });
			  		  		           
			} 
			if(data.success){
					location.reload();			
			}
			$("#loadingforgotpasword").hide();
			//alert(data.message);
			
		}
	});
	return false;
}

</script>