<section id="getappContainer" class="section-80-130 whiteBgSection">
<div class="row">
			<!--contact info-->
			
				<div class="five-col prefix-one" style="margin-right:0">
				<h1 class="sectionTitle"><?php echo trans('frontend.resetpasword');?></h1>
				<div class="titleSeparator"></div>
			
				<div class="separator80"></div>
               	{{ Form::open(array('url'=>'client/resetpassword', 'class'=>'form-signup', 'id'=>'resetpassword-form', 'name'=>'resetpassword-form' )) }}
    				
                {{ Form::hidden('email', $email, array('class'=>'form-control required', 'id'=>'email', 'placeholder'=>trans('frontend.email'), 'required' => '')) }}               
                <br/><span id="email-error"></span>        
                       
                {{ Form::password('password', array('class'=>'form-control required', 'placeholder'=>trans('frontend.password'), 'required' => '')) }}
				{{ Form::password('password_confirmation', array('class'=>'form-control required',  'placeholder'=>trans('frontend.password_confirmation'), 'required' => '')) }}
                <br/><!--<span id="password-error"></span><br />-->
                
                <div id="errordivlogin">
                 
                 </div>	
                <input type="submit" value="<?php echo trans('frontend.send')?>" onclick="return login();"> <i class="fa fa-spin fa-circle-o-notch fa-form-wait" style="display: none;"></i>
                <p id="loadinglogin" style="display: none;"><img src="{{ asset('images/loading.gif') }}"   />&nbsp;&nbsp;{{ trans('userlistflights.loading_message') }}</p>
                <br />
                
            {{ Form::close() }}
				</div>


				<!--separator-->
				
				<!--login-->

				
				<div class="clear"></div>
			</div>
<img class="triangleBottom" src="{{ asset('minisite/img/tri-white-bot.png') }}" alt="" />
</section>

<script type="text/javascript">
	// unblock when ajax activity stops 
   // $(document).ajaxStop($.unblockUI);
   // $(document).ajaxStop($.unblockUI);
function login(){
  //	$.blockUI(); 
  $("#loadinglogin").show();
  $(".required").html("");
  	
	$( "#errordivlogin" ).html('');
	url	=	"{{ URL::to('client/resetpassword') }}";
	data	=	$( "#resetpassword-form" ).serializeArray();
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
				//if(redirecturl == 'dashboard')
				{
					
					godasbord();
				}
				/*else{
					locationpayment();
				}*/
				
			}
			$("#loadinglogin").hide();
			//alert(data.message);
			
		}
	});
	return false;
}

</script>


