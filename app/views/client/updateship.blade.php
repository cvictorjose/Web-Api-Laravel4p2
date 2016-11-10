{{ Form::open(array('url'=>'client/updateship', 'class'=>'form-signup', 'id'=>'login-form', 'name'=>'login-form' )) }}
	<?php 
	$userdetail	=	Session::get('userdetail');
	$client	= Clients::whereRaw('idclient = ?', array($userdetail['idclient']))->first() ;	?>
	<h3><?php echo trans('frontend.invoice_and_shipping');?></h3>
     <br>
    <br>
    <?php echo trans('frontend.your_invoice_address');?>:<br><br>
    <div id="errordivlogin">
     
     </div>	
     	
     {{ Form::text('address', $client['address'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.address'), 'required' => '')) }}                         
    {{ Form::text('city', $client['city'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.city'), 'required' => '')) }} 
    {{ Form::text('province', $client['province'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.province'), 'required' => '')) }} 
    {{ Form::select('nationality', $countryList, $client['nationality'], array('class' => 'form-control', 'required' => '')) }}
    {{ Form::text('zip', $client['zip'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.zip'), 'required' => '')) }}	
    <br>
    <br>
    <?php echo trans('frontend.your_delivery_address');?>:<br><br>		
    {{ Form::text('sh_address', $client['sh_address'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_address'))) }} 
    {{ Form::text('sh_city', $client['sh_city'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_city'))) }} 
    {{ Form::text('sh_province', $client['sh_province'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_province'))) }} 
    {{ Form::select('sh_country', $countryList, $client['sh_country'], array('class' => 'form-control')) }}
    {{ Form::text('sh_zip', $client['sh_zip'], array('class'=>'form-control required', 'placeholder'=>trans('frontend.sh_zip'))) }}

    <input type="submit" value="<?php echo trans('frontend.send')?>" onclick="return login();"> <i class="fa fa-spin fa-circle-o-notch fa-form-wait" style="display: none;"></i>
{{ Form::close() }}
{{ HTML::script('minisite/js/jquery.blockUI.js'); }}
<script type="text/javascript">
	// unblock when ajax activity stops 
    $(document).ajaxStop($.unblockUI);
function login(){
	$.blockUI(); 
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
			$.unblockUI;
			if(data.redirect){
				window.location.href ="{{ URL::to('/') }}	";
			}
			if(data.fail) {
			  $.each(data.errors, function( index, value ) {
				  $( "#errordivlogin" ).append( '<div class="alert alert-danger">'+value+'</div>' );
				/*var errorDiv = '#'+index+'_error';
				$(errorDiv).addClass('required');
				$(errorDiv).empty().append(value);*/
			  });
			  $('html, body').animate({
					scrollTop: $("#editshipaddress").offset().top
				}, 1800);			  		           
			} 
			if(data.success){
				//window.location.href ="{{ URL::to('client/payment') }}	";
				$("#viewshipaddress").html(data.output);
				$("#viewshipaddress").show();
				$("#editshipaddress").hide();
				 $('html, body').animate({
					scrollTop: $("#viewshipaddress").offset().top
				}, 1800);	
			}
			//alert(data.message);
			
		}
	});
	return false;
}

</script>