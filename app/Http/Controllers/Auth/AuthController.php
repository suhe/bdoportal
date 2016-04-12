<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Response;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Auth;
use Lang;
use Redirect;
use Session;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	//use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	/*public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}*/
	
	public function login() {
		return view('auth.page_login');
	}
	
	public function doLogin(AuthRequest $request) {
		$loginField = ['email' => $request->get('email'), 'password' => $request->get('password')];
		$authUser = \App\Models\User::join('companies','companies.id','=','users.company_id')
		->where('email',$request->get('email'))->where('_id',$request->get('company_id'))
		->where('users.active',1)->first();
		
		if($authUser) {
			if (!Auth::attempt($loginField,false)) {
				Session::flash('message', Lang::get('message.email or password wrong'));
				return Redirect::intended('/login');
			}
			else {
				if(Auth::user()->change_password_count > 0)
					return Redirect::intended('/file/download');
				else
					return Redirect::intended('/');
			}
		} else {
			Session::flash('message', Lang::get('message.email or company id wrong'));
			return Redirect::intended('/login');
		}
	}
	
	/**
	 * Auth Process to Logout
	 * Author : Suhendar
	 * Email : hendarsyahss@gmail.com
	 * return @redirect to specific module
	 */
	public function onLogout() {
		//Activity::Record(['module' => $this->module,'event'=>'logout']);
		Auth::logout();
		return Redirect::intended('/login');
	}

}