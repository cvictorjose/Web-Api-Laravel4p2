<?php

/**
*  
*/

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class ClientController extends BaseController
{
	
	//protected $layout = "layouts.main";
	protected $layout = "layouts.main-register";
	private $_api_context;

	public function __construct() {
		//$this->beforeFilter('csrfreg', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('getDashboard')));
		
		// setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
		
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
		
		if (!Session::has('idclient')){
			Session::forget('id');
			Session::forget('email');
			Session::forget('name');
			Session::forget('userdetail');
		}
		
		
		$userdetail	=	Session::get('userdetail');
		if(!isset($userdetail['sh_address']) && Session::get('idclient') != ''){
			$clientship	= Clients::whereRaw('idclient = ?', array(Session::get('idclient')))->first() ;	
			$userdetail['sh_address']=$clientship['sh_address'];
			$userdetail['sh_city']=$clientship['sh_city'];
			$userdetail['sh_province']=$clientship['sh_province'];
			$userdetail['sh_country']=$clientship['sh_country'];
			$userdetail['sh_country1']=$this->getCountry($clientship['sh_country']);
			Session::put('userdetail', $userdetail);
		}
	}

	public function missingMethod($parameters = array())
	{
    	return Response::view('404', array(), 404);
	}
	
	// rest password
	public function getResetpassword(){
		$email	=	urldecode($_REQUEST['email']);
		$usr_resetpassword_hash	=	($_REQUEST['c']);	
		
		$client	= Clients::whereRaw('email =? and usr_resetpassword_hash =?', array($email,$usr_resetpassword_hash))->first() ;	
		if(!empty($client)){
			//Session::put('restpasswordemail',$email);
			$client->usr_resetpassword_hash = rand ( 10000 , 99999 );	
			$client->save();
		}
		else{
			return Redirect::action('HomeController@getIndex');
		}
		$this->layout->content = View::make('client.resetpassword', array('client' => $client, 'email'=>$email));
		
	}
	
	public function postResetpassword(){
		if (Session::has('userdetail')){
				return Response::json(array(
					'redirect' => true
				));				
				//return Redirect::to('home/index');
			}
		$friendly_names = array(			
			'email' => trans('frontend.email'),	
			'password' => trans('frontend.password'),
			'password_confirmation' => trans('frontend.password_confirmation'),		
		);
		
		$input	=	Input::all();
		
		$client	= Clients::whereRaw('email =?', array($input['email']))->first() ;	
		/*if(!empty($client)){
			return Response::json(array(
					'redirect' => true
				));		
		}*/
		$validator = Validator::make(Input::all(), Clients::$rules['resetpassword']);
		
		if($validator->fails()){
			
			return Response::json(array(
				'fail' => true,
				'errors' => $validator->getMessageBag()->toArray()
			));
		}
		else {
			$client->password = sha1(Input::get('password'));	
			if($client->save()){
				Session::put('idclient', $client->idclient);
				Session::put('name', $client->name);
				Session::put('email', $client->email);
				Session::put('userdetail', $client);
				
				Session::flash('success',1);
				Session::flash('message',trans('frontend.restpasswordsuccess'));  
					
					
				//return Redirect::to('client/payment');
				return Response::json(array(
				  'success' => true,
				  'email' => $client->email,
				  'idclient'    =>  $client->idclient
				));
			}
			else{
				return Response::json(array(
					'fail' => true,
					'errors' => $validator->getMessageBag()->toArray()
				));
			}
		}
		
		
		
	}
	
	// post forgot password
	public function postForgotpasword() {
		if (Session::has('userdetail')){
				return Response::json(array(
					'redirect' => true
				));				
				//return Redirect::to('home/index');
			}
		$friendly_names = array(			
			'email' => trans('frontend.email'),			
		);
		
		$input	=	Input::all();
		$validator = Validator::make(Input::all(), Clients::$rules['forgotpassword']);
		
		if($validator->fails()){
			
			return Response::json(array(
				'fail' => true,
				'errors' => $validator->getMessageBag()->toArray()
			));
		}
		else {
			$email	=	$input['email'];
			$client	= Clients::whereRaw('email =?', array($input['email']))->first() ;	
			if(empty($client)){
				$error	=	false;
				$validator->getMessageBag()->add('email', trans('frontend.email_not_exit'));
				return Response::json(array(
					'fail' => true,
					'errors' => $validator->getMessageBag()->toArray()
				));
			}
			else{
				
				$time = time();
			   	$hash = sha1($email.'String used to pad out small strings for a sha1 encryption'.'Other String used to pad out small strings for a sha1 encryption'.$time);
			   	//$retval = $this->dbcontroller->updateUserFieldEmail($email,"usr_resetpassword_hash",$hash);
				
				$client->usr_resetpassword_hash	=	$hash;
				$client->save();
				$encoded_email = urlencode($email);
				
				$body_url	=	URL::to('client/resetpassword')."?c=$hash&email=$encoded_email";
				Mail::send('client.forgotpasswordmail', array('body_url'=>$body_url), function($message){
						$message->to(Input::get('email'), '')->subject('[Safe-bag.com] Password Recovery');
				});
				
				$successData = array('success' => true, 'msg' => 'Reset password link sent successfully.');
				
				Session::flash('success',1);
				Session::flash('message',trans('frontend.restpasswordlinksent'));  
				
				return Response::json($successData, 200);
			}
			
		}
	}
	
	
	// register user for buy a card
	public function getRegister() {
			if (Session::has('userdetail')){
				return Redirect::action('HomeController@getIndex');
			}
			Session::put('register_ref','buypage');
			
				
			$countryList	=	Country::lists('country_name', 'country_code');
			//$countryList	=	array(''=>'- Your Country* -','in'=>'india');
			$countryList['']=	'- Your Country* -';
			ksort($countryList);
			$this->layout->content = View::make('client.register', array('countryList' => $countryList));
		
	}	
	// register user 
	public function getRegisteruser() {
			if (Session::has('userdetail')){
				return Redirect::action('HomeController@getIndex');
			}
			
			
			Session::put('register_ref','dashboard');
			
				
			$countryList	=	Country::lists('country_name', 'country_code');
			//$countryList	=	array(''=>'- Your Country* -','in'=>'india');
			$countryList['']=	'- Your Country* -';
			ksort($countryList);
			$this->layout->content = View::make('client.registeruser', array('countryList' => $countryList));
		
	}	
	
	public function postCreate() {
		
		if (Session::has('userdetail')){
				return Response::json(array(
					'redirect' => true
				));				
				//return Redirect::to('home/index');
			}
		Session::put('register_ref','buypage');
		$yesno		=	Input::get('yesno');
		
		$friendly_names = array(
			'name' => trans('frontend.name'),
			'surname' => trans('frontend.surname'),
			'nationality' => trans('frontend.nationality'),
			'city' => trans('frontend.city'),
			'province' => trans('frontend.province'),
			'address' => trans('frontend.address'),
			'zip' => trans('frontend.zip'),
			'phone' => trans('frontend.phone'),
			'email' => trans('frontend.email'),
			'email_confirmation' => trans('frontend.email_confirmation'),	
			'password' => trans('frontend.password'),
			'password_confirmation' => trans('frontend.password_confirmation'),
			'sh_address' => trans('frontend.sh_address'),
			'sh_city' => trans('frontend.sh_city'),
			'sh_province' => trans('frontend.sh_province'),
			'sh_country' => trans('frontend.sh_country'),
			'sh_zip' => trans('frontend.sh_zip'),
			'dichiaro' => trans('frontend.dichiaro')
		);
		
		if($yesno	==	'yesCheck'){
			$validator = Validator::make(Input::all(), Clients::$rules['createship']);
		}
		else{
			$validator = Validator::make(Input::all(), Clients::$rules['create']);
		}
		$validator->setAttributeNames($friendly_names);
		if($validator->fails())
			return Response::json(array(
				'fail' => true,
				'errors' => $validator->getMessageBag()->toArray()
			));
		else {
			$user = new Clients;
			$user->name = Input::get('name');
			$user->surname = Input::get('surname');
			$user->email = Input::get('email');
			$user->password = sha1(Input::get('password'));
			$user->address = Input::get('address');
			$user->phone = Input::get('phone');
			$user->city = Input::get('city');
			$user->province = Input::get('province');
			$user->nationality = Input::get('nationality');
			$user->zip = Input::get('zip');
			$user->usr_is_confirmed = 1;
			
			$user->fax = Input::get('fax');
			$user->mobile = Input::get('mobile');
			$user->dichiaro = Input::get('dichiaro');
			$user['policy-b'] = Input::get('policy-b');
			$user['policy-c'] = Input::get('policy-c');
			$user['policy-d'] = Input::get('policy-d');
			
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
			$ip = '';
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			$user->facebookId = Input::get('facebookId');
			$user->access_token = Input::get('access_token');
			//$user->lingua_registrazione = Input::get('lingua_registrazione');
			$user->lingua_registrazione = Session::get('lang');
			$user->usr_ip = $ip;
			$user->usr_nmb_logins = 1;
			$user->lastlogin = time();
			$getBrowser	=	Clients::getBrowser();
			
			$user->user_agent = $getBrowser['name'].' '.$getBrowser['version'];
			$user->os = $getBrowser['platform'];
			$user->language_os = Session::get('lang');
			
			$user->save();
			
			
		//save to DB user details
		  if($user->save()) {  
		  	$shipaddress	=	new ShipingAddress;
			$shipaddress->idclient	=	$user->idclient;
			$shipaddress->sh_address = $user->sh_address;
			$shipaddress->sh_city = $user->sh_city;
			$shipaddress->sh_province = $user->sh_province;
			$shipaddress->sh_country = $user->sh_country;
			$shipaddress->sh_zip = $user->sh_zip;
			$shipaddress->save();			
			Mail::send('client.welcome', array('name'=>Input::get('name')), function($message){
					$message->to(Input::get('email'), Input::get('name'))->subject('[Safe-bag.com] Registration confirmed');
			});
		  	//Auth::loginUsingId($user->idclient);
			  //return success  message
			  Session::put('id', $user->idclient);
			  Session::put('idclient', $user->idclient);
			  Session::put('name', $user->name);
			  Session::put('email', $user->email);
			  Session::put('userdetail', $user);
			  //return Redirect::to('client/payment');
				return Response::json(array(
				  'success' => true,
				  'email' => $user->email,
				  'idclient'    =>  $user->idclient
				));
		  }
		}

		
	}
	
	public function postCreateuser() {
		
		if (Session::has('userdetail')){
				return Response::json(array(
					'redirect' => true
				));				
				//return Redirect::to('home/index');
			}
		
		$yesno		=	1;
		Session::put('register_ref','dashboard');
		$friendly_names = array(
			'name' => trans('frontend.name'),
			'surname' => trans('frontend.surname'),
			'nationality' => trans('frontend.nationality'),
			'city' => trans('frontend.city'),
			'province' => trans('frontend.province'),
			'address' => trans('frontend.address'),
			'zip' => trans('frontend.zip'),
			'phone' => trans('frontend.phone'),
			'email' => trans('frontend.email'),
			'email_confirmation' => trans('frontend.email_confirmation'),	
			'password' => trans('frontend.password'),
			'password_confirmation' => trans('frontend.password_confirmation'),
			'sh_address' => trans('frontend.sh_address'),
			'sh_city' => trans('frontend.sh_city'),
			'sh_province' => trans('frontend.sh_province'),
			'sh_country' => trans('frontend.sh_country'),
			'sh_zip' => trans('frontend.sh_zip'),
			'dichiaro' => trans('frontend.dichiaro')
		);
		$input	=	Input::all();
		$input['yesno']	=	$yesno;
		$validator = Validator::make($input, Clients::$rules['create']);
		
		$validator->setAttributeNames($friendly_names);
		if($validator->fails())
			return Response::json(array(
				'fail' => true,
				'errors' => $validator->getMessageBag()->toArray()
			));
		else {
			$user = new Clients;
			$user->name = Input::get('name');
			$user->surname = Input::get('surname');
			$user->phone = Input::get('phone');
			$user->email = Input::get('email');
			$user->password = sha1(Input::get('password'));
			$user->address = Input::get('address');
			$user->city = Input::get('city');
			$user->province = Input::get('province');
			$user->nationality = Input::get('nationality');
			$user->zip = Input::get('zip');
			$user->usr_is_confirmed = 1;
			$user->sh_address = Input::get('sh_address');
			$user->sh_city = Input::get('sh_city');
			$user->sh_province = Input::get('sh_province');
			$user->sh_country = Input::get('sh_country');
			$user->sh_zip = Input::get('sh_zip');
			
			$user->fax = Input::get('fax');
			$user->mobile = Input::get('mobile');
			$user->dichiaro = Input::get('dichiaro');
			$user['policy-b'] = Input::get('policy-b');
			$user['policy-c'] = Input::get('policy-c');
			$user['policy-d'] = Input::get('policy-d');
			
			$ip = '';
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			$user->facebookId = Input::get('facebookId');
			$user->access_token = Input::get('access_token');
			$user->lingua_registrazione = Session::get('lang');
			
			$getBrowser	=	Clients::getBrowser();
			
			$user->user_agent = $getBrowser['name'].' '.$getBrowser['version'];
			
			$user->os = $getBrowser['platform'];
			$user->language_os = Session::get('lang');
			
			$user->usr_ip = $ip;
			$user->usr_nmb_logins = 1;
			$user->lastlogin = time();
			$user->save();
			
			
		//save to DB user details
		  if($user->save()) {  
		  			
			Mail::send('client.welcome', array('name'=>Input::get('name')), function($message){
					$message->to(Input::get('email'), Input::get('name'))->subject('[Safe-bag.com] Registration confirmed');
			});
		  	//Auth::loginUsingId($user->idclient);
			  //return success  message
			  Session::put('id', $user->idclient);
			  Session::put('idclient', $user->idclient);
			  Session::put('name', $user->name);
			  Session::put('email', $user->email);
			  Session::put('userdetail', $user);
			  //return Redirect::to('client/payment');
				return Response::json(array(
				  'success' => true,
				  'email' => $user->email,
				  'idclient'    =>  $user->idclient
				));
		  }
		}

		
	}
	
	public function postUpdateship(){
		if (!Session::has('userdetail')){
				return Response::json(array(
					'redirect' => true
				));				
				//return Redirect::to('home/index');
		}
		$yesno		=	Input::get('yesno');
		
		$friendly_names = array(
			'name' => trans('frontend.name'),
			'surname' => trans('frontend.surname'),
			'nationality' => trans('frontend.nationality'),
			'city' => trans('frontend.city'),
			'province' => trans('frontend.province'),
			'address' => trans('frontend.address'),
			'zip' => trans('frontend.zip'),
			'phone' => trans('frontend.phone'),
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
			$validator = Validator::make(Input::all(), Clients::$rules['updateship']);
		}
		else{
			$validator = Validator::make(Input::all(), Clients::$rules['updateshipnew']);
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
			$user->address = Input::get('address');
			$user->city = Input::get('city');
			$user->province = Input::get('province');
			$user->nationality = Input::get('nationality');
			$user->zip = Input::get('zip');		
			$user->phone = Input::get('phone');
				
			/*$user->sh_address = Input::get('sh_address');
			$user->sh_city = Input::get('sh_city');
			$user->sh_province = Input::get('sh_province');
			$user->sh_country = Input::get('sh_country');
			$user->sh_zip = Input::get('sh_zip');*/	
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
		  	$shipaddress	=	ShipingAddress::find($idclient);
			if(empty($shipaddress)){
				$shipaddress	=	new ShipingAddress;
			}
			$shipaddress->idclient	=	$user->idclient;
			$shipaddress->sh_address = $user->sh_address;
			$shipaddress->sh_city = $user->sh_city;
			$shipaddress->sh_province = $user->sh_province;
			$shipaddress->sh_country = $user->sh_country;
			$shipaddress->sh_zip = $user->sh_zip;
			$shipaddress->save();
			$country	=	$this -> getCountry($user -> nationality);
			$user -> nationality	=	$country;
			/*Mail::send('users.mails.welcome', array('name'=>Input::get('name')), function($message){
					$message->to(Input::get('email'), Input::get('name'))->subject('Register successful!');
			});*/
		  	//Auth::loginUsingId($user->idclient);
			  //return success  message
			  $userdetail	=	$user;
			$output	= '<h3>'.trans('frontend.invoice_and_shipping').'</h3><br><br>';
			$output	.= trans('frontend.your_invoice_address').':<br><br>';
			$output	.=  $userdetail['name'].'<br>';
			$output	.=  $userdetail['address'].'<br>';
			$output	.=  $userdetail['city'].'<br>';
			 
			if($userdetail['province'] != '' && $userdetail['province'] != NULL)
				$output	.=  $userdetail['province'].'<br>';
				
			$output	.=  $userdetail['nationality'].'<br><br>';
			$output	.=  trans('frontend.your_delivery_address').'<br><br>';
			$output	.=  $userdetail['name'].'<br>';
			$output	.=  $userdetail['sh_address'].'<br>';
			$output	.=  $userdetail['sh_city'].'<br>';
			
			if($userdetail['sh_province'] != '' && $userdetail['sh_province'] != NULL)
				$output	.=  $userdetail['sh_province'].'<br>';
			$output	.=  $this -> getCountry($userdetail['sh_country']).'<br><br><br>';
			$output	.= '<a style="vertical-align:middle" href="#" class="dlButtondark" data-target="#myModal" onclick="return updateshipaddress();"><span class="dlButtonWrap"><span class="dlButtonSmall">'.trans('frontend.update').'</span></span></a>';
			  
			  Session::flash('success',1);
			  Session::flash('message',trans('frontend.updatesuccess'));
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
	
	public function getPayment(){
		if (!Session::has('userdetail')){
			return Redirect::to('client/register');
		}
		
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
		
		
		//$userdetail	=	Clients::find(Session::get('idclient'));
		$countryList	=	Country::lists('country_name', 'country_code');
		$this->layout->content = View::make('client.payment', array('qtyList' => $qtyList, 'userdetail'=>$userdetail, 'countryList'=>$countryList));
	}
	
	
	public function postAjaxfbregister(){
		$data	=	Input::all();
		$data['success']	=	true;
		
		
		
		return Response::json($data);
	}
	
	public function postAjaxfblogin(){
		$data	=	Input::all();
		$email	=	$data['email'];
		$data['success']	=	true;
		$client	= Clients::whereRaw('email =?', array($email))->first() ;	
		if(!empty($client)){
			$client->facebookId = Input::get('facebookId');
			$client->access_token = Input::get('access_token');
			$client->usr_nmb_logins = $client->usr_nmb_logins+1;
			$client->lastlogin = time();
			$client->save();
			
			Session::put('id', $client->idclient);
			Session::put('idclient', $client->idclient);
			Session::put('name', $client->name);
			Session::put('email', $client->email);
			$country	=	$this -> getCountry($client -> nationality);
			$data	=	$client;
			$data['success']	=	true;
			$client -> nationality	=	$country;
			$userdata = array('idclient' => $client -> idclient, 'name' => $client -> name, 'surname' => $client -> surname, 'country' => $this -> getCountry($client -> nationality), 'currency' => $client -> currency, 'access_token' => $client -> access_token, 'city' => $client -> city, 'province' => $client -> province, 'address' => $client -> address, 'zip' => $client -> zip, 'email' => $client -> email, 'phone' => $client -> phone, 'fax' => $client -> fax, 'mobile' => $client -> mobile);
			Session::put('userdetail', $client);
		}
		else{
			$data['success']	=	false;			
			Session::put('facebook', $data);
		}
		
		
		return Response::json($data);
	}
	
	public function postAjaxcolorsdropdown(){
		$returnarray	=	array();
		
		
		$qty		=	Input::get('qty');	
		
		
		
		return View::make('client.ajaxcolorsdropdown',array('qty'=>$qty));
	}
	
	public function postAjaxcalculateprice(){
		$returnarray	=	array();
		
		$symbolarray=	$this->getPaypalcurrencies(Session::get('cc'));
		$symbol		=	$symbolarray['symbol'];
		//$symbol		=	Session::get('cc');
		$colour		=	Input::get('colour');
		$qty		=	Input::get('qty');
		
		$defultamount		=	9.90;
		
		$rates_ac_to_products = Exchange::where('currency_code','=','EUR')->first();
		$currency_code  =  Session::get('cc');
		
		switch($currency_code){
			case 'EUR' : $exrate = $rates_ac_to_products->exrate_EUR; break;
			case 'USD' : $exrate = $rates_ac_to_products->exrate_USD; break;
			case 'CHF' : $exrate = $rates_ac_to_products->exrate_CHF; break;
			case 'BRL' : $exrate = $rates_ac_to_products->exrate_BRL; break;
			case 'RUB' : $exrate = $rates_ac_to_products->exrate_RUB; break;
			case 'MXN' : $exrate = $rates_ac_to_products->exrate_MXN; break;
			case 'GBP' : $exrate = $rates_ac_to_products->exrate_GBP; break;
		}
		
		if($currency_code == 'EUR'){
			$price   = (float)$defultamount * (float)$exrate;
		}else{
			$price   = (float)$defultamount * (float)$exrate * floatval('1.10');
		}
		$defultamount		=	$price;
		$amount				=	number_format(round($qty*$defultamount, 1), 2);
		$tax				=	number_format(round((($amount*22)/100), 1), 2);
		$totalamount		=	number_format(round($amount+$tax, 1), 2);
		
		$array	=	array('success' => true, 'symbol'=>$symbol, 'amount'=>$amount, 'tax'=>$tax, 'totalamount'=>$totalamount);
		
		
		return Response::json($array);
	}
	
	public function getPaypalcurrencies($cc) {
		$currenciesArr = array('EUR' => array('name' => "Italian Euro", 'symbol' => "€", 'ASCII' => "&#128;", 'cc' => 'EUR'), 'AUD' => array('name' => "Australian Dollar", 'symbol' => "A$", 'ASCII' => "A&#36;", 'cc' => 'AUD'), 'BRL' => array('name' => "Brazilian Real", 'symbol' => "R$", 'ASCII' => "", 'cc' => 'BRL'), 'CAD' => array('name' => "Canadian Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'CAD'), 'CZK' => array('name' => "Czech Koruna", 'symbol' => "Kč", 'ASCII' => "", 'cc' => 'CZK'), 'DKK' => array('name' => "Danish Krone", 'symbol' => "Kr", 'ASCII' => "", 'cc' => 'DKK'), 'HKD' => array('name' => "Hong Kong Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'HKD'), 'HUF' => array('name' => "Hungarian Forint", 'symbol' => "Ft", 'ASCII' => "", 'cc' => 'HUF'), 'ILS' => array('name' => "Israeli New Sheqel", 'symbol' => "₪", 'ASCII' => "&#8361;", 'cc' => 'ILS'), 'JPY' => array('name' => "Japanese Yen", 'symbol' => "Â¥", 'ASCII' => "&#165;", 'cc' => 'JPY'), 'MXN' => array('name' => "Mexican Peso", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'MXN'), 'NOK' => array('name' => "Norwegian Krone", 'symbol' => "Kr", 'ASCII' => "", 'cc' => 'NOK'), 'NZD' => array('name' => "New Zealand Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'NZD'), 'PHP' => array('name' => "Philippine Peso", 'symbol' => "₱", 'ASCII' => "", 'cc' => 'PHP'), 'PLN' => array('name' => "Polish Zloty", 'symbol' => "zł", 'ASCII' => "", 'cc' => 'PLN'), 'GBP' => array('name' => "Pound Sterling", 'symbol' => "£", 'ASCII' => "&#163;", 'cc' => 'GBP'), 'RUB' => array('name' => "Russian Ruble", 'symbol' => "ք", 'ASCII' => "&#8381;", 'cc' => 'RUB'), 'SGD' => array('name' => "Singapore Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'SGD'), 'SEK' => array('name' => "Swedish Krona", 'symbol' => "kr", 'ASCII' => "", 'cc' => 'SEK'), 'CHF' => array('name' => "Swiss Franc", 'symbol' => "Fr.", 'ASCII' => "", 'cc' => 'CHF'), 'TWD' => array('name' => "Taiwan New Dollar", 'symbol' => "NT$", 'ASCII' => "NT&#36;", 'cc' => 'TWD'), 'THB' => array('name' => "Thai Baht", 'symbol' => "฿", 'ASCII' => "&#3647;", 'cc' => 'THB'), 'USD' => array('name' => "U.S. Dollar", 'symbol' => "$", 'ASCII' => "&#36;", 'cc' => 'USD'));

		return $currenciesArr[$cc];

	}

	

	public function getLogin() {
		if (Auth::check())
		{
    		return Redirect::to('users/dashboard');
		}else{
			$this->layout->content = View::make('users.login');
		}
		
	}
	
	public function postLogin(){
		$email		=	Input::get('email');
		$password	=	Input::get('password');
		$validator = Validator::make(Input::all(), Clients::$rules['login']);
		$error	=	true;
		$msg	=	array();
		if(!$validator->fails()){
			$client	= Clients::whereRaw('password = ? and email =?', array(sha1($password),$email))->first() ;	
			if(empty($client)){
				$error	=	false;
				$msg['email']	=	trans('frontend.errorlogin');	
			}
			else{
				$client->usr_nmb_logins = $client->usr_nmb_logins+1;
				$client->lastlogin = time();
				$client->save();
				 Session::put('id', $client->idclient);
				 Session::put('idclient', $client->idclient);
				 Session::put('name', $client->name);
				 Session::put('email', $client->email);
				 $country	=	$this -> getCountry($client -> nationality);
				 $client -> nationality	=	$country;
				 $userdata = array('idclient' => $client -> idclient, 'name' => $client -> name, 'surname' => $client -> surname, 'country' => $this -> getCountry($client -> nationality), 'currency' => $client -> currency, 'access_token' => $client -> access_token, 'city' => $client -> city, 'province' => $client -> province, 'address' => $client -> address, 'zip' => $client -> zip, 'email' => $client -> email, 'phone' => $client -> phone, 'fax' => $client -> fax, 'mobile' => $client -> mobile);
				 Session::put('userdetail', $client);
				  //return Redirect::to('client/payment');
					return Response::json(array(
					  'success' => true,
					  'email' => $client->email,
					  'idclient'    =>  $client->idclient
					));	
			}
		}
		else{
				return Response::json(array(
					'fail' => true,
					'errors' => $validator->getMessageBag()->toArray()
				));
		}
		if(!$error){
			return Response::json(array(
				  'fail' => true,
				  'errors' => $msg
				  
				));	
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
		Session::forget('id');
		Session::forget('email');
		Session::forget('name');
		Session::forget('userdetail');
		Session::forget('idclient');
		return Redirect::action('HomeController@getIndex');		
	}
	
	public function postPayment()
	{
		if (!Session::has('userdetail')){
			return Redirect::to('client/register');
		}
		
		$colour	=	Input::get('colour');
		$qty	=	Input::get('qty');
		$symbol=	Session::get('cc');
		
		$defultamount		=	9.9;
		$actualamount		=	9.9;
		$rates_ac_to_products = Exchange::where('currency_code','=','EUR')->first();
		$currency_code  =  Session::get('cc');
		
		switch($currency_code){
			case 'EUR' : $exrate = $rates_ac_to_products->exrate_EUR; break;
			case 'USD' : $exrate = $rates_ac_to_products->exrate_USD; break;
			case 'CHF' : $exrate = $rates_ac_to_products->exrate_CHF; break;
			case 'BRL' : $exrate = $rates_ac_to_products->exrate_BRL; break;
			case 'RUB' : $exrate = $rates_ac_to_products->exrate_RUB; break;
			case 'MXN' : $exrate = $rates_ac_to_products->exrate_MXN; break;
			case 'GBP' : $exrate = $rates_ac_to_products->exrate_GBP; break;
		}
		
		if($currency_code == 'EUR'){
			$price   = (float)$defultamount * (float)$exrate;
		}else{
			$price   = (float)$defultamount * (float)$exrate * floatval('1.10');
		}
		$defultamount		=	$price;
		/*$amount				=	number_format(round($qty*$defultamount, 1), 1);
		$tax				=	number_format(round((($amount*22)/100), 1), 1);
		$totalamount		=	number_format(round($amount+$tax, 1), 2);*/
		
		$oneamount			=	number_format(round($defultamount, 1), 1);
		$onetax				=	number_format(round((($oneamount*22)/100), 1), 1);
		$onetotalamount		=	number_format(round($oneamount+$onetax, 1), 2).'';
		
		$amount				=	number_format(($qty*$oneamount), 1);
		$tax				=	number_format(($qty*$onetax), 1);
		$totalamount		=	number_format(($qty*$onetotalamount), 2).'';
		
		$oneactamount			=	number_format(round($actualamount, 1), 1);
		$oneacttax				=	number_format(round((($oneactamount*22)/100), 1), 1);
		$oneacttotalamount		=	number_format(round($oneactamount+$oneacttax, 1), 2);
		
		$actamount			=	number_format(($qty*$oneactamount), 1);
		$acttax				=	number_format(($qty*$oneacttax), 1);
		$acttotalamount		=	number_format(($qty*$oneacttotalamount), 2);
		
		$data['colour']	=	$colour;
		$data['qty']	=	$qty;
		$data['tax']	=	$tax;
		$data['totalamount']	=	$totalamount;
		$data['currency']	=	$symbol;
		$data['defultonetotalamount']	=	$oneacttotalamount;
		$data['defulttotalamount']	=	$acttotalamount;
		$data['defultcurrency']	=	'EUR';
		
		/*var_dump($data).'<br>';
		die();*/
		$totalamount.='';
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
		$listarray	=	array();
		$getcolorarray	=	Clients::getColor();
		for($i=1; $i<=$qty; $i++){
			$item1 = new Item();
			$item1->setName('Color :'.$getcolorarray[$colour[$i]])
				->setCurrency($symbol)
				->setQuantity(1)
				->setPrice($oneacttotalamount);
			$listarray[]	=	$item1;	
		}
	
		$item_list = new ItemList();
		$item_list->setItems($listarray);
	
	
		$amount = new Amount();
		$amount->setCurrency($symbol)
			->setTotal($acttotalamount);
	
		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($item_list)
			->setDescription('Your transaction description');
	
		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(URL::to('client/thanks'))
			->setCancelUrl(URL::to('client/payment'));
	
		$payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirect_urls)
			->setTransactions(array($transaction));
			
			/*var_dump($payment).'<br>';
		die();*/
	
		try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} else {
				die('Some error occur, sorry for inconvenient');
			}
		}
	
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}
	
		// add payment ID to session
		Session::put('paypal_payment_id', $payment->getId());
		$data['paypal_payment_id']	=	$payment->getId();
		$data['idclient']	=	Session::get('id');
		$data['userdetail']	=	Session::get('userdetail');
		
		Session::put('paypal_payment_detail', $data);
		
		
	
		if(isset($redirect_url)) {
			// redirect to paypal
			return Redirect::away($redirect_url);
		}
	
		return Redirect::route('original.route')
			->with('error', 'Unknown error occurred');
	}
	
	public function getThanks()
	{
		// Get the payment ID before session clear
		$payment_id = Session::get('paypal_payment_id');
		$data = Session::get('paypal_payment_detail');
		
		
		
		if(!Session::has('paypal_payment_id')){
			return Redirect::to('client/payment')
				->with('error', 'Payment failed');
		}
	
		// clear the session payment ID
		Session::forget('paypal_payment_id');
		Session::forget('paypal_payment_detail');
	
		if ((Input::get('PayerID')=='') || (Input::get('token')=='')) {
			return Redirect::to('client/payment')
				->with('error', 'Payment failed');
		}
		
		
		
		
	
		$payment = Payment::get($payment_id, $this->_api_context);
	
		// PaymentExecution object includes information necessary 
		// to execute a PayPal account payment. 
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));
	
		//Execute the payment
		$result = $payment->execute($execution, $this->_api_context);
		$newresult	=	$payment->toArray();
		
		$qty	=	$data['qty'];
		$colour	=	implode(',',$data['colour']);
		//for($i=1; $i<=$qty; $i++)
		{
			$shipaddress	=	new MinisiteTransactions;
			$shipaddress->idclient	=	$data['idclient'];
			$shipaddress->address_1 = $data['userdetail']['sh_address'];
			$shipaddress->city = $data['userdetail']['sh_city'];
			$shipaddress->province = $data['userdetail']['sh_province'];
			$shipaddress->country = $data['userdetail']['sh_country'];
			$shipaddress->zip = $data['userdetail']['sh_zip'];
			$shipaddress->price =	$data['defulttotalamount'];
			$shipaddress->quantity =	$qty;
			$shipaddress->card_color =	$colour;
			$shipaddress->currency =	$data['defultcurrency'];
			$shipaddress->payment_date =	time();
			$shipaddress->transaction_id =	$newresult['id'];
			$getBrowser	=	Clients::getBrowser();
			
			$shipaddress -> device = $getBrowser['name'].' '.$getBrowser['version'];
			//$shipaddress -> device		 = $_SERVER['HTTP_USER_AGENT'];
			$shipaddress->save();
		}
	
		//echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
	
		/*if ($result->getState() == 'approved') { // payment made
			$this->layout->content = View::make('client.thanks');
			/*return Redirect::route('original.route')
				->with('success', 'Payment success');* /
		}*/
		$this->layout->content = View::make('client.thanks');
		//return Redirect::route('original.route')->with('error', 'Payment failed');
	}
	
	// card recharge success
	public function getCardrechargesuccess(){
		// Get the payment ID before session clear
		$payment_id = Session::get('paypal_payment_id');
		$data = Session::get('paypal_payment_detail');
		if(!Session::has('paypal_payment_id')){
			return Redirect::to('users/listcards')->with(array('message' => trans('userlistcards.transaction_fail_recharge_card'),'success'=>0));	
		}
		
		// clear the session payment ID
		Session::forget('paypal_payment_id');
		Session::forget('paypal_payment_detail');
	
		if ((Input::get('PayerID')=='') || (Input::get('token')=='')) {
			return Redirect::to('users/listcards')->with(array('message' => trans('userlistcards.transaction_fail_recharge_card'),'success'=>0));	
		}
		
		$payment = Payment::get($payment_id, $this->_api_context);
	
		// PaymentExecution object includes information necessary 
		// to execute a PayPal account payment. 
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));
	
		//Execute the payment
		$result = $payment->execute($execution, $this->_api_context);
		$newresult	=	$payment->toArray();
		
		$package   = Packages::where('package_id','=',$data['package_id']) -> first();
				
		$order = new Transactions;
		$order -> paytype 		 = 'cardrecharge';
		$order -> transaction_id = $newresult['id'];
		
		$order -> price			 = $package->price;
		$order -> currency		 = $package->currency;
		
		$order -> payment_date   = strtotime(date('Y-m-d h:i:s'));
		$order -> rechargecard_id= $data['card_id'];
		$order -> idclient		 = $data['idclient'];
		$getBrowser	=	Clients::getBrowser();
			
		$order -> device = $getBrowser['name'].' '.$getBrowser['version'];
		//$order -> device		 = $_SERVER['HTTP_USER_AGENT'];		
		$order -> save();
		
		
		if(isset($order -> rechargecard_id) && $order->order_id != ''){
			$card = Cards::find($order -> rechargecard_id);
			$card -> flightnumbers	=  $card -> flightnumbers + $data['numflights'];
			$card -> save();
		}
		
		
		
		return Redirect::to('users/listcards')->with(array('message' => trans('userlistcards.transaction_success_recharge_card'),'success'=>1));	
	}
	
	
	// recharge card
	public function postRechargecard()
	{
		
		$colour	=	1;
		$qty	=	1;
		$symbol=	Session::get('cc');
		$idclient	=	Session::get('idclient');
		
		$package_id	=	Input::get('package_id');
		$card_id	=	Input::get('card_id');
		$cards	=	Cards::whereRaw('idclient = ? AND  cardstatus = 1 AND card_id = ?', array($idclient,$card_id))->first();
		$package	=	Packages::find($package_id);
		if(empty($cards) || empty($package)){
			return Redirect::to('users/dashboard');
		}
		
		$rates_ac_to_products = Exchange::where('currency_code','=',$package->currency)->first();
		$currency_code  =  Session::get('cc');
		
		switch($currency_code){
			case 'EUR' : $exrate = $rates_ac_to_products->exrate_EUR; break;
			case 'USD' : $exrate = $rates_ac_to_products->exrate_USD; break;
			case 'CHF' : $exrate = $rates_ac_to_products->exrate_CHF; break;
			case 'BRL' : $exrate = $rates_ac_to_products->exrate_BRL; break;
			case 'RUB' : $exrate = $rates_ac_to_products->exrate_RUB; break;
			case 'MXN' : $exrate = $rates_ac_to_products->exrate_MXN; break;
			case 'GBP' : $exrate = $rates_ac_to_products->exrate_GBP; break;
		}
		
		if($currency_code == $package->currency){
			$price   = (float)$package->price * (float)$exrate;
		}else{
			$price   = (float)$package->price * (float)$exrate * floatval('1.10');
		}
		
		$defultamount		=	$price;
		$amount				=	number_format(round($qty*$defultamount, 1), 1);
		$tax				=	number_format(round(0, 1), 1);
		$totalamount		=	number_format(round($amount+$tax, 1), 2);
		
		$data['package_id']	=	$package_id;
		$data['card_id']	=	$card_id;
		$data['idclient']	=	$idclient;
		//$data['tax']	=	$tax;
		$data['totalamount']	=	$totalamount;
		$data['currency']	=	$symbol;
		$data['defultamount']	=	$package->price;
		$data['defultcurrency']	=	$package->currency;
		$data['numflights']	=	$package->numflights;
		$data['userdetail']	=	Session::get('userdetail');
		
		$totalamount.='';
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
		
		$item1 = new Item();
		$item1->setName('Recharge card #'.$cards->card_number)
			->setCurrency($symbol)
			->setQuantity(1)
			->setPrice($totalamount);
	
		$item_list = new ItemList();
		$item_list->setItems(array($item1));
	
	
		$amount = new Amount();
		$amount->setCurrency($symbol)
			->setTotal($totalamount);
	
		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($item_list)
			->setDescription('Your transaction description');
	
		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(URL::to('client/cardrechargesuccess'))
			->setCancelUrl(URL::to('users/cardrechargefail'));
	
		$payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirect_urls)
			->setTransactions(array($transaction));
	
		try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} else {
				die('Some error occur, sorry for inconvenient');
			}
		}
	
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}
	
		// add payment ID to session
		Session::put('paypal_payment_id', $payment->getId());
		$data['paypal_payment_id']	=	$payment->getId();
		$data['idclient']	=	Session::get('idclient');
		
		
		Session::put('paypal_payment_detail', $data);
	
		if(isset($redirect_url)) {
			// redirect to paypal
			return Redirect::away($redirect_url);
		}
	
		return Redirect::route('original.route')
			->with('error', 'Unknown error occurred');
	}
	
	// card recharge success
	public function getCardbuysuccess(){
		// Get the payment ID before session clear
		$payment_id = Session::get('paypal_payment_id');
		$data = Session::get('paypal_payment_detail');
		if(!Session::has('paypal_payment_id')){
			return Redirect::to('users/listcards')->with(array('message' => trans('userlistcards.transaction_fail_buy_card'),'success'=>0));	
		}
		
		// clear the session payment ID
		Session::forget('paypal_payment_id');
		Session::forget('paypal_payment_detail');
	
		if ((Input::get('PayerID')=='') || (Input::get('token')=='')) {
			return Redirect::to('users/listcards')->with(array('message' => trans('userlistcards.transaction_fail_buy_card'),'success'=>0));	
		}
		
		$payment = Payment::get($payment_id, $this->_api_context);
	
		// PaymentExecution object includes information necessary 
		// to execute a PayPal account payment. 
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));
	
		//Execute the payment
		$result = $payment->execute($execution, $this->_api_context);
		$newresult	=	$payment->toArray();
		
		$qty	=	$data['qty'];
		$colour	=	implode(',',$data['colour']);
		//for($i=1; $i<=$qty; $i++)
		{
			$shipaddress	=	new MinisiteTransactions;
			$shipaddress->idclient	=	$data['idclient'];
			$shipaddress->address_1 = $data['userdetail']['sh_address'];
			$shipaddress->city = $data['userdetail']['sh_city'];
			$shipaddress->province = $data['userdetail']['sh_province'];
			$shipaddress->country = $data['userdetail']['sh_country'];
			$shipaddress->zip = $data['userdetail']['sh_zip'];
			$shipaddress->price =	$data['defulttotalamount'];
			$shipaddress->quantity =	$qty;
			$shipaddress->card_color =	$colour;
			$shipaddress->currency =	$data['defultcurrency'];
			$shipaddress->payment_date =	time();
			$shipaddress->transaction_id =	$newresult['id'];
			$getBrowser	=	Clients::getBrowser();
			
			$shipaddress -> device = $getBrowser['name'].' '.$getBrowser['version'];
			//$shipaddress -> device		 = $_SERVER['HTTP_USER_AGENT'];
			$shipaddress->save();
		}
		
		return Redirect::to('users/listcards')->with(array('message' => trans('userlistcards.transaction_success_buy_card'),'success'=>1));	
	}
	
	// buy a card
	public function postBuycard()
	{
		if (!Session::has('userdetail')){
			return Redirect::to('client/register');
		}
		$userdetail	=	Clients::find(Session::get('idclient'));
		
		if($userdetail['sh_city'] == ''){
			return Redirect::to('users/profile')->with(array('message' => 'Update Shiping address.','success'=>0));	
		}
		
		$colour	=	Input::get('colour');
		$qty	=	Input::get('qty');
		$symbol=	Session::get('cc');
		
		$defultamount		=	9.9;
		$actualamount		=	9.9;
		$rates_ac_to_products = Exchange::where('currency_code','=','EUR')->first();
		$currency_code  =  Session::get('cc');
		
		switch($currency_code){
			case 'EUR' : $exrate = $rates_ac_to_products->exrate_EUR; break;
			case 'USD' : $exrate = $rates_ac_to_products->exrate_USD; break;
			case 'CHF' : $exrate = $rates_ac_to_products->exrate_CHF; break;
			case 'BRL' : $exrate = $rates_ac_to_products->exrate_BRL; break;
			case 'RUB' : $exrate = $rates_ac_to_products->exrate_RUB; break;
			case 'MXN' : $exrate = $rates_ac_to_products->exrate_MXN; break;
			case 'GBP' : $exrate = $rates_ac_to_products->exrate_GBP; break;
		}
		
		if($currency_code == 'EUR'){
			$price   = (float)$defultamount * (float)$exrate;
		}else{
			$price   = (float)$defultamount * (float)$exrate * floatval('1.10');
		}
		$defultamount		=	$price;
		/*$amount				=	number_format(round($qty*$defultamount, 1), 1);
		$tax				=	number_format(round((($amount*22)/100), 1), 1);
		$totalamount		=	number_format(round($amount+$tax, 1), 2);
		
		$actamount				=	number_format(round($qty*$actualamount, 1), 1);
		$acttax				=	number_format(round((($actamount*22)/100), 1), 1);
		$acttotalamount		=	number_format(round($actamount+$acttax, 1), 2);*/
		/*$amount				=	number_format(round($qty*$defultamount, 1), 1);
		$tax				=	number_format(round((($amount*22)/100), 1), 1);
		$totalamount		=	number_format(round($amount+$tax, 1), 2);*/
		
		$oneamount			=	number_format(round($defultamount, 1), 1);
		$onetax				=	number_format(round((($oneamount*22)/100), 1), 1);
		$onetotalamount		=	number_format(round($oneamount+$onetax, 1), 2).'';
		
		$amount				=	number_format(($qty*$oneamount), 1);
		$tax				=	number_format(($qty*$onetax), 1);
		$totalamount		=	number_format(($qty*$onetotalamount), 2).'';
		
		$oneactamount			=	number_format(round($actualamount, 1), 1);
		$oneacttax				=	number_format(round((($oneactamount*22)/100), 1), 1);
		$oneacttotalamount		=	number_format(round($oneactamount+$oneacttax, 1), 2);
		
		$actamount			=	number_format(($qty*$oneactamount), 1);
		$acttax				=	number_format(($qty*$oneacttax), 1);
		$acttotalamount		=	number_format(($qty*$oneacttotalamount), 2);
		
		$data['colour']	=	$colour;
		$data['qty']	=	$qty;
		$data['tax']	=	$tax;
		$data['totalamount']	=	$totalamount;
		$data['currency']	=	$symbol;
		$data['defultonetotalamount']	=	$oneacttotalamount;
		$data['defulttotalamount']	=	$acttotalamount;
		$data['defultcurrency']	=	'EUR';
		
		$totalamount.='';
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
		
		$listarray	=	array();
		$getcolorarray	=	Clients::getColor();
		for($i=1; $i<=$qty; $i++){
			$item1 = new Item();
			$item1->setName('Color :'.$getcolorarray[$colour[$i]])
				->setCurrency($symbol)
				->setQuantity(1)
				->setPrice($oneacttotalamount);
			$listarray[]	=	$item1;	
		}
		/*for($i=1; $i<=$qty; $i++){
			$item1 = new Item();
			$item1->setName('Card Color '.$colour[$i])
				->setCurrency($symbol)
				->setQuantity(1)
				->setPrice($oneacttotalamount);
			$listarray[]	=	$item1;	
		}*/
	
		$item_list = new ItemList();
		$item_list->setItems($listarray);
	
	
		$amount = new Amount();
		$amount->setCurrency($symbol)
			->setTotal($acttotalamount);
	
		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($item_list)
			->setDescription('Your transaction description');
	
		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(URL::to('client/cardbuysuccess'))
			->setCancelUrl(URL::to('users/cardbuyfail'));
	
		$payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirect_urls)
			->setTransactions(array($transaction));
	
		try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} else {
				die('Some error occur, sorry for inconvenient');
			}
		}
	
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}
	
		// add payment ID to session
		Session::put('paypal_payment_id', $payment->getId());
		$data['paypal_payment_id']	=	$payment->getId();
		$data['idclient']	=	Session::get('id');
		$data['userdetail']	=	Session::get('userdetail');
		
		Session::put('paypal_payment_detail', $data);
	
		if(isset($redirect_url)) {
			// redirect to paypal
			return Redirect::away($redirect_url);
		}
	
		return Redirect::route('original.route')
			->with('error', 'Unknown error occurred');
	}
	
	// Terms of service
	public function getTermsservice(){
		//echo Session::get('lang');
		if(Session::get('lang')=='en')
			$this->layout->content = View::make('client.termsservice');
		else
			$this->layout->content = View::make('client.termsserviceit');		
	}
	
	// Terms of service
	public function getPrivacy(){
		//echo Session::get('lang');
		if(Session::get('lang')=='en')
			$this->layout->content = View::make('client.privacy');
		else
			$this->layout->content = View::make('client.privacyit');		
	}
	
	public function postContactus(){
		$return_array	=	array('success'=>true,'message'=>'Message Sent Successful.');
		 $rules = array(
		 			'recaptcha_response_field' => 'required|recaptcha',
					'name'=>'required',
					'message'=>'required',
					'email'=>'required|email',
				);
		 $validator = Validator::make(Input::all(), $rules);
		 
		 if($validator->fails()){
			return Response::json(array(
				'fail' => true,
				'errors' => $validator->getMessageBag()->toArray()
			));
		 }else{
			 $fromEmail = Input::get('email');
			 $fromName = Input::get('name');
			 $subject = trans('frontend.contact_us_condent');
			 $data = Input::get('message');
		
			//$toEmail = 'colella@tech-armada.net';
			$toEmail = 'arul258013@gmail.com';
			$toName = 'Antonio Colella';
			Mail::send('client.contactus', array('data'=>Input::get('message')), function($message){
					$message->from(Input::get('email'), Input::get('name'));
					$message->to('colella@tech-armada.net')->subject('Contact Us');
			});
			
			/*Mail::send('client.contact_us', array('data'=>$data), function($message){
					//$message->from(Input::get('email'), Input::get('name'));
					$message->to(Session::get('arul258013@gmail.com'))->cc('colella@tech-armada.net')->subject('[Safe-bag.com] Bags Update');
			});*/
		
			/*Mail::send('client.contact_us', array('data'=>$data), function($message) use ($toEmail, $toName, $fromEmail, $fromName, $subject)
			{
				$message->to($toEmail, $toName);
		
				$message->from($fromEmail, $fromName);
		
				$message->subject($subject);
			});*/
		 }
			
		return json_encode($return_array);
	}
	
	
	
}

?>
