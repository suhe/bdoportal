<?php
/**
 * Copyright 2015, Portalz BDO
 *
 * IMS Brand Elogue Model @App\Models\Information.php
 * Licensed under The MIT License
 * Author : Suhendar
 * Email : hendarsyahss@gmail.com
 * Redistributions of files Portalz BDO
 *
 * @copyright Copyright 2015, IMS Information Elogue Model @App\Models\Brand.php
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Information extends Model {
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'informations';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','name','mime','description','active','created_by','created_at'];
	
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
	
	

	
}