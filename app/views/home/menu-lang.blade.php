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

if(Session::get('lang')=='it'){
			App::setLocale('it');
}elseif(Session::get('lang')=='en'){
			App::setLocale('en');
}else{
			App::setLocale('it');
}
		

switch ($lang) {
					

			
					
					
					
				
	case 'it' :
		echo '							<a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/it.png" />&nbsp; Italiano</a>
										<div class="mws-dropdown-box">
											<div class="mws-dropdown-content">
												<ul class="mws-notifications">
													<li><a href="?' . build_QSLUM('en') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/en.png" />&nbsp; English</a></li>
													<li><a href="?' . build_QSLUM('it') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/it.png" />&nbsp; Italiano</a></li>
												</ul>
											</div>
										</div>';
		break;

	case 'en' :
		echo '						<a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/en.png" />&nbsp; English</a>
										<div class="mws-dropdown-box">
											<div class="mws-dropdown-content">
											<ul class="mws-notifications">
											<li><a href="?' . build_QSLUM('it') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/it.png" />&nbsp; Italiano</a></li>
											<li><a href="?' . build_QSLUM('en') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/en.png" />&nbsp; English</a></li>
									</ul></div>
										</div>';

		break;
	
	default :
		echo '						<a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/it.png" />&nbsp; Italiano</a>
										<div class="mws-dropdown-box">
											<div class="mws-dropdown-content"><ul class="mws-notifications">
											<li><a href="?' . build_QSLUM('en') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/it.png" />&nbsp; English</a></li>
											<li><a href="?' . build_QSLUM('it') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/en.png" />&nbsp; Italiano</a></li>
									</ul></div>
										</div>';
		break;
}

//if (!function_exists('build_QSLUM')) {
	function build_QSLUM($lang) {
		parse_str($_SERVER['QUERY_STRING'], $query_string);
	
		$query_string['lang'] = $lang;
		$rdr_str = http_build_query($query_string);
	
		return $rdr_str;
	
	}
//}
?>