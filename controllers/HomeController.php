<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function welcome()
	{
		if(Auth::check()){
			echo "remember";
			return Redirect::route('myprofile');
		} else {
			return View::make('home');
			}
	}

	public function doLogin()
	{
		$rules=array(
			'Username' => 'required',
			'Password'=>'required|min:3',
			);
		$validator=Validator::make(Input::all(),$rules);

		if($validator -> fails()){
			print'validate fail';
			return Redirect::to('/')
			->withErrors($validator)
			->withInput(Input::except('Password'));
		}else{
			$userdata=array(
				'email'=>Input::get('Username'),
				'password'=>Input::get('Password'),
				'activated'=>1,
				'banned'=>0
			);
			$Isremember = (Input::has('remember_me')) ? true:false;
			if(Auth::attempt($userdata, $Isremember)){ //remember user
				Session::put('usermail',$userdata['email']);
				return Redirect::route('myprofile');
			}else{

				echo 'login failed '.$userdata['email']."  ".$userdata['password'];
			} 	
		} 		
	}
	//process register
	public function doRegister(){
		
		$rules = array(  //form validation rules
			/*'username'=> 'required|min:3', */
			'pwd'=> 'required|min:3',
			'pwd2'=> 'required|same:pwd',
			'user_email'=> 'required|email|unique:users,email',
			'terms' => 'required'
			);

		$error_msg = array(
			'same'=> 'password must match',
			'min:3'=> 'the minimal length is 3',
			'required'=> 'This field is required',
			'email'=> 'Not a valid eamil address',
			'email.unique'=> 'This email address is exits'
		);

		$validator=Validator::make(Input::all(), $rules, $error_msg);

		if($validator->fails()){ //if validation fail
			$messages=$validator->messages();
			foreach($messages->all() as $message){
				echo $message;
			};
			return Redirect::to('register')->withErrors($validator)->withInput(Input::except('pwd','pwd2'));
		}
		else { // form inputs are validated
			/*$user_name = Input::get('username');*/
			$email = Input::get('user_email');
			//save new user
			$user = new User;
			$code = $this->generate_random_string(10);

			/*$user -> user_name = $user_name;*/
			$user -> email = $email;
			$user -> password =  Hash::make(Input::get('pwd'));
			$user -> activation_code = $code;

			$user -> save(); 
			
			$mailContent=array( //content will be pass to view
				'link' => 'http://deco3801-05.uqcloud.net/email_verify/'.$code,
				/*'user_name' => $user_name,*/
				'email' => $email 
			);

			$user=array(
				'email'=> $email,
				/*'user_name' => $user_name*/
			);

			Mail::send('emails.welcom',$mailContent,function($message)use($user) {
				$message->to($user['email'])->subject('welcome to MoneyLink');
			});
			return Redirect::to('thankyou');
		}
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::route('index')->with('flash_notice', 'You are successfully logged out.');
	}

	public function verify_email($code)
	{
		try{
		$user = User::where('activation_code','=',$code)->first();
		if ($user == null ){
			echo "Invalide verfication code";
			return;
		}elseif ($user-> activated ==1) {
			echo "You have already been verified";
			return;
		}
		$user-> activated= 1;
		$user-> save();
		$id= $user->id;
		Auth::login($user);//verify success and login user
		
		//create a profile record for this new user
		$profile = UserProfile::firstOrNew(array('id'=> $id));
		$financial = FinancialProfile:: firstOrNew(array('user_id'=> $id));
		$profile-> save();
		$financial-> save();
		/*DB::table('users')
			-> where('activation_code',$code)
			-> update(array('activated'=>1));
		}catch(Exception $e) {
			echo $e -> getMessage();
		}*/
		}catch(Exception $e) {
			echo $e -> getMessage();
		}

		return Redirect::route('myprofile');
	}

/********************** helper functions **************************/

	public function generate_random_string($length=10)
	{
		$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		/*$randTimeStr=md5(time(),1);
		$result=$randomString.$randTimeStr;*/
		return $randomString;
	}
	
	}

?>

