<?php
/**
 * Copyright 2015, IMS Application
 *
 * IMS UserController @App\Modules\Role\
 * Licensed under The MIT License
 * Author : Suhendar
 * Email : hendarsyahss@gmail.com
 * Redistributions of files inventory management system (ims)
 *
 * @copyright Copyright 2015, IMS Role Controller @App\Modules\Role\ 
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*/

namespace App\Http\Controllers;
use Caffeinated\Themes\Facades\Theme;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Nayjest\Grids\Components\FiltersRow;
use Nayjest\Grids\Components\Footer;
use Nayjest\Grids\Components\Header;
use Nayjest\Grids\Components\Pager;
use Nayjest\Grids\Components\RenderFunc;
use Nayjest\Grids\DataProvider;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\EloquentDataRow;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use Nayjest\Grids\IdFieldConfig;
use Eusonlito\LaravelMeta\Facade as Meta;
use Auth;
use Breadcrumbs;

class UserController extends Controller {
	/**
	* Constructor of Brand Controller
	*
	* @Auth User Permission / Check 	
	* @Breadcumbs 
	*/
	public function __construct()
	{
		Breadcrumbs::register('user', function($breadcrumbs)
		{
			$breadcrumbs->parent('home');
			$breadcrumbs->push(Lang::get('menu.users'), url('administration/user'), ['icon' => 'ace-icon fa fa-user-md']);
		});
		
		Breadcrumbs::register('user-form', function($breadcrumbs,$data)
		{
			$breadcrumbs->parent('user');
			$breadcrumbs->push(Lang::get('label.new'), url('administration/user/form'), ['icon' => 'ace-icon fa fa-file-o']);
			if($data){
				$breadcrumbs->push(Lang::get('label.edit').' > '.$data->name, url('administration/user/form/'.$data->id), ['icon' => 'ace-icon fa fa-newspaper-o']);
			}
		});
		
		
		Breadcrumbs::register('change-password', function($breadcrumbs)
		{
			$breadcrumbs->parent('home');
			$breadcrumbs->push(Lang::get('menu.change password'), url('setting/change-password'), ['icon' => 'ace-icon fa fa-key']);
		});
		
		Breadcrumbs::register('information', function($breadcrumbs)
		{
			$breadcrumbs->parent('home');
			$breadcrumbs->push(Lang::get('menu.information'), url('setting/information'), ['icon' => 'ace-icon fa fa-info']);
		});
		
		Breadcrumbs::register('user-information', function($breadcrumbs)
		{
			$breadcrumbs->parent('home');
			$breadcrumbs->push(Lang::get('menu.information'), url('user/information'), ['icon' => 'ace-icon fa fa-info']);
		});
	}
	
	/**
	* Index Layout
	*
	* @return @Theme View
	*/
	public function index()
	{
		Meta::title(Lang::get('meta.user'));
		Meta::meta('description', Lang::get('meta.user description'));
		
		$grid = new Grid(
			 (new GridConfig)
				->setDataProvider(
					new EloquentDataProvider (
						\App\Models\User::leftJoin('roles', 'roles.id', '=' ,'users.role_id')
						->leftJoin('companies', 'companies.id', '=' ,'users.company_id')
						->select('users.*')
						->addSelect('roles.name as role_name')
						->addSelect('companies._id as company_id')
						->addSelect('companies.name as company_name')
					)
				)
				->setName('grid')
				->setPageSize(15)
				->setColumns([
					(new FieldConfig)
                        ->setName('email')
                        ->setLabel(Lang::get('label.email'))
                        ->setSortable(true)   
                    ,
					(new FieldConfig)
                        ->setName('company_id')
                        ->setLabel(Lang::get('label.company id'))
                        ->setSortable(true)   
                    ,
					(new FieldConfig)
                        ->setName('company_name')
                        ->setLabel(Lang::get('label.company'))
                        ->setSortable(true)   
                    ,
					(new FieldConfig)
                        ->setName('first_name')
                        ->setLabel(Lang::get('label.first name'))
                        ->setSortable(true)   
                    ,
					(new FieldConfig)
                        ->setName('last_name')
                        ->setLabel(Lang::get('label.last name'))
                        ->setSortable(true)   
                    ,
					(new FieldConfig)
                        ->setName('role_name')
                        ->setLabel(Lang::get('label.role'))
                        ->setSortable(true)   
                    ,
					(new FieldConfig)
                        ->setName('active')
                        ->setLabel(Lang::get('label.active'))
                        ->setSortable(false)
						->setCallback(function ($val) {
							return '<a href="javascript:active(\''.$val.'\')"><center><i class="fa '.($val?'fa-check':'fa-close').'"></i></center></a>';
						})
                    ,
					(new FieldConfig)
                        ->setName('id')
                        ->setLabel(Lang::get('menu.edit'))
                        ->setSortable(false)
                        ->setCallback(function ($val) {
                            return '
								<div class="dropdown">
									<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
									<i class="glyphicon glyphicon-edit"></i>
									'.Lang::get('menu.edit').'
									<span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li><a href="'.url('administration/user/form/'.$val).'"><i class="remove glyphicon glyphicon-edit"></i> '.Lang::get('menu.edit').'</a></li>
										<li><a href="'.url('administration/user/reset-password/'.$val).'"><i class="remove fa fa-key"></i> '.Lang::get('menu.reset password').'</a></li>
										<li><a href="#" class="delete" id="'.$val.'" ><i class="glyphicon glyphicon-trash"></i> '.Lang::get('menu.remove').'</a></li>
									</ul>
								</div>';
                        })
                        
                    ,
				])
		);
		return Theme::view('users.index',compact('grid', 'text'));
	}
	
