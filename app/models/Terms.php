<?php

class Terms extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sfb_terms';
	
	public $timestamps = false;
	
	public $incrementing = false;
	public $primaryKey ='term_id';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public static $rules_registerterms = array(
						    'term_id' 			=>'numeric'
						    
    );
	
	

}
