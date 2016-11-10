{{ HTML::script('minisite/js/jquery.ddslick.min.js'); }}
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
		
								<h2><i class="icol32-application-view-tile"></i><?php echo trans('frontend.edit_profile');?></h2>
								<p style="text-align:justify">
                                <?php echo Session::get('cc');?>
									{{ trans('userlistcards.description') }} 
									<br/><!--<a class="btn mws-login-button" href="{{ URL::to('users/addcard') }}">{{ trans('userlistcards.register_a_smart_card') }}</a>
									<a class="btn mws-login-button" href="{{ URL::to('users/buycard') }}">{{ trans('userlistcards.buy_a_smart_card') }}</a>-->
                                    <!--<a class="btn mws-login-button" href="#" onclick="return registersmartcard();">{{ trans('userlistcards.register_a_smart_card') }}</a>
                                    <a class="btn mws-login-button" href="#" onclick="return buysmartcard();">{{ trans('userlistcards.buy_a_smart_card') }}</a>-->
									

								</p>
								@include('layouts.user-message')
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
                 <div class="mws-panel grid_4">
                    <div class="mws-panel-header">
                        <span><?php echo trans('frontend.edit_profile');?></span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        {{ Form::open(array('url'=>'client/updateship', 'class'=>'mws-form', 'id'=>'login-form', 'name'=>'login-form' )) }}
                        	<div class="mws-form-message error" id="errordivlogin">
                            
                            </div>
                            <fieldset class="mws-form-inline">
                                <legend><?php echo trans('frontend.personal_inform');?></legend>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.name') }}</label>
                                    <div class="mws-form-item">
                                        {{ $userdetail['name'] }}
                                    </div>
                                </div>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.surname') }}</label>
                                    <div class="mws-form-item">
                                        {{ $userdetail['surname'] }}
                                    </div>
                                </div>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.email') }}</label>
                                    <div class="mws-form-item">
                                        {{ $userdetail['email'] }}
                                    </div>
                                </div>
                                
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.address') }}</label>
                                    <div class="mws-form-item">
                                    	{{ Form::text('address', $userdetail['address'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.address'), 'required' => '')) }}
                                        
                                    </div>
                                </div>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.city') }}</label>
                                    <div class="mws-form-item">
                                    	{{ Form::text('city', $userdetail['city'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.city'), 'required' => '')) }}
                                    </div>
                                </div>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.province') }}</label>
                                    <div class="mws-form-item">
                                    	{{ Form::text('province', $userdetail['province'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.province'), 'required' => '')) }}
                                    </div>
                                </div>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.nationality') }}</label>
                                    <div class="mws-form-item">
                                    	{{ Form::select('nationality', $countryList, $userdetail['nationality'], array('class' => 'form-control', 'required' => '')) }}
                                    </div>
                                </div>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.zip') }}</label>
                                    <div class="mws-form-item">
                                    	{{ Form::text('zip', $userdetail['zip'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.zip'), 'required' => '')) }}
                                    </div>
                                </div>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.mobile') }}</label>
                                    <div class="mws-form-item">
                                    	{{ Form::text('mobile', $userdetail['mobile'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.mobile'), 'required' => '')) }}
                                    </div>
                                </div>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.fax') }}</label>
                                    <div class="mws-form-item">
                                    	{{ Form::text('fax', $userdetail['fax'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.fax'), 'required' => '')) }}
                                    </div>
                                </div>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.phone') }}</label>
                                    <div class="mws-form-item">
                                    	{{ Form::text('phone', $userdetail['phone'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.phone'), 'required' => '')) }}
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mws-form-block">
                            	<legend><?php echo trans('frontend.your_delivery_address');?></legend>
                            	<div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.shipadd_defin') }}</label>
                                    <div class="mws-form-item">
                                    	{{ trans('frontend.no') }} {{ Form::radio('yesno', 'noCheck', true, array('style' => 'width:auto;', 'onclick'=>'javascript:yesnoCheck();', 'id'=>'noCheck')) }} {{ trans('frontend.yes') }} {{ Form::radio('yesno', 'yesCheck', '', array('style' => 'width:auto;', 'onclick'=>'javascript:yesnoCheck();', 'id'=>'yesCheck')) }}
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mws-form-inline" id="ifYes" style="display:none">                                
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.sh_address') }}</label>
                                    <div class="mws-form-item">
                                        {{ Form::text('sh_address', $userdetail['sh_address'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_address'))) }}
                                    </div>
                                </div>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.sh_city') }}</label>
                                    <div class="mws-form-item">
                                        {{ Form::text('sh_city', $userdetail['sh_city'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_city'))) }} 
                                    </div>
                                </div>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.sh_province') }}</label>
                                    <div class="mws-form-item">
                                        {{ Form::text('sh_province', $userdetail['sh_province'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_province'))) }} 
                                    </div>
                                </div>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.sh_country') }}</label>
                                    <div class="mws-form-item">
                                        {{ Form::select('sh_country', $countryList, $userdetail['sh_country'], array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="mws-form-row bordered">
                                    <label class="mws-form-label">{{ trans('frontend.sh_zip') }}</label>
                                    <div class="mws-form-item">
                                        {{ Form::text('sh_zip', $userdetail['sh_zip'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_zip'))) }}
                                    </div>
                                </div>
                            </fieldset>
                            <div class="mws-button-row">
                                 <input type="submit" value="{{ trans('frontend.update') }}" class="btn btn-danger" onclick="return login();">
                                 <p id="loading" style="display: none;"><img src="{{ asset('images/loading.gif') }}"   />&nbsp;&nbsp;{{ trans('userlistflights.loading_message') }}</p>
                            </div>
                        {{ Form::close() }}
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
	function yesnoCheck() {
		if (document.getElementById('yesCheck').checked) {
			document.getElementById('ifYes').style.display = 'block';
		}
		else document.getElementById('ifYes').style.display = 'none';
	
	}
	// unblock when ajax activity stops 
   $(function() {$( "#errordivlogin" ).hide();});
function login(){
	$("#loading").show();
	$( "#errordivlogin" ).html('');
	url	=	"{{ URL::to('client/updateship') }}";
	data	=	$( "#login-form" ).serializeArray();
	var token = $('#search > input[name="_token"]').val();
	//data.splice('_token', 1);
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
				$( "#errordivlogin" ).append('<ul>');
			  $.each(data.errors, function( index, value ) {
				  $( "#errordivlogin" ).append( '<li>'+value+'</li>' );
				/*var errorDiv = '#'+index+'_error';
				$(errorDiv).addClass('required');
				$(errorDiv).empty().append(value);*/
			  });
			  $( "#errordivlogin" ).append('</ul>');
			  $('html, body').animate({
					scrollTop: $("#errordivlogin").offset().top
				}, 1800);	
				$( "#errordivlogin" ).show();		  		           
			} 
			if(data.success){
				window.location.href ="{{ URL::to('users/payment') }}	";
				
			}
			//alert(data.message);
			$("#loading").hide();
		}
	});
	return false;
}

</script>			
										



