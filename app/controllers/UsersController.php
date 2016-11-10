<?php

/**
*  
*/
class UsersController extends BaseController
{
	
	//protected $layout = "layouts.main";
	protected $layout = "layouts.user-main";

	public $colors = array('1' => 'Red', '2' => 'Dark Blue', '3' => 'Light Blue', '4' => 'Yellow',  '5' => 'Violet', '6' => 'Pink', '7' => 'Dark Green',  '8' => 'Black');
	

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$currentaction	= substr(Route::currentRouteAction(), (strpos(Route::currentRouteAction(), '@') + 1) );
		
		if($currentaction != 'getLogin' && $currentaction != 'postSignin'){		
			//echo $currentaction;	
			if (Session::get('idclient') !='' && Session::get('email')!='' ){
				
			}		
			else{
				//echo $currentaction;	
				$this->beforeFilter(function(){
				
				return Redirect::to('/');
				
				});
				
			}	
		}
		
		$langData = array('it', 'en');
		
		if (Input::get('lang') && in_array(Input::get('lang'), $langData, true)) {
			$lang = Input::get('lang');
			Session::put('lang', Input::get('lang'));
		
		} elseif (Session::get('lang') && in_array(Session::get('lang'), $langData, true)) {
			$lang = Session::get('lang');
		} elseif (Session::get('lang') && isset($_GET['lang']) && Session::get('lang') == Input::get('lang') && in_array(Input::get('lang'), $langData, true) && in_array(Session::get('lang'), $langData, true)) {
			$lang = Session::get('lang');
		} else {
			Session::put('lang', 'en');
			$lang = Session::get('lang');
		
		}
		App::setLocale($lang);
		
	}
	//profile check for claims management
	public function postAjaxcheckprofile(){
		$userdetail	=	Clients::find(Session::get('idclient'));
		if($userdetail['mobile'] != ''){
			return Response::json(array(
				  'success' => true	,
				  'phone'=>	$userdetail['mobile'],	
				  'phone1'=>	$userdetail->mobile
				));
		}
		else{
			return Response::json(array(
				  'fail' => true,
				  'phone'=>	$userdetail['mobile'],	
				  'phone1'=>	$userdetail->mobile	  
				));
		}
		
	}
	
	//paypal currencies of app
	public function getPaypalcurrencies($cc) {
		$currenciesArr = array('EUR' => array('name' => "Italian Euro", 'symbol' => "€", 'ASCII' => "&#128;", 'cc' => 'EUR'), 'AUD' => array('name' => "Australian Dollar", 'symbol' => "A$", 'ASCII' => "A&#36;", 'cc' => 'AUD'), 'BRL' => array('name' => "Brazilian Real", 'symbol' => "R$", 'ASCII' => "", 'cc' => 'BRL'), 'CAD' => array('name' => "Canadian Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'CAD'), 'CZK' => array('name' => "Czech Koruna", 'symbol' => "Kč", 'ASCII' => "", 'cc' => 'CZK'), 'DKK' => array('name' => "Danish Krone", 'symbol' => "Kr", 'ASCII' => "", 'cc' => 'DKK'), 'HKD' => array('name' => "Hong Kong Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'HKD'), 'HUF' => array('name' => "Hungarian Forint", 'symbol' => "Ft", 'ASCII' => "", 'cc' => 'HUF'), 'ILS' => array('name' => "Israeli New Sheqel", 'symbol' => "₪", 'ASCII' => "&#8361;", 'cc' => 'ILS'), 'JPY' => array('name' => "Japanese Yen", 'symbol' => "Â¥", 'ASCII' => "&#165;", 'cc' => 'JPY'), 'MXN' => array('name' => "Mexican Peso", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'MXN'), 'NOK' => array('name' => "Norwegian Krone", 'symbol' => "Kr", 'ASCII' => "", 'cc' => 'NOK'), 'NZD' => array('name' => "New Zealand Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'NZD'), 'PHP' => array('name' => "Philippine Peso", 'symbol' => "₱", 'ASCII' => "", 'cc' => 'PHP'), 'PLN' => array('name' => "Polish Zloty", 'symbol' => "zł", 'ASCII' => "", 'cc' => 'PLN'), 'GBP' => array('name' => "Pound Sterling", 'symbol' => "£", 'ASCII' => "&#163;", 'cc' => 'GBP'), 'RUB' => array('name' => "Russian Ruble", 'symbol' => "ք", 'ASCII' => "&#8381;", 'cc' => 'RUB'), 'SGD' => array('name' => "Singapore Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'SGD'), 'SEK' => array('name' => "Swedish Krona", 'symbol' => "kr", 'ASCII' => "", 'cc' => 'SEK'), 'CHF' => array('name' => "Swiss Franc", 'symbol' => "Fr.", 'ASCII' => "", 'cc' => 'CHF'), 'TWD' => array('name' => "Taiwan New Dollar", 'symbol' => "NT$", 'ASCII' => "NT&#36;", 'cc' => 'TWD'), 'THB' => array('name' => "Thai Baht", 'symbol' => "฿", 'ASCII' => "&#3647;", 'cc' => 'THB'), 'USD' => array('name' => "U.S. Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'USD'));

		return $currenciesArr[$cc];

	}
	
	// addactivatesmarttracking
	public function postAddactivatesmarttracking(){
		$input	=	Input::all();
		$object = Bags::where('bag_id','=',Input::get('bag_id')) -> first();
		$card   = Cards::where('card_id','=',Input::get('card_id')) -> first();
		$validator = Validator::make(Input::all(), Claimsbag::$rules['actvatesmarttrack']);
		if(!empty($object) && !empty($card)){
			if($card->flightnumbers > 0){
				$bag = new  Claimsbag;
				$bag->idclient 			  = Session::get('idclient');
				$bag->depdate  			  = strtotime(Input::get('depdate'));
				$bag->arrdate  			  = strtotime(Input::get('depdate'));
				$bag->depport  			  = Input::get('depport');
				$bag->arrport  			  = Input::get('arrport');
				$bag->data_registrazione  = strtotime(date('Y-m-d'));
				$bag->date_expiration	  = strtotime("+25 days", strtotime(Input::get('depdate')));
				$bag->airline  			  = Input::get('airline');
				$bag->scalo1  			  = Input::get('scalo1');
				$bag->scalo2  			  = Input::get('scalo2');
				$bag->scalo3  			  = Input::get('scalo3');
				
				if(!empty($card)){
					$bag->smartcardcode  	  = $card->card_number;
				}
				
				if (!empty($object)) {
					
					$bag->bagname  			  = $object->name;
					$bag->bagcolor  		  = $object->color;
					$bag->bagbrand  		  = $object->brand;
					$bag->bagdescription  	  = $object->description;
					$bag->bagpicture1  		  = $object->picture1;
					$bag->bagpicture2  		  = $object->picture2;
					$bag->bagpicture3  		  = $object->picture3;
					
				}
				
				$bag->save();
				if($bag->idbag != ''){
					$order = new Transactions;
					$order -> paytype 		 = 'cardcredit';
					$order -> idbag 		 = $bag->idbag;
					//$order -> transaction_id = Input::get('transaction_id');
					//$order -> price			 = Input::get('price');
					//$order -> currency		 = Input::get('currency');
					//$order -> payment_date   = strtotime(date('Y-m-d h:i:s'));
					$order -> rechargecard_id= Input::get('card_id');
					$order -> idclient		 = Session::get('idclient');
					$order -> payment_date   = strtotime(date('Y-m-d h:i:s'));
					$getBrowser	=	Clients::getBrowser();
					$order -> device		 = $getBrowser['name'].' '.$getBrowser['version'];	
					
					//if(isset($order -> rechargecard_id) && $order->order_id != '')
					if(isset($order -> rechargecard_id)){
						$card = Cards::find($order -> rechargecard_id);
						if($card -> flightnumbers != 0){
							
							$card -> flightnumbers	=  $card -> flightnumbers - '1';
							
							$order -> numflights 	=  $card -> flightnumbers;
						}else{
							$card -> flightnumbers	=  '0';
							$order -> numflights 	=  $card -> flightnumbers;
						}
						
						$card -> save();
					}
					
					$order -> save();
				}
				$bagdetails 	= Claimsbag::find($bag->idbag);
				$client	=	Clients::find(Session::get('idclient'));
				$name	=	$client->name;
				$tomail	=	$client->email;
				//$tomail	=	'arul258013@gmail.com';
				
				Session::put('updatebagsemail', $tomail);
				Mail::send('client.smart_card_activation', array('name'=>$name, 'bagdetails'=>$bagdetails, 'bagobject' => $object), function($message){
						//$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject('[Smart-track.com] Smart Track Activation');
						$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject(trans('emailtemplet.sub_smart_card_activation'));
				});
				Session::forget('updatebagsemail');
				$successData = array('status' => 1, 'referer' => 'pay', 'msg' => 'Payment with card credit successful');
				//return Response::json($successData, 200);
				return Response::json(array('status' => 1, 'referer' => 'pay', 'msg' => 'Payment with card credit successful'));
			}
			else{
				
				$idclient = Session::get('idclient');
				$depport  = Input::get('depport');
				$arrport  = Input::get('arrport');
				$scalo1   = Input::get('scalo1');
				$scalo2   = Input::get('scalo2');
				$scalo3   = Input::get('scalo3');
					
				if(isset($idclient) && is_numeric($idclient)){
					$user 	  		=  Clients::where('idclient', '=' , $idclient) -> first();
					$currency_code  =  Session::get('cc');
					$ccdetails      =  $this->getPaypalcurrencies(Session::get('cc'));
					$symbol         =  $ccdetails['symbol'];
				}
				
				if($scalo1 == '' && $scalo2 == '' && $scalo3 == ''){
					$iata = array($depport,$arrport);
				}elseif($scalo1 != '' && $scalo2 == '' && $scalo3 == ''){
					$iata = array($depport,$arrport,$scalo1);
				}elseif($scalo1 != '' && $scalo2 != '' && $scalo3 == ''){
					$iata = array($depport,$arrport,$scalo1,$scalo2);
				}elseif($scalo1 != '' && $scalo2 != '' && $scalo3 != ''){
					$iata = array($depport,$arrport,$scalo1,$scalo2,$scalo3);
				}
				
				foreach($iata as $key=>$value){
					$prices[] = DB::table('airports_all')
									->join('sfb_airportsrank', 'airports_all.smart_rank', '=', 'sfb_airportsrank.rank')
									->where('airports_all.iata','=', $iata[$key])
									->select('sfb_airportsrank.price', 'sfb_airportsrank.currency', 'airports_all.iata')
									->first();
				}
				
				$rankarray	=	Passthroughpercentage::lists('percentage', 'no_passthrough');
				//$rankarray	=	array();
				
				$max = 0;
				foreach($prices as $obj)
				{
					if($obj->price > $max)
					{
						$max = $obj->price;
						
						//exchange rates get for users
						$rates_ac_to_products    = Exchange::where('currency_code','=',$obj->currency)->first();
						
						switch($currency_code){
							case 'EUR' : $exrate = $rates_ac_to_products->exrate_EUR; break;
							case 'USD' : $exrate = $rates_ac_to_products->exrate_USD; break;
							case 'CHF' : $exrate = $rates_ac_to_products->exrate_CHF; break;
							case 'BRL' : $exrate = $rates_ac_to_products->exrate_BRL; break;
							case 'RUB' : $exrate = $rates_ac_to_products->exrate_RUB; break;
							case 'MXN' : $exrate = $rates_ac_to_products->exrate_MXN; break;
							case 'GBP' : $exrate = $rates_ac_to_products->exrate_GBP; break;
						}
						
						if($currency_code == $obj->currency){
							$price   = (float)$obj->price * (float)$exrate;
						}else{
							$price   = (float)$obj->price * (float)$exrate * floatval('1.10');
						}
						if(count($prices) == 5 ){
							if(isset($rankarray[3]))
								$addtional_price = $price * $rankarray[3];					
							else
								$addtional_price = $price * 0.9;
						}elseif(count($prices) == 4){
							if(isset($rankarray[2]))
								$addtional_price = $price * $rankarray[2];					
							else
								$addtional_price = $price * 0.7;
						}elseif(count($prices) == 3){
							if(isset($rankarray[1]))
								$addtional_price = $price * $rankarray[1];					
							else
								$addtional_price = $price * 0.5;
						}else{
							$addtional_price = '';
						}
						
						
						$totalPrice = floatval($price) + floatval($addtional_price);
						
						//exchange rates get for storing purpose
						$rates_ac_to_products_1    = Exchange::where('currency_code','=',$obj->currency)->first();
						
						switch('EUR'){
							case 'EUR' : $exrate_1 = $rates_ac_to_products_1->exrate_EUR; break;
							case 'USD' : $exrate_1 = $rates_ac_to_products_1->exrate_USD; break;
							case 'CHF' : $exrate_1 = $rates_ac_to_products_1->exrate_CHF; break;
							case 'BRL' : $exrate_1 = $rates_ac_to_products_1->exrate_BRL; break;
							case 'RUB' : $exrate_1 = $rates_ac_to_products_1->exrate_RUB; break;
							case 'MXN' : $exrate_1 = $rates_ac_to_products_1->exrate_MXN; break;
							case 'GBP' : $exrate_1 = $rates_ac_to_products_1->exrate_GBP; break;
						}
						
						$actual_price   = (float)$obj->price * (float)$exrate_1;
						
						
						if(count($prices) == 5 ){
		
							if(isset($rankarray[3]))
								$addtional_price_1 = $actual_price * $rankarray[3];					
							else
								$addtional_price_1 = $actual_price * 0.9;
						}elseif(count($prices) == 4){
							if(isset($rankarray[2]))
								$addtional_price_1 = $actual_price * $rankarray[2];					
							else
								$addtional_price_1 = $actual_price * 0.7;
						}elseif(count($prices) == 3){
							if(isset($rankarray[1]))
								$addtional_price_1 = $actual_price * $rankarray[1];					
							else
								$addtional_price_1 = $actual_price * 0.5;
						}else{
							$addtional_price_1 = '';
						}
						$totalPrice_1 = floatval($actual_price) + floatval($addtional_price_1);
						
						//$cc  = $this->getPaypalcurrencies($obj->currency);
						$finalPrice = array(
											'actual_price'     => number_format(round($totalPrice_1, 1), 2), 
											'actual_currency'  => 'EUR', 
											'price' 		   => number_format(round($totalPrice, 1), 2), 
											'currency'         => $currency_code,
											'symbol'           => $symbol
											);
											
					}
				}
				
				if ( !empty($finalPrice)){
					
					$successData = array('status' => 2, 'successstatus' => 1, 'referer' => 'prices', 'msg' => 'Prices view', 'prices' => $finalPrice);
					return Response::json($successData, 200);
				}else{
					$errorData = array('status' => 2, 'successstatus' => 0, 'referer' => 'prices', 'msg' => 'No prices available!');
					return Response::json($errorData, 200);
				}
				//return Response::json(array('status' => 2, 'referer' => 'pay', 'msg' => 'Payment with card credit successful'));
			}
		}
		else{
			$errorData = array('status' => 0, 'referer' => 'pay', 'msg' => 'Paytype not matching!');
			return Response::json($errorData, 200);
		}
	}
	
	public function postAddactivatesmarttrackingpayment(){
		$input	=	Input::all();
		$object = Bags::where('bag_id','=',Input::get('bag_id')) -> first();
		$card   = Cards::where('card_id','=',Input::get('card_id')) -> first();
		$validator = Validator::make(Input::all(), Claimsbag::$rules['actvatesmarttrack']);
		if(!empty($object) && !empty($card)){
			return Response::json(array('status' => 1, 'referer' => 'pay', 'msg' => 'Payment with card credit successful'));			
		}
		else{
			$errorData = array('status' => 0, 'referer' => 'pay', 'msg' => 'Paytype not matching!');
			return Response::json($errorData, 200);
		}
	}
	
	//displayflightsummary
	public function postDisplayflightsummary(){
		$input	=	Input::all();
		//$input['arrdate']=$input['depdate'];
		$validator = Validator::make(Input::all(), Claimsbag::$rules['validateflights']);
		if($validator->fails()){
			$value	= json_encode(array(
				'fail' => true,
				'errors' => $validator->getMessageBag()->toArray()
			));
			return $value;
		}
		else		
			return View::make('users._displayflightsummary',array('input'=>$input));
	}
	
	// Activate Smart tracking
	public function getActivatesmarttrack(){
		$cards  = Cards::whereRaw('idclient = ? AND  cardstatus = 1', array(Session::get('idclient')))->orderBy('card_id', 'DESC') -> get();
		$bags			= Bags::whereRaw('idclient = ?', array(Session::get('idclient')))-> get();
		$airports		=	Airports::orderBy('city')->lists('city','depport');
		$airportsall	=	Airportsall::orderBy('city')->lists('city','iata');
		$airlines		=	Airlines::orderBy('name_airline')->lists('name_airline','idairline');
		$brandlist	=	Bags::getbrandlist();
		$colorlist	=	Bags::getcolorlist();
		$packages	=	Packages::all();
		$this->layout->content = View::make('users.activatesmarttrack',array('cards'=>$cards, 'bags'=>$bags, 'airportsall'=>$airportsall, 'airports'=>$airports, 'airlines'=>$airlines, 'brandlist'=>$brandlist, 'colorlist'=>$colorlist, 'packages'=>$packages));
	}
	// profile page
	public function getProfile(){
		$userdetail	=	Clients::find(Session::get('idclient'));
		$countryList	=	Country::lists('country_name', 'country_code');
		$this->layout->content = View::make('users.profile', array('userdetail'=>$userdetail, 'countryList'=>$countryList));
	}
	
	// profile page
	public function getViewprofile(){
		$userdetail	=	Clients::find(Session::get('idclient'));
		$countryList	=	Country::lists('country_name', 'country_code');
		$countryList['']=	'-Select-';
		ksort($countryList);
		$this->layout->content = View::make('users.viewprofile', array('userdetail'=>$userdetail, 'countryList'=>$countryList));
	}
	
	public function postUpdateprofile(){
		$yesno		=	Input::get('yesno');
		$friendly_names = array(
			'name' => trans('frontend.name'),
			'surname' => trans('frontend.surname'),
			'nationality' => trans('frontend.nationality'),
			'city' => trans('frontend.city'),
			'province' => trans('frontend.province'),
			'address' => trans('frontend.address'),
			'zip' => trans('frontend.zip'),
			'mobile' => trans('frontend.mobile'),
			'email' => trans('frontend.email'),
			'email_confirmation' => trans('frontend.email_confirmation'),	
			'password' => trans('frontend.password'),
			'password_confirmation' => trans('frontend.password_confirmation'),
			'sh_address' => trans('frontend.sh_address'),
			'sh_city' => trans('frontend.sh_city'),
			'sh_province' => trans('frontend.sh_province'),
			'sh_country' => trans('frontend.sh_country'),
			'sh_zip' => trans('frontend.sh_zip')
		);
		if($yesno	==	'yesCheck'){
			$input	=	Input::all();
			if($input['sh_address'] != '' || $input['sh_city'] != '' || $input['sh_province'] != '' || $input['sh_zip'] != '' || $input['sh_country'] != ''){
				$validator = Validator::make(Input::all(), Clients::$rules['updateprofileship']);
			}
			else
				$validator = Validator::make(Input::all(), Clients::$rules['updateprofile']);
		}
		else{
			$validator = Validator::make(Input::all(), Clients::$rules['updateprofile']);
		}
		
		
		$validator->setAttributeNames($friendly_names);
		$idclient	=	Session::get('idclient');
		
		if($validator->fails())
			return Response::json(array(
				'fail' => true,
				'errors' => $validator->getMessageBag()->toArray()
			));
		else {
			$user = Clients::find($idclient);
			$user->name = Input::get('name');
			$user->surname = Input::get('surname');
			$user->phone = Input::get('phone');
			$user->mobile = Input::get('mobile');
			$user->address = Input::get('address');
			$user->city = Input::get('city');
			$user->province = Input::get('province');
			$user->nationality = Input::get('nationality');
			$user->zip = Input::get('zip');
			$user->usr_is_confirmed = 1;
			if($yesno	==	'yesCheck'){
				$user->sh_address = Input::get('sh_address');
				$user->sh_city = Input::get('sh_city');
				$user->sh_province = Input::get('sh_province');
				$user->sh_country = Input::get('sh_country');
				$user->sh_zip = Input::get('sh_zip');
			}
			else{
				$user->sh_address = $user->address;
				$user->sh_city = $user->city;
				$user->sh_province = $user->province;
				$user->sh_country = $user->nationality;
				$user->sh_zip = $user->zip;
			}	
			$user->save();
			
			
		//save to DB user details
		  if($user->save()) {  
		  	$shipaddress	=	ShipingAddress::find(Session::get('idclient'));
			if(empty($shipaddress)){
				$shipaddress	=	new ShipingAddress;
			}
			//if($yesno	==	'yesCheck')
			{
				$shipaddress->idclient	=	$user->idclient;
				$shipaddress->sh_address = $user->sh_address;
				$shipaddress->sh_city = $user->sh_city;
				$shipaddress->sh_province = $user->sh_province;
				$shipaddress->sh_country = $user->sh_country;
				$shipaddress->sh_zip = $user->sh_zip;
				$shipaddress->save();
				
			}
			/*Mail::send('users.mails.welcome', array('name'=>Input::get('name')), function($message){
					$message->to(Input::get('email'), Input::get('name'))->bcc('safebag.customercare@gmail.com')->subject('Register successful!');
			});*/
		  	//Auth::loginUsingId($user->idclient);
			  //return success  message
			  $userdetail	=	$user;
			$output	= '<h3>'.trans('frontend.invoice_and_shipping').'</h3><br><br>';
			
			  Session::flash('success',1);
			  Session::flash('message',trans('frontend.updatesuccess'));
			    
			$client	=	$user;
			$name	=	$client->name;
			$tomail	=	$client->email;
			//$tomail	=	'arul258013@gmail.com';
			
			Session::put('updatebagsemail', $tomail);			
			Mail::send('client.mail_profile_update', array('name'=>$name), function($message){
					$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject(trans('emailtemplet.sub_profile_update'));
			});
			Session::forget('updatebagsemail');
			
			  //return Redirect::to('client/payment');
				return Response::json(array(
				  'success' => true,
				  'email' => $user->email,
				  'output' => $output,
				  'idclient'    =>  $user->idclient
				));
		  }
		}
	}
	
	// buy a card
	public function getPayment(){		
		$userdetail	=	Clients::find(Session::get('idclient'));
		$testinguserdetail	=	$userdetail->toArray();
		$testinguserdetail['yesno']	=	'yesCheck';
		
		$validator = Validator::make($testinguserdetail, Clients::$rules['updateship']);
		
		if($validator->fails()){
			return Redirect::to('users/profile')->with(array('message' => trans('frontend.update').' '.trans('frontend.your_delivery_address'),'success'=>0));	
		}
		$qtyList	=	array(
						//''=>'-Select-',							
							'1'=>1,
							'2'=>2,
							'3'=>3,
							'4'=>4,
							'5'=>5,
							'6'=>6,
							'7'=>7,
							'8'=>8,
							'9'=>9,
							'10'=>10,
							);
		
		
		$userdetail	=	Clients::find(Session::get('idclient'));
		$countryList	=	Country::lists('country_name', 'country_code');
		$this->layout->content = View::make('users.payment', array('qtyList' => $qtyList, 'userdetail'=>$userdetail, 'countryList'=>$countryList));
	}

	public function missingMethod($parameters = array())
	{
    	return Response::view('404', array(), 404);
	}
	
	public function getLogin() {
		if (Session::get('idclient') !='' && Session::get('email')!='' )
		{
    		return Redirect::to('users/dashboard');
		}else{
			$this->layout->content = View::make('users.login');
		}
		
	}

	public function postSignin() {
		
		$validator = Validator::make(Input::all(), Clients::$rules_signin);
		if ($validator -> passes()) {
			$client = Clients::whereRaw('email = ? and password = ? and usr_is_confirmed = 1', array(strtolower(Input::get('email')), sha1(Input::get('password')))) -> first();
			
			if(!empty($client)) {
				
				$affectedRows = Clients::where('idclient', '=', $client -> idclient) -> update(array('usr_nmb_logins' => $client -> usr_nmb_logins + 1, 'lastlogin' => time()));
				
				if ($affectedRows > 0) {
					$userdata = array('idclient' => $client -> idclient, 'name' => $client -> name, 'surname' => $client -> surname, 'country' => $this -> getCountry($client -> nationality), 'currency' => $client -> currency, 'access_token' => $client -> access_token, 'city' => $client -> city, 'province' => $client -> province, 'address' => $client -> address, 'zip' => $client -> zip, 'email' => $client -> email, 'phone' => $client -> phone, 'fax' => $client -> fax, 'mobile' => $client -> mobile);
					Session::put($userdata);
					/*$successData = array('status' => 1, 'referer' => 'login', 'msg' => 'Login Successful!', 'data' => $data);
					return Response::json($successData, 200);*/
					return Redirect::to('users/dashboard')->with(array('message'=>'You are now logged in!','success'=>1));
				} else {
					/*$errorData1 = array('status' => 0, 'referer' => 'login', 'msg' => 'Email or Password does not match our database!');
					return Response::json($errorData1, 200);*/
					return Redirect::to('/')
					->with(array('message'=>'Your username/password combination was incorrect','success'=>0))
					->withInput();
				}
			} else {
				return Redirect::to('/')
					->with(array('message'=>'Your username/password combination was incorrect','success'=>0))
					->withInput();
			}
		}else{
			return Redirect::to('/')
				        ->withInput()
				        ->withErrors($validator);	
		}
		
	}

	public function getDashboard() {
		
		if (Session::get('idclient') !='' && Session::get('email')!='' )
		{
			return Redirect::to('users/listflights'); 
			
			$orders = MinisiteTransactions::where('idclient','=',Session::get('idclient'))->orderBy('order_id', 'DESC') -> get();
			$cards  = Cards::whereRaw('idclient = ? AND  cardstatus = 1', array(Session::get('idclient')))->orderBy('card_id', 'DESC') -> get();
			$bags  	   = Bags::where('idclient','=',Session::get('idclient'))->orderBy('bag_id', 'DESC') -> get();
			//$flights   = Claimsbag::where('idclient','=',Session::get('idclient'))->where('safebagcode','=','')->orderBy('idbag', 'DESC') -> get();
			$flights   = Claimsbag::whereRaw('idclient = ? AND (safebagcode = "" or safebagcode IS NULL)', array(Session::get('idclient')))->orderBy('idbag', 'DESC') -> get();
			$claims   = Claimsbag::whereRaw('idclient = ? AND  idclaim > 0 and (safebagcode = "" or safebagcode IS NULL)', array(Session::get('idclient')))->orderBy('idbag', 'DESC') -> get();
			//$claims    = Claimsbag::where('idclient','=',Session::get('idclient'))->where('idclaim','>','0')->where('safebagcode','=','')->orderBy('idbag', 'DESC') -> get();
			
			$qtyList	=	array(
						//''=>'-Select-',							
							'1'=>1,
							'2'=>2,
							'3'=>3,
							'4'=>4,
							'5'=>5,
							'6'=>6,
							'7'=>7,
							'8'=>8,
							'9'=>9,
							'10'=>10,
							);
			
			$airportslist	=	Airportsall::lists('city','iata');
			
			$this -> layout -> content = View::make('users.dashboard', array('orders' => $orders,'cards'=>$cards,'bags'=>$bags, 'flights'=>$flights,'claims'=>$claims, 'qtyList'=>$qtyList, 'airportslist'=>$airportslist));
			
		}else{
			return Redirect::to('/');
		}
		
	}
	
	// change password
	public function postChangepassword(){
		$friendly_names = array(			
			'new_password' => trans('frontend.new_password'),	
			'password' => trans('frontend.password'),
			'password_confirmation' => trans('frontend.password_confirmation'),		
		);
		
		$input	=	Input::all();
		
		$client	= Clients::find(Session::get('idclient')) ;	
		/*if(!empty($client)){
			return Response::json(array(
					'redirect' => true
				));		
		}*/
		$input['old_password']	=	$client->password;
		$password	=	Input::get('password');
		$input['password']	=	sha1($password);
		$validator = Validator::make($input, Clients::$rules['changepassword']);
		$validator->setAttributeNames($friendly_names);
		if($validator->fails()){
			
			return Response::json(array(
				'fail' => true,
				'new-passord'=>$input['password'],
				'old-passord'=>$client->password,
				'errors' => $validator->getMessageBag()->toArray()
			));
		}
		else {
			$client->password = sha1(Input::get('new_password'));	
			if($client->save()){
				
				
				Session::flash('success',1);
				Session::flash('message',trans('frontend.changepasswordsuccess'));  
					
					
				//return Redirect::to('client/payment');
				return Response::json(array(
				  'success' => true,
				  'email' => $client->email,
				  'idclient'    =>  $client->idclient
				));
			}
			
		}
	}
	
	//user 1 controller
	public function postUpdateairlinetag()
	{
		$inputs	=	Input::all();
		
		$validator = Validator::make(
			//array('idbag' => 'required'),
			array('file' => $inputs['tag_image']),
			array('file' => 'required|mimes:jpeg,png,jpg,gif,ico|max:1000')
		);
		
		//$affectedRows = Claimsbag::where('idbag', '=', Input::get('idbag')) -> update(array('airlinetag' => Input::get('airlinetag')));
		
		if($validator->fails()) {
			return Response::json(array(
				'fail' => true,
				'errors' => $validator->getMessageBag()->toArray()
			));
			
		} else {
			$filename_pic1	=	'';
			$claims 			= Claimsbag::find(Input::get('idbag'));
			if (Input::hasFile('tag_image')){
				//$destinationPath = 'uploads/airlinetag';
				$destinationPath = Claimsbag::getSavepath().'/airlinetag';
				$ext_pic1 	= Input::file('tag_image')->getClientOriginalExtension();
				$size_pic1 	= Input::file('tag_image')->getSize();						
				$filename_pic1  = str_random(12).'.'.$ext_pic1;
				$folderImage    = $claims->idclient.'-'.$filename_pic1;		
				$upload_pic1    = Input::file('tag_image')->move($destinationPath, $folderImage);
			}
			
			$claims->tag_image = $filename_pic1;
			$claims->save();
			Session::flash('success',1);
			Session::flash('message',trans('userlistflights.airline_tag_image_success'));  
			return Response::json(array(
			  'success' => true,
			  'path'=>$destinationPath,
			  
			));
		}
	}
	
	// deletedocument
	public function postDeletedocument(){
		$inputs	=	Input::all();
		$file_pir	=	$inputs['file_pir'];
		if(unlink($file_pir))
		{
			$claimcode	=	$inputs['docclaimcode'];
			$claims		=	Claims::whereRaw('claimcode =?', array($claimcode))->first();
			$sigdate_out=$claims->sigdate;			
			$anno_claim = date ( "Y", $sigdate_out );
			$mese_claim = date ( "m", $sigdate_out );
			
			$folder_claim = "../../safe-bag/cmsafebag/gestionale-sinistri/sinistro/modules/" . $anno_claim . "/" . $mese_claim . "/" . $claimcode . "/docs/";
			
			$filename	=	str_replace($folder_claim,"",$file_pir);
			
			$filenamearray	=	explode('_',$filename);
			unset($filenamearray[0]);
			$filenamedummy	=	implode('',$filenamearray);
			
			$filenamedummy1	=	$filenamedummy;
			
			$filenamearray	=	explode('-1-'.$claimcode,$filenamedummy);			
			$filenamedummy	=	$filenamearray[0];
			
			
			$nome_file_generato = array(
	  			0 => "claimfile-client", 1 => "airticket", 2 => "pir", 3 => "safebag-receipt",
	  			4 => "claim-airline", 5 => "claim-airline2-transfer", 6 => "valid-id",
	  			7 => "doc-delivery-bag", 8 => "doc-pickup-bag",9 => "doc-new-bag",10 => "photo");
	  
			$nome_file_generato_db = array(
					0 => "modulosinistro", 1 => "airticket", 2 => "pir", 3 => "safebag_receipt",
					4 => "claim_airline", 5 => "claim_airline2_transfer", 6 => "police_complaint",
					7 => "bag_receipt", 8 => "cost_reparations", 9 => "irreparable",10 => "photo");
			
			$key = array_search($filenamedummy, $nome_file_generato);
			$inputfiledummy	=	$nome_file_generato_db[$key];
			$nofile	=	false;
			if($filenamedummy != 'refund-release-client'){
				
				
				$trova=$nome_file_generato[$key];
				
				if ($handle = opendir($folder_claim)) {
					
				
					/* This is the correct way to loop over the directory. */
					while (false !== ($entry = readdir($handle))) {
						if (strpos($entry,$trova))
						 {
							$nofile	=	true;
						}
					}
					$docdefinition = Claimsdocs::getDocdefinition();
					if($nofile == false){
						$claimsdoc	=	Claimsdocs::whereRaw('idclaim =?', array($claims->idclaim))->first() ;	
						if(!empty($claimsdoc)){
								
							$date	=	'date';
							$claimsdoc->idclaim	=	$claims->idclaim;
							$claimsdoc[$inputfiledummy]	=	0;
							
							$claimsdoc->save();
							
							$claimslog	=	new Claimslog;
							if(isset($docdefinition[$inputfiledummy])){
								$claimslog	=	new Claimslog;
								$claimslog->idclaim	=	$claims->idclaim;
								$claimslog->idclient	=	Session::get('idclient');
								$description="Ha eliminato il documento ".$filenamedummy1;
								$claimslog->description	=	$description;
								$claimslog->date_new	=	date('Y-m-d H:i:s',strtotime('+1 hours'));
								$claimslog->save();
							}
						}
					}
					else{
						$claimslog	=	new Claimslog;
						if(isset($docdefinition[$inputfiledummy])){
							$claimslog	=	new Claimslog;
							$claimslog->idclaim	=	$claims->idclaim;
							$claimslog->idclient	=	Session::get('idclient');
							$description="Ha eliminato il documento ".$filenamedummy1;
							$claimslog->description	=	$description;
							$claimslog->date_new	=	date('Y-m-d H:i:s',strtotime('+1 hours'));
							$claimslog->save();
						}	
					}
					
				}
			
			}
			else{
				if ($handle = opendir($folder_claim)) {
					$trova= 'refund-release-client';
					/* This is the correct way to loop over the directory. */
					while (false !== ($entry = readdir($handle))) {
						if (strpos($entry,$trova))
						 {
							$nofile	=	true;
						}
					}
					$docdefinition = Claimsdocs::getDocdefinition();
					
					if($nofile == false){
						
						$claimsdoc	=	Claimsclosed::whereRaw('idclaim =?', array($claims->idclaim))->first() ;	
						$inputfiledummy='conferma_quietanza';
						if(!empty($claimsdoc)){
								
							$date	=	'date';
							$claimsdoc->idclaim	=	$claims->idclaim;
							$claimsdoc->conferma_quietanza	=	0;
							
							$claimsdoc->save();
							
							$claimslog	=	new Claimslog;
							if(isset($docdefinition[$inputfiledummy])){
								$claimslog	=	new Claimslog;
								$claimslog->idclaim	=	$claims->idclaim;
								$claimslog->idclient	=	Session::get('idclient');
								$description="Ha eliminato il documento ".$filenamedummy1;
								$claimslog->description	=	$description;
								$claimslog->date_new	=	date('Y-m-d H:i:s',strtotime('+1 hours'));
								$claimslog->save();
							}
						}
					}
					else{
						$claimslog	=	new Claimslog;
						if(isset($docdefinition[$inputfiledummy])){
							$claimslog	=	new Claimslog;
							$claimslog->idclaim	=	$claims->idclaim;
							$claimslog->idclient	=	Session::get('idclient');
							$description="Ha eliminato il documento ".$filenamedummy1;
							$claimslog->description	=	$description;
							$claimslog->date_new	=	date('Y-m-d H:i:s',strtotime('+1 hours'));
							$claimslog->save();
						}	
					}
				}
			}
			
			
			
			return Response::json(array(
				  'success' => true,
				  'nofile'=>$nofile,
				  'filename'=>$trova,
				  'inputfiledummy'=>$nome_file_generato_db[$key],
				  
				));
		}
		else{
			return Response::json(array(
				  'success' => false,
				  'path'=>'aaa',
				  
				));
		}
	}
	
	
	// add claims document
	public function postAddclaimsdoct(){
		$inputs	=	Input::all();
		
		$inputfile='';
		foreach($inputs as $key=>$value){
			if($key != '_token' && $key != 'idclaim'){
				$inputfile	=	$key;
			}
		}	
		
		$validator = Validator::make(
            array('file' => $inputs[$inputfile]),
            array('file' => 'required|mimes:jpeg,png,pdf,gif,doc,docx|max:5000')
        );
		if($validator->fails()){
			
			return Response::json(array(
				'fail' => true,
				'errors' => $validator->getMessageBag()->toArray()
			));
		}
		else {
			$idclaim	=	$inputs['idclaim'];
			$claims		=	Claims::find($idclaim);
			$path = '/var/www/html/safe-bag/cmsafebag/gestionale-sinistri/sinistro/modules/'.date('Y',($claims['sigdate'])).'/'.date('m',($claims['sigdate'])).'/' . $claims['claimcode'].'/docs/';
			
			/*$files = File::allFiles($path);
			
			$countfiles	=	count($files);*/
			$num_pir	=	1;
			//$path	=	public_path().'/sinistro/modules/'.date('Y',($claims['sigdate'])).'/'.date('m',($claims['sigdate'])).'/' . $claims['claimcode'].'/docs';
			$dummypath	=	storage_path().' '.public_path().' '.base_path().' '.app_path();
			
			//die;
			//$path = 'sinistro/modules/'.date('Y',($claims['sigdate'])).'/'.date('m',($claims['sigdate'])).'/' . $claims['claimcode'];
			//mkdir -m 777 $path;
			//$directroy	=	mkdir($path, 0777, true);

			File::makeDirectory($path, 0777,true,true);
			//die();
			$ext_doc 	= Input::file($inputfile)->getClientOriginalExtension();
			$now= time();
	    	$today = date("dmY");
			$inputfiledummy	=	$inputfile;
			if($inputfile == 'modulosinistro')
				$inputfiledummy	=	'claimfile-client';
			
			if($inputfile == 'police_complaint')
				$inputfiledummy	=	'valid-id';
				
			if($inputfile == 'leaflet')
				$inputfiledummy	=	'doc-delivery-bag';
				
			/*$nome_file_generato = array(
	  			0 => "claimfile-client", 1 => "airticket", 2 => "pir", 3 => "safebag-receipt",4 => "leaflet",
	  			5 => "claim-airline", 6 => "claim-airline2-transfer", 7 => "police-complaint",
	  			8 => "bags-receipt", 9 => "cost-reparations",10 => "irreparable",11 => "photo");*/
				
		   /*$nome_file_generato = array(
									  0 => "claimfile-client", 1 => "airticket", 2 => "pir", 3 => "safebag-receipt",
									  4 => "claim-airline", 5 => "claim-airline2-transfer", 6 => "valid-id",
									  7 => "doc-delivery-bag", 8 => "doc-pickup-bag",9 => "doc-new-bag",10 => "photo");
	  
			$nome_file_generato_db = array(
					0 => "modulosinistro", 1 => "airticket", 2 => "pir", 3 => "safebag_receipt", 4 => "leaflet",
					5 => "claim_airline", 6 => "claim_airline2_transfer", 7 => "police_complaint",
					8 => "bag_receipt", 9 => "cost_reparations", 10 => "irreparable",11 => "photo");*/
					
			$nome_file_generato = array(
	  			0 => "claimfile-client", 1 => "airticket", 2 => "pir", 3 => "safebag-receipt",
	  			4 => "claim-airline", 5 => "claim-airline2-transfer", 6 => "valid-id",
	  			7 => "doc-delivery-bag", 8 => "doc-pickup-bag",9 => "doc-new-bag",10 => "photo");
	  
			$nome_file_generato_db = array(
					0 => "modulosinistro", 1 => "airticket", 2 => "pir", 3 => "safebag_receipt",
					4 => "claim_airline", 5 => "claim_airline2_transfer", 6 => "police_complaint",
					7 => "bag_receipt", 8 => "cost_reparations", 9 => "irreparable",10 => "photo");
			
			$key = array_search($inputfile, $nome_file_generato_db);
			$inputfiledummy	=	$nome_file_generato[$key];
				
			$filename_doc  = $now."_".str_replace("_","-",$inputfiledummy)."-".$num_pir."-".$claims['claimcode']."-".$today.'.'.$ext_doc;
			//str_random(12).'.'.$ext_doc;	
			Input::file($inputfile)->move($path, $filename_doc);
			$claimsdoc	=	Claimsdocs::whereRaw('idclaim =?', array($inputs['idclaim']))->first() ;	
			if(empty($claimsdoc))
				$claimsdoc	=	new Claimsdocs;
				
			$date	=	'date';
			$claimsdoc->idclaim	=	$inputs['idclaim'];
			$claimsdoc[$inputfile]	=	1;
			$claimsdoc->$date	=	time();
			$claimsdoc->date_end	=	time();
			$claimsdoc->save();
			$docdefinition = Claimsdocs::getDocdefinitionupload();
			$claimslog	=	new Claimslog;
			if(isset($docdefinition[$inputfile])){
				$claimslog	=	new Claimslog;
				$claimslog->idclaim	=	$inputs['idclaim'];
				$claimslog->idclient	=	Session::get('idclient');
				//$description="<strong style=color:red;>Pending</strong> - Documento : ".$docdefinition[$inputfile].", da controllare (caricato dalloperatore o Ritornato pending) ";
				$description="<strong style=color:red;>Pending</strong> - Ha caricato il file: ".$docdefinition[$inputfile];
				$claimslog->description	=	$description;
				$claimslog->date_new	=	date('Y-m-d H:i:s',strtotime('+1 hours'));
				$claimslog->save();
			}
			$linguaclaim	=	Session::get('lang');
			$claimcode	=	$claims['claimcode'];
			$sigdate_out=	$claims['sigdate'];
			$anno_claim = date ( "Y", $sigdate_out );
			$mese_claim = date ( "m", $sigdate_out );
			
			$folder_claim_docs="../../safe-bag/cmsafebag/gestionale-sinistri/sinistro/modules/".$anno_claim."/".$mese_claim."/".$claimcode."/docs/";
												
			$folder_claim_docs_dummy = "http://safe-bag.com/cmsafebag/gestionale-sinistri/sinistro/modules/" . $anno_claim . "/" . $mese_claim . "/" . $claimcode . "/docs/";
			$indexdummy	=	Claimsdocs::searchdocumento($folder_claim_docs,$claimcode,str_replace("_","-",$inputfiledummy),$claimsdoc[$inputfile],$linguaclaim, $folder_claim_docs_dummy);
			return Response::json(array(
				  'success' => true,
				  'path'=>$docdefinition,
				  'inputfile'=>$inputfile,
				  'index'=>$indexdummy,
				  'inputfiledummy'=>$inputfiledummy,
				  
				));
			
		}
		
		
		//echo $inputfile;
	}
	
	// show climsdoc
	public function postShowdocument(){
		$inputs	=	Input::all();
		return View::make('users.showdocument',array('inputs'=>$inputs));
	}
	
	public function postAddclaimsrefuse(){
		$inputs	=	Input::all();
		
		$inputfile='';
		foreach($inputs as $key=>$value){
			if($key != '_token' && $key != 'idclaim'){
				$inputfile	=	$key;
			}
		}	
		
		$validator = Validator::make(
            array('file' => $inputs[$inputfile]),
            array('file' => 'required|mimes:jpeg,png,pdf,gif,doc,docx|max:5000')
        );
		if($validator->fails()){
			
			return Response::json(array(
				'fail' => true,
				'errors' => $validator->getMessageBag()->toArray()
			));
		}
		else {
			$idclaim	=	$inputs['idclaim'];
			$claims		=	Claims::find($idclaim);
			$path = '/var/www/html/safe-bag/cmsafebag/gestionale-sinistri/sinistro/modules/'.date('Y',($claims['sigdate'])).'/'.date('m',($claims['sigdate'])).'/' . $claims['claimcode'].'/docs/';
			
			/*$files = File::allFiles($path);
			
			$countfiles	=	count($files);*/
			$num_pir	=	1;
			//$path	=	public_path().'/sinistro/modules/'.date('Y',($claims['sigdate'])).'/'.date('m',($claims['sigdate'])).'/' . $claims['claimcode'].'/docs';
			$dummypath	=	storage_path().' '.public_path().' '.base_path().' '.app_path();
			//die;
			//$path = 'sinistro/modules/'.date('Y',($claims['sigdate'])).'/'.date('m',($claims['sigdate'])).'/' . $claims['claimcode'];
			//mkdir -m 777 $path;
			//$directroy	=	mkdir($path, 0777, true);

			File::makeDirectory($path, 0777,true,true);
			//die();
			$ext_doc 	= Input::file($inputfile)->getClientOriginalExtension();
			$now= time();
	    	$today = date("dmY");
			$inputfiledummy	=	$inputfile;
			if($inputfile == 'conferma_quietanza')
				$inputfiledummy	=	'refund-release-client';
				
			$filename_doc  = $now."_".str_replace("_","-",$inputfiledummy)."-".$num_pir."-".$claims['claimcode']."-".$today.'.'.$ext_doc;
			$filename_doc_dummy  =	str_replace("_","-",$inputfiledummy)."-".$num_pir."-".$claims['claimcode']."-".$today.'.'.$ext_doc;
			//str_random(12).'.'.$ext_doc;	
			Input::file($inputfile)->move($path, $filename_doc);
			$claimsdoc	=	Claimsclosed::whereRaw('idclaim =?', array($inputs['idclaim']))->first() ;	
			if(empty($claimsdoc))
				$claimsdoc	=	new Claimsclosed;
				
			$date	=	'date';
			$claimsdoc->idclaim	=	$inputs['idclaim'];
			$claimsdoc[$inputfile]	=	1;
			
			$claimsdoc->save();
			$docdefinition = Claimsdocs::getDocdefinition();
			$claimslog	=	new Claimslog;
			//if(isset($docdefinition[$inputfile]))
			{
				$claimslog	=	new Claimslog;
				$claimslog->idclaim	=	$inputs['idclaim'];
				$claimslog->idclient	=	Session::get('idclient');
				$description="<strong style=color:red;>Pending</strong> - Ha caricato il file: Modulo Quietanza";
				//$description="<strong style=color:red;>Pending</strong> - Modulo di Quietanza di pagamento da controllare e confermare ";
				$claimslog->description	=	$description;
				$claimslog->date_new	=	date('Y-m-d H:i:s',strtotime('+1 hours'));
				$claimslog->save();
			}
			
			
			$linguaclaim	=	Session::get('lang');
			$claimcode	=	$claims['claimcode'];
			$sigdate_out=	$claims['sigdate'];
			$anno_claim = date ( "Y", $sigdate_out );
			$mese_claim = date ( "m", $sigdate_out );
			
			$folder_claim_docs="../../safe-bag/cmsafebag/gestionale-sinistri/sinistro/modules/".$anno_claim."/".$mese_claim."/".$claimcode."/docs/";
												
			$folder_claim_docs_dummy = "http://safe-bag.com/cmsafebag/gestionale-sinistri/sinistro/modules/" . $anno_claim . "/" . $mese_claim . "/" . $claimcode . "/docs/";
			$indexdummy	=	Claimsdocs::searchdocumento($folder_claim_docs,$claimcode,str_replace("_","-",$inputfiledummy),$claimsdoc[$inputfile],$linguaclaim, $folder_claim_docs_dummy);
			return Response::json(array(
				  'success' => true,
				  'path'=>$docdefinition,
				  'inputfile'=>$inputfile,
				  'index'=>$indexdummy,
				  'inputfiledummy'=>$inputfiledummy,
				  
				));
			/*return Response::json(array(
				  'success' => true,
				  'path'=>$docdefinition,
				  
				));*/
			
		}
		
		
		//echo $inputfile;
	}



    // get lost and found
    public function getListclaimprocess(){
    	
		$existscheck   = Claimsbag::where('idclient','=',Session::get('idclient'))->where('idbag','=',Request::segment(3)) -> get();
		if(!empty($existscheck)){
			 	$claimsbags   = DB::table('claims_bag AS bag')
           				 ->join('claims_client AS client', 'client.idclient', '=', 'bag.idclient')
           			     ->join('claims AS claim', 'claim.idclaim', '=', 'bag.idclaim')
						 ->join('airports_all AS airport', 'airport.id', '=', 'bag.airline')
						 ->where('bag.idbag','=',Request::segment(3))
						 ->where('bag.idclient','=',Session::get('idclient'))
           				 ->get();
		        $airportslist	=	Airportsall::lists('city','iata');
				
				$claimsdoc		=	Claimsdocs::whereRaw('idclaim =?', array($claimsbags[0]->idclaim))->first() ;
				if(empty($claimsdoc))
					$claimsdoc	=	new Claimsdocs;
				$claimsclosed	=	Claimsclosed::whereRaw('idclaim =?', array($claimsbags[0]->idclaim))->first() ;
				if(empty($claimsclosed))
					$claimsclosed	=	new Claimsclosed;
				
		        $this -> layout -> content = View::make('users.listclaimprocess', array('claimsbags'=>$claimsbags, 'airportslist'=>$airportslist, 'claimsdoc'=>$claimsdoc, 'claimsclosed'=>$claimsclosed));
   
		}else{
			return Response::view('404', array(), 404);
		}
        }
	
	// get lost and found
	public function getListclaims(){
		$claimsbags	=	Claimsbag::WhereRaw('idclient = ? and idclaim <> 0 and (safebagcode = "" or safebagcode IS NULL)', array(Session::get('idclient')))->with('claims','airlines')->orderBy('depdate','desc')-> get();
		//$claimsbags   = Claimsbag::where('idclient','=',Session::get('idclient'))->orderBy('idbag', 'DESC')->with('claims','airlines') -> get();
		//$claimsbags   = Claimsbag::where('idclient','=',Session::get('idclient'))->where('idclaim','>','0')->where('safebagcode','=','')->with('claims')->orderBy('idbag', 'DESC') -> get();
		$airportslist	=	Airportsall::lists('city','iata');
		$this -> layout -> content = View::make('users.listclaims', array('claimsbags'=>$claimsbags, 'airportslist'=>$airportslist));
	}
	
	// add cliams
	public function postAddclaims(){
		$input	=	Input::all();	
		$validator = Validator::make(Input::all(), Claims::$rules_addclaims);
		$friendly_names = array(
			'sigdate' => trans('userclaims.sigdate'),
			'lost' => trans('userclaims.lost'),
			'idbag' => trans('userclaims.idbag'),
			'notes' => trans('userclaims.description'),			
		);
		
		$claimsbag   = Claimsbag::find($input['idbag']);
		$now = time();
		if($claimsbag->arrdate > $now)
		{
			$validator->getMessageBag()->add('description', 'Date should greater than '.date('d-m-Y',$claimsbag->arrdate));
			return Response::json(array(
					'fail' => true,
					'errors' => $validator->getMessageBag()->toArray()
			));
			
			
		}
		
		$claimsbag   = Claimsbag::WhereRaw('idclient = ? and idbag = ?',array(Session::get('idclient'), $input['idbag']))->orderBy('idbag', 'DESC')->with('claims') -> get();
		if(empty($claimsbag)){
			$validator->getMessageBag()->add('idbag', trans('userclaims.invalid_bag'));
			//$errorData = array('status' => 0, 'referer' => 'addcard', 'msg' => 'card already assigned !');
			return Response::json(array(
				'fail' => true,
				'errors' => $validator->getMessageBag()->toArray()
			));
		}
		$arrayclaimsbag	=	$claimsbag->toArray();
		$validator1 = Validator::make($arrayclaimsbag[0], Claimsbag::$rules['validateflights']);
		if (!$validator1 -> passes()) {	
			$validator->getMessageBag()->add('description', 'Incompleted flight detail. ');
			return Response::json(array(
					'fail' => true,
					'datadummy'=>$arrayclaimsbag[0],
					'errors' => $validator->getMessageBag()->toArray()
			));
		}
		/*else{
			$validator->getMessageBag()->add('description', 'completed flight detail. ');
			return Response::json(array(
					'fail' => true,
					'errors' => $validator->getMessageBag()->toArray()
			));
		}*/
		/*else{
			$validator->getMessageBag()->add('description', 'Date should less than '.date('d-m-Y',$claimsbag->arrdate));
			return Response::json(array(
					'fail' => true,
					'errors' => $validator->getMessageBag()->toArray()
			));
		}*/
		
		$validator->setAttributeNames($friendly_names);
		if ($validator -> passes()) {	
			
			$claimsbag   = Claimsbag::find($input['idbag']);
			if($claimsbag->idclaim > 0){
				$validator->getMessageBag()->add('idbag', trans('userclaims.invalid_bag'));
				//$errorData = array('status' => 0, 'referer' => 'addcard', 'msg' => 'card already assigned !');
				return Response::json(array(
					'fail' => true,
					'errors' => $validator->getMessageBag()->toArray()
				));
			}
			
			$year = date("y",$now);
			$sigdate	=	$input['sigdate'];
			$sigdate = mktime(0,0,0,substr($sigdate,3,2),substr($sigdate,0,2),substr($sigdate,6,4));
			$claimsbag   = DB::select("SELECT *  FROM `claims` WHERE `claimcode` LIKE CONVERT( _utf8 '%$year-%' USING latin1 ) COLLATE latin1_swedish_ci  ORDER BY `claims`.`idclaim` DESC  LIMIT 0 , 1");
			//var_dump($claimsbag);
			$last_claimcode=$claimsbag[0]->claimcode;
			
			$last_claimcode1=explode("-", $last_claimcode);
			$claimcode_a=$last_claimcode1[0];
			$claimcode_b=$last_claimcode1[1];
			$claimcode_c=$claimcode_b + 1;
			  
			if ($claimcode_a==$year){$claimcode_ok=$year."-".$claimcode_c;}else{$claimcode_ok=$year."-1";}
			
			$model	=	new	Claims;
			$model->claimcode	=	$claimcode_ok;
			$model->idclient	=	Session::get('idclient');
			$model->packaged	=	1;
			$model->sigby		=	1;
			$model->lost	=	$input['lost'];
			$model->notes	=	$input['notes'];
			$model->sigdate	=	$sigdate;
			$model->lingua_sinistro	=	Session::get('lang');
			$model->data_registrazione	=	$now;
			if($model->save()){
				$claimsbag   = Claimsbag::find($input['idbag']);
				$claimsbag->idclaim	=	$model->idclaim;
				$claimsbag->baglost	=	1;
				$claimsbag->lasteditdate	=	$now;
				$claimsbag->save();
				
				$claimslog	=	new Claimslog;
				$claimslog->idclaim	=	$model->idclaim;
				$claimslog->idclient	=	$model->idclient;
				$description="Apertura della pratica di risarcimento";
				$claimslog->description	=	$description;
				$claimslog->date_new	=	date('Y-m-d H:i:s');
				$claimslog->save();
				
				$client	=	Clients::find(Session::get('idclient'));
				$name	=	$client->name;
				$tomail	=	$client->email;
				//$tomail	=	'arul258013@gmail.com';
				
				Session::put('updatebagsemail', $tomail);			
				Mail::send('client.mailrefundrequest', array('name'=>$name,'idbag'=>$input['idbag'],'bagdetails'=>$claimsbag, 'claimcode'=>$model->claimcode), function($message){
						$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject(trans('emailtemplet.sub_refundrequest', array('claim' => $claimcode_ok)));
				});
				Session::forget('updatebagsemail');
				
				
			}
			
			
			
			
			Session::flash('success',1);
			Session::flash('message',trans('userclaims.claims_added_success'));  
			return Response::json(array('success' => true,'model'=>$model));
		}
		else{					
			return Response::json(array(
				'fail' => true,
				'errors' => $validator->getMessageBag()->toArray()
			));
		}
				  
	}

   //get list of cards for users
	public function getListcards() {
		$packages	=	Packages::all();
		$packageslist	=	Packages::lists('package_id', 'price');
		$qtyList	=	array(
						//''=>'-Select-',							
							'1'=>1,
							'2'=>2,
							'3'=>3,
							'4'=>4,
							'5'=>5,
							'6'=>6,
							'7'=>7,
							'8'=>8,
							'9'=>9,
							'10'=>10,
							);
		
		$cards  = Cards::whereRaw('idclient = ? AND  cardstatus = 1', array(Session::get('idclient')))->orderBy('card_id', 'DESC') -> get();
		$this -> layout -> content = View::make('users.listcards', array('cards'=>$cards, 'packages'=>$packages, 'packageslist'=>$packageslist, 'qtyList'=>$qtyList));
		
	}
	
	// card recharge fail
	public function getCardrechargefail(){
		return Redirect::to('users/listcards')->with(array('message' => trans('userlistcards.transaction_fail_recharge_card'),'success'=>0));	
	}
	
	// card recharge fail
	public function getCardactivatefail(){
		return Redirect::to('users/activatesmarttrack')->with(array('message' => trans('userlistcards.transaction_fail_recharge_card'),'success'=>0));	
	}
	
	// activate smarttrack success
	public function getActivatesmarttracksuccess(){
		
		$this -> layout -> content = View::make('users.activatesmarttracksuccess');
	}
	
	// card buy fail
	public function getCardbuyfail(){
		return Redirect::to('users/listcards')->with(array('message' => trans('userlistcards.transaction_fail_buy_card'),'success'=>0));	
	}
	
	
	
	//register the card to app
	public function postAddcard() {
		$input	=	Input::all();
		$input['idclient']	=	Session::get('idclient');
		$validator = Validator::make($input, Cards::$rules_five);
		if ($validator -> passes()) {
			
			$existsCheck = DB::select('select * from sfb_smartcards where idclient = ?  and card_number = ? ', array(Session::get('idclient'), Input::get('card_number')));
			if (!empty($existsCheck)) {
					$validator->getMessageBag()->add('card_number', trans('userlistcards.card_already_assigned'));
					//$errorData = array('status' => 0, 'referer' => 'addcard', 'msg' => 'card already assigned !');
					return Response::json(array(
						'fail' => true,
						'errors' => $validator->getMessageBag()->toArray()
					));
				
			}
			
			$requestCard = Cards::where('card_number', '=', Input::get('card_number')) -> first();
		
			if(!empty($requestCard) && $requestCard->idclient=='0'){
				$card = Cards::find($requestCard->card_id);
				
				//print_r($card);die;
				if (!empty($card)){
					$card -> idclient 		= Session::get('idclient');
					$card -> save();
					
					$client	=	Clients::find($card->idclient);
					$name	=	$client->name;
					$tomail	=	$client->email;
					//$tomail	=	'arul258013@gmail.com';
					
					Session::put('updatebagsemail', $tomail);
					
					Mail::send('client.sendmailtouser_regiterbag', array('name'=>$name,'card_number'=>Input::get('card_number'),'carddetails'=>$card), function($message){
							//$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject(' [Smart-track.com] Smart Track Card Registration');
							$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject(trans('emailtemplet.sub_regiterbag'));
					});
					Session::forget('updatebagsemail');
					
					$successData = array('success' => true, 'referer' => 'addcard', 'msg' => trans('userlistcards.card_added_success'));
					Session::flash('success',1);
					Session::flash('message',trans('userlistcards.card_added_success'));  
					return Response::json($successData, 200);					
					
				}else{
					$validator->getMessageBag()->add('card_number', trans('userlistcards.card_does_not_exit'));
					//$errorData = array('status' => 0, 'referer' => 'addcard', 'msg' => 'Card does not exist or already assigned to a user!');
					return Response::json(array(
						'fail' => true,
						'errors' => $validator->getMessageBag()->toArray()
					));
				}
			}else{
				//$errorData = array('status' => 0, 'referer' => 'addcard', 'msg' => 'Card does not exist or already assigned to a user!');
				$validator->getMessageBag()->add('card_number', trans('userlistcards.card_does_not_exit'));
				return Response::json(array(
					'fail' => true,
					'errors' => $validator->getMessageBag()->toArray()
				));
			}
				
			
		}else{
			return Response::json(array(
				'fail' => true,
				'errors' => $validator->getMessageBag()->toArray()
			));
		}
	}
	
	//delete card
	public function postDeletecard() {
		$input	=	Input::all();
		$input['idclient']	=	Session::get('idclient');
		$validator = Validator::make($input, Cards::$rules_six);
		if ($validator -> passes()) {
			
				$existsCheck = DB::select('select * from sfb_smartcards where idclient = ?  and card_id = ? and cardstatus = 1', array(Session::get('idclient'), Input::get('card_id')));
				
				if (!empty($existsCheck)) {
					$card = Cards::find(Input::get('card_id'));
					$card -> cardstatus 	= '0';
					$card -> flightnumbers	= '1';
					$card -> save();
					$successData = array('success' => true, 'referer' => 'deletecard', 'msg' => trans('userlistcards.card_deleted_success'));
					Session::flash('success',1);
					Session::flash('message',trans('userlistcards.card_deleted_success'));  
					return Response::json($successData, 200);
				}else{
					$validator->getMessageBag()->add('card_number', trans('userlistcards.card_does_not_exit_or_user'));
					$errorData = array('fail' => true, 'errors' => $validator->getMessageBag()->toArray());
					return Response::json($errorData, 200);
				}
		}else{
					$validator->getMessageBag()->add('card_number',  trans('userlistcards.validation_error'));
					$errorData = array('fail' => true, 'errors' => $validator->getMessageBag()->toArray());
					return Response::json($errorData, 200);
		}
		
	}
	
	
	//get list of bags for users
	public function getListbags() {
		
		$bags  = Bags::where('idclient','=',Session::get('idclient'))->orderBy('bag_id', 'DESC') -> get();
		$brandlist	=	Bags::getbrandlist();
		$colorlist	=	Bags::getcolorlist();
		$this -> layout -> content = View::make('users.listbags', array('bags'=>$bags, 'brandlist'=>$brandlist, 'colorlist'=>$colorlist));
		
	}
	
	//delete a bag
	public function postDeletebag()
	{
			$validator = Validator::make(Input::all(), Bags::$rules_updatebags);
			if ($validator -> passes()) {
				$success = Bags::destroy(Input::get('bag_id'));
				if($success==1){					
					$successData = array('success' => true, 'referer' => 'deletebag', 'msg' => trans('userlistbags.bag_deleted_success'));
					Session::flash('success',1);
					Session::flash('message',trans('userlistbags.bag_deleted_success'));  
					return Response::json($successData, 200);
				}else{					
					$validator->getMessageBag()->add('bag_id', trans('userlistbags.bag_deleted_error'));
					$errorData = array('fail' => true, 'errors' => $validator->getMessageBag()->toArray());
					return Response::json($errorData, 200);
				}
				
			}else{
			    $validator->getMessageBag()->add('bag_id', trans('userlistbags.validation_error'));
				$errorData = array('fail' => true, 'errors' => $validator->getMessageBag()->toArray());
				return Response::json($errorData, 200);
			}
	} 	
	
	// get bag deatail w.r.to id
	public function postGetbagdetail(){
		if (Session::get('idclient') !='' && Session::get('email')!='' ){
			$bag_id		=	Input::get('bag_id');
			$idclient	=	Session::get('idclient');
			
			$data	= Bags::whereRaw('bag_id =? and idclient =?', array($bag_id,$idclient))->first() ;	
			/*$data->picture1	=	$idclient.'-'.$data->picture1;
			$data->picture1	=	$idclient.'-'.$data->picture1;
			$data->picture1	=	$idclient.'-'.$data->picture1;*/
			if(!empty($data)){
				if($data->picture1 != '')
					$data->picture1	=	$idclient.'-'.$data->picture1;
				if($data->picture2 != '')
					$data->picture2	=	$idclient.'-'.$data->picture2;
				if($data->picture3 != '')
					$data->picture3	=	$idclient.'-'.$data->picture3;
				$data['success']	=	true;
			}
			else{
				$data['fail']	=	true;
			}
		}
		else{
			$data['fail']	=	true;
		}
		return Response::json($data);
	}

	private $output;
	//add baglist
	public function postAddbaglist(){
		$input	=	Input::all();
		$bag_id	=	Input::get("bag_id");
		$input['idclient']	=	Session::get('idclient');
		$idclient	=	Session::get('idclient');
		if($bag_id != ''){
			$data	= Bags::whereRaw('bag_id =? and idclient =?', array($bag_id,$idclient))->first() ;	
			if(empty($data)){
				return Response::json(array(
					'redirect' => true					
				));
			}
		}
		
		//$destinationPath = 'uploads/bags';
		$destinationPath = Claimsbag::getPathcurrent().'/bags';
		//$mime 		= Input::file('picture1')->getMimeType();
		$allowedTypes = array('jpeg', 'jpg', 'gif', 'png', 'ico');
		
		$error	=	true;
		
		/*if (Input::hasFile('picture1'))
		{
			$ext_pic1 	= Input::file('picture1')->getClientOriginalExtension();
			$size_pic1 	= Input::file('picture1')->getSize();
				$input['picture1']	=	'dummy';
			if(in_array($ext_pic1,$allowedTypes) && $size_pic1 <= 100000){
				
				
			}else{
				//$error	=	false;
				//$validator->getMessageBag()->add('picture1', 'Invalid File.');
				$filename_pic1	  = ''; 
				
				
			}
			  
		}
		if($bag_id != ''){
			$input['picture1']	=	'dummy';
		}*/
		$friendly_names = array(
			'name' => trans('userlistbags.name'),
			'brand' => trans('userlistbags.brand'),
			'color' => trans('userlistbags.color'),
			'description' => trans('userlistbags.description'),
			'picture1' => trans('userlistbags.picture1'),
			'picture2' => trans('userlistbags.picture2'),
			'picture3' => trans('userlistbags.picture3'),
		);
		$validator = Validator::make($input, Bags::$rules_add);
		$validator->setAttributeNames($friendly_names);
		if ($validator -> passes()) {
			
			//$destinationPath = 'uploads';
			//$destinationPath = Claimsbag::getSavepath().'/bags';
			//$mime 		= Input::file('picture1')->getMimeType();
			$allowedTypes = array('jpeg', 'jpg', 'gif', 'png', 'ico');
			
			$error	=	true;
			
			if (Input::hasFile('picture1'))
			{
				$ext_pic1 	= Input::file('picture1')->getClientOriginalExtension();
				$size_pic1 	= Input::file('picture1')->getSize();
				if(in_array($ext_pic1,$allowedTypes) && $size_pic1 <= 100000){
					
				  	
				}else{
					$error	=	false;
					$validator->getMessageBag()->add('picture1', trans('validation.image', array('attribute' => trans('userlistbags.picture1'))));
					$filename_pic1	  = ''; 
					
				}
				  
			}else{
					$filename_pic1	  = ''; 
					if($bag_id == ''){
						//$error	=	false;
						//$validator->getMessageBag()->add('picture1', trans('validation.required', array('attribute' => trans('userlistbags.picture1'))));
						
					}
					else{
						$filename_pic1	  =	$data['picture1'];
					}
					
			}
			
			if (Input::hasFile('picture2'))
			{
				$ext_pic2 	= Input::file('picture2')->getClientOriginalExtension();
				$size_pic2 	= Input::file('picture2')->getSize();
				if(in_array($ext_pic2,$allowedTypes) && $size_pic2 <= 100000){
				  	
				}else{
					$error	=	false;
					$validator->getMessageBag()->add('picture2', trans('validation.image', array('attribute' => trans('userlistbags.picture2'))));
					$filename_pic2	  = ''; 
				}
				 
			}else{
				$filename_pic2	  = ''; 
				if(!empty($data)){
						$filename_pic2	  =	$data['picture2'];
				}
			}
			
			if (Input::hasFile('picture3'))
			{
				$ext_pic3 	= Input::file('picture3')->getClientOriginalExtension();
				$size_pic3 	= Input::file('picture3')->getSize();
				if(in_array($ext_pic3,$allowedTypes) && $size_pic3 <= 100000){
				  	
				}else{
					$error	=	false;
					$validator->getMessageBag()->add('picture3', trans('validation.image', array('attribute' => trans('userlistbags.picture3'))));
					$filename_pic3	  = ''; 
				}
				  
			}
			else{
				$filename_pic3	  = ''; 
				if(!empty($data)){
						$filename_pic3	  =	$data['picture3'];
				}
			}
			
			if($error){
				//echo "aa";
				if (Input::hasFile('picture1'))
				{
					$ext_pic1 	= Input::file('picture1')->getClientOriginalExtension();
					$size_pic1 	= Input::file('picture1')->getSize();
					if(in_array($ext_pic1,$allowedTypes) && $size_pic1 <= 100000){
						$filename_pic1  = str_random(12).'.'.$ext_pic1;		
						//$realpath	=	Input::file('picture1')->getRealPath().'/'.Input::file('picture1')->getClientOriginalName();
						$upload_pic1    = Input::file('picture1')->move($destinationPath, $input['idclient'].'-'.$filename_pic1);
						
						/*$failpathcurrent	=	$destinationPath.'/12881-xYs5PY1MI1Xx.jpg';//.$input['idclient'].'-'.$filename_pic1;
						$ssh_command = 'scp safebag@188.15.138.122:'.$failpathcurrent.' 
root@109.168.44.84:/var/www/html/safe-bag/stws/public/uploads/bags/';
		 $ssh_command ='scp -r -o "ForwardAgent=yes" safebag@188.15.138.122:'.$failpathcurrent.'  root@109.168.44.84:/var/www/html/safe-bag/stws/public/uploads/bags/';
						$ssh_response = \SSH::run($ssh_command, function($line)
						{
							$this->output = $line.PHP_EOL;
						});
						
						
					
						echo  'command : => '.$ssh_command.' output =>'.$this->output.'';
						//SSH::into('production')->put($failpathcurrent, 'html/safe-bag/stws/public/uploads/bags/');
					//SSH::into('production')->get('/var/www/html/safe-bag/stws/public/uploads/bags/11751-tPPZj7IR8JvZ.jpg', '/var/www/html/website/smart-track/public/uploads/bags/');
						Config::set('remote.connections.runtime.host', '109.168.44.84');
						//Config::set('remote.connections.runtime.port', '22');
						Config::set('remote.connections.runtime.username', 'root');
						Config::set('remote.connections.runtime.password', 'Pentium1h');*/
						
						
					}
					  
				}
				
				if (Input::hasFile('picture2'))
				{
					$ext_pic2 	= Input::file('picture2')->getClientOriginalExtension();
					$size_pic2 	= Input::file('picture2')->getSize();
					if(in_array($ext_pic2,$allowedTypes) && $size_pic2 <= 100000){
						$filename_pic2  = str_random(12).'.'.$ext_pic2;
						$upload_pic2    = Input::file('picture2')->move($destinationPath, $input['idclient'].'-'.$filename_pic2);
					}
					 
				}
				
				if (Input::hasFile('picture3'))
				{
					$ext_pic3 	= Input::file('picture3')->getClientOriginalExtension();
					$size_pic3 	= Input::file('picture3')->getSize();
					if(in_array($ext_pic3,$allowedTypes) && $size_pic3 <= 100000){
						$filename_pic3  = str_random(12).'.'.$ext_pic3;		
						$upload_pic3    = Input::file('picture3')->move($destinationPath, $input['idclient'].'-'.$filename_pic3);
					}
					  
				}
				if(empty($data))
					$bag = new Bags;
				else
					$bag =	$data;
				$bag -> idclient 	= Session::get('idclient');
				$bag -> name 		= Input::get('name');
				$bag -> brand 		= Input::get('brand');
				$bag -> color 		= Input::get('color');
				$bag -> description	= Input::get('description');
				$bag -> picture1	= $filename_pic1;
				$bag -> picture2	= $filename_pic2;
				$bag -> picture3	= $filename_pic3;
				$bag -> save();
				
				$successData = array('success' => true, 'msg' => 'Bags added successfully', 'destinationPath'=>$destinationPath, 'bag_id' => DB::getPdo()->lastInsertId());
				
				$client	=	Clients::find($bag->idclient);
				$name	=	$client->name;
				$tomail	=	$client->email;
				//$tomail	=	'arul258013@gmail.com';
				
				Session::put('updatebagsemail', $tomail);			
				Mail::send('client.mail_bag_register', array('name'=>$name, 'bag_name'=>$bag->name, 'color'=> $bag->color, 'brand'=>$bag->brand), function($message){
						//$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject('[Smart-track.com] Bag Registration');
						$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject(trans('emailtemplet.sub_bag_register'));
				});
				Session::forget('updatebagsemail');
				
				Session::flash('success',1);
				if(empty($data))
					Session::flash('message',trans('userlistbags.bag_added_success'));  
				else
					Session::flash('message',trans('userlistbags.bag_updated_success'));  
				return Response::json($successData, 200);
			}
			else{
				return Response::json(array(
					'fail' => true,
					'errors' => $validator->getMessageBag()->toArray()
				));
			}
		}else{
			return Response::json(array(
				'fail' => true,
				'errors' => $validator->getMessageBag()->toArray()
			));
		}
 
       
		return Response::json(array(
				  'success' => true,
				  'data' => $data,				  
				)); 
	}
	
	public function getFlightsdetails(){
		$idbag	=	Request::segment(3);
		$idclaim	=	Request::segment(4);
		if($idbag != 0)
			$existscheck   = Claimsbag::where('idclient','=',Session::get('idclient'))->where('idbag','=',Request::segment(3)) -> get();
		else
			$existscheck   = Claimsbag::where('idclient','=',Session::get('idclient'))->where('idclaim','=',Request::segment(4)) -> get();
			
		if(!empty($existscheck)){
			if($idbag != 0){
			 	$flights = DB::table('claims_bag')
									->leftJoin('sfb_smarttransactions', 'claims_bag.idbag', '=', 'sfb_smarttransactions.idbag')
									->leftJoin('sfb_smartcards', 'sfb_smarttransactions.rechargecard_id', '=', 'sfb_smartcards.card_id')
									->whereRaw('claims_bag.idclient = ? AND  (claims_bag.safebagcode = "" or claims_bag.safebagcode is null) AND claims_bag.idbag = ? GROUP BY claims_bag.idbag', array(Session::get('idclient'),Request::segment(3)))									
									->orderBy('claims_bag.depdate','desc')
						            ->get();
									
									
			}
			else{
				$flights = DB::table('claims_bag')
									->leftJoin('sfb_smarttransactions', 'claims_bag.idbag', '=', 'sfb_smarttransactions.idbag')
									->leftJoin('sfb_smartcards', 'sfb_smarttransactions.rechargecard_id', '=', 'sfb_smartcards.card_id')
									->whereRaw('claims_bag.idclient = ? AND  (claims_bag.safebagcode = "" or claims_bag.safebagcode is null) AND claims_bag.idclaim = ? GROUP BY claims_bag.idbag', array(Session::get('idclient'),Request::segment(4)))									
									->orderBy('claims_bag.depdate','desc')
						            ->get();
			}
						            
			$queries = DB::getQueryLog();
			$last_query = end($queries);
			//print_r($last_query);die;
			
			foreach($flights as $key=>$value){
				if($flights[$key]->depport!='' && !empty($flights[$key]->depport)){
					$depportName[$key]  = DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->depport))->lists('city');
					//print_r($last_query);die;	
				}else{
					$depportName[$key][0] = '';
				}
				if($flights[$key]->arrport!='' && !empty($flights[$key]->arrport)){
					$arrportName[$key]  = DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->arrport))->lists('city');	
				}else{
					$arrportName[$key][0]  = '';
				}
				
				if($flights[$key]->scalo1!=''){
					$scalo1Name[$key]	    = DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->scalo1))->lists('city');
					$scalo1[$key]	 		= $scalo1Name[$key][0];		
				}else{
					$scalo1[$key]	 		= '';	
				}
				if($flights[$key]->scalo2!=''){
					$scalo2Name[$key]   	= DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->scalo2))->lists('city');
					$scalo2[$key]	 	   	= $scalo2Name[$key][0];	
				}else{
					$scalo2[$key]	 	  	= '';	
				}
				if($flights[$key]->scalo3!=''){
					$scalo3Name[$key]   	= DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->scalo3))->lists('city');
					$scalo3[$key]	 		= $scalo3Name[$key][0];	
				}else{
					$scalo3[$key]  			= '';	
				}
				
				//pictures
				/*if($flights[$key]->bagpicture1!=''){
					$flights[$key]->bagpicture1 = URL::to('/').'/uploads/'.$flights[$key]->bagpicture1;
				}else{
					$flights[$key]->bagpicture1 = '';
				}
				
				if($flights[$key]->bagpicture2!=''){
					$flights[$key]->bagpicture2 = URL::to('/').'/uploads/'.$flights[$key]->bagpicture2;
				}else{
					$flights[$key]->bagpicture2 = '';
				}
				
				if($flights[$key]->bagpicture3!=''){
					$flights[$key]->bagpicture3 = URL::to('/').'/uploads/'.$flights[$key]->bagpicture3;
				}else{
					$flights[$key]->bagpicture3 = '';
				}*/
				
				
				$data[] = array(
									'idbag'	 		 => $flights[$key]->idbag,
									'idclient'	 	 => $flights[$key]->idclient,
									'idclaim'	 	 => $flights[$key]->idclaim,
									'depport'	 	 => @$depportName[$key][0],
									'arrport'	 	 => @$arrportName[$key][0],
									'depdate' 		 => date('d-m-Y',$flights[$key]->depdate),
									'scalo1' 		 => $scalo1[$key],
									'scalo2' 		 => $scalo2[$key],
									'scalo3' 		 => $scalo3[$key],
									'airline' 		 => $flights[$key]->airline,
									
									
									'transaction_id' => $flights[$key]->transaction_id,
									'paytype'	 	 => $flights[$key]->paytype,
									'payment_date'	 => date('d-m-Y', $flights[$key]->payment_date),
									
									'card_id' 	 	 => $flights[$key]->card_id,
									'card_color' 	 => $flights[$key]->card_color,
									
									
									'smartcardcode'	 => $flights[$key]->smartcardcode,
									'name'	 		 => $flights[$key]->bagname,
									'brand'	 		 => $flights[$key]->bagbrand,
									'color'			 => $flights[$key]->bagcolor,
									'description'	 => $flights[$key]->bagdescription,
									'picture1'	 	 => $flights[$key]->bagpicture1,
									'picture2'	 	 => $flights[$key]->bagpicture2,
									'picture3'	 	 => $flights[$key]->bagpicture3,
									'airlinetag' 	 => $flights[$key]->airlinetag,
									'status'	 	 => $flights[$key]->flightstatus,
									'tag_image'	 	 => $flights[$key]->tag_image,
	
									
									'date_expiration'	 => $flights[$key]->date_expiration,								
									'flag_status'	 => $flights[$key]->flag_status
							   );
			}
			if(!empty($flights)){
				/*$successData = array('status' => 1, 'referer' => 'myflights', 'msg' => 'Flights view', 'flights' => $data);
				return Response::json($successData, 200);*/
				$this -> layout -> content = View::make('users.flightsdetails', array('flights'=>$data));
			}
			else{
				//$errorData = array('status' => 0, 'referer' => 'myflights', 'msg' => 'No flights available!');
				//return Response::json($errorData, 200);
				$this -> layout -> content = View::make('users.flightsdetails', array('flights'=> ''));
			}
   
		}else{
			return Response::view('404', array(), 404);
		}
	}
	
	//get list of bags for users
	public function getListflights() {
		
		//$flights   = Claimsbag::where('idclient','=',Session::get('idclient'))->orderBy('idbag', 'DESC') -> get();
		
		//$flights = Claimsbag::whereRaw('idclient = ? and safebagcode is NULL', array($idclient))->get();
		/*$flights = DB::table('claims_bag')
									->leftJoin('sfb_smarttransactions', 'claims_bag.idbag', '=', 'sfb_smarttransactions.idbag')
									->leftJoin('sfb_smartcards', 'sfb_smarttransactions.rechargecard_id', '=', 'sfb_smartcards.card_id')
									->whereRaw('claims_bag.idclient = ? and claims_bag.safebagcode is NULL GROUP BY claims_bag.idbag', array(Session::get('idclient')))
									->orderBy('claims_bag.depdate','desc')
						            ->get();*/
		$flights = DB::table('claims_bag')
									->leftJoin('sfb_smarttransactions', 'claims_bag.idbag', '=', 'sfb_smarttransactions.idbag')
									->leftJoin('sfb_smartcards', 'sfb_smarttransactions.rechargecard_id', '=', 'sfb_smartcards.card_id')
									->whereRaw('claims_bag.idclient = ?  AND  (claims_bag.safebagcode = "" or claims_bag.safebagcode is null) and claims_bag.safebagcode is NULL GROUP BY claims_bag.idbag', array(Session::get('idclient')))									
									->orderBy('claims_bag.depdate','desc')
						            ->get();
									
		//$flights   = Claimsbag::whereRaw('idclient = ? AND idclaim = 0 AND (safebagcode = "" or safebagcode IS NULL)', array(Session::get('idclient')))->orderBy('idbag', 'DESC') -> get();							
									
						            
		$queries = DB::getQueryLog();
		$last_query = end($queries);
		//print_r($last_query);die;
		
		foreach($flights as $key=>$value){
			if($flights[$key]->depport!='' && !empty($flights[$key]->depport)){
				$depportName[$key]  = DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->depport))->lists('city');
				//print_r($last_query);die;	
			}else{
				$depportName[$key][0] = '';
			}
			if($flights[$key]->arrport!='' && !empty($flights[$key]->arrport)){
				$arrportName[$key]  = DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->arrport))->lists('city');	
			}else{
				$arrportName[$key][0]  = '';
			}
			
			if($flights[$key]->scalo1!=''){
				$scalo1Name[$key]	    = DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->scalo1))->lists('city');
				$scalo1[$key]	 		= $scalo1Name[$key][0];		
			}else{
				$scalo1[$key]	 		= '';	
			}
			if($flights[$key]->scalo2!=''){
				$scalo2Name[$key]   	= DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->scalo2))->lists('city');
				$scalo2[$key]	 	   	= $scalo2Name[$key][0];	
			}else{
				$scalo2[$key]	 	  	= '';	
			}
			if($flights[$key]->scalo3!=''){
				$scalo3Name[$key]   	= DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->scalo3))->lists('city');
				$scalo3[$key]	 		= $scalo3Name[$key][0];	
			}else{
				$scalo3[$key]  			= '';	
			}
			
			//pictures
			/*if($flights[$key]->bagpicture1!=''){
				$flights[$key]->bagpicture1 = URL::to('/').'/uploads/'.$flights[$key]->bagpicture1;
			}else{
				$flights[$key]->bagpicture1 = '';
			}
			
			if($flights[$key]->bagpicture2!=''){
				$flights[$key]->bagpicture2 = URL::to('/').'/uploads/'.$flights[$key]->bagpicture2;
			}else{
				$flights[$key]->bagpicture2 = '';
			}
			
			if($flights[$key]->bagpicture3!=''){
				$flights[$key]->bagpicture3 = URL::to('/').'/uploads/'.$flights[$key]->bagpicture3;
			}else{
				$flights[$key]->bagpicture3 = '';
			}*/
			
			
			$data[] = array(
							    'idbag'	 		 => $flights[$key]->idbag,
							    'idclient'	 	 => $flights[$key]->idclient,
								'idclaim'	 	 => $flights[$key]->idclaim,
							    'depport'	 	 => @$depportName[$key][0],
							    'arrport'	 	 => @$arrportName[$key][0],
							    'depdate' 		 => date('d-m-Y',$flights[$key]->depdate),
							    'scalo1' 		 => $scalo1[$key],
							    'scalo2' 		 => $scalo2[$key],
							    'scalo3' 		 => $scalo3[$key],
							    'airline' 		 => $flights[$key]->airline,
							    
								
								'transaction_id' => $flights[$key]->transaction_id,
								'paytype'	 	 => $flights[$key]->paytype,
								'payment_date'	 => date('d-m-Y', $flights[$key]->payment_date),
								
								'card_id' 	 	 => $flights[$key]->card_id,
								'card_color' 	 => $flights[$key]->card_color,
								
								
								'smartcardcode'	 => $flights[$key]->smartcardcode,
								'name'	 		 => $flights[$key]->bagname,
								'brand'	 		 => $flights[$key]->bagbrand,
								'color'			 => $flights[$key]->bagcolor,
								'description'	 => $flights[$key]->bagdescription,
								'picture1'	 	 => $flights[$key]->bagpicture1,
								'picture2'	 	 => $flights[$key]->bagpicture2,
								'picture3'	 	 => $flights[$key]->bagpicture3,
								'airlinetag' 	 => $flights[$key]->airlinetag,
								'status'	 	 => $flights[$key]->flightstatus,
								'tag_image'	 	 => $flights[$key]->tag_image,
								
								'date_expiration'	 => $flights[$key]->date_expiration,								
								'flag_status'	 => $flights[$key]->flag_status
						   );
		}
		if(!empty($flights)){
			/*$successData = array('status' => 1, 'referer' => 'myflights', 'msg' => 'Flights view', 'flights' => $data);
			return Response::json($successData, 200);*/
			$this -> layout -> content = View::make('users.listflights', array('flights'=>$data));
		}else{
			//$errorData = array('status' => 0, 'referer' => 'myflights', 'msg' => 'No flights available!');
			//return Response::json($errorData, 200);
			$this -> layout -> content = View::make('users.listflights', array('flights'=> ''));
		}
		
		
	}
	
	//change the status of claims when lost 
	function postChangestatus()
	{
		$validator = Validator::make(Input::all(), Claimsbag::$rules_status);
		if ($validator -> passes()) {
			$claims 				= Claimsbag::find(Input::get('idbag'));
			$claims->flightstatus   = Input::get('status');
			$lost	=	true;
			if(Input::get('status')=='act'){
				$claims->flag_status   = 1;
				$lost	=	false;
			}else{
				$claims->flag_status   = 0;
			}
			$claims->save();
			$client	=	Clients::find(Session::get('idclient'));
			$name	=	$client->name;
			$tomail	=	$client->email;
			//$tomail	=	'arul258013@gmail.com';
			
			Session::put('updatebagsemail', $tomail);	
			if($lost == true)
			{		
				Mail::send('client.sendmailtouser_updatebags', array('name'=>$name,'idbag'=>Input::get('idbag'),'bagdetails'=>$claims,'lost'=>$lost), function($message){
						$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject(trans('emailtemplet.sub_updatebags'));
				});
			}
			else{
				Mail::send('client.sendmailtouser_updatebags', array('name'=>$name,'idbag'=>Input::get('idbag'),'bagdetails'=>$claims,'lost'=>$lost), function($message){
							$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject(trans('emailtemplet.sub_updatebags_1'));
				});
			}
			
			Session::forget('updatebagsemail');
			
			$successData = array('status' => 1, 'referer' => 'changestatus', 'msg' => 'Claim updated!', 'flightstatus'=>$claims->flightstatus, 'flag_status'=>$claims->flag_status);
			return Response::json($successData, 200);
		}else{
			$errorData = array('status' => 0, 'referer' => 'changestatus', 'msg' => 'Error in validation!');
			return Response::json($errorData, 200);
		}
	}
	
	//bring data by status
	
	public function getChangeflight($status) {
			
		$flights = DB::table('claims_bag')
									->leftJoin('sfb_smarttransactions', 'claims_bag.idbag', '=', 'sfb_smarttransactions.idbag')
									->leftJoin('sfb_smartcards', 'sfb_smarttransactions.rechargecard_id', '=', 'sfb_smartcards.card_id')
									->where('claims_bag.flightstatus', 'LIKE', '%'.$status.'%')
									->whereRaw('claims_bag.idclient = ? and claims_bag.safebagcode is NULL', array(Session::get('idclient')))
						            ->get();
									
						            
		$queries = DB::getQueryLog();
		$last_query = end($queries);
		//print_r($last_query);die;
		//print_r($flights);die;
		foreach($flights as $key=>$value){
			
			if($flights[$key]->depport!='' && !empty($flights[$key]->depport)){
				$depportName[$key]  = DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->depport))->lists('city');
				//print_r($last_query);die;	
			}else{
				$depportName[$key][0] = '';
			}
			if($flights[$key]->arrport!='' && !empty($flights[$key]->arrport)){
				$arrportName[$key]  = DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->arrport))->lists('city');	
			}else{
				$arrportName[$key][0]  = '';
			}
			
			if($flights[$key]->scalo1!=''){
				$scalo1Name[$key]	    = DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->scalo1))->lists('city');
				$scalo1[$key]	 		= $scalo1Name[$key][0];		
			}else{
				$scalo1[$key]	 		= '';	
			}
			if($flights[$key]->scalo2!=''){
				$scalo2Name[$key]   	= DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->scalo2))->lists('city');
				$scalo2[$key]	 	   	= $scalo2Name[$key][0];	
			}else{
				$scalo2[$key]	 	  	= '';	
			}
			if($flights[$key]->scalo3!=''){
				$scalo3Name[$key]   	= DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->scalo3))->lists('city');
				$scalo3[$key]	 		= $scalo3Name[$key][0];	
			}else{
				$scalo3[$key]  			= '';	
			}
			
			
			$data[] = array(
							    'idbag'	 		 => $flights[$key]->idbag,
							    'idclient'	 	 => $flights[$key]->idclient,
								'idclaim'	 	 => $flights[$key]->idclaim,
							    'depport'	 	 => @$depportName[$key][0],
							    'arrport'	 	 => @$arrportName[$key][0],
							    'depdate' 		 => date('d-m-Y',$flights[$key]->depdate),
							    'scalo1' 		 => $scalo1[$key],
							    'scalo2' 		 => $scalo2[$key],
							    'scalo3' 		 => $scalo3[$key],
							    'airline' 		 => $flights[$key]->airline,
							    
								
								'transaction_id' => $flights[$key]->transaction_id,
								'paytype'	 	 => $flights[$key]->paytype,
								'payment_date'	 => date('d-m-Y', $flights[$key]->payment_date),
								
								'card_id' 	 	 => $flights[$key]->card_id,
								'card_color' 	 => $flights[$key]->card_color,
								
								
								'smartcardcode'	 => $flights[$key]->smartcardcode,
								'name'	 		 => $flights[$key]->bagname,
								'brand'	 		 => $flights[$key]->bagbrand,
								'color'			 => $flights[$key]->bagcolor,
								'description'	 => $flights[$key]->bagdescription,
								'picture1'	 	 => $flights[$key]->bagpicture1,
								'picture2'	 	 => $flights[$key]->bagpicture2,
								'picture3'	 	 => $flights[$key]->bagpicture3,
								'airlinetag' 	 => $flights[$key]->airlinetag,
								'status'	 	 => $flights[$key]->flightstatus,
								'tag_image' 	 => $flights[$key]->tag_image,
								
								'date_expiration'	 => $flights[$key]->date_expiration,								
								'flag_status'	 => $flights[$key]->flag_status
						   );
		}
		if(!empty($flights)){
			
			return View::make('users.changeflight', array('flights'=>$data));
		}else{
			return View::make('users.changeflight', array('flights'=> ''));
		}
		
		
	}
	
	//get coiuntry fo coutry code
	public function getCountry($ccode) {
		$country = Country::where('country_code', '=', $ccode) -> first();
		if ( !empty($country)){
			return $country -> country_name;
		} else {
			return false;
		}

	}
	public function getLogout() {
		//Auth::logout();
		if (Session::get('idclient') !='' && Session::get('email')!='' )
		{
		$userdata = array('idclient', 'name', 'surname', 'country', 'currency', 'access_token', 'city', 'province', 'address', 'zip', 'email', 'phone', 'fax', 'mobile');
		foreach($userdata as $k=>$v):
			Session::forget($userdata[$k]);
		endforeach;	
		
		//return Redirect::to('/')->with(array('message' => 'Your are now logged out!','success'=>0));
		return Redirect::to('/')->with(array('message' => 'Your are now logged out!','success'=>0));
		}else{
			return Redirect::to('/');
		}
	}
	
}

?>
