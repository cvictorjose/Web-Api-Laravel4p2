<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function __construct() {		
		
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
		else{
			$this->beforeFilter(function(){
				return Redirect::to('users/dashboard');
			});
			if (!Session::has('userdetail')){
			$client	=	Clients::find(Session::get('idclient'));
				Session::put('id', $client->idclient);
				Session::put('idclient', $client->idclient);
				Session::put('name', $client->name);
				Session::put('email', $client->email);			
				$userdata = array('idclient' => $client -> idclient, 'name' => $client -> name, 'surname' => $client -> surname, 'country' => $this -> getCountry($client -> nationality), 'currency' => $client -> currency, 'access_token' => $client -> access_token, 'city' => $client -> city, 'province' => $client -> province, 'address' => $client -> address, 'zip' => $client -> zip, 'email' => $client -> email, 'phone' => $client -> phone, 'fax' => $client -> fax, 'mobile' => $client -> mobile);
				Session::put('userdetail', $client);
			}
		}
	}
	
	protected $layout = "layouts.main";
	
	public function missingMethod($parameters = array())
	{
    	return Response::view('404', array(), 404);
	}
	public function getIndex()
	{
		
		$this->layout->content =  View::make('home.index');
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
	
	

}
