<?php

class Claimsbag extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'claims_bag';
	
	public $timestamps = false;
	public $incrementing = true;
	public $primaryKey ='idbag';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public static $rules_status = array(
						    'idbag' 			=>'required|numeric'
						    
    );
	
	public function claims()
    {
        return $this->hasOne('Claims', 'idclaim', 'idclaim');
    }
	
	public function airlines()
    {
        return $this->hasOne('Airportsall', 'id', 'airline');
    }
	
	public static function getSavepath(){
		//$destinationPath = 'uploads';
		$destinationPath = '/var/www/html/safe-bag/stws/public/uploads';	
		return $destinationPath;
	}
	
	public static function getSavedpath(){
		//$destinationPath = 'uploads';
		$destinationPath = 'http://safe-bag.com/stws/public/';	 
		return $destinationPath;
	}

}
