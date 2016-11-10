<html xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
<?php 

if(isset($_SERVER['REQUEST_URI']) &&  $_SERVER['REQUEST_URI']== '/login.php'){?>	
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<?php } ?>	
</head>

<body>
<div id="fb-root"></div>

<script>
	var appid 		= '214374582105950';
	var appsecret   = '665a4604bb10a40352ea75d2de2c0b33';
	window.fbAsyncInit = function(event) {

	FB.init({
		appId:  appid,
		status: false,
		cookie: true,
		xfbml: true,
		oauth: true,
		channelUrl : '{{ URL::to("/")."/channel.php" }}'
	});

	FB.Event.subscribe('auth.authResponseChange', function(response) {
	if (response.status === 'connected') {

			var uid = response.authResponse.userID;
			var accessToken = response.authResponse.accessToken;
		
			//make server call to extend access token
			var exchangeUrl = "https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&fb_exchange_token=" + accessToken + "&client_id=" + appid + "&client_secret=" + appsecret;
			$('#loadingMessage').show();
			$.ajax({
			type : "GET",
			url : exchangeUrl,
		
			success : function(data) {
						extended = data.split('=');
						//console.log(data.param('access_token'));return false;
						extendedAT = extended['1'].replace('&expires', '');
						//return true;
						var userLang = navigator.language || navigator.userLanguage;
					
						langcty = userLang.split('-');
					
						FB.api('/me', function(response) {
							
							
										//console.log(response);return false;
										obj = {};
										obj.name = response.first_name;
										obj.surname = response.last_name;
										obj.email = response.email;
										obj.facebookId = uid;
										
										locale = (response.locale).split('_');
										obj.nationality = locale[1];
										
										
										obj.lingua_registrazione = langcty[0];
										//obj.nationality = langcty[1]
										
										
										obj.access_token = extendedAT;
						
						
										if(obj.email && obj.hasOwnProperty('email') ){
											
										}else{
											FB.logout(function(response) {
												$('#loadingMessage').hide();
  												alert("<?php if(isset($facebook_invalid_email)) echo $facebook_invalid_email; else echo "Please validate your facebook email account!"; ?>");
												document.location = document.location;
											});
											
										}
										
										$.post(getBaseURL() + "ws/fbregister", obj).success(function(data) {
									
												//parsedata = JSON.parse(data);
												parsedata = $.parseJSON(data);
												
												
												if(parsedata.client_id && parsedata.hasOwnProperty('client_id')){
													regfeeds = {};
													regfeeds.name = 'Safe Bag';
													regfeeds.caption = obj.name+' is now a member of Safe Bag Community';
													regfeeds.description = 'Safe Bag ensures a comfortable and safe travel experience to airport travellers: Luggage Wraps with a special 100% recyclable plastic film resistant to water, oil and cold. Luggage Tracking, thanks to a sticker with a unique code integrated with SITA World Tracer. Extension of Airline\'s Refund in case of loss or damage of your bag';
													regfeeds.link = 'http://safe-bag.com/index.php?lang=en';
													regfeeds.picture = 'http://safe-bag.tech-armada.net/ws/template-voucher/img/safebag.jpg';
												
													//posts on wall while registering
													FB.api('/me/feed', 'post', regfeeds, function(response){});
													
												}
												
												//console.log(parsedata);return false;
												if(parsedata.data && parsedata.data.hasOwnProperty('idclient')){
													
													objnew 				 = {};
													objnew.idclient		 = parsedata.data.idclient;
													objnew.access_token  = extendedAT;
													objnew.facebookId 	 = uid;
													$.post(getBaseURL() + "ws/update_access_token", objnew).done(function(data) {});
												}
												
												
												objsafe = {};
												objsafe.email = obj.email;
												objsafe.facebookId = uid;
												objsafe.loginfbaction = 'loginfbaction';
											
												$.post(getBaseURL() + "login4/php/corecontroller.php", objsafe).done(function(data) {
													
													$('#loadingMessage').hide();
													 if(location.pathname == '/index.php' || location.pathname == '/'  || location.pathname == '/en/' || location.pathname == '/it/' ||  location.pathname == '/en/index.php' ||  location.pathname == '/it/index.php' ||  location.pathname == '/booking/book-step3.php' ){
													 	
													 	if(location.pathname == '/en/' ||  location.pathname == '/en/index.php'){
													 		location.replace('index.php?lang=en');
													 	}else if(location.pathname == '/it/' ||  location.pathname == '/it/index.php'){
													 		location.replace('index.php?lang=it');
													 	}else if(location.pathname == '/booking/book-step3.php'){
													 		location.replace('/booking/book-step3.php');
													 	}else{
													 		location.replace('index.php?lang=it');
													 	}
														
													 }else{
													 	document.location = document.location;
														
													 }
											
												});
												
												
						
									},'json');
						});

					}
				});

		}
	});

	};
	
		( function() {
			var e = document.createElement('script');
			e.async = true;

			var localelang = navigator.language || navigator.userLanguage;

			langUp = localelang.replace('-', '_');

			
			e.src = document.location.protocol +
     
      		'//connect.facebook.net/en_US/all/debug.js';
			document.getElementById('fb-root').appendChild(e);
		}());

</script>


<div class="fb-login-button" ><a href="#" onClick="fblogin();return false;"><img src="{{ asset('images/facebook_login.png') }}" style="width:210px !important;"></a></div>

<span id="loadingMessage" style="display: none;"><?php if(isset($facebook_please_wait)) echo $facebook_please_wait; else echo "Please Wait...";?></span>
<script>
	function getBaseURL() {
		return location.protocol + "//" + location.hostname + (location.port && ":" + location.port) + "/";
	}


	function fblogin()
	{
		 FB.login(function(response) {
		 		
		 }, {scope: 'publish_stream,publish_actions,email'});	
	}
</script>

</body>
<html>
