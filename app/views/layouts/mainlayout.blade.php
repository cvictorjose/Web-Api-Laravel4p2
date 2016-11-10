<!DOCTYPE html>
<html>
<head>
	<title>Safe Bag - Smart Track</title>
	
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
    <script src="http://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
    

</head>

<body>

	<!--responsive menu placeholder-->
	<div id="followMenu"><div class="clear"></div></div>

	<!--BEGIN TOP CONTAINER (slider&nav)-->
	<section id="topContainer">
		<div id="navigationWrapmini">
			<div class="row">
				<div class="three-col"><img src="{{ asset('minisite/img/logo.png') }}" alt="Safe Bag Spa"/></div>
		
			
				<div class="six-col menuWrap"><!--last-col--> 
					<ul class="mainMenu" style="float:left;">
						<li><a href="#" class="backtohome" onClick="backtohome();">< Back to home</a></li>
						
					</ul>
					
				</div>
				</div>
				<div class="clear"></div>

	   		</div>
   		</div>

   		
   		<div class="clear"></div>
	</section>
	<!--END TOP CONTAINER-->


	<!--BEGIN CONTENT WRAPPER-->
	<div id="contentWrapper">
    
    <!--END CONTACT CONTAINER-->
    	<section id="getappContainer" class="section-80-130 whiteBgSection">
			{{ $content }}			
		</section>


		<!--BEGIN FOOTER WRAPPER-->
		<section id="footerContainer" class="section-160-30 footer">
			<div class="separator80"></div>
			<a href="#"><img src="{{ asset('minisite/img/logo.png') }}" alt="Safe Bag Spa"/></a>
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
    	You can put whatever HTML you want in a panel!
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
	    $(document).ready(function(){
	        $('#layerslider').layerSlider({
	        	thumbnailNavigation: 'disabled',
	        	skinsPath: 'layerslider/skins/',
	        	navPrevNext: false,
	        	navStartStop: false,
	        	showCircleTimer: false
	        });
			
				

	    });			
		
		function backtohome(){
			location.href="{{ URL::to('users/dashboard') }}";
		}


	</script>

<!--Function to show-hide different address fields -->

	<script type="text/javascript">

function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';

}

</script>

	<!-- Theme JS -->
    {{ HTML::script('minisite/js/ruler.js'); }}
    {{ HTML::script('minisite/js/jquery.dropdown.js'); }}
	<!--<script src="js/ruler.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.dropdown.js"></script> -->
</body>
</html> 