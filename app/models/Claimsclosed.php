<?php

class Claimsclosed extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'claims_closed';
	
	
	public $timestamps = false;
	public $incrementing = true;
	public $primaryKey ='idclaim';
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
