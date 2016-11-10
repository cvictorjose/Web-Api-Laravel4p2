<?php

class Clients extends Eloquent  {

	
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'claims_client';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public $primaryKey ='idclient';
 	public $timestamps = false;
	

	public static $rules_register = array(
						   
						    'email'		=> 'unique:claims_client'
						    
    );
	
	public static $rules_signin = array(
						   
						    'email'		=> 'required|email',
						    'password'	=> 'required'
						    
    );
	
	protected $yesnotest;
	public static $rules = array(
			'create'=>array(
							'name'             			=> 'required', 						// just a normal required validation
							'surname'          			=> 'required', 
							'nationality'      			=> 'required', 
							'city'             			=> 'required', 
							'province'         			=> 'required', 
							'address'         			=> 'required', 
							'zip' 	        			=> 'required', 
							'mobile'         			=> 'required', 	
							'yesno'						=> 'required',
							'email'            			=> 'required|email|unique:claims_client', 	// required and must be unique in the claims_client table
							'email_confirmation'        => 'required|same:email',
							'password'         			=> 'required',
							'password_confirmation'		=> 'required|same:password', // required and has to match the password field
							'dichiaro' 	      			=> 'required',
							'user_reg_via' 	      			=> 'required' 			
						),
			'createship'=>array(
							'name'             			=> 'required', 						// just a normal required validation
							'surname'          			=> 'required', 
							'nationality'      			=> 'required', 
							'city'             			=> 'required', 
							'province'         			=> 'required', 
							'address'         			=> 'required', 
							'zip' 	        			=> 'required', 
							'mobile'         			=> 'required', 	
							'yesno'						=> 'required',
							'email'            			=> 'required|email|unique:claims_client', 	// required and must be unique in the claims_client table
							'email_confirmation'        => 'required|same:email',
							'password'         			=> 'required',
							'password_confirmation'		=> 'required|same:password' ,			// required and has to match the password field
							'sh_address'      			=> 'required', 
							'sh_city'          			=> 'required', 
							'sh_province'     			=> 'required', 
							'sh_country'       			=> 'required', 
							'sh_zip' 	      			=> 'required', 
							'dichiaro' 	      			=> 'required',
							'user_reg_via' 	      			=> 'required'
						),
			'login'=>array(
							'email'            			=> 'required|email',
							'password'         			=> 'required'
						),
			'updateship'=>array(							
							'nationality'      			=> 'required', 
							'city'             			=> 'required', 
							'province'         			=> 'required', 
							'address'         			=> 'required', 
							'zip' 	        			=> 'required', 
							'mobile'         			=> 'required', 							
							'sh_address'      			=> 'required', 
							'sh_city'          			=> 'required', 
							'sh_province'     			=> 'required', 
							'sh_country'       			=> 'required', 
							'sh_zip' 	      			=> 'required'
						),
			'updateshipnew'=>array(							
							'nationality'      			=> 'required', 
							'city'             			=> 'required', 
							'province'         			=> 'required', 
							'address'         			=> 'required', 
							'zip' 	        			=> 'required', 
							'mobile'         			=> 'required'							
						),
			'updateprofileship'=>array(
							'name'             			=> 'required', 						// just a normal required validation
							'surname'          			=> 'required', 
							'nationality'      			=> 'required', 
							'city'             			=> 'required', 
							'province'         			=> 'required', 
							'address'         			=> 'required', 
							'zip' 	        			=> 'required', 
							'mobile'         			=> 'required', 	
							'yesno'						=> 'required',							
							'sh_address'      			=> 'required', 
							'sh_city'          			=> 'required', 
							'sh_province'     			=> 'required', 
							'sh_country'       			=> 'required', 
							'sh_zip' 	      			=> 'required'
						),
			'updateprofile'=>array(
							'name'             			=> 'required', 						// just a normal required validation
							'surname'          			=> 'required', 
							'nationality'      			=> 'required', 
							'city'             			=> 'required', 
							'province'         			=> 'required', 
							'address'         			=> 'required', 
							'zip' 	        			=> 'required', 
							'mobile'         			=> 'required', 	
							'yesno'						=> 'required',														
						),
			'forgotpassword'=>array(
							'email'            			=> 'required|email',														
						),
			'resetpassword'=>array(
							'email'            			=> 'required|email',
							'password'         			=> 'required',
							'password_confirmation'		=> 'required|same:password' ,														
						),
			'changepassword'=>array(
							'old_password'         		=> 'required',
							'password'         			=> 'required|same:old_password',
							'new_password'            	=> 'required',
							'password_confirmation'		=> 'required|same:new_password' ,														
						),
		);
		
		
	
	
	protected $guarded = array('idclient','email','name');
	
	
	public static function getPaypalcurrencies($cc) {
		$currenciesArr = array('EUR' => array('name' => "Italian Euro", 'symbol' => "€", 'ASCII' => "&#128;", 'cc' => 'EUR'), 'AUD' => array('name' => "Australian Dollar", 'symbol' => "A$", 'ASCII' => "A&#36;", 'cc' => 'AUD'), 'BRL' => array('name' => "Brazilian Real", 'symbol' => "R$", 'ASCII' => "", 'cc' => 'BRL'), 'CAD' => array('name' => "Canadian Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'CAD'), 'CZK' => array('name' => "Czech Koruna", 'symbol' => "Kč", 'ASCII' => "", 'cc' => 'CZK'), 'DKK' => array('name' => "Danish Krone", 'symbol' => "Kr", 'ASCII' => "", 'cc' => 'DKK'), 'HKD' => array('name' => "Hong Kong Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'HKD'), 'HUF' => array('name' => "Hungarian Forint", 'symbol' => "Ft", 'ASCII' => "", 'cc' => 'HUF'), 'ILS' => array('name' => "Israeli New Sheqel", 'symbol' => "₪", 'ASCII' => "&#8361;", 'cc' => 'ILS'), 'JPY' => array('name' => "Japanese Yen", 'symbol' => "Â¥", 'ASCII' => "&#165;", 'cc' => 'JPY'), 'MXN' => array('name' => "Mexican Peso", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'MXN'), 'NOK' => array('name' => "Norwegian Krone", 'symbol' => "Kr", 'ASCII' => "", 'cc' => 'NOK'), 'NZD' => array('name' => "New Zealand Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'NZD'), 'PHP' => array('name' => "Philippine Peso", 'symbol' => "₱", 'ASCII' => "", 'cc' => 'PHP'), 'PLN' => array('name' => "Polish Zloty", 'symbol' => "zł", 'ASCII' => "", 'cc' => 'PLN'), 'GBP' => array('name' => "Pound Sterling", 'symbol' => "£", 'ASCII' => "&#163;", 'cc' => 'GBP'), 'RUB' => array('name' => "Russian Ruble", 'symbol' => "ք", 'ASCII' => "&#8381;", 'cc' => 'RUB'), 'SGD' => array('name' => "Singapore Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'SGD'), 'SEK' => array('name' => "Swedish Krona", 'symbol' => "kr", 'ASCII' => "", 'cc' => 'SEK'), 'CHF' => array('name' => "Swiss Franc", 'symbol' => "Fr.", 'ASCII' => "", 'cc' => 'CHF'), 'TWD' => array('name' => "Taiwan New Dollar", 'symbol' => "NT$", 'ASCII' => "NT&#36;", 'cc' => 'TWD'), 'THB' => array('name' => "Thai Baht", 'symbol' => "฿", 'ASCII' => "&#3647;", 'cc' => 'THB'), 'USD' => array('name' => "U.S. Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'USD'));

		return $currenciesArr[$cc];

	}

	public static function getColor(){
		$colors = array('1' => 'Blue', '2' => 'Orange', '3' => 'Red', '4' => 'Green');
		//$colors = array('1' => 'Red', /*'2' => 'Dark Blue',*/ '3' => 'Light Blue', '4' => 'Yellow', /* '5' => 'Violet', '6' => 'Pink',*/ '7' => 'Dark Green'/*,  '8' => 'Black'*/);
		//$colors = array('1' => 'Blue', '2' => 'Orange', '3' => 'Red', '4' => 'Green');
		return $colors;
	}
	
	public static function getBrowser(){
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
	
		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
	   
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}
		elseif(preg_match('/Firefox/i',$u_agent))
		{
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		}
		elseif(preg_match('/Chrome/i',$u_agent))
		{
			$bname = 'Google Chrome';
			$ub = "Chrome";
		}
		elseif(preg_match('/Safari/i',$u_agent))
		{
			$bname = 'Apple Safari';
			$ub = "Safari";
		}
		elseif(preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Opera';
			$ub = "Opera";
		}
		elseif(preg_match('/Netscape/i',$u_agent))
		{
			$bname = 'Netscape';
			$ub = "Netscape";
		}
	   
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}
	   
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
	   
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
	   
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	} 

}
