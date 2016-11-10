<?php

/**
 *
 */
class adminController extends BaseController {

	protected $layout = "layouts.admin-main";

	//public $colors = array('1' => 'Red', '2' => 'Dark Blue', '3' => 'Light Blue', '4' => 'Yellow',  '5' => 'Violet', '6' => 'Pink', '7' => 'Dark Green',  '8' => 'Black');
	public $colors = array('1' => 'Blue', '2' => 'Orange', '3' => 'Red', '4' => 'Green');
	
	public function __construct() {
		$this -> beforeFilter('csrf', array('on' => 'post'));
		$this -> beforeFilter('auth', 
						array('only' => 
										array(
											   //'postSignin',
											   
											   'getDashboard',
										       'getListorders',
										       'getOrders',
										       
										       'getAddcard', 
										       'getSearchcard', 
										       'getListcards',
										       'getSuspendcard',
										       'getDeletecard', 
										       'postAddcard',
											   'postAddcardsingle',
											   'postSearchcard',
											   
										       'getListpackages',
										       'getUpdatepackage', 
										       'getAddpackage',
										       'postAddpackage',
										       'postUpdatepackage',
										       
										       'getListriskairports',
										       'getAddrank',
										       'getUpdaterank',
										       'postAddrank',
										       'postUpdaterank',
										       'postUpdatemassrank', 
										       
										       'getTerms',
										       'getAddterm',
										       'getUpdateterm',
										       'postAddterm',
										       'postUpdateterm',
										      
										       'getPaymentcontrol',
											   'postPaymentcontrol',
											   
											   'postAddproduct',
											   'getDeleteproduct',
											   'postUpdateproduct',
										       'getProducts',
										       
										       'getLogout'
											   
											   )));
		//$this->beforeFilter('auth', array('except' => 'getIndex','getLogin'));
	}


	
	public function missingMethod($parameters = array())
	{
    	return Response::view('404', array(), 404);
	}

	public function getIndex() {
		/*Sentry::register(array(
		 'email'    => 'admin@safe-bag.com',
		 'password' => 'safebag2014!!',
		 ));*/
		if (Auth::check()) {
			return Redirect::to('admin/dashboard');
		} else {
			$this -> layout -> content = View::make('admin.login');
		}

	}


	public function getLogin() {
		if (Auth::check()) {
			return Redirect::to('admin/dashboard');
		} else {
			$this -> layout -> content = View::make('admin.login');
		}

	}

