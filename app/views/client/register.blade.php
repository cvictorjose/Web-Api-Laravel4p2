<section id="getappContainer" class="section-80-130 whiteBgSection">
<div class="row">
			<!--contact info-->
			
				<div class="five-col prefix-one" style="margin-right:0">
				<h1 class="sectionTitle"><?php echo trans('frontend.register');?></h1>
				<div class="titleSeparator"></div>
			
				<div class="separator80"></div>
                <?php 
				if(!Session::has('facebook')){
				?>
               	 @include('client.fblogin')
                <?php
				}
                ?>
                
				<!--<a class="btn btn-block btn-social btn-lg btn-facebook" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-lg']);"><i class="fa fa-facebook"></i>Sign in with Facebook</a>-->
					<!--contact form-->
					{{ Form::open(array('url'=>'client/create', 'class'=>'form-signup', 'id'=>'register-form' )) }}
                    	
                    	<!--@foreach($errors->all() as $error)
           
                                <div class="alert alert-danger">
                                     {{ $error }}
                                </div>
                         @endforeach-->
                         <div id="errordiv">
                         
                         </div>
                         {{ Form::text('name', null, array('class'=>'form-control required', 'id'=>'name', 'placeholder'=>trans('frontend.name'), 'required' => '')) }}                        
                         <br/><span id="name-error"></span>    
                         {{ Form::text('surname', null, array('class'=>'form-control required', 'id'=>'surname', 'placeholder'=>trans('frontend.surname'), 'required' => '')) }}
                         <br/><span id="surname-error"></span>
                         
                        {{ Form::text('email', null, array('class'=>'form-control required', 'id'=>'email', 'placeholder'=>trans('frontend.email'), 'required' => '')) }}               
                        <br/><span id="email-error"></span>        
                        {{ Form::text('email_confirmation', null, array('class'=>'form-control required', 'id'=>'email_confirmation', 'placeholder'=>trans('frontend.email_confirmation'), 'required' => '')) }}
                        <br/><span id="email_confirmation-error"></span>
                        {{ Form::password('password', array('class'=>'form-control required', 'placeholder'=>trans('frontend.password'), 'required' => '')) }}
{{ Form::password('password_confirmation', array('class'=>'form-control required',  'placeholder'=>trans('frontend.password_confirmation'), 'required' => '')) }}
						<br/><span id="password-error"></span>
                        
                        {{ Form::text('address', null, array('class'=>'form-control required', 'placeholder'=>trans('frontend.address'), 'required' => '')) }}                        
                        <br /><span id="address-error"></span> 
                        {{ Form::text('city', null, array('class'=>'form-control required', 'placeholder'=>trans('frontend.city'), 'required' => '')) }} 
                        <br/><span id="city-error"></span>
                        {{ Form::text('province', null, array('class'=>'form-control required', 'placeholder'=>trans('frontend.province'), 'required' => '')) }} 
                        <br/><span id="province-error"></span>
						{{ Form::select('nationality', $countryList, null, array('class' => 'form-control', 'id'=>'nationality', 'required' => '')) }}
                        <br/><span id="nationality-error"></span>
                        {{ Form::text('zip', null, array('class'=>'form-control required', 'placeholder'=>trans('frontend.zip'), 'required' => '')) }}
                        <br/><span id="zip-error"></span>
                        {{ Form::text('mobile', null, array('class'=>'form-control required', 'placeholder'=>trans('frontend.mobile'), 'required' => '')) }}
                        <br/><span id="mobile-error"></span>
                        
                        {{ Form::text('fax', null, array('class'=>'form-control required', 'placeholder'=>trans('frontend.fax'), 'required' => '')) }}
                        <br/><span id="fax-error"></span>
                        {{ Form::text('phone', null, array('class'=>'form-control required', 'placeholder'=>trans('frontend.phone'), 'required' => '')) }}
                        <br/><span id="phone-error"></span>
                        
						
						{{ trans('frontend.shipadd_defin') }}<br><br>{{ trans('frontend.no') }} {{ Form::radio('yesno', 'noCheck', true, array('style' => 'width:auto;', 'onclick'=>'javascript:yesnoCheck();', 'id'=>'noCheck')) }} {{ trans('frontend.yes') }} {{ Form::radio('yesno', 'yesCheck', '', array('style' => 'width:auto;', 'onclick'=>'javascript:yesnoCheck();', 'id'=>'yesCheck')) }} <br>
                        <br/><span id="yesno-error"></span>
                        <div id="ifYes" style="display:none">
                            {{ Form::text('sh_address', null, array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_address'))) }} 
                            <br/><span id="sh_address-error"></span>
                            {{ Form::text('sh_city', null, array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_city'))) }} 
                            <br/><span id="sh_city-error"></span>
                            {{ Form::text('sh_province', null, array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_province'))) }} 
                            <br/><span id="sh_province-error"></span>
                            {{ Form::select('sh_country', $countryList, null, array('class' => 'form-control')) }}
                            <br/><br/><span id="sh_country-error"></span>
                            {{ Form::text('sh_zip', null, array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_zip'))) }} 
                            <br/><span id="sh_zip-error"></span>
                            
                        </div>
                        {{ Form::checkbox('dichiaro', 1, '', array('style' => 'width: 30px; margin-bottom: 10px;', 'value'=>1)) }} {{ trans('frontend.i_agree_to') }} <a class="privacy" target="_blank" href="{{ URL::to('client/termsservice') }}">{{ trans('frontend.terms_of_services') }}</a> and <a class="privacy" target="_blank" href="{{ URL::to('client/privacy') }}">{{ trans('frontend.policy_a') }}</a>
                        <br/><span id="dichiaro-error"></span>
                        <br />
                        <br />
                        {{ trans('frontend.policy_b') }}
                        <br />
                         <br />
                        {{ Form::radio('policy-b', '1', true, array('style' => 'width:auto; margin-bottom: 10px;')) }} {{ trans('frontend.i_agree') }} {{ Form::radio('policy-b', '0', '', array('style' => 'width:auto; margin-bottom: 10px;')) }} {{ trans('frontend.i_disagree') }}  <br>
                        <br />
                        {{ trans('frontend.policy_c') }}
                        <br />
                        <br />
                        {{ Form::radio('policy-c', '1', true, array('style' => 'width:auto; margin-bottom: 10px;')) }} {{ trans('frontend.i_agree') }} {{ Form::radio('policy-c', '0', '', array('style' => 'width:auto; margin-bottom: 10px;')) }} {{ trans('frontend.i_disagree') }}  <br>
                        <br />
                        {{ trans('frontend.policy_d') }}
                        <br />
                         <br />
                        {{ Form::radio('policy-d', '1', true, array('style' => 'width:auto; margin-bottom: 10px;')) }} {{ trans('frontend.i_agree') }} {{ Form::radio('policy-d', '0', '', array('style' => 'width:auto; margin-bottom: 10px;')) }} {{ trans('frontend.i_disagree') }}  <br>
                        
                        
                        {{ Form::hidden('access_token', null, array('class'=>'form-control required', 'id'=>'access_token', 'placeholder'=>trans('frontend.name'), 'required' => '')) }} 
                        {{ Form::hidden('facebookId', null, array('class'=>'form-control required', 'id'=>'facebookId', 'placeholder'=>trans('frontend.name'), 'required' => '')) }} 
                        {{ Form::hidden('lingua_registrazione', null, array('class'=>'form-control required', 'id'=>'lingua_registrazione', 'placeholder'=>trans('frontend.name'), 'required' => '')) }} 

						{{ Form::submit( trans('frontend.register'), array('class'=>'btn btn-lg btn-primary btn-block','onclick'=>'return submitform()'))}}
{{ Form::close() }}
						
					<p id="loading" style="display: none;"><img src="{{ asset('images/loading.gif') }}"   />&nbsp;&nbsp;{{ trans('userlistflights.loading_message') }}</p>
				</div>


				<!--separator-->
				<div class="one-col">
				<h2 style="margin-top: 25px;text-align:center;"><?php echo trans('userdashboard.or');?></h2>
				<div class="separator"></div>
				</div>
				<!--login-->

				<div class="five-col  last-col">
				<h1 class="sectionTitle"><?php echo trans('frontend.login');?></h1>
				<div class="titleSeparator"></div>
			
				<div class="separator80"></div>
					<!--contact form-->
                    @include('client.login')
                    <!--{{ Form::open(array('url'=>'client/login', 'class'=>'form-signup', 'id'=>'login-form', 'name'=>'login-form' )) }}
                    	<div id="errordivlogin">
                         
                         </div>					
						<input type="email" name="email" placeholder="Your Email..." required/>
						<input type="password" name="password" placeholder="Your Password..." required/>

						<input type="submit" value="SEND" onclick="return login();"> <i class="fa fa-spin fa-circle-o-notch fa-form-wait" style="display: none;"></i>
					{{ Form::close() }}-->
					<?php /*?><br /><br />
                    <h1 class="sectionTitle"><?php echo trans('frontend.forgotpasword');?></h1>
                    <div class="titleSeparator"></div>
                    
                    @include('client.forgotpasword')<?php */?>
					<p id="formSubmitMessage"></p>
				</div>
				<div class="clear"></div>
			</div>
<img class="triangleBottom" src="{{ asset('minisite/img/tri-white-bot.png') }}" alt="" />
</section>

{{ HTML::script('minisite/js/jquery.blockUI.js'); }}
<script type="text/javascript">
	// unblock when ajax activity stops 
   // $(document).ajaxStop($.unblockUI);
	
$( document ).ready(function() {
    <?php 
	if(Session::has('facebook')){
		$data	=	Session::get('facebook');
		//var_dump($data);
	?>
		$("#register-form #name").val('<?php echo $data['name']?>');
		$("#register-form #email").val('<?php echo $data['email']?>');
		$("#register-form #email_confirmation").val('<?php echo $data['email']?>');
		nationality	=	'<?php echo $data['nationality']?>';
		$("#register-form #nationality").val((nationality.toLowerCase()));
		$("#register-form #facebookId").val('<?php echo $data['facebookId']?>');
		$("#register-form #access_token").val('<?php echo $data['access_token']?>');
		$("#register-form #surname").val('<?php echo $data['surname']?>');
		$("#register-form #lingua_registrazione").val('<?php echo $data['lingua_registrazione']?>');
	<?php 
		Session::forget('facebook');
	}
	?>
});

function submitform(){
	//$.blockUI(); 
	$("#loading").show();
	$( "#errordiv" ).html('');
	url	=	$( "#register-form" ).attr( "action" );
	data	=	$( "#register-form" ).serializeArray();
	var token = $('#search > input[name="_token"]').val();
	//data.splice('_token', 1);
	$(".required").html("");
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
			  $.each(data.errors, function( index, value ) {
				 // $( "#errordiv" ).append( '<div class="alert alert-danger">'+value+'</div>' );
				var errorDiv = '#'+index+'-error';
				$(errorDiv).addClass('required');
				$(errorDiv).empty().append(value);
			  });
			  			  		           
			} 
			if(data.success){
				
				window.location.href ="{{ URL::to('client/payment') }}	";
			}
			//alert(data.message);
			$("#loading").hide();
			
		}
	});
	return false;
}

function locationpayment(){
	window.location.href ="{{ URL::to('client/payment') }}	";
}
/*$( "#register-form" ).submit(function( event ) {    
  event.preventDefault();

  var $form = $( this ),
    data = $form.serialize(),
    url = $form.attr( "action" );

  var posting = $.post( url, { formData: data } );

  posting.done(function( data ) {
    if(data.fail) {
      $.each(data.errors, function( index, value ) {
        var errorDiv = '#'+index+'_error';
        $(errorDiv).addClass('required');
        $(errorDiv).empty().append(value);
      });
      $('#successMessage').empty();          
    } 
    if(data.success) {
        $('.register').fadeOut(); //hiding Reg form
        var successContent = '<div class="message"><h3>Registration Completed Successfully</h3><h4>Please Login With the Following Details</h4><div class="userDetails"><p><span>Email:</span>'+data.email+'</p><p><span>Password:********</span></p></div></div>';
      $('#successMessage').html(successContent);
    } //success
  }); //done
});*/
</script>

<!--{{ Form::open(array('url'=>'users/create', 'class'=>'form-signup', 'id'=>'register-form' )) }}
    <h2 class="form-signup-heading">Please Register</h2>
 
    <!--<ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
	@foreach($errors->all() as $error)
           
			<div class="alert alert-danger">
				 {{ $error }}
			</div>
     @endforeach
 
    {{ Form::text('first_name', null, array('class'=>'form-control required', 'placeholder'=>'First Name')) }}
    {{ Form::text('last_name', null, array('class'=>'form-control required', 'placeholder'=>'Last Name')) }}
    {{ Form::text('email', null, array('class'=>'form-control required', 'placeholder'=>'Email Address')) }}
    {{ Form::password('password', array('class'=>'form-control required', 'placeholder'=>'Password')) }}
    {{ Form::password('password_confirmation', array('class'=>'form-control required', 'placeholder'=>'Confirm Password')) }}
	 
    {{ Form::submit('Register', array('class'=>'btn btn-lg btn-primary btn-block'))}}
{{ Form::close() }}-->


