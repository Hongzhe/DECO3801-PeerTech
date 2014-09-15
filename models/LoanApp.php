<?php 

class LoanApp extends Eloquent {
	

	protected $table = 'loan_app';
	protected $primaryKey= 'loan_id';
	protected $fillable = array('loan_id','user_id', 'amount', 'term'
		, 'pref_rate','purpose', 'description','weight');
	
	public $timestamps = false;
	
	public function evaluateWeight($id, $loan_id) {
		$finance = FinancialProfile::where('user_id', '=', $id)->first();
		$count = LoanApp::where('user_id','=',$id)->count();
		$loan_app = LoanApp::where('loan_id','=', $loan_id)->first();
		$current_bids = Bid::where('loan_id', '=', $loan_id)->count();
		
		$amout = $loan_app-> amount;
		$term = $loan_app-> term;
		$rate= $loan_app-> pref_rate;
		 
		$residence = $finance-> residence_status;

		$year_income = ($finance-> monthly_income) *12;
		
		$home_loan = $finance-> home_loan;
		$car_loan = $finance-> car_loan;
		$other_loan = $finance-> other_loan;
		$expense = $finance-> loan_repayment;
		$other_exp = $finance-> other_expense;
		
		$house_owner = 0;
		if(strcmp($residence,'Mortage')==0 || strcmp($residence,'noMortage')==0) {
			$house_owner = 1;
		}

		$property = $finance-> property;
		$vehicle = $finance-> vehicle;
		$share = $finance-> share;
		$other_property = $finance-> others;

		$active_loan =  
		$total_liab = $home_loan+$car_loan+$other_loan;
		$income_debt_ratio = $year_income/(1+ $count + $total_liab);
		$total_assests = $property+$vehicle+$share+$other_property;
		$disposable_income = $year_income - $total_liab;

		$sum = $rate + $house_owner+$total_assests+ $income_debt_ratio
				+ $current_bids + $disposable_income;

		$weight =  pow($sum, 1/6);
		//$loan_app-> weight = $weight; 
		return $weight;
	}	
}