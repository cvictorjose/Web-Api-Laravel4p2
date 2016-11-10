<?php

class Claimslog extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'claims_log';
	
	
	public $timestamps = false;
	public $incrementing = true;
	public $primaryKey ='idlog';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	
	
	public function claims()
    {
        return $this->hasOne('Claims', 'idclaim', 'idclaim');
    }
	
	

}
