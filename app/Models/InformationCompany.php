<?php
/**
 * Copyright 2015, Portalz BDO
 *
 * IMS Brand Elogue Model @App\Models\FileUser.php
 * Licensed under The MIT License
 * Author : Suhendar
 * Email : hendarsyahss@gmail.com
 * Redistributions of files Portalz BDO
 *
 * @copyright Copyright 2015, IMS File Elogue Model @App\Models\FileUser.php
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InformationCompany extends Model {
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'information_companies';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['information_id','company_id'];
	
	/**
     * The attributes of primary key
     *
     * @var array
     */
	protected $primaryKey = null;
	/**
     * Auto increment
     *
     * @var boolean
     */
    public $incrementing = false;
    
	/**
     * Date with update / insert remember token
     *
     * @var boolean
     */
	public $timestamps = false;
	
	
}