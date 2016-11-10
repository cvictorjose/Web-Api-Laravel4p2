<?php
class WsControllers extends BaseController {
		
		
	public function __construct()
    {
        //$this -> beforeFilter('csrf', array('on' => 'post'));

        //$this->beforeFilter('csrf', array('on' => 'post'));

        //$this->afterFilter('log', array('only' =>array('fooAction', 'barAction')));
         /*$this->beforeFilter(function($route) {
		        $param = $route->getParameter('three');
		        if ( ! empty($param) )
		        {
		            App::abort(404);            
		        }
		    });*/
    }	
	
	public function missingMethod($parameters = array())
	{
		return Response::view('404', array(), 404);
	}
	
	public function getIndex() {

		return "arrived to ws development";

	}

	

	//paypal currencies of app
	public function getPaypalcurrencies($cc) {
		$currenciesArr = array('EUR' => array('name' => "Italian Euro", 'symbol' => "€", 'ASCII' => "&#128;", 'cc' => 'EUR'), 'AUD' => array('name' => "Australian Dollar", 'symbol' => "A$", 'ASCII' => "A&#36;", 'cc' => 'AUD'), 'BRL' => array('name' => "Brazilian Real", 'symbol' => "R$", 'ASCII' => "", 'cc' => 'BRL'), 'CAD' => array('name' => "Canadian Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'CAD'), 'CZK' => array('name' => "Czech Koruna", 'symbol' => "Kč", 'ASCII' => "", 'cc' => 'CZK'), 'DKK' => array('name' => "Danish Krone", 'symbol' => "Kr", 'ASCII' => "", 'cc' => 'DKK'), 'HKD' => array('name' => "Hong Kong Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'HKD'), 'HUF' => array('name' => "Hungarian Forint", 'symbol' => "Ft", 'ASCII' => "", 'cc' => 'HUF'), 'ILS' => array('name' => "Israeli New Sheqel", 'symbol' => "₪", 'ASCII' => "&#8361;", 'cc' => 'ILS'), 'JPY' => array('name' => "Japanese Yen", 'symbol' => "Â¥", 'ASCII' => "&#165;", 'cc' => 'JPY'), 'MXN' => array('name' => "Mexican Peso", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'MXN'), 'NOK' => array('name' => "Norwegian Krone", 'symbol' => "Kr", 'ASCII' => "", 'cc' => 'NOK'), 'NZD' => array('name' => "New Zealand Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'NZD'), 'PHP' => array('name' => "Philippine Peso", 'symbol' => "₱", 'ASCII' => "", 'cc' => 'PHP'), 'PLN' => array('name' => "Polish Zloty", 'symbol' => "zł", 'ASCII' => "", 'cc' => 'PLN'), 'GBP' => array('name' => "Pound Sterling", 'symbol' => "£", 'ASCII' => "&#163;", 'cc' => 'GBP'), 'RUB' => array('name' => "Russian Ruble", 'symbol' => "ք", 'ASCII' => "&#8381;", 'cc' => 'RUB'), 'SGD' => array('name' => "Singapore Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'SGD'), 'SEK' => array('name' => "Swedish Krona", 'symbol' => "kr", 'ASCII' => "", 'cc' => 'SEK'), 'CHF' => array('name' => "Swiss Franc", 'symbol' => "Fr.", 'ASCII' => "", 'cc' => 'CHF'), 'TWD' => array('name' => "Taiwan New Dollar", 'symbol' => "NT$", 'ASCII' => "NT&#36;", 'cc' => 'TWD'), 'THB' => array('name' => "Thai Baht", 'symbol' => "฿", 'ASCII' => "&#3647;", 'cc' => 'THB'), 'USD' => array('name' => "U.S. Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'USD'));

		return $currenciesArr[$cc];

	}

	//get coiuntry fo coutry code
	public function getCountry($ccode) {
		$country = Country::where('country_code', '=', $ccode) -> first();
		if ( ! $country->isEmpty() ){
			return $country -> country_name;
		} else {
			return false;
		}

	}

	//getbags
	public function getBagsbyidclient($idclient) {
		$bags = Claimsbag::whereRaw('idclient = ? and idclaim > 0', array($idclient)) -> first();
		
		if ( ! $bags->isEmpty() ){
			return $bags;
		} else {
			return false;
		}

	}
	
	//bag management 
	//get all bags of user
	public function getBags($idclient) {
		
		$bags = Bags::where('idclient', '=', $idclient) -> get();
		
		if ( ! $bags->isEmpty() ){
			
			foreach($bags as $key=>$value){
				
				$data[] = array(
								'bag_id' 		 => $bags[$key]->bag_id,
								'name'	 		 => $bags[$key]->name,
								'brand'	 		 => $bags[$key]->brand,
								'color'			 => $bags[$key]->color,
								'description'	 => $bags[$key]->description,
								/*'picture1'	 	 => ($bags[$key]->picture1 !='') ? URL::to('/').'/uploads/'.$bags[$key]->picture1 : '',
								'picture2'	 	 => ($bags[$key]->picture2 !='') ? URL::to('/').'/uploads/'.$bags[$key]->picture2 : '',
								'picture3'	 	 => ($bags[$key]->picture3 !='') ? URL::to('/').'/uploads/'.$bags[$key]->picture3 : ''*/
								'picture1'	 	 => ($bags[$key]->picture1 !='') ? asset('uploads/'.$bags[$key]->picture1) : '',
								'picture2'	 	 => ($bags[$key]->picture2 !='') ? asset('uploads/'.$bags[$key]->picture2) : '',
								'picture3'	 	 => ($bags[$key]->picture3 !='') ? asset('uploads/'.$bags[$key]->picture3) : ''
								); 
			}
			
			$successData = array('status' => 1, 'referer' => 'bags', 'msg' => 'Bags view', 'bags' => $data);
			return Response::json($successData, 200);
		}else{
			$errorData = array('status' => 0, 'referer' => 'bags', 'msg' => 'No bags available!');
			return Response::json($errorData, 200);
		}
	}
	
	public function getBagsform() {
		 	
		return View::make('admin.bagform');
	}
	
	//add bag
	public function postAddbag() {
		$validator = Validator::make(Input::all(), Bags::$rules_registerbags);
		if ($validator -> passes()) {
			
			$destinationPath = 'uploads';
			//$mime 		= Input::file('picture1')->getMimeType();
			$allowedTypes = array('jpeg', 'jpg', 'gif', 'png', 'ico');
			
			if (Input::hasFile('picture1'))
			{
				$ext_pic1 	= Input::file('picture1')->getClientOriginalExtension();
				$size_pic1 	= Input::file('picture1')->getSize();
				if(in_array($ext_pic1,$allowedTypes) && $size_pic1 <= 100000){
					$filename_pic1  = str_random(12).'.'.$ext_pic1;		
				  	$upload_pic1    = Input::file('picture1')->move($destinationPath, $filename_pic1);
				  	
				}else{
					$filename_pic1	  = ''; 
					
				}
				  
			}else{
				  	$filename_pic1	  = ''; 
					
			}
			
			if (Input::hasFile('picture2'))
			{
				$ext_pic2 	= Input::file('picture2')->getClientOriginalExtension();
				$size_pic2 	= Input::file('picture2')->getSize();
				if(in_array($ext_pic2,$allowedTypes) && $size_pic2 <= 100000){
				  	$filename_pic2  = str_random(12).'.'.$ext_pic2;
				  	$upload_pic2    = Input::file('picture2')->move($destinationPath, $filename_pic2);
				}else{
					$filename_pic2	  = ''; 
				}
				 
			}else{
				 	$filename_pic2	  = ''; 
			}
			
			if (Input::hasFile('picture3'))
			{
				$ext_pic3 	= Input::file('picture3')->getClientOriginalExtension();
				$size_pic3 	= Input::file('picture3')->getSize();
				if(in_array($ext_pic3,$allowedTypes) && $size_pic3 <= 100000){
				  	$filename_pic3  = str_random(12).'.'.$ext_pic3;		
				  	$upload_pic3    = Input::file('picture3')->move($destinationPath, $filename_pic3);
				}else{
					$filename_pic3	  = ''; 
				}
				  
			}else{
				  	$filename_pic3	  = ''; 
			}

			$bag = new Bags;
			$bag -> idclient 	= Input::get('idclient');
			$bag -> name 		= Input::get('name');
			$bag -> brand 		= Input::get('brand');
			$bag -> color 		= Input::get('color');
			$bag -> description	= Input::get('description');
			$bag -> picture1	= $filename_pic1;
			$bag -> picture2	= $filename_pic2;
			$bag -> picture3	= $filename_pic3;
			$bag -> save();
			
			$successData = array('status' => 1, 'referer' => 'addbags', 'msg' => 'Bags added successfully', 'bag_id' => DB::getPdo()->lastInsertId());
			return Response::json($successData, 200);
		}else{
			$errorData = array('status' => 0, 'referer' => 'addbags', 'msg' => 'Validation error!');
			return Response::json($errorData, 200);
		}
	}
	
	//update bag
	public function postUpdatebag() {
		
		$validator = Validator::make(Input::all(), Bags::$rules_updatebags);
		if ($validator -> passes()) {
			
			$destinationPath = 'uploads';
			$allowedTypes = array('jpeg', 'jpg', 'gif', 'png', 'ico');
			
			$bag = Bags::find(Input::get('bag_id'));
			
			
			if (Input::hasFile('picture1'))
			{
				$ext_pic1 	= Input::file('picture1')->getClientOriginalExtension();
				$size_pic1 	= Input::file('picture1')->getSize();
				if(in_array($ext_pic1,$allowedTypes) && $size_pic1 <= 100000){
					$filename_pic1  = str_random(12).'.'.$ext_pic1;		
				  	$upload_pic1    = Input::file('picture1')->move($destinationPath, $filename_pic1);
				  	
				}else{
					$filename_pic1	  = $bag -> picture1; 
				}
				  
			}else{
				  	$filename_pic1	  = $bag -> picture1; 
			}
			
			if (Input::hasFile('picture2'))
			{
				$ext_pic2 	= Input::file('picture2')->getClientOriginalExtension();
				$size_pic2 	= Input::file('picture2')->getSize();
				if(in_array($ext_pic2,$allowedTypes) && $size_pic2 <= 100000){
				  	$filename_pic2  = str_random(12).'.'.$ext_pic2;
				  	$upload_pic2    = Input::file('picture2')->move($destinationPath, $filename_pic2);
				}else{
					$filename_pic2	  = $bag -> picture2; 
				}
				 
			}else{
				 	$filename_pic2	  = $bag -> picture2; 
			}
			
			if (Input::hasFile('picture3'))
			{
				$ext_pic3 	= Input::file('picture3')->getClientOriginalExtension();
				$size_pic3 	= Input::file('picture3')->getSize();
				if(in_array($ext_pic3,$allowedTypes) && $size_pic3 <= 100000){
				  	$filename_pic3  = str_random(12).'.'.$ext_pic3;		
				  	$upload_pic3    = Input::file('picture3')->move($destinationPath, $filename_pic3);
				}else{
					$filename_pic3	  = $bag -> picture3; 
				}
				  
			}else{
				  	$filename_pic3	  = $bag -> picture3; 
			}

			
			
			//print_r($bag);die;
			if (!empty($bag)){
				$bag -> name 		= Input::get('name');
				$bag -> brand 		= Input::get('brand');
				$bag -> color 		= Input::get('color');
				$bag -> description	= Input::get('description');
				$bag -> picture1	= $filename_pic1;
				$bag -> picture2	= $filename_pic2;
				$bag -> picture3	= $filename_pic3;
				$bag -> save();
				$successData = array('status' => 1, 'referer' => 'updatebags', 'msg' => 'Bags updated successfully');
				return Response::json($successData, 200);
				
			}else{
				$errorData = array('status' => 0, 'referer' => 'updatebags', 'msg' => 'bag not exists!');
				return Response::json($errorData, 200);
			}	
			
			
		}else{
			$errorData = array('status' => 0, 'referer' => 'updatebags', 'msg' => 'Validation error!');
			return Response::json($errorData, 200);
		}
	}

	//delete a bag
	public function postDeletebag()
	{
			$validator = Validator::make(Input::all(), Bags::$rules_updatebags);
			if ($validator -> passes()) {
				$success = Bags::destroy(Input::get('bag_id'));
				if($success==1){
					$successData = array('status' => 1, 'referer' => 'deletebag', 'msg' => 'Bags deleted successfully');
					return Response::json($successData, 200);
				}else{
					$errorData = array('status' => 0, 'referer' => 'deletebag', 'msg' => 'Error in deleting of bag_id not exists!');
			    	return Response::json($errorData, 200);
				}
				
			}else{
				$errorData = array('status' => 0, 'referer' => 'deletebag', 'msg' => 'Validation error!');
			    return Response::json($errorData, 200);
			}
	} 	
	//card management
	
	//check the card number and response card details
		public function postCheckcard() {
		
		$validator = Validator::make(Input::all(), Cards::$rules_five);
		if ($validator -> passes()) {
			
			$existsCheck = DB::select('select * from sfb_smartcards where idclient = ?  and card_number = ? ', array(Input::get('idclient'), Input::get('card_number')));
			if (!empty($existsCheck)) {
					$errorData = array('status' => 0, 'referer' => 'checkcard', 'msg' => 'card already assigned !');
					return Response::json($errorData, 200);
				
			}
			
			$requestCard = Cards::where('card_number', '=', Input::get('card_number')) -> first();
		
			if(!empty($requestCard) && $requestCard->idclient=='0'){
				$card = Cards::find($requestCard->card_id);
				
				//print_r($card);die;
				if (!empty($card)){
					
					$successData = array('status' => 1, 'referer' => 'checkcard', 'msg' => 'Card available!' , 'data'=>$card);
					return Response::json($successData, 200);
					
				}else{
					$errorData = array('status' => 0, 'referer' => 'checkcard', 'msg' => 'Card does not exist or already assigned to a user!');
					return Response::json($errorData, 200);
				}
			}else{
				$errorData = array('status' => 0, 'referer' => 'checkcard', 'msg' => 'Card does not exist or already assigned to a user!');
				return Response::json($errorData, 200);
			}
				
			
		}else{
			$errorData = array('status' => 0, 'referer' => 'checkcard', 'msg' => 'Validation error!');
			return Response::json($errorData, 200);
		}
	}
	
	//register the card to app
	public function postAddcard() {
		
		$validator = Validator::make(Input::all(), Cards::$rules_five);
		if ($validator -> passes()) {
			
			$existsCheck = DB::select('select * from sfb_smartcards where idclient = ?  and card_number = ? ', array(Input::get('idclient'), Input::get('card_number')));
			if (!empty($existsCheck)) {
					$errorData = array('status' => 0, 'referer' => 'addcard', 'msg' => 'card already assigned !');
					return Response::json($errorData, 200);
				
			}
			
			$requestCard = Cards::where('card_number', '=', Input::get('card_number')) -> first();
		
			if(!empty($requestCard) && $requestCard->idclient=='0'){
				$card = Cards::find($requestCard->card_id);
				
				//print_r($card);die;
				if (!empty($card)){
					$card -> idclient 		= Input::get('idclient');
					$card -> save();
					/*Session::put('lang', 'en');
					$lang = Session::get('lang');
					App::setLocale($lang);*/
					
					$client	=	Clients::find($card->idclient);
					$name	=	$client->name.' '.$client->surname;
					$tomail	=	$client->email;
					//$tomail	=	'arul258013@gmail.com';
					
					Session::put('updatebagsemail', $tomail);
					/*Session::put('lang', 'it');
					$lang = Session::get('lang');
					App::setLocale($lang);*/
					Mail::send('client.sendmailtouser_regiterbag', array('name'=>$name,'card_number'=>Input::get('card_number'),'carddetails'=>$card), function($message){
							$message->to(Session::get('updatebagsemail'))->cc('colella@tech-armada.net')->subject('[Safe-bag.com] Regiser Card');
					});
					Session::forget('updatebagsemail');
					
					$successData = array('status' => 1, 'referer' => 'addcard', 'msg' => 'Card added successfully');
					return Response::json($successData, 200);
					
				}else{
					$errorData = array('status' => 0, 'referer' => 'addcard', 'msg' => 'Card does not exist or already assigned to a user!');
					return Response::json($errorData, 200);
				}
			}else{
				$errorData = array('status' => 0, 'referer' => 'addcard', 'msg' => 'Card does not exist or already assigned to a user!');
				return Response::json($errorData, 200);
			}
				
			
		}else{
			$errorData = array('status' => 0, 'referer' => 'addcard', 'msg' => 'Validation error!');
			return Response::json($errorData, 200);
		}
	}

	


	//show brands
	public function getBrands() {
		$brands = Brands::select('brand_name','brand_id','status')->where('status','=','1')->get();
		if($brands!=''){
			$successData = array('status' => 1, 'referer' => 'brands', 'brands' => $brands);
			return Response::json($successData, 200);	
		}else{
			$errorData = array('status' => 0, 'referer' => 'brands', 'msg' => 'No brands available ');
			return Response::json($errorData, 200);
		}
		
		
	}
	
	public function postDeletecard() {
		
		$validator = Validator::make(Input::all(), Cards::$rules_six);
		if ($validator -> passes()) {
			
				$existsCheck = DB::select('select * from sfb_smartcards where idclient = ?  and card_id = ? and cardstatus = 1', array(Input::get('idclient'), Input::get('card_id')));
				
				if (!empty($existsCheck)) {
					$card = Cards::find(Input::get('card_id'));
					$card -> cardstatus 	= '0';
					$card -> flightnumbers	= '1';
					$card -> save();
					$successData = array('status' => 1, 'referer' => 'deletecard', 'msg' => 'Card delete successfully');
					return Response::json($successData, 200);
				}else{
					$errorData = array('status' => 0, 'referer' => 'deletecard', 'msg' => 'card not exists or user not exists!');
					return Response::json($errorData, 200);
				}
		}else{
					$errorData = array('status' => 0, 'referer' => 'deletecard', 'msg' => 'validation error!');
					return Response::json($errorData, 200);
		}
		
	}
	//recharge a card
	public function postPay()
	{
		/*$bag 	= Claimsbag::find(Input::get('idbag'));
		$client	=	Clients::find(Input::get('idclient'));
		$name	=	$client->name.' '.$client->surname;
		//$tomail	=	$client->email;
		$tomail	=	'arul258013@gmail.com';
		
		Session::put('updatebagsemail', $tomail);
		Mail::send('client.sendmailtouser_registerbags', array('name'=>$name,'idbag'=>$bag->idbag,'bagdetails'=>$bag), function($message){
				$message->to(Session::get('updatebagsemail'))->cc('colella@tech-armada.net')->subject('[Safe-bag.com] Bags registration');
		});
		Session::forget('updatebagsemail');*/
		$validator = Validator::make(Input::all(), Transactions::$rules_one);
		if ($validator -> passes()) {
			
			if(Input::get('paytype') == 'cardcredit' )
			{
				
				$object = Bags::where('bag_id','=',Input::get('bag_id')) -> first();
				$card   = Cards::where('card_id','=',Input::get('rechargecard_id')) -> first();
		
				$bag = new  Claimsbag;
				$bag->idclient 			  = Input::get('idclient');
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
					$order -> rechargecard_id= Input::get('rechargecard_id');
					$order -> idclient		 = Input::get('idclient');
					$order -> payment_date   = strtotime(date('Y-m-d h:i:s'));
					$order -> device		 = Input::get('device');		
					
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
				$client	=	Clients::find(Input::get('idclient'));
				$name	=	$client->name.' '.$client->surname;
				$tomail	=	$client->email;
				//$tomail	=	'arul258013@gmail.com';
				
				Session::put('updatebagsemail', $tomail);
				Mail::send('client.sendmailtouser_registerbags', array('name'=>$name,'idbag'=>$bag->idbag,'bagdetails'=>$bagdetails), function($message){
						$message->to(Session::get('updatebagsemail'))->cc('colella@tech-armada.net')->subject('[Safe-bag.com] Bags registration');
				});
				Session::forget('updatebagsemail');
				$successData = array('status' => 1, 'referer' => 'pay', 'msg' => 'Payment with card credit successful');
				return Response::json($successData, 200);
			}elseif(Input::get('paytype') == 'cardrecharge'){
					
				//$package   = Packages::where('package_id','=',Input::get('package_id')) -> first();
				$package   = Packages::find(Input::get('package_id'));
				$order = new Transactions;
				$order -> paytype 		 = 'cardrecharge';
				$order -> transaction_id = Input::get('transaction_id');
				$order -> numflights     = $package->numflights;
				$order -> price			 = $package->price;
				$order -> currency		 = $package->currency;
				
				$order -> payment_date   = strtotime(date('Y-m-d h:i:s'));
				$order -> rechargecard_id= Input::get('rechargecard_id');
				$order -> idclient		 = Input::get('idclient');
				$order -> device		 = Input::get('device');		
				
				$order -> save();
				
				if(isset($order -> rechargecard_id) && $order->order_id != ''){
					$card = Cards::find($order -> rechargecard_id);
					$card -> flightnumbers	=  $card -> flightnumbers + Input::get('numflights');
					$order -> numflights 	=  $card -> flightnumbers;
					$card -> save();
				}
				
				$successData = array('status' => 1, 'referer' => 'pay', 'msg' => 'Recharge successful');
				return Response::json($successData, 200);
			
				}elseif(Input::get('paytype') == 'paypal'){
					
				//$object = DB::select('select * from sfb_smartbag where bag_id = ?', array(Input::get('bag_id')));
				$object = Bags::where('bag_id','=',Input::get('bag_id')) -> first();
				$card   = Cards::where('card_id','=',Input::get('rechargecard_id')) -> first();
		
				$bag = new  Claimsbag;
				$bag->idclient 			  = Input::get('idclient');
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
				//$bag->smartcardcode  	  = Input::get('card_number');
				if(!empty($card)){
					$bag->smartcardcode  	  = $card->card_number;
				}
				//$iataArr = array(Input::get('depport'), Input::get('arrport'), Input::get('scalo1'), Input::get('scalo2'), Input::get('scalo3'));
				
				//$bigprice = $this->getPrices($iataArr);
				
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
				
				if($bag->idbag != '' && Input::get('numflights') > '0'){
					
					$package   = Packages::where('package_id','=',Input::get('package_id')) -> first();
					
					$order = new Transactions;
					$order -> paytype 		 = 'cardrecharge';
					$order -> transaction_id = Input::get('transaction_id');
					$order -> idbag 		 = $bag->idbag;
					$order -> numflights     = Input::get('numflights');
					$order -> price			 = $package->price;
					$order -> currency		 = $package->currency;
					$order -> payment_date   = strtotime(date('Y-m-d h:i:s'));
					$order -> rechargecard_id= Input::get('rechargecard_id');
					$order -> idclient		 = Input::get('idclient');	
					$order -> device		 = Input::get('device');	
					$order -> save();
					
					
					$order = new Transactions;
					$order -> paytype 		 = 'cardcredit';
					$order -> idbag 		 = $bag->idbag;
					$order -> rechargecard_id= Input::get('rechargecard_id');
					$order -> numflights     = Input::get('numflights');
					$order -> idclient		 = Input::get('idclient');	
					$order -> payment_date   = strtotime(date('Y-m-d h:i:s'));
					$order -> device		 = Input::get('device');	
					$order -> save();
					
				}elseif($bag->idbag != '' && Input::get('numflights') == '0'){
					$order = new Transactions;
					$order -> paytype 		 = 'paypal';
					$order -> idbag 		 = $bag->idbag;
					$order -> transaction_id = Input::get('transaction_id');
					//$order -> price			 = Input::get('price');
					//$order -> currency		 = Input::get('currency');
					$order -> price			 = Input::get('actual_price');
					$order -> currency		 = Input::get('actual_currency');
					$order -> numflights     = Input::get('numflights');
					$order -> payment_date   = strtotime(date('Y-m-d h:i:s'));
					$order -> rechargecard_id= Input::get('rechargecard_id');
					$order -> idclient		 = Input::get('idclient');
					$order -> device		 = Input::get('device');		
					$order -> save();
				}
				
				if(isset($order -> rechargecard_id) && $order->order_id != ''){
					$card = Cards::find($order -> rechargecard_id);
					$card -> flightnumbers	=  $card -> flightnumbers + Input::get('numflights');
					$card -> save();
				}
				$bagdetails 	= Claimsbag::find($bag->idbag);
				$client	=	Clients::find(Input::get('idclient'));
				$name	=	$client->name.' '.$client->surname;
				$tomail	=	$client->email;
				//$tomail	=	'arul258013@gmail.com';
				
				Session::put('updatebagsemail', $tomail);
				Mail::send('client.sendmailtouser_registerbags', array('name'=>$name,'idbag'=>$bag->idbag,'bagdetails'=>$bagdetails), function($message){
						$message->to(Session::get('updatebagsemail'))->cc('colella@tech-armada.net')->subject('[Safe-bag.com] Bags registration');
				});
				Session::forget('updatebagsemail');
				$successData = array('status' => 1, 'referer' => 'pay', 'msg' => 'Paypal payment successful');
				return Response::json($successData, 200);
			}else{
				$errorData = array('status' => 0, 'referer' => 'pay', 'msg' => 'Paytype not matching!');
				return Response::json($errorData, 200);
			}
			
			
		}else{
			$errorData = array('status' => 0, 'referer' => 'pay', 'msg' => 'validation error!');
			return Response::json($errorData, 200);
		}
	}
	
	//get user cards
	public function getCards($idclient) {
		
		$cards = DB::select('select * from sfb_smartcards where idclient = ?  and cardstatus = 1 ', array($idclient));
		if (!empty($cards)) {
			$successData = array('status' => 1, 'referer' => 'cards', 'msg' => 'Cards view', 'cards' => $cards);
			return Response::json($successData, 200);
		}else{
			$errorData = array('status' => 0, 'referer' => 'cards', 'msg' => 'No cards available!');
			return Response::json($errorData, 200);
		}
	}
	//card management ends
	
	//packages management
	public function getPackages($idclient) {
		
		if(isset($idclient) && is_numeric($idclient)){
			$user 	  		= Clients::where('idclient', '=' , $idclient) -> first();
			$currency_code  =  $user->currency;
            $ccdetails      =  $this->getPaypalcurrencies($user->currency);
            $symbol         =  $ccdetails['symbol'];
		}
		
		$packages = Packages::where('status','=',1)->orderBy('package_id', 'DESC') -> get();
		
		if ( ! $packages->isEmpty() ){
			foreach ($packages as $key => $value) {
				$rates_ac_to_products[$key] = Exchange::where('currency_code','=',$packages[$key]->currency)->first();

                switch($currency_code){
                    case 'EUR' : $exrate[$key] = $rates_ac_to_products[$key]->exrate_EUR; break;
                    case 'USD' : $exrate[$key] = $rates_ac_to_products[$key]->exrate_USD; break;
                    case 'CHF' : $exrate[$key] = $rates_ac_to_products[$key]->exrate_CHF; break;
					case 'BRL' : $exrate[$key] = $rates_ac_to_products[$key]->exrate_BRL; break;
                    case 'RUB' : $exrate[$key] = $rates_ac_to_products[$key]->exrate_RUB; break;
                    case 'MXN' : $exrate[$key] = $rates_ac_to_products[$key]->exrate_MXN; break;
					case 'GBP' : $exrate[$key] = $rates_ac_to_products[$key]->exrate_GBP; break;
                }
				
				if($currency_code == $packages[$key]->currency){
					$price[$key]   = (float)$packages[$key]->price * (float)$exrate[$key];
				}else{
					$price[$key]   = (float)$packages[$key]->price * (float)$exrate[$key] * floatval('1.10');
				}
				
				$data[] = array(
								'package_id' => $packages[$key]->package_id,
								'price' 	 => number_format(round($price[$key], 1), 2),
								'currency' 	 => $currency_code,
								'symbol' 	 => $symbol,
								'numflights' => $packages[$key]->numflights
								);
			}
			$successData = array('status' => 1, 'referer' => 'packages', 'msg' => 'Packages view', 'pakckages' => $data);
			return Response::json($successData, 200);
		}else{
			$errorData = array('status' => 0, 'referer' => 'packages', 'msg' => 'No packages available!');
			return Response::json($errorData, 200);
		}
	}
	
	//risk prices management
	public function postPrices() {
			
		$idclient = Input::get('idclient');
		$depport  = Input::get('depport');
		$arrport  = Input::get('arrport');
		$scalo1   = Input::get('scalo1');
		$scalo2   = Input::get('scalo2');
		$scalo3   = Input::get('scalo3');
			
		if(isset($idclient) && is_numeric($idclient)){
			$user 	  		=  Clients::where('idclient', '=' , $idclient) -> first();
			$currency_code  =  $user->currency;
            $ccdetails      =  $this->getPaypalcurrencies($user->currency);
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
					$addtional_price = $price * 0.9;
				}elseif(count($prices) == 4){
					$addtional_price = $price * 0.7;
				}elseif(count($prices) == 3){
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
					$addtional_price_1 = $actual_price * 0.9;
				}elseif(count($prices) == 4){
					$addtional_price_1 = $actual_price * 0.7;
				}elseif(count($prices) == 3){
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
			
			$successData = array('status' => 1, 'referer' => 'prices', 'msg' => 'Prices view', 'prices' => $finalPrice);
			return Response::json($successData, 200);
		}else{
			$errorData = array('status' => 0, 'referer' => 'prices', 'msg' => 'No prices available!');
			return Response::json($errorData, 200);
		}
	}
	
	
	
	
	//live exchange
	function getLiveyahooexchange($cc)
	{
		$ccData = array('EUR','CHF','USD','BRL','RUB','MXN','GBP' );

			switch($cc){
						case 'EUR' :
									//EUR exchanges
									foreach ($ccData as $key => $value) {
										//EUR - ALL
										$url = 'http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $cc . $value .'=X';
										$handle = @fopen($url, 'r');
							
										if ($handle) {
											$result = fgets($handle, 4096);
											$EUR_CONVERTED = explode(',',$result);
											fclose($handle);
										}
										
							
										$allData[$cc][$value] = $EUR_CONVERTED[1];
									}
			
						break;
			
						case 'CHF' :
									//CHF exchanges
									foreach ($ccData as $key => $value) {
										//CHF - ALL
										$url = 'http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $cc . $value .'=X';
										$handle = @fopen($url, 'r');
							
										if ($handle) {
											$result = fgets($handle, 4096);
											$CHF_CONVERTED = explode(',',$result);
											fclose($handle);
										}
										
							
										$allData[$cc][$value] = $CHF_CONVERTED[1];
									}
						break;
						
						case 'USD' :
									//USD exchanges
									foreach ($ccData as $key => $value) {
										//USD - ALL
										$url = 'http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $cc . $value .'=X';
										$handle = @fopen($url, 'r');
							
										if ($handle) {
											$result = fgets($handle, 4096);
											$USD_CONVERTED = explode(',',$result);
											fclose($handle);
										}
										
							
										$allData[$cc][$value] = $USD_CONVERTED[1];
									}
						break;
			
						case 'BRL' :
									//BRL exchanges
									foreach ($ccData as $key => $value) {
										//BRL - ALL
										$url = 'http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $cc . $value .'=X';
										$handle = @fopen($url, 'r');
							
										if ($handle) {
											$result = fgets($handle, 4096);
											$BRL_CONVERTED = explode(',',$result);
											fclose($handle);
										}
										
							
										$allData[$cc][$value] = $BRL_CONVERTED[1];
									}
						break;
			
						case 'RUB':
									//RUB exchanges
									foreach ($ccData as $key => $value) {
										//RUB - ALL
										$url = 'http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $cc . $value .'=X';
										$handle = @fopen($url, 'r');
							
										if ($handle) {
											$result = fgets($handle, 4096);
											$RUB_CONVERTED = explode(',',$result);
											fclose($handle);
										}
										
							
										$allData[$cc][$value] = $RUB_CONVERTED[1];
									}
						break;
							
						case 'MXN':
									//MXN exchanges
									foreach ($ccData as $key => $value) {
										//MXN - ALL
										$url = 'http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $cc . $value .'=X';
										$handle = @fopen($url, 'r');
							
										if ($handle) {
											$result = fgets($handle, 4096);
											$MXN_CONVERTED = explode(',',$result);
											fclose($handle);
										}
										
							
										$allData[$cc][$value] = $MXN_CONVERTED[1];
									}
						break;
			
						case 'GBP':
									//GBP exchanges
									foreach ($ccData as $key => $value) {
										//GBP - ALL
										$url = 'http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $cc . $value .'=X';
										$handle = @fopen($url, 'r');
							
										if ($handle) {
											$result = fgets($handle, 4096);
											$GBP_CONVERTED = explode(',',$result);
											fclose($handle);
										}
										
							
										$allData[$cc][$value] = $GBP_CONVERTED[1];
									}
						break;
			}
			echo "<pre>";
			print_r($allData);
			echo "</pre>";
			
			Exchange::destroy($cc);
			foreach($allData as $key=>$value){
				$exchange 				= new Exchange;
				$exchange->currency_code= $cc;
				$exchange->exrate_EUR	= $allData[$key]['EUR'];
				$exchange->exrate_CHF	= $allData[$key]['CHF'];
				$exchange->exrate_USD	= $allData[$key]['USD'];
				$exchange->exrate_BRL	= $allData[$key]['BRL'];
				$exchange->exrate_RUB	= $allData[$key]['RUB'];
				$exchange->exrate_MXN	= $allData[$key]['MXN'];
				$exchange->exrate_GBP	= $allData[$key]['GBP'];
				$exchange->save();
			}
	}

	//myflights
	
	function getMyflights($idclient)
	{
		//$flights = Claimsbag::whereRaw('idclient = ? and safebagcode is NULL', array($idclient))->get();
		$flights = DB::table('claims_bag')
									->leftJoin('sfb_smarttransactions', 'claims_bag.idbag', '=', 'sfb_smarttransactions.idbag')
									->leftJoin('sfb_smartcards', 'sfb_smarttransactions.rechargecard_id', '=', 'sfb_smartcards.card_id')
									->whereRaw('claims_bag.idclient = ? and claims_bag.safebagcode is NULL GROUP BY claims_bag.idbag', array($idclient))
									->orderBy('claims_bag.depdate', 'desc')
						            ->get();
									
						            
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
			if($flights[$key]->bagpicture1!=''){
				$flights[$key]->bagpicture1 = asset('uploads/'.$flights[$key]->bagpicture1) ; //URL::to('/').'/uploads/'.$flights[$key]->bagpicture1;
			}else{
				$flights[$key]->bagpicture1 = '';
			}
			
			if($flights[$key]->bagpicture2!=''){
				$flights[$key]->bagpicture2 = asset('uploads/'.$flights[$key]->bagpicture2); //URL::to('/').'/uploads/'.$flights[$key]->bagpicture2;
			}else{
				$flights[$key]->bagpicture2 = '';
			}
			
			if($flights[$key]->bagpicture3!=''){
				$flights[$key]->bagpicture3 = asset('uploads/'.$flights[$key]->bagpicture3); //URL::to('/').'/uploads/'.$flights[$key]->bagpicture3;
			}else{
				$flights[$key]->bagpicture3 = '';
			}
			
			if($flights[$key]->tag_image!=''){
				$flights[$key]->tag_image = asset('uploads/airlinetag/'.$flights[$key]->idclient.'-'.$flights[$key]->tag_image); //URL::to('/').'/uploads/airlinetag/'.$flights[$key]->idclient.'-'.$flights[$key]->tag_image;
			}else{
				$flights[$key]->tag_image = '';
			}
			
			
			//$airline  = $this->get
			$airlines = Airlines::where('idairline','=',$flights[$key]->airline)->get();
			//print_r($airlines[0]->name_airline);die;
			$data[] = array(
							    'idbag'	 		 => $flights[$key]->idbag,
							    'idclient'	 	 => $flights[$key]->idclient,
							    'depport'	 	 => @$depportName[$key][0],
							    'arrport'	 	 => @$arrportName[$key][0],
							    'depdate' 		 => date('d-m-Y',$flights[$key]->depdate),
								'scalo1' 		 => $scalo1[$key],
							    'scalo2' 		 => $scalo2[$key],
							    'scalo3' 		 => $scalo3[$key],
							    'airline' 		 => $airlines[0]->name_airline,
							    
								
								'transaction_id' => $flights[$key]->transaction_id,
								'paytype'	 	 => $flights[$key]->paytype,
								'payment_date'	 => date('d-m-Y', $flights[$key]->payment_date),
								
								'card_id' 	 	 => $flights[$key]->card_id,
								'card_color' 	 => $flights[$key]->card_color,
								
								
								'smartcardcode'	 => $flights[$key]->smartcardcode,
								'numflights'	 => $flights[$key]->flightnumbers,
								'name'	 		 => $flights[$key]->bagname,
								'brand'	 		 => $flights[$key]->bagbrand,
								'color'			 => $flights[$key]->bagcolor,
								'description'	 => $flights[$key]->bagdescription,
								'picture1'	 	 => $flights[$key]->bagpicture1,
								'picture2'	 	 => $flights[$key]->bagpicture2,
								'picture3'	 	 => $flights[$key]->bagpicture3,
								
								'tag_image'		 => $flights[$key]->tag_image,
								'airlinetag' 	 => $flights[$key]->airlinetag,
								
								'date_expiration'=> ($flights[$key]->date_expiration != '0') ? date('d-m-Y',$flights[$key]->date_expiration) : '',
								'status'	 	 => $flights[$key]->flightstatus,
								'flag_status' 	 => $flights[$key]->flag_status
						   );
		}
		if(!empty($flights)){
			$successData = array('status' => 1, 'referer' => 'myflights', 'msg' => 'Flights view', 'flights' => $data);
			return Response::json($successData, 200);
		}else{
			$errorData = array('status' => 0, 'referer' => 'myflights', 'msg' => 'No flights available!');
			return Response::json($errorData, 200);
		}
	}


	function getSetexpirestatus()
	{
		$today = strtotime(date('Y-m-d'));
		$allbags = Claimsbag::all();
		
		foreach($allbags as $allbag){
			//print_r($allbag->date_expiration);die;
			if($allbag->date_expiration !=  '0' && $allbag->date_expiration <=  $today){
				if($allbag->flightstatus=='actlost'){
					$affectedRows = DB::table('claims_bag')->where('date_expiration','=',$allbag->date_expiration)->where('flightstatus','=','actlost')->update(array('flightstatus' => 'explost'));
				}elseif($allbag->flightstatus=='act'){
					$affectedRows = DB::table('claims_bag')->where('date_expiration','=',$allbag->date_expiration)->where('flightstatus','=','act')->update(array('flightstatus' => 'exp'));
				}
				
			}
		}
		return 1;
	}
	
	


	//change the status of claims when lost 
	function postChangestatus()
	{
		$validator = Validator::make(Input::all(), Claimsbag::$rules_status);
		
		if ($validator -> passes()) {
			$claims 				= Claimsbag::find(Input::get('idbag'));
			if(Input::get('status')=='act'){
				$claims->flag_status   = '1';
			}
			$claims->flightstatus   = Input::get('status');
			$claims->save();
			$client	=	Clients::find($claims->idclient);
			$name	=	$client->name.' '.$client->surname;
			$tomail	=	$client->email;
			//$tomail	=	'arul258013@gmail.com';
			
			Session::put('updatebagsemail', $tomail);
			/*Session::put('lang', 'it');
			$lang = Session::get('lang');
			App::setLocale($lang);*/
			Mail::send('client.sendmailtouser_updatebags', array('name'=>$name,'idbag'=>Input::get('idbag'),'bagdetails'=>$claims), function($message){
					$message->to(Session::get('updatebagsemail'))->cc('colella@tech-armada.net')->subject('[Safe-bag.com] Bags Update');
			});
			Session::forget('updatebagsemail');
			if(Input::get('status')=='act'){
				$successData = array('status' => 1, 'referer' => 'changestatus', 'msg' => 'Way to go! We are happy you found your luggage.');
				return Response::json($successData, 200);
			}else{
				$successData = array('status' => 1, 'referer' => 'changestatus', 'msg' => ' We are sorry that your luggage is lost. Safe Bag is now searching for your luggage. Please check your email, we have sent you the instructions to follow.');
				return Response::json($successData, 200);
			}
			
			
			
		}else{
			$errorData = array('status' => 0, 'referer' => 'changestatus', 'msg' => 'Error in validation!');
			return Response::json($errorData, 200);
		}
	}
	
	//add airlinetag after bag added
	function postAddairlinetag()
	{
		$validator = Validator::make(Input::all(), Claimsbag::$rules_status);
		if ($validator -> passes()) {
			$destinationPath = 'uploads/airlinetag';
			$allowedTypes = array('jpeg', 'jpg', 'gif', 'png', 'ico');
			
			$claims 			= Claimsbag::find(Input::get('idbag'));
			
			if (Input::hasFile('tag_image'))
			{
				$ext_pic1 	= Input::file('tag_image')->getClientOriginalExtension();
				$size_pic1 	= Input::file('tag_image')->getSize();
				if(in_array($ext_pic1,$allowedTypes) && $size_pic1 <= 100000){
					$filename_pic1  = str_random(12).'.'.$ext_pic1;
					$folderImage    = $claims->idclient.'-'.$filename_pic1;		
				  	$upload_pic1    = Input::file('tag_image')->move($destinationPath, $folderImage);
				  	
				}else{
					$filename_pic1	  = ''; 
				}
				  
			}else{
				  	$filename_pic1	  = ''; 
			}
			//$claims->airlinetag = Input::get('airlinetag');
			$claims->tag_image = $filename_pic1;
			$claims->save();
			$successData = array('status' => 1, 'referer' => 'addairlinetag', 'img_url'=> asset('uploads/airlinetag/'.$folderImage)/*URL::to('/').'/uploads/airlinetag/'.$folderImage*/, 'msg' => 'Airlinetag added!');
			return Response::json($successData, 200);
		}else{
			$errorData = array('status' => 0, 'referer' => 'addairlinetag', 'msg' => 'Error in validation!');
			return Response::json($errorData, 200);
		}
	}
}
?>