	/**
	* Function OnForm
	* to View Form User
	* @Request @Name,@Code etc
	*
	* @return json
	*/
	public function onForm($id = 0)
	{
		Meta::title(Lang::get('meta.user add'));
		Meta::meta('description', Lang::get('meta.user add description'));
		$Model = \App\Models\User::select(['id','first_name','last_name','email','role_id','active','information','company_id'])
		->where('id',$id)
		->first();
		return Theme::view('users.form',[
			'data' => $Model
		]);	
	}
	
	/**
	* Function OnForm
	* to View Form User
	* @Request @Name,@Code etc
	*
	* @return json
	*/
	public function onPageResetPassword($id = 0)
	{
		Meta::title(Lang::get('meta.reset password'));
		Meta::meta('description', Lang::get('meta.reset password description'));
		$Model = \App\Models\User::select(['id','first_name','last_name','email','role_id','active','information','company_id'])
		->where('id',$id)
		->first();
		return Theme::view('users.reset-password',[
			'data' => $Model
		]);	
	}
	
	/**
	* Function Store
	* to Save/Update Brand From Brand Form
	* @Request @Name,@Code etc
	*
	* @return json
	*/
	public function onStore(\App\Http\Requests\UserRequest $request)
	{
		$is_exist = \App\Models\User::where('email', $request->get('email'))->where('id', '!=', $request->get('id'))->get(['id'])->first();
		
		if($is_exist)
		{
			$param['error'] =  true;
			$param['message'] = Lang::get('message.user unique email');
			return json_encode($param);
		}
		
		$user = new \App\Models\User();
		if($request->get('id') != 0)
		{
			$user = $user->where('id',$request->get('id'))->first();
			$user->updated_at = date('Y-m-d H:i:s');
			$user->updated_by = Auth::user()->id;
		}
		else
		{
			$user->password = bcrypt($request->get('password'));
			$user->created_at = date('Y-m-d H:i:s');
			$user->created_by = Auth::user()->id;
		}
		
		$user->first_name = $request->get('first_name');
		$user->last_name = $request->get('last_name');
		$user->email = $request->get('email');
		$user->company_id = $request->get('company_id');
		$user->role_id = $request->get('role_id');
		$user->active = $request->get('active')?$request->get('active'):0;
		$user->information = $request->get('information');
		$user->save();
		
		$param['message'] =  $request->get('id')?Lang::get('info.updated'):Lang::get('info.inserted');
		$param['error'] = false; 
		return json_encode($param);
	}
	
	/**
	* Function Store
	* to Save/Update Brand From Brand Form
	* @Request @Name,@Code etc
	*
	* @return json
	*/
	public function onResetPassword(\App\Http\Requests\ResetPasswordRequest $request)
	{
		$user = new \App\Models\User();
		$user = $user->where('id',$request->get('id'))->first();
		$user->updated_at = date('Y-m-d H:i:s');
		$user->updated_by = Auth::user()->id;
		$user->password = bcrypt($request->get('password'));
		$user->save();
		$param['message'] =  $request->get('id')?Lang::get('info.updated'):Lang::get('info.inserted');
		$param['error'] = false; 
		return json_encode($param);
	}
	
	/**
	* Function Remove
	* Process Delete the Brand Data
	*
	* @return \Illuminate\Http\JsonResponse
	*/
	public function onDelete()
	{
		$id = Input::get('id');
		$Model = \App\Models\User::select(['id'])
		->where('id',$id)
		->first();
		
		if($Model)
		{
			\App\Models\User::where('id', $id)->delete();
			$param['message'] = Lang::get('message.has deleted');
			$param['error'] = false;
		}
		else
		{
			$param['message'] = Lang::get('message.has error');
			$param['error'] = true;
		}
		return json_encode($param);
	}
	
