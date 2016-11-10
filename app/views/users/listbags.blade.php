<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
<style type="text/css">
.typeahead, .tt-query, .tt-hint {
    border: 2px solid #ccc;
    border-radius: 8px;    
    height: 30px;
    line-height: 30px;
    outline: medium none;
    padding: 8px 12px;
    width: 396px;
}
.typeahead {
    background-color: #fff;
}
.typeahead:focus {
    border: 2px solid #0097cf;
}
.tt-query {
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
    color: #999;
}
.tt-dropdown-menu {
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    margin-top: 12px;
    padding: 8px 0;
    width: 422px;
}
.tt-suggestion {
    font-size: 18px;
    line-height: 24px;
    padding: 3px 20px;
}
.tt-suggestion.tt-cursor {
    background-color: #0097cf;
    color: #fff;
}
.tt-suggestion p {
    margin: 0;
}
.gist {
    font-size: 14px;
}
#custom-templates .empty-message {
    padding: 5px 10px;
    text-align: center;
}
#multiple-datasets .league-name {
    border-bottom: 1px solid #ccc;
    margin: 0 20px 5px;
    padding: 3px 0;
}
#scrollable-dropdown-menu .tt-dropdown-menu {
    max-height: 150px;
    overflow-y: auto;
}
#rtl-support .tt-dropdown-menu {
    text-align: right;
}
</style>
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
		
								<h2><i class="icol32-application-view-tile"></i>{{ trans('userlistbags.your_bags') }}</h2>
								<p style="text-align:justify">
									{{ trans('userlistbags.description') }} 
									<br/><!--<a class="btn mws-login-button" href="{{ URL::to('users/addbag') }}">{{ trans('userlistbags.register_a_new_bag') }}</a>-->
                                    <a class="btn mws-login-button" href="#" onclick="return addbag();">{{ trans('userlistbags.register_a_new_bag') }}</a>
									

								</p>
								@include('layouts.user-message')
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
						@foreach($bags as $bag)
						<div class="mws-panel grid_4">
								<!-- Panel Header -->
								<div class="mws-panel-header">
									
									<span><i class="icon-book"></i>{{ '#'.$bag->bag_id }}</span>
								</div>
								<div class="mws-panel-body">
									<!--<h3>{{ trans('userlistbags.your_cards') }}</h3>-->
									   <ul class="mws-summary clearfix">
									   	
				                            <li class='clearfix'>
				                            	@if($bag->picture1 != '' && file_exists(('uploads/'.$bag->picture1)))
				                                	<span class="key"><img src="{{ asset('uploads/'.$bag->picture1) }}"  /></span>
                                                @endif
                                                @if($bag->picture2 != '' && file_exists(('uploads/'.$bag->picture2)))
				                                	<span class="key"><img src="{{ asset('uploads/'.$bag->picture2) }}"  /></span>
                                                @endif
                                                @if($bag->picture3 != '' && file_exists(('uploads/'.$bag->picture3)))
				                                	<span class="key"><img src="{{ asset('uploads/'.$bag->picture3) }}"  /></span>
                                                @endif
				                                <span class="val">
				                                    <span class="text-nowrap">{{ $bag->name }}</span><br/>
				                                    <span class="text-nowrap"><?php echo trans('userlistbags.color');?> : {{ $bag->color }}</span><br/>
				                                    <span class="text-nowrap"><?php echo trans('userlistbags.brand');?> : {{ $bag->brand }}</span><br/>
				                                </span>
				                            </li>
				                            
				                        
				                        </ul>
                                    <a class="btn mws-login-button" href="#" onclick="return editform('{{ $bag->bag_id }}');">{{ trans('userlistbags.edit_bag') }}</a>
                                    <a class="btn mws-login-button" href="#" onclick="return deletebag('{{ $bag->bag_id }}');">{{ trans('userlistbags.delete_bag') }}</a>                                    
									
									<!--<a class="btn mws-login-button" href="{{ URL::to('users/editbag') }}">{{ trans('userlistbags.edit_bag') }}</a>
									<a class="btn mws-login-button" href="{{ URL::to('users/deletebag') }}">{{ trans('userlistbags.delete_bag') }}</a>-->

								</div>
							</div>	
                        @endforeach  
                <!-- Panels End -->
                
                <div id="mws-form-dialog">                    
                    {{ Form::open(array('url'=>'users/addbaglist', 'class'=>'form-signup', 'id'=>'addbaglistform', 'enctype'=>'multipart/form-data' )) }}
                        <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                        <div id="errordiv">
                         
                         </div>
                        <div class="mws-form-inline">
                            <div class="mws-form-row">
                            	<label class="mws-form-label"><?php echo trans('userlistbags.name');?></label>
                                <div class="mws-form-item">
                            	{{ Form::hidden('bag_id', null, array('class'=>'form-control required', 'id'=>'bag_id')) }}      
                                {{ Form::text('name', null, array('class'=>'form-control required', 'id'=>'name', 'placeholder'=>trans('userlistbags.placeholder_name'), 'required' => '')) }}  
                                </div>    
                            </div>
                            <div class="mws-form-row">
                            	<label class="mws-form-label"><?php echo trans('userlistbags.color');?></label>
                                <div class="mws-form-item">
                            	{{ Form::select('color', $colorlist, null, array('class' => 'form-control', 'id'=>'color', 'required' => '')) }}
                               </div>
                            </div>
                            <div class="mws-form-row">
                            	<label class="mws-form-label"><?php echo trans('userlistbags.brand');?></label>
                                <div class="mws-form-item">
                                {{ Form::text('brand', null, array('class'=>'form-control required typeahead', 'id'=>'brand', 'placeholder'=>trans('userlistbags.brand'), 'required' => '')) }}   
                                </div>   
                            </div>
                            <div class="mws-form-row">
                            	<label class="mws-form-label"><?php echo trans('userlistbags.description');?></label>
                                <div class="mws-form-item">
                                {{ Form::textarea('description', null, array('class'=>'form-control required', 'id'=>'description', 'placeholder'=>trans('userlistbags.description'), 'required' => '')) }}    
                                </div>  
                            </div>                            
                            <div class="mws-form-row">
                                <label class="mws-form-label"><?php echo trans('userlistbags.placeholder_pictures');?></label>
                            </div>
                            <div class="mws-form-row">
                               	<div id="picture1_div"></div>
                                <div class="mws-form-item">
                                {{ Form::file('picture1') }}
                                </div>
                               
                            </div>
                            <div class="mws-form-row">
                                <div id="picture2_div"></div>
                                <div class="mws-form-item">
                                {{ Form::file('picture2') }}
                                </div>
                               
                            </div>
                            <div class="mws-form-row">
                                <div id="picture3_div"></div>
                                <div class="mws-form-item">
                                {{ Form::file('picture3') }}
                                </div>
                               
                            </div>
                            
                            
                        </div>
                        {{ Form::submit( trans('frontend.update'), array('class'=>'btn btn-lg btn-primary btn-block','onclick'=>'return submitform()'))}}
                        <p id="loadinglogin" style="display: none;"><img src="{{ asset('images/loading.gif') }}"   />&nbsp;&nbsp;{{ trans('userlistflights.loading_message') }}</p>
                    {{ Form::close() }}
                </div>
                
                {{ Form::open(array('url'=>'users/deletebag', 'class'=>'form-signup', 'id'=>'deletebagform', 'enctype'=>'multipart/form-data' )) }}
                	{{ Form::hidden('bag_id', null, array('class'=>'form-control required', 'id'=>'bag_id')) }}
                {{ Form::close() }}
                <div id="dialog-confirm">
                  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{{ trans('userlistbags.conform_message') }}</p>
                </div>
                

   
   
            </div>
            
            
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            @include('layouts.admin-foot')
            
            
        </div>
        
        
        <!-- Main Container End -->
        
    </div>
   
    
    <script>
	
