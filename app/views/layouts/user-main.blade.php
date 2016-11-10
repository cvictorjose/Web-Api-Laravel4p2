<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
	<!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<!-- Viewport Metatag -->
		<meta name="viewport" content="width=device-width,initial-scale=1.0">

		<meta name="designer" content="Coded by - Tech Armada Company : info @ tech-armada .net"/>
		<meta name="copyright" content="Copyright <?php echo date('Y'); ?> Safebag, All Copyrights Reserved"/>

		{{ HTML::style('packages/bootstrap/css/bootstrap.min.css')}}
		{{ HTML::style('packages/css/fonts/ptsans/stylesheet.css')}}
		{{ HTML::style('packages/css/fonts/icomoon/style.css')}}
		{{ HTML::style('packages/css/login.min.css')}}
		{{ HTML::style('packages/css/mws-theme.css')}}

		<!-- Plugin Stylesheets first to ease overrides -->
		{{ HTML::style('packages/plugins/colorpicker/colorpicker.css')}}
		{{ HTML::style('packages/custom-plugins/wizard/wizard.css')}}

		<!-- Required Stylesheets -->
		{{ HTML::style('packages/custom-plugins/picklist/picklist.css')}}
		{{ HTML::style('packages/bootstrap/css/bootstrap.min.css')}}

		{{ HTML::style('packages/css/fonts/ptsans/stylesheet.css')}}
		{{ HTML::style('packages/css/fonts/icomoon/style.css')}}
		{{ HTML::style('packages/css/mws-style.css')}}
		{{ HTML::style('packages/css/icons/icol16.css')}}
		{{ HTML::style('packages/css/icons/icol32.css')}}
		{{ HTML::style('packages/css/demo.css')}}
		{{ HTML::style('packages/jui/css/jquery.ui.all.css')}}
		{{ HTML::style('packages/jui/jquery-ui.custom.css')}}
		<!-- Theme Stylesheet -->
		{{ HTML::style('packages/css/mws-theme.css')}}
		{{ HTML::style('packages/css/themer.css')}}

		<!-- I button-->
		<!--<link rel="stylesheet" type="text/css" href="plugins/select2/select2.css" media="screen">-->
		
	    {{ HTML::style('packages/css/jquery.ibutton.css')}}
		<!-- country flags -->
		<!--<link rel="stylesheet" type="text/css" href="http://cloud.github.com/downloads/lafeber/world-flags-sprite/flags32.css" />

		<!--Uploader stylesheet-->

		<title> Safebag - Smart Track </title>

	</head>
	<body>

		

		<!-- JS Includes -->

		{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'); }}

		{{ HTML::script('packages/js/libs/jquery-1.8.3.min.js'); }}
		{{ HTML::script('packages/custom-plugins/fileinput.js'); }}
		<!-- jQuery-UI Dependent Scripts -->
		{{ HTML::script('packages/jui/js/jquery-ui-effects.min.js'); }}
		<!-- Plugin Scripts -->
		{{ HTML::script('packages/plugins/validate/jquery.validate-min.js'); }}
		<!-- Login Script -->
		{{ HTML::script('packages/js/core/login.js'); }}
		{{ HTML::script('minisite/js/jquery.blockUI.js'); }}
		<!-- JavaScript Plugins -->
		{{ HTML::script('packages/js/libs/jquery.mousewheel.min.js'); }}
		{{ HTML::script('packages/js/libs/jquery.placeholder.min.js'); }}

		<!--wizard  -->
		{{ HTML::script('packages/custom-plugins/wizard/wizard.min.js'); }}
		{{ HTML::script('packages/custom-plugins/wizard/jquery.form.min.js'); }}

		<!-- jQuery-UI Dependent Scripts -->
		{{ HTML::script('packages/jui/js/jquery-ui-1.9.2.min.js'); }}
		{{ HTML::script('packages/jui/jquery-ui.custom.min.js'); }}
		{{ HTML::script('packages/jui/js/jquery.ui.touch-punch.js'); }}
		{{ HTML::script('packages/jui/js/globalize/globalize.js'); }}
		{{ HTML::script('packages/jui/js/globalize/cultures/globalize.culture.en-US.js'); }}

		<!-- Plugin Scripts -->
		{{ HTML::script('packages/plugins/datatables/jquery.dataTables.min.js'); }}
		{{ HTML::script('packages/plugins/colorpicker/colorpicker-min.js'); }}

		<!-- i button -->
		{{ HTML::script('packages/js/libs/jquery.ibutton.min.js'); }}

		<!-- Core Script -->
		{{ HTML::script('packages/bootstrap/js/bootstrap.min.js'); }}
		{{ HTML::script('packages/js/core/mws.js'); }}

		<!-- CKeditor-->
		{{ HTML::script('packages/plugins/ckeditor/ckeditor.js'); }}
		
		<script>
		 // unblock when ajax activity stops 
    $(document).ajaxStop($.unblockUI); 
   
 
 
    function test() { 
        $.ajax({ url: 'wait.php', cache: false }); 
    } 
 
    $(document).ready(function() { 
        
        
        				$.ajaxSetup ({
    						// Disable caching of AJAX responses
    						cache: false
						});
				     //status click change
				    
				      $("#active_click").click(function (event) {
				      					
				      				   $('#loading').show();	
				      					
									   $( "#changeflight" ).load( "{{ URL::to('users/changeflight').'/act' }}", function() {
 										 	$('#loading').hide();		
										});
									
			                
			           });
			           $("#expired_click").click(function (event) {
				      				$('#loading').show();
				      		 		$( "#changeflight" ).load( "{{ URL::to('users/changeflight').'/exp' }}", function() {
 										$('#loading').hide();		
									});
				      		
			                
			           });
			           $("#lost_click").click(function (event) {
				      		 $('#loading').show();	
				      		$( "#changeflight" ).load( "{{ URL::to('users/changeflight').'/lost' }}", function() {
 								$('#loading').hide();		
							});
				      		
			                
			           });
    }); 
 </script>
<script>
    
    
    
			$(function() {

				@if(Request::segment('2')=='listflights' || Request::segment('2')=='flightsdetails')
					 if( $.fn.iButton ) {
				            $('.ibutton').iButton({
				            	change : function($input){
				            		var domName = $($input).attr('name');
				            		var domValue = $($input).attr('value');
				            		var idbag   = domName.replace('status_','');
				            		var status  = domValue;
				            		//alert(idbag);
				            		if($('#airlinetag_'+idbag).val()!=''){
				            			
				            			//console.log($($input).attr('name'));
										r=true;
				            			 if(status == 'actlost'){
											 r	= confirm("{{ trans('userlistflights.conform_lost_message') }}");
										 }
										 if (r == true) {
											$.ajax({
											  type: "POST",
											  url: "{{ URL::to('users/changestatus') }}",
											  data: { '_token': $('#_token').val(), 'status': status, 'idbag' : idbag  },
											  dataType: 'json',
											  success : function(data){
												  if(data.flag_status == 0)
												 	alert('{{ trans("userlistflights.status_update_message_1") }}');
												  else
												  	alert('{{ trans("userlistflights.status_update_message_2") }}');
												  location.reload()
											  }
											});
										 }
										 else{
											// alert($($input).attr('checked'));
											$($input).prop('checked', false); 
											$($input).iButton("repaint");
										}
											 
											  
				            		}else{
				            			alert('{{ trans("userlistflights.airlinetag_empty_message") }}');
				            			return false;
				            		}
				            		
				            				
				            	}
				            	
				            });
				     }
				     
				     
				     
				     //airline tag udpate dialog
				      $(".editairlinetag").bind("click", function (event) {
				      		
				      		
				      		var idbag_data = $(this).attr('id');
				      		var idbag = idbag_data.replace('idbag_','');
				      		
			                $("#airlinetag_dialog_"+idbag).dialog({
			                    //modal: true,
			                    width : 400,
			                    height : 200 
			                    
			                }).dialog("open");
			                event.preventDefault();
			                
			            });
				     
				     
				     
				     
				     
				     
				@endif

				$('#message').delay(4000).fadeTo(1000, 0.01).slideUp(500);

		

			});

			function areyousure(delurl)
			{
			if (confirm('Are you sure to delete?')) {
				location.href = delurl;
			} else {}
			}
		</script>
        
        <!-- Panels Start -->

		{{ $content }}

		<!--content view ends -->

		<!-- Themer Script (Remove if not needed) -->
		<!--<script src="js/core/themer.js"></script>-->

	</body>
</html>