	/**
	* Function OnForm
	* to View Form User
	* @Request @Name,@Code etc
	*
	* @return json
	*/
	public function onPageInformation($id = 0)
	{
		Meta::title(Lang::get('meta.user'));
		Meta::meta('description', Lang::get('meta.user information'));
		
		/** File Information Download **/
		$query = \App\Models\Information::leftJoin('users', 'users.id', '=' ,'informations.created_by')
		->select('informations.*')
		->addSelect("users.first_name as upload_name")
		->where('informations.active', '=', '1');
		$grid = new Grid(
			(new GridConfig)
			->setDataProvider(
				new EloquentDataProvider (
					$query
				)
			)
			->setName('grid')
			->setPageSize(15)
			->setColumns([
				(new FieldConfig)
				->setName('name')
				->setLabel(Lang::get('label.name'))
				->setSortable(false)
				->setCallback(function ($val) {
					return '<a href="'.url('file/information/download/'.$val).'">'.$val.'</a>';
				})
				,
				(new FieldConfig)
				->setName('description')
				->setLabel(Lang::get('label.description'))
				->setSortable(true)
				,
							
				(new FieldConfig)
				->setName('upload_name')
				->setLabel(Lang::get('label.upload by'))
				->setSortable(true)
				,
				(new FieldConfig)
				->setName('upload_at')
				->setLabel(Lang::get('label.upload at'))
				->setSortable(true)
				,				
			])
		);
		
		
		/** End File Information Download **/
		
		return Theme::view('users.pages.information',[
			'data' => Auth::user(),
			'grid' => $grid,
			
		]);	
	}
	
	/**
	* Function OnForm
	* to View Form User
	* @Request @Name,@Code etc
	*
	* @return json
	*/
	public function onPageChangePassword()
	{
		Meta::title(Lang::get('meta.change password'));
		Meta::meta('description', Lang::get('meta.change user password'));
		return Theme::view('users.pages.change-password',[
			'data' => 0
		]);	
	}
	
	/**
	* Function Store
	* to Save/Update Brand From Brand Form
	* @Request @Name,@Code etc
	*
	* @return json
	*/
	public function onChangePassword(\App\Http\Requests\ChangePasswordRequest $request)
	{
		$user = new \App\Models\User();
		$user = $user->where('id',Auth::user()->id)->first();
		$user->password = bcrypt($request->get('password'));
		$user->updated_by = Auth::user()->id;
		$user->updated_at = date('Y-m-d H:i:s');
		$user->save();
		$param['message'] =  Lang::get('message.updated');
		$param['error'] = false; 
		return json_encode($param);
	}
	
	/**
	* Index Layout
	*
	* @return @Theme View
	*/
	public function onPageUserInformation() {
		Meta::title(Lang::get('meta.user information'));
		Meta::meta('description', Lang::get('meta.user information description'));
		
		$query = \App\Models\User::leftJoin('roles', 'roles.id', '=' ,'users.role_id')
		->leftJoin('companies', 'companies.id', '=' ,'users.company_id')
		->select('users.*')
		->where('roles.authorize','=','0');
	
		if(Auth::user()->authorize() != 1)
			$query = $query->where('users.company_id','=',Auth::user()->company_id);
			
		$query = $query->addSelect('roles.name as role_name')
		->addSelect('companies._id as company_id')
		->addSelect('companies.name as company_name');	
		
		$grid = new Grid(
			 (new GridConfig)
				->setDataProvider(
					new EloquentDataProvider (
						$query
					)
				)
				->setName('grid')
				->setPageSize(15)
				->setColumns([
					(new FieldConfig)
                        ->setName('email')
                        ->setLabel(Lang::get('label.email'))
                        ->setSortable(true)   
                    ,
					(new FieldConfig)
                        ->setName('first_name')
                        ->setLabel(Lang::get('label.first name'))
                        ->setSortable(true)   
                    ,
					(new FieldConfig)
                        ->setName('last_name')
                        ->setLabel(Lang::get('label.last name'))
                        ->setSortable(true)   
                    ,
					(new FieldConfig)
                        ->setName('information')
                        ->setLabel(Lang::get('label.leave entitlement'))
                        ->setSortable(true)   
                    ,
					(new FieldConfig)
                        ->setName('active')
                        ->setLabel(Lang::get('label.active'))
                        ->setSortable(false)
						->setCallback(function ($val) {
							return '<a href="javascript:active(\''.$val.'\')"><center><i class="fa '.($val?'fa-check':'fa-close').'"></i></center></a>';
						})
                    ,
				])
		);
		
		$grid2 = new Grid ( (new GridConfig ())->setDataProvider ( new EloquentDataProvider ( \App\Models\Information::leftJoin ( 'users', 'users.id', '=', 'informations.created_by' )->select ( 'informations.*' )->addSelect ( "users.first_name as upload_name" )->addSelect ( "informations.created_at as upload_at" ) ) )->setName ( 'grid' )->setPageSize ( 15 )->setColumns ( [
				(new FieldConfig ())->setName ( 'name' )->setLabel ( Lang::get ( 'label.name' ) )->setSortable ( false )->setCallback ( function ($val) {
					return '<a href="' . url ( 'file/information/download/' . $val ) . '">' . $val . '</a>';
				} ),
				(new FieldConfig ())->setName ( 'description' )->setLabel ( Lang::get ( 'label.description' ) )->setSortable ( true ),
				(new FieldConfig ())->setName ( 'upload_name' )->setLabel ( Lang::get ( 'label.upload by' ) )->setSortable ( true ),
				(new FieldConfig ())->setName ( 'upload_at' )->setLabel ( Lang::get ( 'label.upload at' ) )->setSortable ( true ),
				
				]
		) );
		
		return Theme::view('users.pages.user-information',compact('grid','grid2','text'));
	}
	
	
	
}
 