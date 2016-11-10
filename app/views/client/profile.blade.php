<section id="getappContainer" class="section-80-130 whiteBgSection">
<div class="row">
			<!--contact info-->
			
				<div class="five-col prefix-one" style="margin-right:0">
				<h1 class="sectionTitle"><?php echo trans('frontend.edit_profile');?></h1>
				<div class="titleSeparator"></div>
			
				<div class="separator80"></div>
               
                
				<!--<a class="btn btn-block btn-social btn-lg btn-facebook" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-lg']);"><i class="fa fa-facebook"></i>Sign in with Facebook</a>-->
					<!--contact form-->
					{{ Form::open(array('url'=>'client/updateshipnew', 'class'=>'form-signup', 'id'=>'register-form' )) }}
                    	
                    	<!--@foreach($errors->all() as $error)
           
                                <div class="alert alert-danger">
                                     {{ $error }}
                                </div>
                         @endforeach-->
                         <div id="errordiv">
                         
                         </div>
                         {{ Form::text('name', $userdetail['name'], array('class'=>'form-control required', 'id'=>'name', 'placeholder'=>trans('frontend.name'), 'required' => '')) }}                        
                         <br/><span id="name-error"></span>    
                         {{ Form::text('surname', $userdetail['surname'], array('class'=>'form-control required', 'id'=>'surname', 'placeholder'=>trans('frontend.surname'), 'required' => '')) }}
                         <br/><span id="surname-error"></span>
                        
                        {{ Form::text('address', $userdetail['address'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.address'), 'required' => '')) }}                        
                        <br /><span id="address-error"></span> 
                        {{ Form::text('city', $userdetail['city'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.city'), 'required' => '')) }} 
                        <br/><span id="city-error"></span>
                        {{ Form::text('province', $userdetail['province'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.province'), 'required' => '')) }} 
                        <br/><span id="province-error"></span>
						{{ Form::select('nationality', $countryList, $userdetail['nationality'], array('class' => 'form-control', 'id'=>'nationality', 'required' => '')) }}
                        <br/><span id="nationality-error"></span>
                        {{ Form::text('zip', $userdetail['zip'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.zip'), 'required' => '')) }}
                        <br/><span id="zip-error"></span>
                        {{ Form::text('mobile', $userdetail['mobile'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.mobile'), 'required' => '')) }}
                        <br/><span id="mobile-error"></span>
                        
                        {{ Form::text('fax', $userdetail['fax'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.fax'), 'required' => '')) }}
                        <br/><span id="fax-error"></span>
                        {{ Form::text('phone', $userdetail['phone'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.phone'), 'required' => '')) }}
                        <br/><span id="phone-error"></span>
                        
						
						{{ trans('frontend.shipadd_defin') }}<br><br>{{ trans('frontend.no') }} {{ Form::radio('yesno', 'noCheck', true, array('style' => 'width:auto;', 'onclick'=>'javascript:yesnoCheck();', 'id'=>'noCheck')) }} {{ trans('frontend.yes') }} {{ Form::radio('yesno', 'yesCheck', '', array('style' => 'width:auto;', 'onclick'=>'javascript:yesnoCheck();', 'id'=>'yesCheck')) }} <br>
                        <br/><span id="yesno-error"></span>
                        <div id="ifYes" style="display:none">
                            {{ Form::text('sh_address', $userdetail['sh_address'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_address'))) }} 
                            <br/><span id="sh_address-error"></span>
                            {{ Form::text('sh_city', $userdetail['sh_city'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_city'))) }} 
                            <br/><span id="sh_city-error"></span>
                            {{ Form::text('sh_province', $userdetail['sh_province'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_province'))) }} 
                            <br/><span id="sh_province-error"></span>
                            {{ Form::select('sh_country', $countryList, $userdetail['sh_country'], array('class' => 'form-control')) }}
                            <br/><br/><span id="sh_country-error"></span>
                            {{ Form::text('sh_zip', $userdetail['sh_zip'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_zip'))) }} 
                            <br/><span id="sh_zip-error"></span>
                            
                        </div>
                       

						{{ Form::submit( trans('frontend.register'), array('class'=>'btn btn-lg btn-primary btn-block','onclick'=>'return submitform()'))}}
{{ Form::close() }}
						
					<p id="loading" style="display: none;"><img src="{{ asset('images/loading.gif') }}"   />&nbsp;&nbsp;{{ trans('userlistflights.loading_message') }}</p>
				</div>


				<!--separator-->
				
				<!--login-->

				
				<div class="clear"></div>
			</div>
<img class="triangleBottom" src="{{ asset('minisite/img/tri-white-bot.png') }}" alt="" />
</section>

{{ HTML::script('minisite/js/jquery.blockUI.js'); }}
<script type="text/javascript">
	// unblock when ajax activity stops 
   // $(document).ajaxStop($.unblockUI);
	


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


