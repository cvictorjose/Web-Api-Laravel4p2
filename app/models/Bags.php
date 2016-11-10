<?php

class Bags extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sfb_smartbag';
	
	public $timestamps = false;
	
	public $incrementing = false;
	public $primaryKey ='bag_id';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public static $rules_registerbags = array(
						    'idclient' 			=>'required|numeric'
						    
    );	
	
	
	public static $rules_updatebags = array(
						    'bag_id' 			=>'required|numeric'
						    
    );
	
	public static $rules_add = array(
						    'idclient' 			=>'required|numeric',
							'name' 			=>'required',
							'color' 			=>'required',
							'brand' 			=>'required'
							//'picture1' 			=>'required'
						    
    );
	
	
	public static function getbrand(){
		return array("AccessoryInnovations"=>"AccessoryInnovations", "AmericanFlyer"=>"AmericanFlyer", "ASICS"=>"ASICS", "adidas"=>"adidas", "AmericanTourister"=>"AmericanTourister", "Athalon"=>"Athalon", "AdrienneVittadini"=>"AdrienneVittadini", "AND1"=>"AND1", "Athena"=>"Athena", "AllegraK"=>"AllegraK", "AnneKlein"=>"AnneKlein", "Atlantic"=>"Atlantic", "ALPINESTARS"=>"ALPINESTARS", "Arc'Teryx"=>"Arc'Teryx", "Augusta"=>"Augusta", "Alternative"=>"Alternative", "ArmaniJeans"=>"ArmaniJeans", "AuthenticPigment"=>"AuthenticPigment", "AmericanApparel"=>"AmericanApparel", "Aigner"=>"Aigner", "BabyEssentials"=>"BabyEssentials", "BetseyJohnson"=>"BetseyJohnson", "BodyGlove"=>"BodyGlove", "Baggallini"=>"Baggallini", "BeverlyHillsPoloClub"=>"BeverlyHillsPoloClub", "Boyt"=>"Boyt", "BCBGeneration"=>"BCBGeneration", "Bigmansland"=>"Bigmansland", "Briggs&Riley"=>"Briggs&Riley", "Bella"=>"Bella", "BillBlass"=>"BillBlass", "Bumkins"=>"Bumkins", "BelleHop"=>"BelleHop", "Billabong"=>"Billabong", "Burberry"=>"Burberry", "BenSherman"=>"BenSherman", "Bodhi"=>"Bodhi", "Burton"=>"Burton", "Bench"=>"Bench", "Callaway"=>"Callaway", "Champion"=>"Champion", "Coleman"=>"Coleman", "CalvinKlein"=>"CalvinKlein", "Chloe"=>"Chloe", "Columbia"=>"Columbia", "Capezio"=>"Capezio", "ChristianAudigier"=>"ChristianAudigier", "Converse"=>"Converse", "Carhartt"=>"Carhartt", "Cloudz"=>"Cloudz", "crocs"=>"crocs", "Carter's"=>"Carter's", "COACH"=>"COACH", "Crumpler"=>"Crumpler", "CaseLogic"=>"CaseLogic", "CODi"=>"CODi", "Cutter&Buck"=>"Cutter&Buck", "CAT"=>"CAT", "ColeHaan"=>"ColeHaan", "DC"=>"DC", "DianeVonFurstenberg"=>"DianeVonFurstenberg", "DistrictThreads"=>"DistrictThreads", "Dejuno"=>"Dejuno", "DiaperDude"=>"DiaperDude", "Dolce&Gabbana"=>"Dolce&Gabbana", "Delsey"=>"Delsey", "Dickies"=>"Dickies", "Dooney&Bourke"=>"Dooney&Bourke", "DerekAlexander"=>"DerekAlexander", "Diesel"=>"Diesel", "Dopp"=>"Dopp", "DesignGo"=>"DesignGo", "Disney"=>"Disney", "DoratheExplorer"=>"DoratheExplorer", "Desigual"=>"Desigual", "Eagle"=>"Eagle", "EdHardy"=>"EdHardy", "Ellehammer"=>"Ellehammer", "EagleCreek"=>"EagleCreek", "EdHeck"=>"EdHeck", "EmporioArmani"=>"EmporioArmani", "eBags"=>"eBags", "EddieBauer"=>"EddieBauer", "ESPRIT"=>"ESPRIT", "EchoDesign"=>"EchoDesign", "Electric"=>"Electric", "Etnies"=>"Etnies", "Ecogear"=>"Ecogear", "Element"=>"Element", "FABStarpoint"=>"FABStarpoint", "Filson"=>"Filson", "Fox"=>"Fox", "FamousStarsandStraps"=>"FamousStarsandStraps", "Floto"=>"Floto", "FoxRacing"=>"FoxRacing", "FastForward"=>"FastForward", "Flud"=>"Flud", "FredPerry"=>"FredPerry", "Ferrari"=>"Ferrari", "FocusedSpace"=>"FocusedSpace", "FrenchConnection"=>"FrenchConnection", "Field&Stream"=>"Field&Stream", "Foley+Corinna"=>"Foley+Corinna", "Frye"=>"Frye", "Fila"=>"Fila", "Fossil"=>"Fossil", "Freitag"=>"Freitag", "Ghurka"=>"Ghurka", "GeoffreyBeene"=>"GeoffreyBeene", "GOJANE"=>"GOJANE", "GUESS"=>"GUESS", "Gerber"=>"Gerber", "Gucci"=>"Gucci", "Goyard"=>"Goyard", "HalstonHeritage"=>"HalstonHeritage", "HellyHansen"=>"HellyHansen", "HotTopic"=>"HotTopic", "Harley-Davidson"=>"Harley-Davidson", "HerschelSupplyCo."=>"HerschelSupplyCo.", "Humangear"=>"Humangear", "HEAD"=>"HEAD", "Hex"=>"Hex", "Hurley"=>"Hurley", "HelloKitty"=>"HelloKitty", "Heys"=>"Heys", "Hartmann"=>"Hartmann", "iSafe"=>"iSafe", "IvankaTrump"=>"IvankaTrump", "IZOD"=>"IZOD", "ITLuggage"=>"ITLuggage", "JWorld"=>"JWorld", "JessicaSimpson"=>"JessicaSimpson", "JonathanAdler"=>"JonathanAdler", "JackSpade"=>"JackSpade", "JohnDeere"=>"JohnDeere", "Jordan"=>"Jordan", "JenniChan"=>"JenniChan", "JohnVarvatos"=>"JohnVarvatos", "JuicyCouture"=>"JuicyCouture", "K-Swiss"=>"K-Swiss", "KennethColeREACTION"=>"KennethColeREACTION", "Kiva"=>"Kiva", "Keen"=>"Keen", "KIDORABLE"=>"KIDORABLE", "Knirps"=>"Knirps", "KennethColeNewYork"=>"KennethColeNewYork", "Kipling"=>"Kipling", "Knomo"=>"Knomo", "Lacoste"=>"Lacoste", "Liberty"=>"Liberty", "Loungefly"=>"Loungefly", "LaurelBurch"=>"LaurelBurch", "LillyPulitzer"=>"LillyPulitzer", "LuckyBrand"=>"LuckyBrand", "LeSportsac"=>"LeSportsac", "Lipault"=>"Lipault", "Lug"=>"Lug", "Levi's"=>"Levi's", "Lojel"=>"Lojel", "LuvableFriends"=>"LuvableFriends", "LewisN.Clark"=>"LewisN.Clark", "LondonFog"=>"LondonFog", "LuxuryDivas"=>"LuxuryDivas", "Louis Vuitton"=>"Louis Vuitton", "Longchamp"=>"Longchamp", "MANGO"=>"MANGO", "Merrell"=>"Merrell", "MODERM"=>"MODERM", "MarcbyMarcJacobs"=>"MarcbyMarcJacobs", "MetalMulisha"=>"MetalMulisha", "MonsterHigh"=>"MonsterHigh", "MarcJacobs"=>"MarcJacobs", "Mi-PacBackpacks"=>"Mi-PacBackpacks", "MossyOak"=>"MossyOak", "MarcNewYorkbyAndrewMarc"=>"MarcNewYorkbyAndrewMarc", "MichaelKors"=>"MichaelKors", "MountainHardwear"=>"MountainHardwear", "Marmot"=>"Marmot", "MICHAELMichaelKors"=>"MICHAELMichaelKors", "MudPie"=>"MudPie", "Mercury"=>"Mercury", "Nautica"=>"Nautica", "NewEra"=>"NewEra", "Nike"=>"Nike", "Neff"=>"Neff", "Nickelodeon"=>"Nickelodeon", "NineWest"=>"NineWest", "NewBalance"=>"NewBalance", "NicoleMiller"=>"NicoleMiller", "NIXON"=>"NIXON", "O'Neill"=>"O'Neill", "Olympia"=>"Olympia", "OverlandSheepskinCo"=>"OverlandSheepskinCo", "Oakley"=>"Oakley", "Orvis"=>"Orvis", "OverlandTravelware"=>"OverlandTravelware", "Oilily"=>"Oilily", "OutdoorResearch"=>"OutdoorResearch", "Pacsafe"=>"Pacsafe", "Pendleton"=>"Pendleton", "PortAuthority"=>"PortAuthority", "PanAm"=>"PanAm", "PepeJeans"=>"PepeJeans", "Prada"=>"Prada", "PASTE"=>"PASTE", "PielLeather"=>"PielLeather", "prAna"=>"prAna", "Patagonia"=>"Patagonia", "PierreCardin"=>"PierreCardin", "PUMA"=>"PUMA", "PaulFrank"=>"PaulFrank", "Poler"=>"Poler", "Quiksilver"=>"Quiksilver", "Ranipak"=>"Ranipak", "Revo"=>"Revo", "rockflowerpaper"=>"rockflowerpaper", "Rawlings"=>"Rawlings", "RicardoBeverlyHills"=>"RicardoBeverlyHills", "Rockland"=>"Rockland", "Realtree"=>"Realtree", "RipCurl"=>"RipCurl", "Roxy"=>"Roxy", "RebeccaMinkoff"=>"RebeccaMinkoff", "RMCMartinKsohoh"=>"RMCMartinKsohoh", "RVCA"=>"RVCA", "Reebok"=>"Reebok", "RobertGraham"=>"RobertGraham", "Salomon"=>"Salomon", "Skechers"=>"Skechers", "Stanley"=>"Stanley", "Samsonite"=>"Samsonite", "Spalding"=>"Spalding", "StellaMcCartney"=>"StellaMcCartney", "Sanrio"=>"Sanrio", "Speedo"=>"Speedo", "StephenJoseph"=>"StephenJoseph", "Seafolly"=>"Seafolly", "Spiderman"=>"Spiderman", "SteveMadden"=>"SteveMadden", "ShedRain"=>"ShedRain", "Sprayground"=>"Sprayground", "SwissGear"=>"SwissGear", "TapouT"=>"TapouT", "TokenBags"=>"TokenBags", "Trafalgar"=>"Trafalgar", "TedBaker"=>"TedBaker", "Tokidoki"=>"Tokidoki", "TravelBlue"=>"TravelBlue", "TheNorthFace"=>"TheNorthFace", "TommyBahama"=>"TommyBahama", "Traveler'sChoice"=>"Traveler'sChoice", "Timberland"=>"Timberland", "TommyHilfiger"=>"TommyHilfiger", "Trumpette"=>"Trumpette", "Tinkerbell"=>"Tinkerbell", "ToryBurch"=>"ToryBurch", "TUMI"=>"TUMI", "Titan"=>"Titan", "Totes"=>"Totes", "TYR"=>"TYR", "Tamrac"=>"Tamrac", "Trunki"=>"Trunki", "UltraClub"=>"UltraClub", "UnderArmour"=>"UnderArmour", "Vans"=>"Vans", "Victorinox"=>"Victorinox", "Volcom"=>"Volcom", "VeraBradley"=>"VeraBradley", "VivienneWestwood"=>"VivienneWestwood", "Voltaic Systems"=>"Voltaic Systems", "Wenger"=>"Wenger", "WesternChief"=>"WesternChief", "XOXO"=>"XOXO", "ZeroHalliburton"=>"ZeroHalliburton", "ZooYork"=>"ZooYork");
		$list	=	Brands::lists('brand_name', 'brand_name');
		
		return $list;
	}
	
	public static function getbrandlist(){
		$list	=	Brands::lists('brand_name', 'brand_name');
		
		return $list;
	}
	
	public static function getcolorcode(){
		$array	=	array("black"=>"#000000","silver"=>"#C0C0C0","gray"=>"#808080","white"=>"#FFFFFF","maroon"=>"#800000","red"=>"#FF0000","purple"=>"#800080", "fuchsia"=>"#FF00FF", "green"=>"#008000", "lime"=>"#00FF00", "olive"=>"#808000", "yellow"=>"#FFFF00", "navy"=>"#000080", "blue"=>"#0000FF","teal"=>"#008080", "aqua"=>"#00FFFF", "Orange"=>"#FFA500" );
		
		return $array;	
	}
	
	public static function getcolorlist(){
			$returnarray	=	array();
			$colors	=	self::getcolorcode();
			foreach( $colors as $key =>$value){
				$returnarray[$key]	=	$key;
			}
			
			return $returnarray;
	}
}
