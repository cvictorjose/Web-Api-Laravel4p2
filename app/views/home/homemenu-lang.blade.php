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

switch ($lang) {

	case 'it' :
		echo '							<ul class="dropdown-menu" id="newbg">
											<li><a href="?' . build_QSL('en') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/en.png" />&nbsp; English</a></li>
											<li><a href="?' . build_QSL('it') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/it.png" />&nbsp; Italiano</a></li>
										</ul>';
		break;

	case 'en' :
		echo '						<ul class="dropdown-menu" id="newbg">
											<li><a href="?' . build_QSL('it') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/it.png" />&nbsp; Italiano</a></li>
											<li><a href="?' . build_QSL('en') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/en.png" />&nbsp; English</a></li>
									</ul>';

		break;
	
	default :
		echo '						<ul class="dropdown-menu" id="newbg">
											<li><a href="?' . build_QSL('en') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/it.png" />&nbsp; English</a></li>
											<li><a href="?' . build_QSL('it') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/flags/en.png" />&nbsp; Italiano</a></li>
										</ul>';
		break;
}

function build_QSL($lang) {
	parse_str($_SERVER['QUERY_STRING'], $query_string);

	$query_string['lang'] = $lang;
	$rdr_str = http_build_query($query_string);

	return $rdr_str;

}
?>