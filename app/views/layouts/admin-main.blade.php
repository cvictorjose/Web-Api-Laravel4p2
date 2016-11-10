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
		<!--<link rel="stylesheet" type="text/css" href="plugins/select2/select2.css" media="screen">
		<link rel="stylesheet" type="text/css" href="plugins/ibutton/jquery.ibutton.css" media="screen">

		<!-- country flags -->
		<!--<link rel="stylesheet" type="text/css" href="http://cloud.github.com/downloads/lafeber/world-flags-sprite/flags32.css" />

		<!--Uploader stylesheet-->

		<title> Safebag - Smart Track </title>

	</head>
	<body>

		<!-- Panels Start -->

		{{ $content }}

		<!--content view ends -->

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
		{{ HTML::script('packages/plugins/ibutton/jquery.ibutton.min.js'); }}

		<!-- Core Script -->
		{{ HTML::script('packages/bootstrap/js/bootstrap.min.js'); }}
		{{ HTML::script('packages/js/core/mws.js'); }}

		<!-- CKeditor-->
		{{ HTML::script('packages/plugins/ckeditor/ckeditor.js'); }}
		
		<script>
						$(function() {

			//load ckeditor for terms
			@if( Route::currentRouteAction() == 'AdminController@getAddterm' || Route::currentRouteAction() == 'AdminController@getUpdateterm')
			//for ckeditor
			CKEDITOR.replace( 'description',
			{
			uiColor: '#9AB8F3',
			});

			$('#terms_form').validate({
			ignore : [],
			debug : false,
			rules : {
			title : { required:true } ,
			description : {
			required : function() {
			CKEDITOR.instances.description.updateElement();
			},

			minlength : 10
			}
			},
			messages : {
			title : {
			required : "Please enter Title"

			},
			description : {
			required : "Please enter Text"

			}
			}
			});
			@endif

			$('#message').delay(4000).fadeTo(1000, 0.01).slideUp(500);

			//order manager
			/*$('#bagorders').dataTable({

			sPaginationType: "full_numbers"
			});*/

			//card manager
			/*	$('#tbl_cards').dataTable({

			sPaginationType: "full_numbers"
			});*/
			
			//add new package popup
			$('#addnewpackage').click(function(){
				
				$("#mws-form-dialog-addupdatepackage").dialog("option", {
						modal: true
				}).dialog("open");
					event.preventDefault();
				

			});
			$('#addpackageform').validate({
															ignore : [],
															debug : false,
															rules : {
																		price 		: { required : true },
																		numflights  : { required : true,number: true }
																	}	  
												
												
			});
			$("#mws-form-dialog-addupdatepackage").dialog({
				autoOpen: false,
				title: "Add a new package",
				modal: true,
				width: "400",
				buttons: [{
						text: "Submit",
						click: function () {
							$(this).find('form#addpackageform').submit();
						}
				}]
			});
			//add new package popup ends
			
			
			
			
			//update package popup starts
			$('.edit-package').click(function(){
				
				//console.log($(this).attr('id'));
				str 		= $(this).attr('id');
				package_id  = parseInt(str.replace("edit-",""));
				//console.log(package_id);
				/*$("#mws-form-dialog-addupdatepackage-"+package_id).dialog("option", {
						modal: true
				}).dialog("open");*/
				$("#mws-form-dialog-addupdatepackage-"+package_id).dialog({
					autoOpen: true,
					title: "Update a package",
					modal: true,
					width: "400",
					buttons: [{
							text: "Submit",
							click: function () {
								$(this).find('form#updatepackageform').submit();
							}
					}]
				});
			
				event.preventDefault();
			});
			
			$('#updatepackageform').validate({
															ignore : [],
															debug : false,
															rules : {
																		price 		: { required : true },
																		numflights  : { required : true,number: true }
																	}	  
												
												
			});
			//update package popup ends
			
			
			//ranks update popup starts
			
			
			$('.edit-rank').click(function(){
				
				//console.log($(this).attr('id'));
				str 		= $(this).attr('id');
				rank_id  	= parseInt(str.replace("edit-",""));
				
				$("#mws-form-dialog-addupdaterank-"+rank_id).dialog({
					autoOpen: true,
					title: "Update a rank",
					modal: true,
					width: "400",
					buttons: [{
							text: "Submit",
							click: function () {
								$(this).find('form#updaterankform').submit();
							}
					}]
				});
			
				event.preventDefault();
			});
			
			$('#updaterankform').validate({
															ignore : [],
															debug : false,
															rules : {
																		price 		: { required : true }
																		
																	}	  
												
												
			});
			
			//ranks update popup ends
			
			
			@if( Route::currentRouteAction() == 'AdminController@getListriskairports')
			//risk manager
			var oTable=$("#tpl_airports").dataTable({
			sPaginationType: "full_numbers",
			"bStateSave": true,
			"aoColumns":[
			{"bSortable":false},
			null,null,null,
			{"bSortable":false}

			]
			});
			var nodes=oTable.fnGetNodes();
			$("#checkbox-main-header").click(function(){
			if($(this).is(":checked")){
			$('.checkbox-tr',nodes).attr("checked",true);
			}else{
			$('.checkbox-tr',nodes).attr("checked",false);
			}
			});

			//click to search
			$('#filterByRank1').click(function() {
			//$(this).addClass('bgblack');
			//$('#filterByRank2').removeClass('bgblack');
			oTable.fnFilter('1',4);
			});

			$('#filterByRank2').click(function() {
			oTable.fnFilter('2',4);
			});

			$('#filterByRank3').click(function() {
			oTable.fnFilter('3',4);
			});

			$('#clearFilters').click(function() {
			oTable.fnFilter('',4);

			$('.dataTables_filter input').val('').keyup();

			});
			$('.dataTables_filter input').attr("placeholder", "Search...");

			$('#massedit').click(function(){
				var allVals = [];
				$('input[name="id"]:checked',nodes).each(function() {
				allVals.push($(this).val());
				});
	
				//console.log(allVals);
				if (typeof allVals !== 'undefined' && allVals.length > 0) {
				// the array is defined and has at least one element
				strVals = JSON.stringify(allVals);
				$('#mws-validate').append("<input type='hidden' name='idchecked' value='"+strVals+"' />");
	
				$("#mws-form-dialog").dialog("option", {
				modal: true
				}).dialog("open");
				event.preventDefault();
				}else{
				alert('No airports selected for mass udpate!');
				}

			});

			$("#mws-form-dialog").dialog({
			autoOpen: false,
			title: "Mass rank update",
			modal: true,
			width: "350",
			buttons: [{
			text: "Submit",
			click: function () {
			$(this).find('form#mws-validate').submit();
			}
			}]
			});

			@endif

			//product related
			@if( Route::currentRouteAction() == 'AdminController@getAddproduct' || Route::currentRouteAction() == 'AdminController@getUpdateproduct')
			CKEDITOR.replace('descrizione_web_full', {
			uiColor : '#9AB8F3',

			});
			CKEDITOR.replace('descrizione_web', {
			uiColor : '#9AB8F3',

			});

			CKEDITOR.editorConfig = function(config) {
			// Define changes to default configuration here. For example:
			config.width = '850';
			config.height = '300';
			// config.uiColor = '#AADC6E';
			};

			$('#products_form').validate({
			ignore : [],
			debug : false,
			rules : {

			descrizione_web_full : {
			required : function() {
			CKEDITOR.instances.descrizione_web_full.updateElement();
			},
			},
			descrizione_web : {
			required : function() {
			CKEDITOR.instances.descrizione_web.updateElement();
			},
			}
			},
			messages : {

			descrizione_web_full : {
			required : "Please enter Text"

			},
			descrizione_web : {
			required : "Please enter Text"

			}
			}
			});

			$("#data_di_scandenza").datepicker({
			dateFormat : "yy-mm-dd",
			minDate : 0
			});

			$("#start_date").datepicker({
			dateFormat : "yy-mm-dd",
			minDate : 0
			});

			$("#end_date").datepicker({
			dateFormat : "yy-mm-dd",
			minDate : 0
			});

			$("#prezzo_web_app").keydown(function(e) {
			// Allow: backspace, delete, tab, escape, enter and .
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
			// Allow: Ctrl+A
			(e.keyCode == 65 && e.ctrlKey === true) ||
			// Allow: home, end, left, right
			(e.keyCode >= 35 && e.keyCode <= 39)) {
			// let it happen, don't do anything
			return;
			}
			// Ensure that it is a number and stop the keypress
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			e.preventDefault();
			}
			});

			$("#prezzo_aeroporto").keydown(function(e) {
			// Allow: backspace, delete, tab, escape, enter and .
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
			// Allow: Ctrl+A
			(e.keyCode == 65 && e.ctrlKey === true) ||
			// Allow: home, end, left, right
			(e.keyCode >= 35 && e.keyCode <= 39)) {
			// let it happen, don't do anything
			return;
			}
			// Ensure that it is a number and stop the keypress
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			e.preventDefault();
			}
			});

			$('.checkall').click(function() {
			$('.all_airports').closest('div').find('input[type=checkbox]').prop('checked', this.checked);
			});

			$("#picture1,#codice_prodotto,#codice_item").change(function() {

			var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')

			var codice_prodotto = $('#codice_prodotto').val();
			var codice_item = $('#codice_item').val();
			var extension = filename.split('.').pop();
			var newfilename = codice_prodotto + '-' + codice_item + '.' + extension;

			$.ajax({

			url : 'http://smart-tracking.tech-armada.net/uploads/products/' + newfilename,
			type : 'HEAD',
			error : function() {
			//alert('File not exists!');
			},
			success : function(ev) {
			alert('File already exists!');
			}
			});
			});

			@endif

			});

			function areyousure(delurl)
			{
			if (confirm('Are you sure to delete?')) {
			location.href = delurl;
			} else {}
			}
		</script>

		<!-- Themer Script (Remove if not needed) -->
		<!--<script src="js/core/themer.js"></script>-->

	</body>
</html>