//	https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js
$(function() {
  var input = document.getElementById("images"),
      formdata = false;
    
  if (window.FormData) {
	//  alert("aa");
    /*formdata = new FormData();
    document.getElementById("btn").style.display = "none";*/
  }
  

});
$(function() {
$( "#mws-form-dialog" ).dialog({
autoOpen: false,
//left:'15%',
width: '70%',
//modal: true,
});

$( "#dialog-confirm" ).dialog({
	autoOpen: false,
	left:'15%',
	//width: '50%',
	modal: true,
});

});

function deletebag(id){
	$("#deletebagform #bag_id").val(id);
	$('.ui-dialog-title').html("{{ trans('userlistbags.delete_bag') }}");
	//$( "#dialog-confirm" ).dialog( "open" );
	$( "#dialog-confirm" ).dialog({
		  resizable: false,
		  modal: true,
		  buttons: {
			"{{ trans('userlistbags.delete_bag') }}": function() {
			 // $( this ).dialog( "close" );
				$('#deletebagform').ajaxForm(function(result) {
					data	=	result;
					if(data.redirect){
						window.location.href ="{{ URL::to('users/dashboard') }}	";
					}
					if(data.fail) {
					  $.each(data.errors, function( index, value ) {
						 // alert(value);
						  $( "#mws-validate-error" ).append( '<div class="alert alert-danger">'+value+'</div>' );
						   $( "#mws-validate-error" ).show();
						/*var errorDiv = '#'+index+'_error';
						$(errorDiv).addClass('required');
						$(errorDiv).empty().append(value);*/
					  });
					  $('html, body').animate({
							scrollTop: $("#errordiv").offset().top
						}, 800);			  		           
					} 
					if(data.success){
						location.reload();
						//window.location.href ="{{ URL::to('users/listbags') }}	";
					}
					
				}).submit();
			},
			"{{ trans('userlistbags.cancel') }}": function() {
			  $( this ).dialog( "close" );
			}
		  }
		});
		
		$( "#dialog-confirm" ).dialog( "open" );
	
	return false;
}

