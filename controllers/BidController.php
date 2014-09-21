<?php

class BidController extends BaseController {

	public function makeBid($loan_id) {
		$id = Auth::user()-> id;
		$loan_app = LoanApp::where('loan_id','=',$loan_id)->first();
		$bid_Id;	
		
		if(! Bid::isMadeBefore($loan_id, $id) ) {
			$bid = new Bid;
			$bid-> user_id = $id;
			$bid-> loan_id = $loan_id;
			$bid-> bid_date = date('Y-m-d H:i:s');
			$bid-> bid_amount = $loan_app-> amount;
		
		/*$bid-> bid_term = $loan_app-> term;
		$bid-> bid_rate = $loan_app-> pref_rate; */
	

			$bid-> save();
		/*$bid_Id= $bid-> bid_id;*/
		/*$bid_acc = BidAccept::firstOrNew('where','=',$bid_Id);
		$bid_acc -> loan_id = $loan_id;
		$bid_acc -> accepte = 0;*/

		//update the loan weight
			$weight = $loan_app->evaluateWeight($id, $loan_id);
			$loan_app-> save();	    
		}
	/*	$bid_acc = BidAccept::firstOrNew(array('bid_id'=>$bid_Id));
		$bid_acc -> loan_id = $loan_id;
		$bid_acc -> accepted = 0;
		$bid_acc->save();*/
		/*$pdata = $profile->getProfile($id);   // method defined in its model
		$fdata = $financial->getFinancialProfile($id); */// methd defined in its model

		return Redirect::route('lend');
	}

}
