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
		echo '						<ul class="dropdown-menu" id="newbg">
											<li><a href="?' . build_QS('USD') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a></li>
											<li><a href="?' . build_QS('CHF') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a></li>
											<li><a href="?' . build_QS('BRL') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a></li>
											<li><a href="?' . build_QS('RUB') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a></li>
											<li><a href="?' . build_QS('MXN') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a></li>
											<li><a href="?' . build_QS('GBP') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a></li>
						   		   		</ul>';
		break;

	case 'USD' :
		echo '
							      		<ul class="dropdown-menu" id="newbg">
											<li><a href="?' . build_QS('EUR') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€)</a></li>
											<li><a href="?' . build_QS('CHF') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a></li>
											<li><a href="?' . build_QS('BRL') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a></li>
											<li><a href="?' . build_QS('RUB') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a></li>
											<li><a href="?' . build_QS('MXN') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a></li>
											<li><a href="?' . build_QS('GBP') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a></li>
						   		   		</ul>';

		break;
	case 'CHF' :
		echo '			      		<ul class="dropdown-menu" id="newbg">
											<li><a href="?' . build_QS('EUR') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€)</a></li>
											<li><a href="?' . build_QS('USD') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a></li>
											<li><a href="?' . build_QS('BRL') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a></li>
											<li><a href="?' . build_QS('RUB') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a></li>
											<li><a href="?' . build_QS('MXN') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a></li>
											<li><a href="?' . build_QS('GBP') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a></li>
						   		   		</ul>';

		break;

	case 'BRL' :
		echo '
							      		<ul class="dropdown-menu" id="newbg">
											<li><a href="?' . build_QS('EUR') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€)</a></li>
											<li><a href="?' . build_QS('USD') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a></li>
											<li><a href="?' . build_QS('CHF') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a></li>
											<li><a href="?' . build_QS('RUB') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a></li>
											<li><a href="?' . build_QS('MXN') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a></li>
											<li><a href="?' . build_QS('GBP') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a></li>
						   		   		</ul>';

		break;

	case 'RUB' :
		echo '
							      		<ul class="dropdown-menu" id="newbg">
											<li><a href="?' . build_QS('EUR') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€)</a></li>
											<li><a href="?' . build_QS('USD') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a></li>
											<li><a href="?' . build_QS('CHF') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a></li>
											<li><a href="?' . build_QS('BRL') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a></li>
											<li><a href="?' . build_QS('MXN') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a></li>
											<li><a href="?' . build_QS('GBP') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a></li>
						   		   		</ul>';

		break;

	case 'MXN' :
		echo '
							      		<ul class="dropdown-menu" id="newbg">
											<li><a href="?' . build_QS('EUR') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€)</a></li>
											<li><a href="?' . build_QS('USD') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a></li>
											<li><a href="?' . build_QS('CHF') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a></li>
											<li><a href="?' . build_QS('BRL') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a></li>
											<li><a href="?' . build_QS('RUB') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a></li>
											<li><a href="?' . build_QS('GBP') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a></li>
						   		   		</ul>';

		break;

	case 'GBP' :
		echo '
							      		<ul class="dropdown-menu" id="newbg">
											<li><a href="?' . build_QS('EUR') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/EUR.png" />&nbsp; EUR (€)</a></li>
											<li><a href="?' . build_QS('USD') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a></li>
											<li><a href="?' . build_QS('CHF') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a></li>
											<li><a href="?' . build_QS('BRL') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a></li>
											<li><a href="?' . build_QS('RUB') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a></li>
											<li><a href="?' . build_QS('MXN') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a></li>
						   		   		</ul>';

		break;

	default :
		echo '
							      		<ul class="dropdown-menu" id="newbg">
											<li><a href="?' . build_QS('USD') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/USD.png" />&nbsp; USD ($)</a></li>
											<li><a href="?' . build_QS('CHF') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/CHF.png" />&nbsp; CHF (Fr.)</a></li>
											<li><a href="?' . build_QS('BRL') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/BRL.png" />&nbsp; BRL (R$)</a></li>
											<li><a href="?' . build_QS('RUB') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/RUB.png" />&nbsp; RUB (ք)</a></li>
											<li><a href="?' . build_QS('MXN') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/MXN.png" />&nbsp; MXN ($)</a></li>
											<li><a href="?' . build_QS('GBP') . '"><img style="vertical-align: middle;"src="http://' . $_SERVER['SERVER_NAME'] . '/images/32x/GBP.png" />&nbsp; GBP (£)</a></li>
						   		   		</ul>';
		break;
}

function build_QS($cc) {
	parse_str($_SERVER['QUERY_STRING'], $query_string);

	$query_string['cc'] = $cc;
	$rdr_str = http_build_query($query_string);

	return $rdr_str;

}
?>