function addbag(){
	$("#addbaglistform #bag_id").val("");
	$('#addbaglistform')[0].reset();
	$('.ui-dialog-title').html("{{ trans('userlistbags.register_a_new_bag') }}");
	$( "#mws-form-dialog" ).dialog( "open" );
	
	$( "#mws-validate-error" ).html("");
	$( "#mws-validate-error" ).hide();
	$("#picture1_div").html("");
	$("#picture2_div").html("");
	$("#picture3_div").html("");
	return false;
}
function editform(bag_id){
	//alert(id);
	
	$( "#mws-validate-error" ).html("");
	$( "#mws-validate-error" ).hide();
	$("#picture1_div").html("");
	$("#picture2_div").html("");
	$("#picture3_div").html("");
	$('#addbaglistform')[0].reset();
	data	=	new Array();
	data['bag_id']	=	bag_id;
	data['_token']	=	"<?php echo csrf_token(); ?>";
	$.ajax({
		type: 'post',
		url: "{{ URL::to('users/getbagdetail') }}",
		dataType: 'json',
		data: {'bag_id':bag_id, '_token':"<?php echo csrf_token(); ?>"},
		enctype: 'multipart/form-data',
		success: function(data) {
			if(data.success){
				$("#addbaglistform #bag_id").val(data.bag_id);
				$("#name").val(data.name);
				$("#color").val(data.color);
				$("#brand").val(data.brand);
				$("#description").val(data.description);
				if(data.picture1 != ''){
					value	=	'<span class="key"><img src="'+"{{ asset('uploads/') }}/"+data.picture1+'" style="width:150px;"  /></span>';					
					$("#picture1_div").html(value)
				}
				if(data.picture2 != ''){
					value	=	'<span class="key"><img src="'+"{{ asset('uploads/') }}/"+data.picture2+'" style="width:150px;" /></span>';
					$("#picture2_div").html(value)
				}
				if(data.picture3 != ''){
					value	=	'<span class="key"><img src="'+"{{ asset('uploads/') }}/"+data.picture3+'" style="width:150px;" /></span>';
					$("#picture3_div").html(value)
				}
				$('.ui-dialog-title').html("{{ trans('userlistbags.edit_bag') }}");
				$( "#mws-form-dialog" ).dialog( "open" );
			}
			else{
				window.location.href ="{{ URL::to('users/dashboard') }}	";
			}
		}
	});
	return false;
}
//$(document).ajaxStop($.unblockUI);
function submitform(){ 
 $("#loadinglogin").show();
 $( "#mws-validate-error" ).html("");
 $( "#mws-validate-error" ).hide();
 	
    $('#addbaglistform').ajaxForm(function(result) {
		data	=	result;
		if(data.redirect){
			window.location.href ="{{ URL::to('users/dashboard') }}	";
		}
		if(data.fail) {
		  $.each(data.errors, function( index, value ) {
			 // alert(value);
			  $( "#mws-validate-error" ).append( '<div class="alert alert-danger">'+value+'</div>' );
			   $( "#mws-validate-error" ).show();
			/*var errorDiv = '#'+index+'_error';
			$(errorDiv).addClass('required');
			$(errorDiv).empty().append(value);*/
		  });
		  $('html, body').animate({
				scrollTop: $("#errordiv").offset().top
			}, 800);			  		           
		} 
		if(data.success){
			$( "#mws-form-dialog" ).dialog( "close" );
			location.reload();
			//window.location.href ="{{ URL::to('users/listbags') }}	";
		}
		$("#HiddenRowsa").hide();
		$('#table').prepend(result);
		 $("#loadinglogin").hide();
	}).submit();
	
	return false;	
}
function submitform1(){
	$(".ui-dialog .ui-widget .ui-widget-content .ui-corner-all .ui-draggable .ui-resizable").css({ left:'15%'});
	//$.blockUI(); 
	$( "#errordiv" ).html('');
	url	=	$( "#addbaglistform" ).attr( "action" );
	form	=	$( "#addbaglistform" );
	
	//data	=	new FormData(form);
	data	=	$( "#addbaglistform" ).serializeArray();
	//var token = $('#search > input[name="_token"]').val();
	//data.splice('_token', 1);
	$.ajax({
		type: 'post',
		url: url,
		dataType: 'json',
		data: data,
		enctype: 'multipart/form-data',
		success: function(data) {
			if(data.redirect){
				window.location.href ="{{ URL::to('users/dashboard') }}	";
			}
			if(data.fail) {
			  $.each(data.errors, function( index, value ) {
				  alert(value);
				  $( "#errordiv" ).append( '<div class="alert alert-danger">'+value+'</div>' );
				/*var errorDiv = '#'+index+'_error';
				$(errorDiv).addClass('required');
				$(errorDiv).empty().append(value);*/
			  });
			  $('html, body').animate({
					scrollTop: $("#errordiv").offset().top
				}, 800);			  		           
			} 
			if(data.success){
				window.location.href ="{{ URL::to('users/listbags') }}	";
			}
			//alert(data.message);
			
		}
	});
	
	return false;	
}

var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substrRegex;
 
    // an array that will be populated with substring matches
    matches = [];
 
    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');
 
    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        // the typeahead jQuery plugin expects suggestions to a
        // JavaScript object, refer to typeahead docs for more info
        matches.push({ value: str });
      }
    });
 
    cb(matches);
  };
};
 
var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
  'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
  'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
  'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
  'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
  'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
  'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
  'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
  'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
];

var states = <?php echo json_encode($brandlist);?>;
 
$('.typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1,
  maxLength: 10
},
{
  name: 'states',
  displayKey: 'value',  
  source: substringMatcher(states)
});



</script>