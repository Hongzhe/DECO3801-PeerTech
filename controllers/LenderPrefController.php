<?php

class LenderPrefController extends BaseController {
 
	public function LendPref()
	{   
		$id = Auth::user()-> id;
		$LendPrefers =  LenderPref::where('id','=', $id)-> first();

		$minAmount = $lenderPrefers-> min_amount;
		$minTerm = $lenderPrefers-> min_term;
		$minRate = $lenderPrefers-> min_rate;
		$maxAmount = $lenderPrefers-> max_amount;
		$maxTerm = $lenderPrefers-> max_term;
		$maxRate = $lenderPrefers-> max_rate;
	
		$data =array(
				'minAmount'=> $minAmount, 
				'minTerm'=> $minTerm,
				'minRate' => $minRate,
				'maxAmount'=> $maxAmount,
				'minTerm'=> $maxTerm,
				'minRate'=> $maxRate
			);
		return View::make('lendPage')-> with($data); 
	}   
	
	public function saveLendPref(){

		$id = Auth::user()-> id;
		$loanApp = LoanApp::where('user_id','=',$id)->get();
		$profile =  UserProfile::where('id','=', $id)-> first();
		$financial = FinancialProfile::where('user_id', $id)-> first();
		
		$lender_prefers =  LenderPref::firstOrNew(array('user_id'=> $id));
		$lender_prefers -> min_amount =Input::get('minLoan'); 
		$lender_prefers -> min_term =Input::get('minTerm');
		$lender_prefers -> min_rate =Input::get('minRate');
		$lender_prefers -> max_amount=Input::get('maxLoan'); 
		$lender_prefers -> max_term =Input::get('maxTerm'); 
		$lender_prefers -> max_rate =Input::get('maxRate'); 
		$lender_prefers -> save();
		
		$results = $this-> search();
		$pdata = $profile->getProfile($id);   // method defined in its model
		$fdata = $financial->getFinancialProfile($id); // methd defined in its model

			$bids = DB::table('bids')
				 -> join('loan_app','bids.loan_id','=', 'loan_app.loan_id')
				 -> join('profile','profile.id','=','loan_app.user_id')
				 -> select('bid_amount','pref_rate', 'term','purpose','fname','lname')
				 -> orderBy('bid_date','DESC')
				 -> get();

		return View::make('myprofiles',compact('bids','pdata','fdata','results','loanApp'));     
	/*	return Redirect::route('myprofile');   */
	}

	/*search mathing loan applications*/
	public function search() {
		$id = Auth::user()-> id;	
		$lendPrefers = LenderPref::where('user_id','=',$id)->first();
		
		//get lender prferences
		$maxAmount = $lendPrefers-> max_amount;
		$minAmount = $lendPrefers-> min_amount;
		$maxRate = $lendPrefers-> max_rate;
		$minRate = $lendPrefers-> min_rate;
		$maxTerm = $lendPrefers-> max_term;
		$minTerm= $lendPrefers-> min_term;
		$data = array(
			'maxAmount'=> $maxAmount,
			'minAmount'=> $minAmount,
			'maxRate'=> $maxRate,
			'minRate'=> $minRate,
			'maxTerm'=> $maxTerm,
			'minTerm'=> $minTerm
		);

		//search for matched application
		$loanApps = DB::table('loan_app')
					->join('profile','loan_app.user_id','=','profile.id')
					->select('profile.fname','profile.lname','loan_app.amount',
							  'loan_app.pref_rate','loan_app.term','loan_app.purpose','loan_app.loan_id')
					-> whereBetween('amount',array($data['minAmount'], $data['maxAmount']))
				    ->whereBetween('term',array($data['minTerm'], $data['maxTerm']))
				    -> whereBetween('pref_rate', array($data['minRate'], $data['maxRate']))
				    -> where('loan_app.user_id','<>', $id)  //exclude user
				    -> orderBy('weight','DESC')
				    ->get();
		return $loanApps;
	} 
}
?>
