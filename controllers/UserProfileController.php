<?php

class UserProfileController extends BaseController {

	/* pass data to profile view */
	public function profile()
	{   
		$id = Auth::user()-> id;
		$usermail = Auth::user()-> email;

		$profile =  UserProfile::where('id','=', $id)-> first();
		
		$financial = FinancialProfile::where('user_id', $id)-> first();

		$bids = DB::table('bids')
				 -> join('loan_app','bids.loan_id','=', 'loan_app.loan_id')
				 -> join('profile','profile.id','=','loan_app.user_id')
				 -> select('bid_amount','pref_rate', 'term','purpose','fname','lname')
				 -> orderBy('bid_date','DESC')
				 -> get();

		$loanApp =  LoanApp:: where('user_id','=', $id)->get();
		
		$allLoan = DB::table('loan_app')
					-> join('profile','loan_app.user_id','=','profile.id')
					-> select('profile.fname','profile.lname','loan_app.amount',
							  'loan_app.pref_rate','loan_app.term','loan_app.purpose','loan_app.loan_id')
					-> where('loan_app.user_id','<>',$id)  //exclude user 
				    -> orderBy('weight','DESC')
				    -> get();
		
		// think about cacahe below two queries 
		$pdata = $profile->getProfile($id);   //  method defiend in its model
		$age = '2014' - $pdata['year_dob'];
		$fdata = $financial->getFinancialProfile($id); // methd defined in its model
					
		return View::make('profile',compact('bids','pdata','fdata', 'loanApp', 'allLoan', 'age'));
	}
	public function borrow()
	{   
		$id = Auth::user()-> id;
		$usermail = Auth::user()-> email;

		$profile =  UserProfile::where('id','=', $id)-> first();
		
		$financial = FinancialProfile::where('user_id', $id)-> first();

		$bids = DB::table('bids')
				 -> join('loan_app','bids.loan_id','=', 'loan_app.loan_id')
				 -> join('profile','profile.id','=','loan_app.user_id')
				 -> select('bid_amount','pref_rate', 'term','purpose','fname','lname')
				 -> orderBy('bid_date','DESC')
				 -> get();

		$loanApp =  LoanApp:: where('user_id','=', $id)->get();
		
		$allLoan = DB::table('loan_app')
					-> join('profile','loan_app.user_id','=','profile.id')
					-> select('profile.fname','profile.lname','loan_app.amount',
							  'loan_app.pref_rate','loan_app.term','loan_app.purpose','loan_app.loan_id')
					-> where('loan_app.user_id','<>',$id)  //exclude user 
				    -> orderBy('weight','DESC')
				    -> get();
		
		// think about cacahe below two queries 
		$pdata = $profile->getProfile($id);   //  method defiend in its model
		$fdata = $financial->getFinancialProfile($id); // methd defined in its model
					
		return View::make('borrow',compact('bids','pdata','fdata', 'loanApp', 'allLoan'));
	}
	public function lend()
	{   
		$id = Auth::user()-> id;
		$usermail = Auth::user()-> email;

		$profile =  UserProfile::where('id','=', $id)-> first();
		
		$financial = FinancialProfile::where('user_id', $id)-> first();

		$bids = DB::table('bids')
				 -> join('loan_app','bids.loan_id','=', 'loan_app.loan_id')
				 -> join('profile','profile.id','=','loan_app.user_id')
				 -> select('bid_amount','pref_rate', 'term','purpose','fname','lname')
				 -> orderBy('bid_date','DESC')
				 -> get();

		$loanApp =  LoanApp:: where('user_id','=', $id)->get();
		
		$allLoan = DB::table('loan_app')
					-> join('profile','loan_app.user_id','=','profile.id')
					-> select('profile.fname','profile.lname','loan_app.amount',
							  'loan_app.pref_rate','loan_app.term','loan_app.purpose','loan_app.loan_id')
					-> where('loan_app.user_id','<>',$id)  //exclude user 
				    -> orderBy('weight','DESC')
				    -> get();
		
		// think about cacahe below two queries 
		$pdata = $profile->getProfile($id);   //  method defiend in its model
		$fdata = $financial->getFinancialProfile($id); // methd defined in its model
					
		return View::make('lend',compact('bids','pdata','fdata', 'loanApp', 'allLoan'));
	}
	public function mytransaction()
	{   
		$id = Auth::user()-> id;
		$usermail = Auth::user()-> email;

		$profile =  UserProfile::where('id','=', $id)-> first();
		
		$financial = FinancialProfile::where('user_id', $id)-> first();

		$bids = DB::table('bids')
				 -> join('loan_app','bids.loan_id','=', 'loan_app.loan_id')
				 -> join('profile','profile.id','=','loan_app.user_id')
				 -> select('bid_amount','pref_rate', 'term','purpose','fname','lname')
				 -> where('bids.user_id','=',$id)
				 -> orderBy('bid_date','DESC')
				 -> get();

		$loanApp =  LoanApp:: where('user_id','=', $id)->get();
		
		$allLoan = DB::table('loan_app')
					-> join('profile','loan_app.user_id','=','profile.id')
					-> select('profile.fname','profile.lname','loan_app.amount',
							  'loan_app.pref_rate','loan_app.term','loan_app.purpose','loan_app.loan_id')
					-> where('loan_app.user_id','<>',$id)  //exclude user 
				    -> orderBy('weight','DESC')
				    -> get();
		/*$active_bids = DB::table('loan_app')
				     -> join('bids_accepted','loan_app.loan_id','=','bids_accepted.loan_id')
				     -> join('bids','bids_accepted.bid_id','=','bids.bid_id')
				     -> join('users','loan_app.user_id','=', 'users.id')
				     -> select('users.email','bids.bid_amount','term','pref_rate','purpose','loan_app.progress')
				     -> where('bids.user_id','=', $id)
				     -> where('bids_accepted.loan_id','=','loan_app.loan_id')
				     -> where('bids_accepted.accepted','=','1')
				     //-> where('users.id','=','loan_app.user_id')
				     -> get();*/
		$accepted_bid = DB:: table('bids')
						-> join('bids_accepted','bids.bid_id','=', 'bids_accepted.bid_id')
						-> select('bids.loan_id','bid_amount')
						-> where('user_id','=', $id)
						-> where('bids_accepted.accepted','=','1')
						-> get();
		$loanIds =array();
		foreach($accepted_bid as $b) {
			array_push($loanIds,$b->loan_id);
		};
		if(sizeof($loanIds)==0) {
			array_push($loanIds,'z');
		};
		$accepted_loan = DB::table('loan_app')
						-> join('users','users.id','=','loan_app.user_id')
						-> join('bids','loan_app.loan_id','=', 'bids.loan_id')
						-> select('bid_amount','users.email','term','pref_rate','purpose','progress')
						-> whereIn('loan_app.loan_id',$loanIds)
						-> where('bids.user_id','=', $id)
						-> get();

		// think about cacahe below two queries 
		$pdata = $profile->getProfile($id);   //  method defiend in its model
		$fdata = $financial->getFinancialProfile($id); // methd defined in its model
		
		return View::make('mytransaction',compact('loanIds','bids','pdata','fdata', 'loanApp', 'allLoan','accepted_loan'));	
	}
	public function editProfile() {
		$id = Auth::user()-> id;
		$usermail = Auth::user()-> email;

		$userProfile =  UserProfile::where('id','=', $id)-> first();

		if($userProfile == null) // if user has not add it profile. 
			return View::make('editprofiles')->with('usermail',$usermail);
			
		$userfname = $userProfile-> fname; 
		$userlname = $userProfile-> lname;
		$userstreetno = $userProfile-> streetno;
		$userstreet = $userProfile-> street;
		$usersuburb = $userProfile-> suburb;
		$userstate = $userProfile-> state;
		$userpostcode = $userProfile-> postcode;
		$userdobday = $userProfile-> day_dob;
		$userdobmonth = $userProfile-> month_dob;
		$userdobyear = $userProfile-> year_dob;
		$userphone = $userProfile-> phone;
		$usertfn = $userProfile-> tfn;
		$userpidtype = $userProfile-> pidtype;
		$userpidnum = $userProfile-> pidnum;
		$usersidtype = $userProfile-> sidtype;
		$usersidnum = $userProfile-> sidnum;
		$userdes = $userProfile-> description;

		$data =array(
				'usermail'=> $usermail, 
				'userfname'=> $userfname,
				'userlname' => $userlname,
				'userstreetno' => $userstreetno,
				'userstreet' => $userstreet,
				'usersuburb' => $usersuburb,
				'userstate' => $userstate,
				'userpostcode' => $userpostcode,
				'day_dob' => $userdobday,
				'month_dob' => $userdobmonth,
				'year_dob' => $userdobyear,
				'userphone' => $userphone,
				'usertfn' => $usertfn,
				'userpidtype' => $userpidtype,
				'userpidnum' => $userpidnum,
				'usersidtype' => $usersidtype,
				'usersidnum' => $usersidnum,
				'userdes' => $userdes,
				'usergender' => $userProfile-> gender,
				'useroccuptaion'=> $userProfile-> occupation,

			);
		return View::make('editprofiles',array('data'=>$data)); 
	}

