<?php

class Exchange extends Eloquent  {

	
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sfb_exchange_rates';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
    public $timestamps = false;
	public $primaryKey ='currency_code';



	

}
