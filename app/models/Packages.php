<?php

class Packages extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sfb_cardpackages';
	
	public $timestamps = false;
	
	public $primaryKey ='package_id';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public static $rules_firstform = array(
						    //'price' 			=>'required|regex:/[\d]{2}.[\d]{2}/',
						    'price' 			=>'required|numeric',
						    'currency'   		=>'required|alpha',
						    'numflights'		=>'required|numeric|min:1'
						    
    );
	

}