	public function postSignin() {

		if (Input::get('remember_me') == 'remember_me') {
			$stay = true;

		} else {
			$stay = false;
		}

		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), $stay)) {

			return Redirect::to('admin/dashboard') -> with(array('message' => 'You are now logged in!', 'success' => 1));
		} else {
			return Redirect::to('admin/login') -> with(array('message' => 'Your username/password combination was incorrect', 'success' => 0)) -> withInput();
		}
	}

	//takes to admin dashboard
	public function getDashboard() {
		$data = Session::all();
		$email = Auth::user() -> email;
		$id = Auth::id();
		$name = $email = Auth::user() -> firstname;

		$this -> layout -> content = View::make('admin.dashboard');
	}

	//takes to order management
	public function getListorders() {

		$orders = Orders::orderBy('idbag', 'DESC') -> get();
		//print_r($orders);
		$this -> layout -> content = View::make('admin.listorders', array('orders' => $orders));
	}

	//takes to sinlge order
	public function getOrders($transaction_id) {
		$method = Request::method();
		if (Request::isMethod('get')) {
			$order = Orders::where('transaction_id', '=', $transaction_id) -> first();
			if (!empty($order)) {
				$client = Clients::where('idclient', '=', $order -> idclient) -> first();
				$this -> layout -> content = View::make('admin.singleorder', array('order' => $order, 'client' => $client));
			} else {

				return Response::view('404', array(), 404);
			}

		}
		if (Request::isMethod('post')) {
			print_r($_POST);
			die ;
			;
		}

	}

	//cards management starts

	public function getAddcard() {

		$this -> layout -> content = View::make('admin.addcard');

	}

	public function getSearchcard() {

		$this -> layout -> content = View::make('admin.searchcard', array('card' => '', 'client' => '', 'colors' => $this -> colors));

	}

	public function getListcards() {

		$cards = Cards::orderBy('card_id', 'DESC') ->paginate(10);
		$this -> layout -> content = View::make('admin.listcards', array('cards' => $cards, 'colors' => $this -> colors));
	}

	public function postAddcard() {

		$validator = Validator::make(Input::all(), Cards::$rules_firstform);

		if ($validator -> passes()) {
			for ($i = Input::get('start_range'); $i <= Input::get('end_range'); $i++) {
				$validator = Validator::make(array('card_number' => Input::get('prefix').sprintf("%08d", $i).strtoupper(Input::get('suffix'))), Cards::$rules_third);
				if ($validator -> passes()) {
					$card = new Cards;
					$card -> card_number = Input::get('prefix').sprintf("%08d", $i).strtoupper(Input::get('suffix'));
					$card -> card_color  = Input::get('card_color');
					$card -> save();
				} else {
					return Redirect::to('admin/addcard') -> with(array('message' => 'Oops while validating!', 'success' => 0)) -> withErrors($validator) -> withInput();
				}

			}

			return Redirect::to('admin/addcard') -> with(array('message' => 'Cards range inserted!', 'success' => 1));
		} else {
			return Redirect::to('admin/addcard') -> with(array('message' => 'Oops while validating!', 'success' => 0)) -> withErrors($validator) -> withInput();
		}

	}

	public function postAddcardsingle() {

		$validator = Validator::make(Input::all(), Cards::$rules_secondform);

		if ($validator -> passes()) {

			$card = new Cards;
			$card -> card_number = strtoupper(Input::get('prefix').Input::get('card_number').Input::get('suffix'));
			$card -> card_color = Input::get('card_color');
			$card -> save();

			return Redirect::to('admin/addcard') -> with(array('message' => 'Card  inserted!', 'success' => 1));
		} else {

			return Redirect::to('admin/addcard') -> with(array('message' => 'Oops while validating!', 'success' => 0)) -> withErrors($validator) -> withInput();
		}

	}

	public function postSearchcard() {

		$validator = Validator::make(Input::all(), Cards::$rules_four);

		if ($validator -> passes()) {
			$card = Cards::where('card_number', '=', Input::get('card_number')) -> first();
			if (!empty($card)) {
				$client = Clients::where('idclient', '=', $card -> idclient) -> first();
				$this -> layout -> content = View::make('admin.searchcard', array('card' => $card, 'client' => $client, 'colors' => $this -> colors));
			} else {
				return Response::view('404', array(), 404);
			}
		} else {
			return Redirect::to('admin/addcard') -> with(array('message' => 'Oops while validating!', 'success' => 0)) -> withErrors($validator) -> withInput();
		}

	}

	public function getSuspendcard($card_id, $status) {

		$method = Request::method();
		if ($status == 1) {
			$status = 0;
		} else {
			$status = 1;
		}
		if (Request::isMethod('get')) {
			$affectedRows = Cards::where('card_id', '=', $card_id) -> update(array('cardstatus' => $status,'idclient'=>0));
			if ($affectedRows > 0) {
				return Redirect::to('admin/listcards') -> with(array('message' => 'Card  Suspended!', 'success' => 1));
			} else {
				return Redirect::to('admin/listcards') -> with(array('message' => 'Error in suspending card!', 'success' => 0));
			}
		} else {
			return Response::view('404', array(), 404);
		}

	}

	public function getDeletecard($card_id) {

		$method = Request::method();

		if (Request::isMethod('get')) {
			$affectedRows = Cards::where('card_id', '=', $card_id) -> delete();
			if ($affectedRows > 0) {
				return Redirect::to('admin/listcards') -> with(array('message' => 'Card Deleted!', 'success' => 1));
			} else {
				return Redirect::to('admin/listcards') -> with(array('message' => 'Error in deleting card!', 'success' => 0));
			}
		} else {
			return Response::view('404', array(), 404);
		}

	}

	//cards management ends

	//package management starts

	public function getListpackages() {

		$packages = Packages::orderBy('package_id', 'DESC') -> get();
		$this -> layout -> content = View::make('admin.listpackages', array('packages' => $packages));
	}

	// To create a new package
	public function getAddpackage() {
		// Load user/createOrUpdate.blade.php view
		$this -> layout -> content = View::make('admin.addupdatepackage');
	}

	// To update an existing package (load to edit)
	public function getUpdatepackage($package_id) {
		$package = Packages::where('package_id', '=', $package_id) -> first();
		// Load user/createOrUpdate.blade.php view
		$this -> layout -> content = View::make('admin.addupdatepackage') -> with('package', $package);
	}

	//add new package
	public function postAddpackage() {

		$validator = Validator::make(Input::all(), Packages::$rules_firstform);

		if ($validator -> passes()) {

			$card = new Packages;
			$card -> price = Input::get('price');
			$card -> currency = Input::get('currency');
			$card -> numflights = Input::get('numflights');
			$card -> status = Input::get('status');
			$card -> save();
		
			return Redirect::to('admin/listpackages') -> with(array('message' => 'Package inserted!', 'success' => 1));
		} else {
			return Redirect::to('admin/listpackages') -> with(array('message' => 'Oops while validating!', 'success' => 0)) -> withErrors($validator) -> withInput();
		}

	}
	//update  package
	public function postUpdatepackage() {

		$validator = Validator::make(Input::all(), Packages::$rules_firstform);
		$package_id = Input::get('package_id');
		if ($validator -> passes()) {
			
			$affectedRows = Packages::where('package_id', '=', $package_id ) -> update(array('price' => Input::get('price'),'currency'=>Input::get('currency'),'numflights'=>Input::get('numflights'),'status'=>Input::get('status') ));
			if ($affectedRows > 0) {
				//return Redirect::to('admin/updatepackage/'.$package_id ) -> with(array('message' => 'Package Updated!', 'success' => 1));
				return Redirect::to('admin/listpackages/') -> with(array('message' => 'Package Updated!', 'success' => 1));
			} else {
				//return Redirect::to('admin/updatepackage/'.$package_id ) -> with(array('message' => 'Error in updating package!', 'success' => 0));
				return Redirect::to('admin/listpackages/' ) -> with(array('message' => 'Error in updating package!', 'success' => 0));
			}

			
		} else {
			return Redirect::to('admin/updatepackage/'.$package_id) -> with(array('message' => 'Oops while validating!', 'success' => 0)) -> withErrors($validator) -> withInput();
		}

	}

	//package management ends
	
	//airport risk management starts
	public function getListriskairports() {

		$airports = Airportsall::orderBy('city', 'ASC') -> get();
		$ranks 	  = Ranks::orderBy('rank', 'ASC') -> get();
		$this -> layout -> content = View::make('admin.listriskairports', array('airports' => $airports,'ranks'=> $ranks));
	}
	
	// To create a new rank
	public function getAddrank() {
		$this -> layout -> content = View::make('admin.addupdaterank');
	}

	// To update an existing rank (load to edit)
	public function getUpdaterank($rank_id) {
		$rank = Ranks::where('rank_id', '=', $rank_id) -> first();
		$this -> layout -> content = View::make('admin.addupdaterank') -> with('rank', $rank);
	}

	//add new package
	public function postAddrank() {

		$validator = Validator::make(Input::all(), Ranks::$rules_firstform);

		if ($validator -> passes()) {

			$rank = new Ranks;
			$rank -> price = Input::get('price');
			$rank -> currency = Input::get('currency');
			$rank -> save();
		
			return Redirect::to('admin/addrank') -> with(array('message' => 'Rank inserted!', 'success' => 1));
		} else {
			return Redirect::to('admin/addrank') -> with(array('message' => 'Oops while validating!', 'success' => 0)) -> withErrors($validator) -> withInput();
		}

	}
	//update  rank
	public function postUpdaterank() {

		$validator = Validator::make(Input::all(), Ranks::$rules_firstform);
		$rank_id = Input::get('rank_id');
		if ($validator -> passes()) {
			
			$affectedRows = Ranks::where('rank_id', '=', $rank_id ) -> update(array('price' => Input::get('price'),'currency'=>Input::get('currency') ));
			if ($affectedRows > 0) {
				//return Redirect::to('admin/updaterank/'.$rank_id ) -> with(array('message' => 'Rank Updated!', 'success' => 1));
				return Redirect::to('admin/listriskairports' ) -> with(array('message' => 'Rank Updated!', 'success' => 1));
			} else {
				//return Redirect::to('admin/updaterank/'.$rank_id ) -> with(array('message' => 'Error in updating rank!', 'success' => 0));
				return Redirect::to('admin/listriskairports') -> with(array('message' => 'Error in updating rank!', 'success' => 0));
			}

			
		} else {
			return Redirect::to('admin/listriskairports') -> with(array('message' => 'Oops while validating!', 'success' => 0)) -> withErrors($validator) -> withInput();
		}

	}
	
	
	//update  mass ranks  
	public function postUpdatemassrank() {

			$arrayData = json_decode(Input::get('idchecked'));
			if(!empty($arrayData)){
				foreach ($arrayData as $key => $value) {
					$affectedRows = Airportsall::where('id', '=', $arrayData[$key] ) -> update(array('smart_rank' => Input::get('smart_rank') ));
				}
				if (isset($affectedRows) && $affectedRows > 0) {
					return Redirect::to('admin/listriskairports') -> with(array('message' => 'Ranks Updated!', 'success' => 1));
				} else {
					return Redirect::to('admin/listriskairports' ) -> with(array('message' => 'Error:  Update failed!', 'success' => 0));
				}
			}else{
				return Redirect::to('admin/listriskairports' ) -> with(array('message' => 'Error:  You are trying to update without selecting any airports!', 'success' => 0));
			}
			

	}

	//airport risk management ends
	
	
	
	
	
	//old services we used in safe-bag
	
	//terms management
	public function getTerms()
	{
		$terms = Terms::orderBy('term_id', 'DESC') -> get();
		
		$this -> layout -> content = View::make('admin.listterms', array('terms' => $terms));
	
	}
	
	// To create a new term
	public function getAddterm() {
		$this -> layout -> content = View::make('admin.addupdateterm');
	}

	// To update an existing rank (load to edit)
	public function getUpdateterm($term_id) {
		$term = Terms::where('term_id', '=', $term_id) -> first();
		$this -> layout -> content = View::make('admin.addupdateterm') -> with('term', $term);
	}

	//add new package
	public function postAddterm() {

		$validator = Validator::make(Input::all(), Terms::$rules_registerterms);

		if ($validator -> passes()) {

			$term = new Terms;
			$term -> title 		 = Input::get('title');
			$term -> description = iconv("UTF-8", "UTF-8",htmlspecialchars( stripslashes((string) Input::get('description')) ));
			$term -> save();
		
			return Redirect::to('admin/addterm') -> with(array('message' => 'Term inserted!', 'success' => 1));
		} else {
			return Redirect::to('admin/addterm') -> with(array('message' => 'Oops while validating!', 'success' => 0)) -> withErrors($validator) -> withInput();
		}

	}
	//update  term
	public function postUpdateterm() {

		$validator  = Validator::make(Input::all(), Terms::$rules_registerterms);
		$term_id 	= Input::get('term_id');
		if ($validator -> passes()) {
			
			$affectedRows = Terms::where('term_id', '=', $term_id ) -> update(array('title' => Input::get('title'),'description'=>iconv("UTF-8", "UTF-8",htmlspecialchars( stripslashes((string) Input::get('description')) )) ));
			if ($affectedRows > 0) {
				return Redirect::to('admin/updateterm/'.$term_id ) -> with(array('message' => 'Term Updated!', 'success' => 1));
			} else {
				return Redirect::to('admin/updateterm/'.$term_id ) -> with(array('message' => 'Error in updating term!', 'success' => 0));
			}

			
		} else {
			return Redirect::to('admin/updateterm/'.$term_id) -> with(array('message' => 'Oops while validating!', 'success' => 0)) -> withErrors($validator) -> withInput();
		}

	}
	
	//delete a term
	public function getDeleteterm($term_id)
	{
			$method = Request::method();

		if (Request::isMethod('get')) {
			$affectedRows = Terms::where('term_id', '=', $term_id) -> delete();
			if ($affectedRows > 0) {
				return Redirect::to('admin/terms') -> with(array('message' => 'Term Deleted!', 'success' => 1));
			} else {
				return Redirect::to('admin/terms') -> with(array('message' => 'Error in deleting term!', 'success' => 0));
			}
		} else {
			return Response::view('404', array(), 404);
		}
	} 	


	//products management
	public function getProducts()
	{
		$products = Products::orderBy('id_prodotto', 'DESC') -> get();
		$airports = Airports::orderBy('city', 'ASC') -> get();
		
		
		$this -> layout -> content = View::make('admin.listproducts', array('products' => $products,'airports'=>$airports));
	
	}
	
	// To create a new product
	public function getAddproduct() {
		$airports = Airports::where('stato','=','1')->orderBy('city', 'ASC') -> get();
		$airlines = Airlines::orderBy('name_airline', 'ASC') -> lists('name_airline','idairline');
		$terms = Terms::orderBy('term_id', 'DESC') ->lists('title','term_id');
		$this -> layout -> content = View::make('admin.addupdateproduct',array('airports'=>$airports,'airlines'=>$airlines,'terms'=>$terms));
	}

	// To update an existing product (load to edit)
	public function getUpdateproduct($id_prodotto) {
		$product = Products::where('id_prodotto', '=', $id_prodotto) -> first();
		$airports = Airports::where('stato','=','1')->orderBy('city', 'ASC') -> get();
		$airlines = Airlines::orderBy('name_airline', 'ASC') -> lists('name_airline','idairline');
		$terms = Terms::orderBy('term_id', 'DESC') ->lists('title','term_id');
		$this -> layout -> content = View::make('admin.addupdateproduct',array('airports'=>$airports,'airlines'=>$airlines,'terms'=>$terms)) -> with('product', $product);
	}

	//add new product
	public function postAddproduct() {

		//$validator = Validator::make(Input::all(), Products::$rules_registerproducts);
			// Build the input for our validation
		    $input = array('image' => Input::file('picture1'));
		
		    // Within the ruleset, make sure we let the validator know that this
		    // file should be an image
		    $rules = array(
		        'image' => 'image'
		    );

    		// Now pass the input and rules into the validator
    		$validator = Validator::make($input, $rules);

		if ($validator -> passes()) {
			
			$destinationPath = 'uploads/products';
			$allowedTypes 	 = array('jpeg', 'jpg', 'gif', 'png', 'ico');	
			if (Input::hasFile('picture1'))
			{
				$ext_pic 	= Input::file('picture1')->getClientOriginalExtension();
				$size_pic 	= Input::file('picture1')->getSize();
				if(in_array($ext_pic,$allowedTypes) && $size_pic <= 200000){
					  	$filename_pic   = strtolower(Input::get('codice_prodotto')) . '-' . strtolower(Input::get('codice_item')) . '.' . $ext_pic;	
					  	$upload_pic     = Input::file('picture1')->move($destinationPath, $filename_pic);
				}else{
						$filename_pic	  = ''; 
				}
			}else{
						$filename_pic	  = ''; 
			}	  
			
				
			$product= new Products;
			$product -> codice_prodotto			=  Input::get('codice_prodotto');
			$product -> codice_item				=  Input::get('codice_item');
			$product -> titolo					=  Input::get('titolo');
			$product -> image					=  $filename_pic;
			$product -> descrizione_web		 	=  iconv("UTF-8", "UTF-8",htmlspecialchars( stripslashes((string) Input::get('descrizione_web')) ));
			$product -> descrizione_web_full 	=  iconv("UTF-8", "UTF-8",htmlspecialchars( stripslashes((string) Input::get('descrizione_web_full')) ));
			$product -> descrizione_app 		=  Input::get('descrizione_app');
			$product -> prezzo_web_app	 		=  Input::get('prezzo_web_app');
			$product -> prezzo_aeroporto 		=  Input::get('prezzo_aeroporto');
			$product -> lingua					=  Input::get('lingua');
			$product -> aeroporto_di_vendita 	=  @implode(',',Input::get('aeroporto_di_vendita'));
			$product -> data_di_scandenza 		=  Input::get('data_di_scandenza');
			$product -> start_date		 		=  strtotime(Input::get('start_date'));
			$product -> end_date		 		=  strtotime(Input::get('end_date'));
			$product -> currency		 		=  Input::get('currency');
			$product -> idairline		 		=  Input::get('idairline');
			$product -> terms			 		=  Input::get('term_id');
			$product -> save();
		
			return Redirect::to('admin/addproduct') -> with(array('message' => 'Product inserted!', 'success' => 1));
		} else {
			return Redirect::to('admin/addproduct') -> with(array('message' => 'Oops while validating!', 'success' => 0)) -> withErrors($validator) -> withInput();
		}

	}
	//update  product
	public function postUpdateproduct() {

		$validator  	= Validator::make(Input::all(), Products::$rules_updateproducts);
		$id_prodotto 	= Input::get('id_prodotto');
		
		if ($validator -> passes()) {
			$product = Products::find($id_prodotto);
			$destinationPath = 'uploads/products';
			$allowedTypes 	 = array('jpeg', 'jpg', 'gif', 'png', 'ico');	
			if (Input::hasFile('picture1'))
			{
				$ext_pic 	= Input::file('picture1')->getClientOriginalExtension();
				$size_pic 	= Input::file('picture1')->getSize();
				if(in_array($ext_pic,$allowedTypes) && $size_pic <= 200000){
					  	$filename_pic   = strtolower(Input::get('codice_prodotto')) . '-' . strtolower(Input::get('codice_item')) . '.' . $ext_pic;	
					  	$upload_pic     = Input::file('picture1')->move($destinationPath, $filename_pic);
				}else{
						$filename_pic	  = $product->image; 
				}
			}else{
						$filename_pic	  = $product->image; 
			}	  
			
				
			
			$product -> codice_prodotto			=  Input::get('codice_prodotto');
			$product -> codice_item				=  Input::get('codice_item');
			$product -> titolo					=  Input::get('titolo');
			$product -> image					=  $filename_pic;
			$product -> descrizione_web		 	=  iconv("UTF-8", "UTF-8",htmlspecialchars( stripslashes((string) Input::get('descrizione_web')) ));
			$product -> descrizione_web_full 	=  iconv("UTF-8", "UTF-8",htmlspecialchars( stripslashes((string) Input::get('descrizione_web_full')) ));
			$product -> descrizione_app 		=  Input::get('descrizione_app');
			$product -> prezzo_web_app	 		=  Input::get('prezzo_web_app');
			$product -> prezzo_aeroporto 		=  Input::get('prezzo_aeroporto');
			$product -> lingua					=  Input::get('lingua');
			$product -> aeroporto_di_vendita 	=  @implode(',',Input::get('aeroporto_di_vendita'));
			$product -> data_di_scandenza 		=  Input::get('data_di_scandenza');
			$product -> start_date		 		=  strtotime(Input::get('start_date'));
			$product -> end_date		 		=  strtotime(Input::get('end_date'));
			$product -> currency		 		=  Input::get('currency');
			$product -> idairline		 		=  Input::get('idairline');
			$product -> terms			 		=  Input::get('term_id');
			$product -> save();
			
			
			if (!empty($product)){
				return Redirect::to('admin/updateproduct/'.$id_prodotto ) -> with(array('message' => 'Product Updated!', 'success' => 1));
			} else {
				return Redirect::to('admin/updateproduct/'.$id_prodotto ) -> with(array('message' => 'Error in updating product!', 'success' => 0));
			}

			
		} else {
			return Redirect::to('admin/updateproduct/'.$id_prodotto) -> with(array('message' => 'Oops while validating!', 'success' => 0)) -> withErrors($validator) -> withInput();
		}

	}
	
	//delete a product
	public function getDeleteproduct($id_prodotto)
	{
		$method = Request::method();

		if (Request::isMethod('get')) {
			
			$affectedRows = Products::where('id_prodotto', '=', $id_prodotto) -> delete();
			if ($affectedRows > 0) {
				return Redirect::to('admin/products') -> with(array('message' => 'Product Deleted!', 'success' => 1));
			} else {
				return Redirect::to('admin/products') -> with(array('message' => 'Error in deleting product!', 'success' => 0));
			}
		} else {
			return Response::view('404', array(), 404);
		}
	} 
	
	//paymentcontrol get
	public function getPaymentcontrol()
	{
		$paymentcontrol = Paymentcontrol::orderBy('control_id', 'DESC') -> first();
		$this -> layout -> content = View::make('admin.listpaymentcontrol', array('paymentcontrol' => $paymentcontrol));
	
	}
	//paymentcontrol post
	public function postPaymentcontrol()
	{
			$affectedRows = Paymentcontrol::where('control_id', '=', '1' ) -> update(array('payment_enable' => Input::get('payment_enable')));
			if ($affectedRows > 0) {
				return Redirect::to('admin/paymentcontrol') -> with(array('message' => 'Payment Control updated!', 'success' => 1));
			} else {
				return Redirect::to('admin/paymentcontrol') -> with(array('message' => 'Error in updating control!', 'success' => 0));
			}
	}
	
	public function getLogout() {
		Auth::logout();
		return Redirect::to('admin/login') -> with(array('message' => 'Your are now logged out!', 'success' => 0));
	}
	
	
	 
}
?>
