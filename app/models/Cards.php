<?php

class Cards extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sfb_smartcards';
	
	public $timestamps = false;
	public $incrementing = true;
	public $primaryKey ='card_id';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public static $rules_firstform = array(
						    'start_range' 		=>'required|numeric|min:1',
						    'end_range'   		=>'required|numeric|min:1',
						    'card_number'		=>'unique:sfb_smartcards',
						    'prefix'			=>'required|size:4',
						    'suffix'			=>'required|size:2',
						    'card_color'  		=>'required|alpha_num'
						    
						    
    );
	
	public static $rules_secondform = array(
						    'card_number' 		=>'required|unique:sfb_smartcards|size:14',
						    //'prefix'			=>'required|size:4',
						   // 'suffix'			=>'required|size:2',
						    'card_color'  		=>'required|alpha_num'
						   
						    
    );

	public static $rules_third = array(
						    'card_number'		=>'unique:sfb_smartcards'
	 );
	 public static $rules_four = array(
						    'card_number'		=>'required|alpha_num|size:14'
	 );
	 
	 public static $rules_five = array(
						    'card_number'		=>'required|alpha_num|size:14',
						    'idclient'			=>'required|numeric'
	 );
	 
	  public static $rules_six= array(
						    'card_id'			=>'required|alpha_num',
						    'idclient'			=>'required|numeric'
	 );
}
