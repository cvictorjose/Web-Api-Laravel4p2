<?php

class Transactions extends Eloquent  {

	
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sfb_smarttransactions';
	public $timestamps = false;
	public $incrementing = true;
	public $primaryKey ='order_id';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
   public static $rules_one = array(
						    'paytype' 		=> 'required',
						    //'transaction_id'=> 'required',
						    'idclient'		=> 'required|numeric'
	);




	

}
