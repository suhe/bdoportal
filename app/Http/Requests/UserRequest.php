<?php
/**
 * Copyright 2015, Suhendar
 *
 * \App\Request\RoleRequest.php
 * Licensed under The MIT License
 * Author : Suhendar
 * Email : hendarsyahss@gmail.com
 * Redistributions of files Bdo Portalz
 *
 * @copyright Copyright 2015, Portalz 
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace App\Http\Requests;
use App\Http\Requests\Request;

class UserRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
    /**
     * Get the validation rules that apply to the request.
     * Error -- unique:companies,name,$id,id --
     * @return array
     */
    public function rules()
    {
        return [
			'first_name' => "required|min:1",
			'last_name' => "required|min:1",
			'company_id' => "required|min:1",
			'email' => "required|min:1|email",
			'role_id' => "required",
			'password' => "required_if:id,0",
			'repeat_password' => 'required_if:id,0|same:password',
			'information' => "required|min:1",
        ];
    }
	
	/**
	* Get the error messages for the defined validation rules.
	*
	* @return array
	*/
   public function messages()
   {
	   return [
		   'password.required_if' => 'The password field is required ',
		   'repeat_password.required_if' => 'The repeat password field is required ',
	   ];
   }
	
}

 