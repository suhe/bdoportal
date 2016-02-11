<?php
/**
 * Copyright 2015, Portalz BDO
 *
 * IMS Brand Elogue Model @App\Models\Role.php
 * Licensed under The MIT License
 * Author : Suhendar
 * Email : hendarsyahss@gmail.com
 * Redistributions of files Portalz BDO
 *
 * @copyright Copyright 2015, IMS Role Elogue Model @App\Models\Brand.php
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {
	use Authenticatable, CanResetPassword;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','name','description','active','role_id'];
	
	/**
     * The database table used by primary key model.
     *
     * @var string
     */
	protected $primaryKey = 'id';
	
	/**
     * Date with update / insert remember token
     *
     * @var boolean
     */
	public $timestamps = false;
	
	public static function authorize()
	{
		$val = 0;
		$role = \App\Models\Role::where('id',Auth::user()->role_id)->first();
		if($role)
			$val = $role->authorize;
		return $val;	
	}
	
}