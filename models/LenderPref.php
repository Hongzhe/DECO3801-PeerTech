<?php 

class LenderPref extends Eloquent {
	

	protected $table = 'lender_prefers';
	protected $primaryKey='user_id';
	protected $fillable = array('user_id', 'min_amount', 'min_term'
		, 'min_rate','max_amont', 'max_term', 'max_rate');
	
	public $timestamps = false;

}
