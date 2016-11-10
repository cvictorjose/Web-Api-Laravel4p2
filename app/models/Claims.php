<?php

class Claims extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'claims';
	
	public $timestamps = false;
	public $incrementing = true;
	public $primaryKey ='idclaim';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public static $rules_addclaims = array(
						    'sigdate' 			=>'required',
							'lost' 			=>'required',
							'idbag'			=>'required',	
							'notes'			=>'required',						
							
						    
    );
	
	public function claimsbag()
    {
        return $this->hasOne('Claimsbag', 'idclaim', 'idclaim');
    }

}
