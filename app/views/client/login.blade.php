{{ Form::open(array('url'=>'client/login', 'class'=>'form-signup', 'id'=>'login-form', 'name'=>'login-form' )) }}
    				
    <input type="email" name="email" placeholder="<?php echo trans('frontend.your_email')?>..." required/>
    <br/><span id="email-error"></span>
    <input type="password" name="password" placeholder="<?php echo trans('frontend.your_password')?>..." required/>
    <br/><!--<span id="password-error"></span><br />-->
    
	<div id="errordivlogin" style="width: 100%;position: relative;margin-top: -20px;margin-bottom: 2px;margin-left:0">
     
     </div>	
     <br/>
    <input type="submit" value="<?php echo trans('frontend.send')?>" onclick="return login();"> <i class="fa fa-spin fa-circle-o-notch fa-form-wait" style="display: none;"></i>
    <p id="loadinglogin" style="display: none;"><img src="{{ asset('images/loading.gif') }}"   />&nbsp;&nbsp;{{ trans('userlistflights.loading_message') }}</p>
    <br />
    <?php 
	if(Request::segment(1)==''){ ?>
    <a href="{{ URL::to('client/registeruser') }}"><?php echo trans('frontend.forgot_your_password')?></a>
    <?php } ?>
{{ Form::close() }}
{{ HTML::script('minisite/js/jquery.blockUI.js'); }}
<script type="text/javascript">
	// unblock when ajax activity stops 
   // $(document).ajaxStop($.unblockUI);
   // $(document).ajaxStop($.unblockUI);
function login(){
  //	$.blockUI(); 
  $("#loadinglogin").show();
  $(".required").html("");
  	var redirecturl	=	'<?php echo Session::get('register_ref');?>';
	$( "#errordivlogin" ).html('');
	url	=	"{{ URL::to('client/login') }}";
	data	=	$( "#login-form" ).serializeArray();
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
				  $( "#errordivlogin" ).append( '<div class="alert alert-danger">'+value+'</div>' );
				/*var errorDiv = '#login-form #'+index+'-error';
				$(errorDiv).addClass('required');
				$(errorDiv).empty().append(value);*/
			  });
			  		  		           
			} 
			if(data.success){
				/*if(redirecturl == 'dashboard')
				{
					
					godasbord();
				}
				else*/
				{
					locationpayment();
				}
				
			}
			$("#loadinglogin").hide();
			//alert(data.message);
			
		}
	});
	return false;
}

</script>