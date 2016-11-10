<?php

class Products extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sfb_products';
	
	public $timestamps = false;
	
	public $incrementing = false;
	public $primaryKey ='id_prodotto';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public static $rules_registerproducts = array(
						    'file' 			=> 'image'
						    
    );
	public static $rules_updateproducts = array(
						   'id_prodotto' 			=>'numeric'
						    
    );
	
	

}
