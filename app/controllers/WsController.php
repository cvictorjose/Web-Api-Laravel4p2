<?php
class WsController extends BaseController {
		
		
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
	
	public function missingMethod($parameters = array())
	{
		return Response::view('404', array(), 404);
	}
	
	public function getIndex() {

		return "Arrived to ws development";

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
	
	// add claims document
	public function postAddclaimsdoct(){
		$inputs	=	Input::all();
		
		$inputfile='';
		foreach($inputs as $key=>$value){
			if($key != '_token' && $key != 'idclaim'){
				$inputfile	=	$key;
			}
		}	
		$files = Input::file($inputfile);
		if(count($files)>0){
			foreach($files as $file) {
				$validator = Validator::make(
					array('file' => $file),
					array('file' => 'required|mimes:jpeg,png,pdf,gif,doc,docx|max:5000')
				);
				if($validator->fails()){
				
					return Response::json(array(
						'fail' => true,
						'count'=>count($files).'ttt'.$inputfile,
						'errors' => $validator->getMessageBag()->toArray()
					));
				}
			}
		}
		else{
			$validator = Validator::make(
				array('file' => $inputs[$inputfile]),
				array('file' => 'required|mimes:jpeg,png,pdf,gif,doc,docx|max:5000')
			);
		}
		
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
			$kk=1;
			foreach($files as $file) {
				$ext_doc 	= $file->getClientOriginalExtension();
				$now= time().$kk;
				$kk++;
			
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
				$file->move($path, $filename_doc);
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
					$claimslog->idclient	=	$inputs['idclient'];
					//$description="<strong style=color:red;>Pending</strong> - Documento : ".$docdefinition[$inputfile].", da controllare (caricato dalloperatore o Ritornato pending) ";
					$description="<strong style=color:red;>Pending</strong> - Ha caricato il file: ".$docdefinition[$inputfile];
					$claimslog->description	=	$description;
					$claimslog->date_new	=	date('Y-m-d H:i:s');
					$claimslog->save();
				}
			}
			$linguaclaim	=	$inputs['lang'];
			$claimcode	=	$claims['claimcode'];
			$sigdate_out=	$claims['sigdate'];
			$anno_claim = date ( "Y", $sigdate_out );
			$mese_claim = date ( "m", $sigdate_out );
			
			$folder_claim_docs="../../../safe-bag/cmsafebag/gestionale-sinistri/sinistro/modules/".$anno_claim."/".$mese_claim."/".$claimcode."/docs/";
												
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
	
	public function postAddclaimsrefuse(){
		$inputs	=	Input::all();
		
		$inputfile='';
		foreach($inputs as $key=>$value){
			if($key != '_token' && $key != 'idclaim'){
				$inputfile	=	$key;
			}
		}	
		$valitatiotrue	=	true;
		$files = Input::file($inputfile);
		if(count($files)>0){
			foreach($files as $file) {
				$validator = Validator::make(
					array('file' => $file),
					array('file' => 'required|mimes:jpeg,png,pdf,gif,doc,docx|max:5000')
				);
				if($validator->fails()){
				
					return Response::json(array(
						'fail' => true,
						'count'=>count($files).'ttt'.$inputfile,
						'errors' => $validator->getMessageBag()->toArray()
					));
				}
			}
		}
		else{
			$validator = Validator::make(
				array('file' => $inputs[$inputfile]),
				array('file' => 'required|mimes:jpeg,png,pdf,gif,doc,docx|max:5000')
			);
		}
		if($validator->fails())
		{
			
			return Response::json(array(
				'fail' => true,
				'count'=>count($files).'gggg',
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
			$kk=1;
			foreach($files as $file) {
				$ext_doc 	= $file->getClientOriginalExtension();
				$now= time().$kk;
				$kk++;
				$today = date("dmY");
				$inputfiledummy	=	$inputfile;
				if($inputfile == 'conferma_quietanza')
					$inputfiledummy	=	'refund-release-client';
					
				$filename_doc  = $now."_".str_replace("_","-",$inputfiledummy)."-".$num_pir."-".$claims['claimcode']."-".$today.'.'.$ext_doc;
				$filename_doc_dummy  =	str_replace("_","-",$inputfiledummy)."-".$num_pir."-".$claims['claimcode']."-".$today.'.'.$ext_doc;
				//str_random(12).'.'.$ext_doc;	
				$file->move($path, $filename_doc);
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
					$claimslog->idclient	=	$inputs['idclient'];
					$description="<strong style=color:red;>Pending</strong> - Ha caricato il file: Modulo Quietanza";
					//$description="<strong style=color:red;>Pending</strong> - Modulo di Quietanza di pagamento da controllare e confermare ";
					$claimslog->description	=	$description;
					$claimslog->date_new	=	date('Y-m-d H:i:s');
					$claimslog->save();
				}
			
			}
			$linguaclaim	=	$inputs['lang'];
			$claimcode	=	$claims['claimcode'];
			$sigdate_out=	$claims['sigdate'];
			$anno_claim = date ( "Y", $sigdate_out );
			$mese_claim = date ( "m", $sigdate_out );
			
			$folder_claim_docs="../../../safe-bag/cmsafebag/gestionale-sinistri/sinistro/modules/".$anno_claim."/".$mese_claim."/".$claimcode."/docs/";
												
			$folder_claim_docs_dummy = "http://safe-bag.com/cmsafebag/gestionale-sinistri/sinistro/modules/" . $anno_claim . "/" . $mese_claim . "/" . $claimcode . "/docs/";
			$indexdummy	=	Claimsdocs::searchdocumento($folder_claim_docs,$claimcode,str_replace("_","-",$inputfiledummy),$claimsdoc[$inputfile],$linguaclaim, $folder_claim_docs_dummy);
			return Response::json(array(
				  'success' => true,
				  'path'=>$docdefinition,
				  'inputfile'=>$inputfile,
				  'index'=>$indexdummy,
				  'count'=>count($inputs[$inputfile]),
				  'inputfiledummy'=>$inputfiledummy,
				  
				));
			/*return Response::json(array(
				  'success' => true,
				  'path'=>$docdefinition,
				  
				));*/
			
		}
		
		
		//echo $inputfile;
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
			$inputs['idclient'] = $claims->idclient;
			
			$folder_claim = "../../../safe-bag/cmsafebag/gestionale-sinistri/sinistro/modules/" . $anno_claim . "/" . $mese_claim . "/" . $claimcode . "/docs/";
			
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
								$claimslog->idclient	=	$inputs['idclient'];
								$description="Ha eliminato il documento ".$filenamedummy1;
								$claimslog->description	=	$description;
								$claimslog->date_new	=	date('Y-m-d H:i:s');
								$claimslog->save();
							}
						}
					}
					else{
						$claimslog	=	new Claimslog;
						if(isset($docdefinition[$inputfiledummy])){
							$claimslog	=	new Claimslog;
							$claimslog->idclaim	=	$claims->idclaim;
							$claimslog->idclient	=	$inputs['idclient'];
							$description="Ha eliminato il documento ".$filenamedummy1;
							$claimslog->description	=	$description;
							$claimslog->date_new	=	date('Y-m-d H:i:s');
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
							//if(isset($docdefinition[$inputfiledummy]))
							{
								$claimslog	=	new Claimslog;
								$claimslog->idclaim	=	$claims->idclaim;
								$claimslog->idclient	=	$inputs['idclient'];
								$description="Ha eliminato il documento ".$filenamedummy1;
								$claimslog->description	=	$description;
								$claimslog->date_new	=	date('Y-m-d H:i:s');
								$claimslog->save();
							}
						}
					}
					else{
						$claimslog	=	new Claimslog;
						//if(isset($docdefinition[$inputfiledummy]))
						{
							$claimslog	=	new Claimslog;
							$claimslog->idclaim	=	$claims->idclaim;
							$claimslog->idclient	=	$inputs['idclient'];
							$description="Ha eliminato il documento ".$filenamedummy1;
							$claimslog->description	=	$description;
							$claimslog->date_new	=	date('Y-m-d H:i:s');
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
				$destinationPath = 'uploads/airlinetag';
				//$destinationPath = Claimsbag::getSavepath().'/airlinetag';
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
	
	public function postAddbaglist(){
		$input	=	Input::all();
		$bag_id	=	Input::get("bag_id");
		$input['idclient']	=	Input::get('idclient');
		$idclient	=	Input::get('idclient');
		if($bag_id != ''){
			$data	= Bags::whereRaw('bag_id =? and idclient =?', array($bag_id,$idclient))->first() ;	
			if(empty($data)){
				return Response::json(array(
					'redirect' => true					
				));
			}
		}
		
		$destinationPath = 'uploads/bags';
		//$destinationPath = Claimsbag::getPathcurrent().'/bags';
		//$mime 		= Input::file('picture1')->getMimeType();
		$allowedTypes = array('jpeg', 'jpg', 'gif', 'png', 'ico');
		
		$error	=	true;
		
		if(isset($input['lang']))
			Session::put('lang',$input['lang']);
		else
			Session::put('lang','en');
				
		$lang = Session::get('lang');
		App::setLocale($lang);
			
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
						
						/*$myimage = Image::make($destinationPath.'/'.$bag->idclient.'-'.$filename_pic1);
						$height = $myimage->height();
						$width =  $myimage->width();
						//if($height>$width)
						{
							$myimage->rotate(90);
						}*/
						
						
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
				$bag -> idclient 	= $idclient;
				$bag -> name 		= Input::get('name');
				$bag -> brand 		= Input::get('brand');
				$bag -> color 		= Input::get('color');
				$bag -> description	= Input::get('description');
				$bag -> picture1	= $filename_pic1;
				$bag -> picture2	= $filename_pic2;
				$bag -> picture3	= $filename_pic3;
				$bag -> save();
				
				$successData = array('success' => true, 'msg' => 'Bags added successfully', 'bag_id' => DB::getPdo()->lastInsertId());
				
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
								'picture1'	 	 => ($bags[$key]->picture1 !='') ? asset('uploads/bags/'.$idclient.'-'.$bags[$key]->picture1) : '',
								'picture2'	 	 => ($bags[$key]->picture2 !='') ? asset('uploads/bags/'.$idclient.'-'.$bags[$key]->picture2) : '',
								'picture3'	 	 => ($bags[$key]->picture3 !='') ? asset('uploads/bags/'.$idclient.'-'.$bags[$key]->picture3) : ''
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
			
			$destinationPath = 'uploads/bags';
			//$mime 		= Input::file('picture1')->getMimeType();
			$allowedTypes = array('jpeg', 'jpg', 'gif', 'png', 'ico');
			$error	=	true;
			if (Input::hasFile('picture1'))
			{
				$ext_pic1 	= Input::file('picture1')->getClientOriginalExtension();
				$size_pic1 	= Input::file('picture1')->getSize();
				if(in_array($ext_pic1,$allowedTypes) && $size_pic1 <= 1000000){
					$filename_pic1  = str_random(12).'.'.$ext_pic1;		
				  	$upload_pic1    = Input::file('picture1')->move($destinationPath, Input::get('idclient').'-'.$filename_pic1);
				  	
				}else{
					$error	=	false;
					$filename_pic1	  = ''; 
					$validator->getMessageBag()->add('picture1', trans('validation.image', array('attribute' => trans('userlistbags.picture1'))));
					
				}
				  
			}else{
				  	$filename_pic1	  = ''; 
					
			}
			
			if (Input::hasFile('picture2'))
			{
				$ext_pic2 	= Input::file('picture2')->getClientOriginalExtension();
				$size_pic2 	= Input::file('picture2')->getSize();
				if(in_array($ext_pic2,$allowedTypes) && $size_pic2 <= 1000000){
				  	$filename_pic2  = str_random(12).'.'.$ext_pic2;
				  	$upload_pic2    = Input::file('picture2')->move($destinationPath, Input::get('idclient').'-'.$filename_pic2);
				}else{
					$filename_pic2	  = ''; 
					$validator->getMessageBag()->add('picture2', trans('validation.image', array('attribute' => trans('userlistbags.picture1'))));
					$error	=	false;
				}
				 
			}else{
				 	$filename_pic2	  = ''; 
			}
			
			if (Input::hasFile('picture3'))
			{
				$ext_pic3 	= Input::file('picture3')->getClientOriginalExtension();
				$size_pic3 	= Input::file('picture3')->getSize();
				if(in_array($ext_pic3,$allowedTypes) && $size_pic3 <= 1000000){
				  	$filename_pic3  = str_random(12).'.'.$ext_pic3;		
				  	$upload_pic3    = Input::file('picture3')->move($destinationPath, Input::get('idclient').'-'.$filename_pic3);
				}else{
					$filename_pic3	  = ''; 
					$validator->getMessageBag()->add('picture3', trans('validation.image', array('attribute' => trans('userlistbags.picture1'))));
					$error	=	false;
				}
				  
			}else{
				  	$filename_pic3	  = ''; 
			}
			
			if(!$error){
				$errorData = array('status' => 0, 'referer' => 'addbags', 'msg' => 'Validation error!');
				return Response::json($errorData, 200);
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
			
			$client	=	Clients::find($bag->idclient);
			$name	=	$client->name;
			$tomail	=	$client->email;
			//$tomail	=	'arul258013@gmail.com';
			
			Session::put('updatebagsemail', $tomail);			
			Mail::send('client.mail_bag_register', array('name'=>$name, 'bag_name'=>$bag->name, 'color'=> $bag->color, 'brand'=>$bag->brand), function($message){
					$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject(trans('emailtemplet.sub_bag_register'));
			});
			Session::forget('updatebagsemail');
			
			
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
			
			$destinationPath = 'uploads/bags';
			$allowedTypes = array('jpeg', 'jpg', 'gif', 'png', 'ico');
			
			$bag = Bags::find(Input::get('bag_id'));
			
			
			if (Input::hasFile('picture1'))
			{
				$ext_pic1 	= Input::file('picture1')->getClientOriginalExtension();
				$size_pic1 	= Input::file('picture1')->getSize();
				if(in_array($ext_pic1,$allowedTypes) && $size_pic1 <= 1000000){
					$filename_pic1  = str_random(12).'.'.$ext_pic1;		
				  	$upload_pic1    = Input::file('picture1')->move($destinationPath, $bag->idclient.'-'.$filename_pic1);
					
					/*$myimage = Image::make($destinationPath.'/'.$bag->idclient.'-'.$filename_pic1);
					$height = $myimage->height();
					$width =  $myimage->width();
					if($height>$width)
					{
						$myimage->rotate(90);
					}*/
				  	
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
				if(in_array($ext_pic2,$allowedTypes) && $size_pic2 <= 1000000){
				  	$filename_pic2  = str_random(12).'.'.$ext_pic2;
				  	$upload_pic2    = Input::file('picture2')->move($destinationPath, $bag->idclient.'-'.$filename_pic2);
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
				if(in_array($ext_pic3,$allowedTypes) && $size_pic3 <= 1000000){
				  	$filename_pic3  = str_random(12).'.'.$ext_pic3;		
				  	$upload_pic3    = Input::file('picture3')->move($destinationPath, $bag->idclient.'-'.$filename_pic3);
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
				$bags		=	Bags::find(Input::get('bag_id'));
				if($bags->picture1 != ''){
					File::delete('/var/www/html/safe-bag/stws/public/uploads/bags/'.$bags->idclient.$bags->picture1);
				}
				if($bags->picture2 != ''){
					File::delete('/var/www/html/safe-bag/stws/public/uploads/bags/'.$bags->idclient.$bags->picture1);
				}
				if($bags->picture3 != ''){
					File::delete('/var/www/html/safe-bag/stws/public/uploads/bags/'.$bags->idclient.$bags->picture1);
				}
				
				$success = Bags::destroy(Input::get('bag_id'));
				if($success==1){
					$successData = array('success' => true, 'status' => 1, 'referer' => 'deletebag', 'msg' => 'Bags deleted successfully');
					return Response::json($successData, 200);
				}else{
					$errorData = array('fail' => true, 'status' => 0, 'referer' => 'deletebag', 'msg' => 'Error in deleting of bag_id not exists!');
			    	return Response::json($errorData, 200);
				}
				
			}else{
				$errorData = array('fail' => true, 'status' => 0, 'referer' => 'deletebag', 'msg' => 'Validation error!');
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
		
			if(!empty($requestCard) && $requestCard->idclient=='0' && $requestCard->cardstatus=='1'){
				$card = Cards::find($requestCard->card_id);
				
				//print_r($card);die;
				if (!empty($card)){
					$card -> idclient 		= Input::get('idclient');
					$card -> save();
					/*Session::put('lang', 'en');
					$lang = Session::get('lang');
					App::setLocale($lang);*/
					
					$client	=	Clients::find($card->idclient);
					$name	=	$client->name;
					$tomail	=	$client->email;
					//$tomail	=	'arul258013@gmail.com';
					
					Session::put('updatebagsemail', $tomail);
					/*Session::put('lang', 'it');
					$lang = Session::get('lang');
					App::setLocale($lang);*/
					Mail::send('client.sendmailtouser_regiterbag', array('name'=>$name,'card_number'=>Input::get('card_number'),'carddetails'=>$card), function($message){
							$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject(trans('emailtemplet.sub_user_regiterbag'));
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
				$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject('[Smart-track.com] Bags registration');
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
				$client	=	Clients::find($bag->idclient);
				$name	=	$client->name;
				$tomail	=	$client->email;
				//$tomail	=	'arul258013@gmail.com';
				
				Session::put('updatebagsemail', $tomail);
				Mail::send('client.smart_card_activation', array('name'=>$name, 'bagdetails'=>$bagdetails, 'bagobject' => $object), function($message){
						$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject(trans('emailtemplet.sub_smart_card_activation'));
				});
				Session::forget('updatebagsemail');
				/*$bagdetails 	= Claimsbag::find($bag->idbag);
				$client	=	Clients::find(Input::get('idclient'));
				$name	=	$client->name.' '.$client->surname;
				$tomail	=	$client->email;
				//$tomail	=	'arul258013@gmail.com';
				
				Session::put('updatebagsemail', $tomail);
				Mail::send('client.sendmailtouser_registerbags', array('name'=>$name,'idbag'=>$bag->idbag,'bagdetails'=>$bagdetails), function($message){
						$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject('[Smart-track.com] Bags registration');
				});
				Session::forget('updatebagsemail');*/
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
				$name	=	$client->name;
				$tomail	=	$client->email;
				//$tomail	=	'arul258013@gmail.com';
				
				Session::put('updatebagsemail', $tomail);
				/*Mail::send('client.sendmailtouser_registerbags', array('name'=>$name,'idbag'=>$bag->idbag,'bagdetails'=>$bagdetails), function($message){
						$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject('[Smart-track.com] Bags registration');
				});*/
				Mail::send('client.smart_card_activation', array('name'=>$name, 'bagdetails'=>$bagdetails, 'bagobject' => $object), function($message){
						$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject(trans('emailtemplet.sub_smart_card_activation'));
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
					//$price[$key]   = (float)$packages[$key]->price * (float)$exrate[$key] * floatval('1.10');
					
					$withouttax	=	(float)$packages[$key]->price * (float)$exrate[$key];
					$taxAmount = (float)$withouttax * floatval((2.5/100));
					$total = (float)$withouttax +(float)$taxAmount;
					$price[$key]   = $total;
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
				if(isset($scalo1Name[$key][0]))
					$scalo1[$key]	 		= $scalo1Name[$key][0];	
				else
					$scalo1[$key]	 		= '';	
			}else{
				$scalo1[$key]	 		= '';	
			}
			if($flights[$key]->scalo2!=''){
				$scalo2Name[$key]   	= DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->scalo2))->lists('city');
				//$scalo2[$key]	 	   	= $scalo2Name[$key][0];	
				if(isset($scalo2Name[$key][0]))
					$scalo2[$key]	 		= $scalo2Name[$key][0];	
				else
					$scalo2[$key]	 		= '';
			}else{
				$scalo2[$key]	 	  	= '';	
			}
			if($flights[$key]->scalo3!=''){
				$scalo3Name[$key]   	= DB::table('airports_all')->whereRaw('iata = ?', array($flights[$key]->scalo3))->lists('city');
				//$scalo3[$key]	 		= $scalo3Name[$key][0];	
				if(isset($scalo3Name[$key][0]))
					$scalo3[$key]	 		= $scalo3Name[$key][0];	
				else
					$scalo3[$key]	 		= '';
			}else{
				$scalo3[$key]  			= '';	
			}
			
			//pictures
			if($flights[$key]->bagpicture1!=''){
				$flights[$key]->bagpicture1 = asset('uploads/bags/'.$flights[$key]->idclient.'-'.$flights[$key]->bagpicture1) ; //URL::to('/').'/uploads/'.$flights[$key]->bagpicture1;
			}else{
				$flights[$key]->bagpicture1 = '';
			}
			
			if($flights[$key]->bagpicture2!=''){
				$flights[$key]->bagpicture2 = asset('uploads/bags/'.$flights[$key]->idclient.'-'.$flights[$key]->bagpicture2); //URL::to('/').'/uploads/'.$flights[$key]->bagpicture2;
			}else{
				$flights[$key]->bagpicture2 = '';
			}
			
			if($flights[$key]->bagpicture3!=''){
				$flights[$key]->bagpicture3 = asset('uploads/bags/'.$flights[$key]->idclient.'-'.$flights[$key]->bagpicture3); //URL::to('/').'/uploads/'.$flights[$key]->bagpicture3;
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
			//$airlines = Airportsall::where('id','=',$flights[$key]->airline)->get();
			//print_r($airlines[0]->name_airline);die;
			$data[] = array(
							    'idbag'	 		 => $flights[$key]->idbag,
							    'idclient'	 	 => $flights[$key]->idclient,
							   // 'depport'	 	 => (isset($depportName[$key][0])) ? $depportName[$key][0] : '',
								//'arrport'	 	 => (isset($arrportName[$key][0])) ? $arrportName[$key][0] : '',
								'depport'	 	 => @$depportName[$key][0],
							    'arrport'	 	 => @$arrportName[$key][0],
							    'depdate' 		 => date('d-m-Y',$flights[$key]->depdate),
								'scalo1' 		 => $scalo1[$key],
							    'scalo2' 		 => $scalo2[$key],
							    'scalo3' 		 => $scalo3[$key],
							    //'airline' 		 => $airlines[0]->name_airline,
								'airline' 		 => (isset($airlines[0])) ? $airlines[0]->name_airline : '',
							    
								
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
			$lost	=	true;
			if(Input::get('status')=='act'){
				$claims->flag_status   = '1';
				$lost	=	false;
			}
			$claims->flightstatus   = Input::get('status');
			$claims->save();
			$client	=	Clients::find($claims->idclient);
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
			//$tomail	=	'arul258013@gmail.com';
			
			/*Session::put('updatebagsemail', $tomail);
			
			Mail::send('client.sendmailtouser_updatebags', array('name'=>$name,'idbag'=>Input::get('idbag'),'bagdetails'=>$claims), function($message){
					$message->to(Session::get('updatebagsemail'))->bcc('safebag.customercare@gmail.com')->subject('[Smart-track.com] Bags Update');
			});
			Session::forget('updatebagsemail');*/
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