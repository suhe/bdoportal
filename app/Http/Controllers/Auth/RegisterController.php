<?php namespace App\Http\Controllers\Auth;

use \App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Response;
use \App\Models\User;

class RegisterController extends Controller {
	
	public function onCreate() 
	{
		$User = new User();
		if((Input::has('name')) && (Input::has('email')) && Input::has('password'))
		{
			if ($User->isUserExisted(Input::get('email'))) 
			{
				$response["error"] = true;
				$response["error_msg"] = "User already existed with " . Input::get('email');
				echo json_encode($response);
			}
			else 
			{
				$user = $User->onSaveRegister(Input::get('name'),Input::get('email'),Input::get('password'));
				if($user) 
				{
					$response = [
						"error" => false,
						"uid" => $user->unique_id,
						"user" => [
							"name" => $user->name,
							"email" => $user->email,
							"created_at" => $user->created_at,
							"updated_at" => $user->updated_at
						]
					];
					echo json_encode($response);
				}
				else 
				{
					$response["error"] = true;
					$response["error_msg"] = "Login credentials are wrong. Please try again!";
					echo json_encode($response);
				}
			}
		}
		else 
		{
			$response = [
				"error" => true,
				"error_msg" => "Required parameters (name, email or password) is missing!"
			];
			echo json_encode($response);
		}
		
	}
	
}