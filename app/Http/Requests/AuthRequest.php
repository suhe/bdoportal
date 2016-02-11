<?php
/**
 * Copyright 2015, Suhendar
 *
 * \App\Request\AuthRequest.php
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

class AuthRequest extends Request
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
			'email' => "required|email|min:1",
			'company_id' => "required|min:1",
			'password' => 'required|min:1',
        ];
    }
	
}

 