<?php

class Ranks extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sfb_airportsrank';
	
	public $timestamps = false;
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public static $rules_firstform = array(
						    'price' 			=>'required|numeric',
							
						    
    );
	

}
