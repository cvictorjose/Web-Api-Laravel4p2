<?php

class Brands extends Eloquent  {

	
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'st_brands';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
    public $timestamps = false;
	public $primaryKey ='brand_id';



	

}