	/* save user profile */
	public function saveProfile(){
		$id = Auth::user()-> id;
		
		$profile =  UserProfile::firstOrNew(array('id' => $id));
		$profile -> fname =Input::get('fname');
		$profile -> lname =Input::get('lname');
		$profile -> streetno=Input::get('streetno');
		$profile -> street =Input::get('street');
		$profile -> suburb =Input::get('suburb');
		$profile -> postcode =Input::get('postcode');
		$profile -> state = Input::get('state');
		$profile -> day_dob=Input::get('day_dob');
		$profile -> month_dob=Input::get('month_dob');
		$profile -> year_dob=Input::get('year_dob');
		$profile -> phone=Input::get('phone');
		$profile -> tfn=Input::get('tfn');
		$profile -> pidtype=Input::get('pidtype');
		$profile -> pidnum=Input::get('pidnum');
		$profile -> sidtype=Input::get('sidtype');
		$profile -> sidnum=Input::get('sidnum');
		$profile -> description = Input::get('description');
		$profile -> gender = Input::get('gender');
		$profile -> occupation = Input::get('occupation');
		$profile -> save();

		return Redirect::to('profile');        
	}

	public function saveFinancialProfile(){
		$id = Auth::user()-> id;
		$profile =  FinancialProfile::firstOrNew(array('user_id' => $id));
		$profile -> residence_status = Input::get('residence');
		$profile ->  year_cur_addr = Input::get('year_cur_addr');
		$profile -> year_cur_addr = Input::get('month_cur_addr');
		$profile -> year_old_addr = Input::get('year_old_addr');
		$profile -> year_old_addr = Input::get('year_old_addr');
		$profile -> employ_status = Input::get('employment');
		$profile -> employer = Input::get('employer');
		$profile -> position = Input::get('position');
		$profile -> year_cur_job = Input::get('year_cur_job');
		$profile -> month_cur_job = Input::get('month_cur_job');
		$profile -> year_old_job = Input::get('year_old_job');
		$profile -> month_old_job = Input::get('month_old_job');
		$profile -> monthly_income = Input::get('income');
		$profile -> loan_repayments = Input::get('payment');
		$profile -> other_expense = Input::get('expense');
		$profile -> home_loan = Input::get('homeloan');
		$profile -> car_loan = Input::get('carloan');
		$profile -> other_loan = Input::get('otherloan');
		$profile -> property = Input::get('property');
		$profile -> vehicle = Input::get('vehicle');
		$profile -> share = Input::get('share');
		$profile -> others = Input::get('otherproperty');
		$profile -> save();
		return Redirect::to("thankyou");
	}
	
}
?>
