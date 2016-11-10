<?php

$ccData = array('EUR', 'CHF', 'USD', 'BRL', 'RUB', 'MXN', 'GBP');

if (Input::get('cc') && in_array(Input::get('cc'), $ccData, true)) {
	$cc = Input::get('cc');
	Session::put('cc', Input::get('cc'));

} elseif (Session::get('cc') && in_array(Session::get('cc'), $ccData, true)) {
	$cc = Session::get('cc');
} elseif (Session::get('cc') && isset($_GET['cc']) && Session::get('cc') == Input::get('cc') && in_array(Input::get('cc'), $ccData, true) && in_array(Session::get('cc'), $ccData, true)) {
	$cc = Session::get('cc');
} else {
	Session::put('cc', 'EUR');
	$cc = Session::get('cc');

}

switch ($cc) {

	case 'EUR' :
		echo '<a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€)</a>						   <div class="mws-dropdown-box">
<div class="mws-dropdown-content"><ul class="mws-notifications">
<li><a href="?' . build_QSUM('USD') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a></li>
<li><a href="?' . build_QSUM('CHF') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a></li>
<li><a href="?' . build_QSUM('BRL') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a></li>
<li><a href="?' . build_QSUM('RUB') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a></li>
<li><a href="?' . build_QSUM('MXN') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a></li>
<li><a href="?' . build_QSUM('GBP') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a></li>
</ul></div>
</div>';
		break;

	case 'USD' :
		echo '<a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a>
<div class="mws-dropdown-box">
<div class="mws-dropdown-content"><ul class="mws-notifications">
<li><a href="?' . build_QSUM('EUR') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€)</a></li>
<li><a href="?' . build_QSUM('CHF') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a></li>
<li><a href="?' . build_QSUM('BRL') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a></li>
<li><a href="?' . build_QSUM('RUB') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a></li>
<li><a href="?' . build_QSUM('MXN') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a></li>
<li><a href="?' . build_QSUM('GBP') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a></li>
</ul></div>
</div>';

		break;
	case 'CHF' :
		echo '<a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a>			      		<div class="mws-dropdown-box">
<div class="mws-dropdown-content"><ul class="mws-notifications">
<li><a href="?' . build_QSUM('EUR') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€)</a></li>
<li><a href="?' . build_QSUM('USD') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a></li>
<li><a href="?' . build_QSUM('BRL') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a></li>
<li><a href="?' . build_QSUM('RUB') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a></li>
<li><a href="?' . build_QSUM('MXN') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a></li>
<li><a href="?' . build_QSUM('GBP') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a></li>
</ul></div>
</div>';

		break;

	case 'BRL' :
		echo '<a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a>
<div class="mws-dropdown-box">
<div class="mws-dropdown-content"><ul class="mws-notifications">
<li><a href="?' . build_QSUM('EUR') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€)</a></li>
<li><a href="?' . build_QSUM('USD') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a></li>
<li><a href="?' . build_QSUM('CHF') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a></li>
<li><a href="?' . build_QSUM('RUB') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a></li>
<li><a href="?' . build_QSUM('MXN') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a></li>
<li><a href="?' . build_QSUM('GBP') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a></li>
</ul></div>
</div>';

		break;

	case 'RUB' :
		echo '<a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a>
<div class="mws-dropdown-box">
<div class="mws-dropdown-content"><ul class="mws-notifications">
<li><a href="?' . build_QSUM('EUR') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€)</a></li>
<li><a href="?' . build_QSUM('USD') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a></li>
<li><a href="?' . build_QSUM('CHF') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a></li>
<li><a href="?' . build_QSUM('BRL') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a></li>
<li><a href="?' . build_QSUM('MXN') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a></li>
<li><a href="?' . build_QSUM('GBP') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a></li>
</ul></div>
</div>';

		break;

	case 'MXN' :
		echo '<a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a>
<div class="mws-dropdown-box">
<div class="mws-dropdown-content"><ul class="mws-notifications">
<li><a href="?' . build_QSUM('EUR') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€)</a></li>
<li><a href="?' . build_QSUM('USD') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a></li>
<li><a href="?' . build_QSUM('CHF') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a></li>
<li><a href="?' . build_QSUM('BRL') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a></li>
<li><a href="?' . build_QSUM('RUB') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a></li>
<li><a href="?' . build_QSUM('GBP') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a></li>
</ul></div>
</div>';

		break;

	case 'GBP' :
		echo '<a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a>
<div class="mws-dropdown-box">
<div class="mws-dropdown-content"><ul class="mws-notifications">
<li><a href="?' . build_QSUM('EUR') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€)</a></li>
<li><a href="?' . build_QSUM('USD') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a></li>
<li><a href="?' . build_QSUM('CHF') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a></li>
<li><a href="?' . build_QSUM('BRL') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a></li>
<li><a href="?' . build_QSUM('RUB') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a></li>
<li><a href="?' . build_QSUM('MXN') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a></li>
</ul></div>
</div>';

		break;

	default :
		echo '<a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€)</a>
<div class="mws-dropdown-box">
<div class="mws-dropdown-content"><ul class="mws-notifications">
<li><a href="?' . build_QSUM('USD') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a></li>
<li><a href="?' . build_QSUM('CHF') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a></li>
<li><a href="?' . build_QSUM('BRL') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a></li>
<li><a href="?' . build_QSUM('RUB') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a></li>
<li><a href="?' . build_QSUM('MXN') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a></li>
<li><a href="?' . build_QSUM('GBP') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a></li>
</ul></div>
</div>';
		break;
}
//if (!function_exists('build_QSUM')) {
function build_QSUM($cc) {
	parse_str($_SERVER['QUERY_STRING'], $query_string);

	$query_string['cc'] = $cc;
	$rdr_str = http_build_query($query_string);

	return $rdr_str;

}

//}
?>