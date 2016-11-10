<!DOCTYPE html>
<html>
<head>
	<title>Safe Bag - Smart Track</title>
	<!-- Theme stylesheet -->
    {{ HTML::style('minisite/css/style.css')}}
    {{ HTML::style('minisite/css/responsive.css')}}
	<!--<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/responsive.css" rel="stylesheet" type="text/css">-->
	<!-- Roboto Font stylesheet -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
	<!-- FontAwesome stylesheet -->
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- LayerSlider stylesheet -->
    {{ HTML::style('minisite/layerslider/css/layerslider.css')}}
    
	<!--<link rel="stylesheet" href="layerslider/css/layerslider.css" type="text/css">-->
	
    {{ HTML::style('minisite/css/lightbox.css')}}
    {{ HTML::style('minisite/css/jquery.dropdown.css')}}
	<!--<link href="css/lightbox.css" rel="stylesheet" />
	<link type="text/css" rel="stylesheet" href="css/jquery.dropdown.css" />-->
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <script src="http://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

</head>

<body>
	<!--responsive menu placeholder-->
	<div id="followMenu"><div class="clear"></div></div>
     <?php

		$langData = array('it', 'en');
		
		if (Input::get('lang') && in_array(Input::get('lang'), $langData, true)) {
			$lang = Input::get('lang');
			Session::put('lang', Input::get('lang'));
		
		} elseif (Session::get('lang') && in_array(Session::get('lang'), $langData, true)) {
			$lang = Session::get('lang');
		} elseif (Session::get('lang') && isset($_GET['lang']) && Session::get('lang') == Input::get('lang') && in_array(Input::get('lang'), $langData, true) && in_array(Session::get('lang'), $langData, true)) {
			$lang = Session::get('lang');
		} else {
			Session::put('lang', 'it');
			$lang = Session::get('lang');
		
		}
		App::setLocale($lang);
		?>

	<!--BEGIN TOP CONTAINER (slider&nav)-->
	<section id="topContainer">
		<div id="navigationWrap">
			<div class="row">
				<div class="three-col"><img src="minisite/img/logo.png" alt="Safe Bag Spa"/></div>
				<div class="nine-col last-col menuWrap"><!--last-col--> 
					<ul class="mainMenu" style="float:right;margin-right:5%">
                    	<?php 
						if(Session::has('userdetail')){ ?>
                        <li><a href="#" data-dropdown="#dropdown-5"><?php echo Session::get('name');?></a></li>
						
                       <?php 
						}
						else{
					   ?>
						<li><a href="#" data-dropdown="#dropdown-1"><?php echo trans('frontend.login');?></a></li>
						<li><a href="#" data-dropdown="#dropdown-2" onClick="return register();"><?php echo trans('frontend.register');?></a></li>                       
                       <?php 
						}
						?>
						<li>
                        <?php 
						switch ($lang) {
							case 'it' :
									echo	'<a href="#" data-dropdown="#dropdown-3"><img id="menuimg" style="vertical-align: middle;"style="vertical-align: middle;" src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/it.png" />&nbsp; Italiano </a></li>';
								break;							
							case 'en' :
									echo	'<a href="#" data-dropdown="#dropdown-3"><img id="menuimg" style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/en.png" />&nbsp; English </a></li>';
								break;
							default :
									echo	'<a href="#" data-dropdown="#dropdown-3"><img style="vertical-align: middle;"style="vertical-align: middle;" src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/it.png" />&nbsp; Italiano </a></li>';
								break;							
								
						}	
						?>
                        
                        <!--<a href="#" data-dropdown="#dropdown-3">English</a></li>-->
						<!--<li><a href="#reviewContainer">Reviews</a></li>-->
						<!--<li><a href="#screensContainer">Screens</a></li>-->
						<!--<li><a href="#demoContainer">Demo</a></li>-->
						<!--<li><a href="#getappContainer">Get App</a></li>-->
                        <?php

						$cc = Session::get('cc');
						?>
						<li>
                        <?php 
							switch ($cc) {
								case 'EUR' :
									echo	'<a href="#" data-dropdown="#dropdown-4"><img style="vertical-align: middle;"style="vertical-align: middle;" src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€) </a></li>';
								break;							
							case 'CHF' :
									echo	'<a href="#" data-dropdown="#dropdown-4"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.) </a></li>';
								break;
							case 'USD' :
									echo	'<a href="#" data-dropdown="#dropdown-4"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($) </a></li>';
								break;							
							case 'BRL' :
									echo	'<a href="#" data-dropdown="#dropdown-4"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$) </li>';
								break;
							case 'RUB' :
									echo	'<a href="#" data-dropdown="#dropdown-4"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք) </li>';
								break;							
							case 'MXN' :
									echo	'<a href="#" data-dropdown="#dropdown-4"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($) </li>';
								break;
							case 'GBP' :
									echo	'<a href="#" data-dropdown="#dropdown-4"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£) </li>';
								break;														
							default :
									echo	'<a href="#" data-dropdown="#dropdown-4"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€) </li>';
									Session::put('cc','EUR');
								break;		
								
							}
						?>
                        	
					</ul>
					
				</div>

				<div class="clear"></div>
			</div>
			
				

	   		</div>

   		<!-- BEGIN SLIDER -->
   		<div id="sliderWraper" class="row">
   		<!--<div class="absolute"><ul><li>sometext</li><li>sometext</li><li>sometext</li></ul><p>conditions</p>
   		</div>-->
	   		<div id="layerslider" style="width: 1170px;max-width: 1170px; height: 690px;">
			    <!-- first slide -->
			    <div class="ls-slide">
	        		<img src="minisite/img/demoimg/slider1.png" alt="Phone" class="ls-l" style="top: 30px; left: 0;" 
	        			data-ls="offsetxin: 0; offsetxout : 0; offsetyin: 100; durationin: 2000" />

        			<p class="ls-l sliderText" style="top: 50px; left: 550px;" 
        				data-ls="offsetxin: 0; offsetxout : 0; offsetyin: 50; durationin: 2000;">
        			<span><?php echo trans('frontend.only');?> 
						<?php 
						//echo '€9,90';
						//$symbolarray	=	Clients::getPaypalcurrencies(Session::get('cc'));
						//$defultamount		=	9.90;
						//$symbol		=	$symbolarray['symbol'];
						//
						//$rates_ac_to_products = Exchange::where('currency_code','=','EUR')->first();
						//$currency_code  =  Session::get('cc');
						
						//switch($currency_code){
						//	case 'EUR' : $exrate = $rates_ac_to_products->exrate_EUR; break;
						//	case 'USD' : $exrate = $rates_ac_to_products->exrate_USD; break;
						//	case 'CHF' : $exrate = $rates_ac_to_products->exrate_CHF; break;
						//	case 'BRL' : $exrate = $rates_ac_to_products->exrate_BRL; break;
						//	case 'RUB' : $exrate = $rates_ac_to_products->exrate_RUB; break;
						//	case 'MXN' : $exrate = $rates_ac_to_products->exrate_MXN; break;
						//	case 'GBP' : $exrate = $rates_ac_to_products->exrate_GBP; break;
						//}
						
						//if($currency_code == 'EUR'){
						//	$price   = (float)$defultamount * (float)$exrate;
						//}else{
						//	$price   = (float)$defultamount * (float)$exrate * floatval('1.10');
						//}
						//$defultamount		=	$price;
						//
						//echo $symbol.number_format(round($defultamount, 1), 2);
						//
						?>
                        </span><br/><?php echo trans('frontend.only_condent');?></p>

        			<a href="#supportContainer" class="buttonBig ls-l" style="top: 300px; left: 531px;" 
        				data-ls="offsetxin: 0; offsetxout: 0; delayin: 300; offsetyin: 100; durationin: 2000;"><?php echo trans('frontend.cap_how_it_works');?></a> 

        			<a href="#demoContainer" class="buttonBig ls-l" style="top: 300px; left: 745px;"
        				data-ls="offsetxin: 0; offsetxout: 0; delayin: 300; offsetyin: 100; durationin: 2000;"><?php echo trans('frontend.cap_get_yours_now');?></a>	

					<a href="#aboutContainer" class="buttonBig ls-l" style="top: 300px; left: 967px;"
        				data-ls="offsetxin: 0; offsetxout: 0; delayin: 300; offsetyin: 100; durationin: 2000;"><?php echo trans('frontend.cap_how_it_works_2');?></a>	
			    </div>
			    <!-- second slide -->
			    <div class="ls-slide">
	        		<img src="minisite/img/demoimg/slider2.png" alt="Phone" class="ls-l" style="top: -40px; left: 0;" 
	        			data-ls="offsetxin: 0; offsetxout : 0; offsetyin: 100; durationin: 2000" />

        			<p class="ls-l sliderText" style="top: 50px; left: 550px;" 
        				data-ls="offsetxin: 0; offsetxout : 0; offsetyin: 50; durationin: 2000;">
        			<span><?php echo trans('frontend.cap_the_card');?></span><br/><?php echo trans('frontend.many_features_inside');?></p>

        			<a href="#supportContainer" class="buttonBig ls-l" style="top: 300px; left: 531px;" 
        				data-ls="offsetxin: 0; offsetxout: 0; delayin: 300; offsetyin: 100; durationin: 2000;"><?php echo trans('frontend.cap_how_it_works');?></a> 

        			<a href="#demoContainer" class="buttonBig ls-l" style="top: 300px; left: 745px;"
        				data-ls="offsetxin: 0; offsetxout: 0; delayin: 300; offsetyin: 100; durationin: 2000;"><?php echo trans('frontend.cap_get_yours_now');?></a>	

					<a href="#aboutContainer" class="buttonBig ls-l" style="top: 300px; left: 967px;"
        				data-ls="offsetxin: 0; offsetxout: 0; delayin: 300; offsetyin: 100; durationin: 2000;"><?php echo trans('frontend.cap_how_it_works_2');?></a>	
			    </div>
			    <!-- third slide -->
			    <div class="ls-slide">
	        		<img src="minisite/img/demoimg/slider3.png" alt="Phone" class="ls-l" style="top: 0px; left: 0;" 
	        			data-ls="offsetxin: 0; offsetxout : 0; offsetyin: 100; rotatein: 0; durationin: 2000" />

        			<p class="ls-l sliderText" style="top: 50px; left: 550px;" 
        				data-ls="offsetxin: 0; offsetxout : 0; offsetyin: 50; durationin: 2000;">
        			<span><?php echo trans('frontend.cap_happyness');?></span><br/><?php echo trans('frontend.on_the_move');?></p>

        			<a href="#supportContainer" class="buttonBig ls-l" style="top: 300px; left: 531px;" 
        				data-ls="offsetxin: 0; offsetxout: 0; delayin: 300; offsetyin: 100; durationin: 2000;"><?php echo trans('frontend.cap_how_it_works');?></a> 

        			<a href="#demoContainer" class="buttonBig ls-l" style="top: 300px; left: 745px;"
        				data-ls="offsetxin: 0; offsetxout: 0; delayin: 300; offsetyin: 100; durationin: 2000;"><?php echo trans('frontend.cap_get_yours_now');?></a>	

					<a href="#aboutContainer" class="buttonBig ls-l" style="top: 300px; left: 967px;"
        				data-ls="offsetxin: 0; offsetxout: 0; delayin: 300; offsetyin: 100; durationin: 2000;"><?php echo trans('frontend.cap_how_it_works_2');?></a>	
			    </div>   
				<!-- 4th slide -->
			    <div class="ls-slide">
	        		<img src="minisite/img/demoimg/slider4.png" alt="Phone" class="ls-l" style="top: 0px; left: 0;" 
	        			data-ls="offsetxin: 0; offsetxout : 0; offsetyin: 100; rotatein: 0; durationin: 2000" />

        			<p class="ls-l sliderText" style="top: 50px; left: 550px;" 
        				data-ls="offsetxin: 0; offsetxout : 0; offsetyin: 50; durationin: 2000;">
        			<span><?php echo trans('frontend.cap_happyness_2');?></span><br/><?php echo trans('frontend.on_the_move_2');?></p>

        			<a href="#supportContainer" class="buttonBig ls-l" style="top: 300px; left: 531px;" 
        				data-ls="offsetxin: 0; offsetxout: 0; delayin: 300; offsetyin: 100; durationin: 2000;"><?php echo trans('frontend.cap_how_it_works');?></a> 
					
        			<a href="#demoContainer" class="buttonBig ls-l" style="top: 300px; left: 745px;"
        				data-ls="offsetxin: 0; offsetxout: 0; delayin: 300; offsetyin: 100; durationin: 2000;"><?php echo trans('frontend.cap_get_yours_now');?></a>	

					<a href="#aboutContainer" class="buttonBig ls-l" style="top: 300px; left: 967px;"
        				data-ls="offsetxin: 0; offsetxout: 0; delayin: 300; offsetyin: 100; durationin: 2000;"><?php echo trans('frontend.cap_how_it_works_2');?></a>	
			    </div> 	
				<!-- 5th slide -->
			    <div class="ls-slide">
	        		<img src="minisite/img/demoimg/slider5.png" alt="Phone" class="ls-l" style="top: 0px; left: 0;" 
	        			data-ls="offsetxin: 0; offsetxout : 0; offsetyin: 100; rotatein: 0; durationin: 2000" />

        			<p class="ls-l sliderText" style="top: 50px; left: 550px;" 
        				data-ls="offsetxin: 0; offsetxout : 0; offsetyin: 50; durationin: 2000;">
        			<span><?php echo trans('frontend.cap_happyness_3');?></span><br/><?php echo trans('frontend.on_the_move_3');?></p>
					
        			<a href="#" class="dlButton ls-l" style="top: 300px; left: 531px;"><i class="fa fa-apple"></i><span class="dlButtonWrap" style="font-size:15px !important;line-height:18px !important;">Download for<br><span class="dlButtonSmall">Apple iOS</span></span></a>
        			
					
					<a href="#" class="dlButton ls-l" style="top: 300px; left: 745px;" ><i class="fa fa-android"></i><span class="dlButtonWrap" style="font-size:15px !important;line-height:18px !important;">Download for<br><span class="dlButtonSmall">Android</span></span></a>
					
			    </div> 				
	   		</div>
   		</div>
   		<!-- END SLIDER -->
   		<div class="clear"></div>
	</section>
	<!--END TOP CONTAINER-->


	<!--BEGIN CONTENT WRAPPER-->
	<div id="contentWrapper">
	<!--add your own sections in this div-->

		<!--HOW IT WORKS CONTAINER-->
        {{ $content }}
		
		<!--END CONTACT CONTAINER-->


		<!--BEGIN FOOTER WRAPPER-->
		<section id="footerContainer" class="section-160-30 footer">
			<div class="separator80"></div>
			<a href="#"><img src="minisite/img/logo.png" alt="Safe Bag Spa"/></a>
			<div class="separator80"></div>

			<a href="#"><i class="fa fa-twitter"></i></a>
			<a href="#"><i class="fa fa-facebook"></i></a>
			<a href="#"><i class="fa fa-google-plus"></i></a>

			<div class="separator80"></div>
			<p>Copyright &copy; 2014<br/> Safe Bag Spa <a href="#">Credits</a></p>
		</section>
		<!--END FOOTER WRAPPER-->

	</div>
	<!--END CONTENT WRAPPER-->

	<div id="responsiveMenuToggle"><i class="fa fa-bars"></i></div>
	<div id="dropdown-1" class="dropdown dropdown-tip">
    	<div class="dropdown-panel">
        	<ul class="dropdown-menu">
                <!--<li><a href="#"><img style="vertical-align: middle;"src="{{ asset('images/active_404.png') }}" /></a></li>-->
                <li id="facemenu">@include('client.fblogin-inside')</li>
    			<li>@include('client.login')</li>
            </ul>
    	</div>
	</div>
    <div id="dropdown-5" class="dropdown dropdown-tip">
    	<div class="dropdown-panel">
        	<ul class="dropdown-menu">
                <!--<li><a href="#"><img style="vertical-align: middle;"src="{{ asset('images/active_404.png') }}" /></a></li>-->
                <li><a href="{{ URL::to('users/viewprofile') }}"><?php echo trans('frontend.profile');?></a></li>
    			<li><a href="#" onClick="return logout();"><?php echo trans('frontend.logout');?></a></li>
            </ul>
    	</div>
	</div>
   <!--<div id="dropdown-2" class="dropdown dropdown-tip">
    	<div class="dropdown-panel">
    		<ul class="dropdown-menu">
               
                <li><a href="{{ URL::to('client/register') }}"><i class="glyphicon glyphicon-registration-mark"></i> <span><?php // echo trans('frontend.register');?></span></a></li>                
            </ul>
    	</div>
	</div>-->
   <div id="dropdown-3" class="dropdown dropdown-tip">
    	<div class="dropdown-panel">
        @include('home.homemenu-lang')    	
    	</div>
	</div>
    <div id="dropdown-4" class="dropdown dropdown-tip">
    	<div class="dropdown-panel">
        @include('home.homemenu-currency')    	
    	</div>
	</div>
	<!-- jQuery & GreenSock -->
	
    {{ HTML::script('minisite/layerslider/js/greensock.js'); }}
	<!--<script src="layerslider/js/greensock.js" type="text/javascript"></script>-->
	 
	<!-- LayerSlider script files -->
    {{ HTML::script('minisite/layerslider/js/layerslider.transitions.js'); }}
    {{ HTML::script('minisite/layerslider/js/layerslider.kreaturamedia.jquery.js'); }}
	<!--<script src="layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
	<script src="layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>-->

	<!-- Lightbox -->
    {{ HTML::script('minisite/js/lightbox.min.js'); }}
	<!--<script src="js/lightbox.min.js"></script>-->

	<!-- Shuffle.js (screens) -->
    {{ HTML::script('minisite/js/jquery.shuffle.modernizr.js'); }}
	<!--<script src="js/jquery.shuffle.modernizr.js"></script>-->

	<!-- Layer Slider init -->
	<script type="text/javascript">
		function logout(){
			window.location.href ="{{ URL::to('client/logout') }}	";
		}
		function locationpayment(){
			window.location.href ="{{ URL::to('users/dashboard') }}	";
			//window.location.href ="{{ URL::to('client/payment') }}	";
		}
		function locationpayment1(){
			//window.location.href ="{{ URL::to('users/dashboard') }}	";
			window.location.href ="{{ URL::to('client/payment') }}	";
		}
		function register(){
			window.location.href ="{{ URL::to('client/registeruser') }}";
		}
		function dashbord(){
			window.location.href ="{{ URL::to('users/dashboard') }}	";
		}
		function godasbord(){
			window.location.href ="{{ URL::to('users/dashboard') }}	";
		}
	    $(document).ready(function(){
	        $('#layerslider').layerSlider({
	        	thumbnailNavigation: 'disabled',
	        	skinsPath: 'minisite/layerslider/skins/',
	        	navPrevNext: false,
	        	navStartStop: false,
	        	showCircleTimer: false
	        });
			

	    });
		
		$( window ).scroll(function() {
			$( "#followMenu" ).trigger( "click" );
			//alert("ss");
		});


	</script>

	<!-- Theme JS -->
    {{ HTML::script('minisite/js/ruler.js'); }}
    {{ HTML::script('minisite/js/jquery.dropdown.js'); }}
	<!--<script src="js/ruler.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.dropdown.js"></script> -->
</body>
</html> 