<?php

class Passthroughpercentage extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sfb_passthroughpercentage';
	
	public $timestamps = false;
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public static $rules_firstform = array(
						    'no_passthrough' 			=>'required|numeric',
							'percentage' 			=>'required|numeric',
						    
    );
	

}
