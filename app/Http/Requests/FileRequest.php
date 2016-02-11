<?php
/**
 * Copyright 2015, Suhendar
 *
 * \App\Request\FileRequest.php
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

class FileRequest extends Request
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
			'name' => "required|min:1",
			'description' => 'required|min:1',
			'image'	=> 'required_if:id,""'
        ];
    }
	
}

 