<?php
/**
 * Copyright 2015, IMS Application
 *
 * IMS RoleController @App\Modules\Role\
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
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use Eusonlito\LaravelMeta\Facade as Meta;
use Auth;
use Breadcrumbs;

class RoleController extends Controller {
	/**
	* Constructor of Brand Controller
	*
	* @Auth User Permission / Check 	
	* @Breadcumbs 
	*/
	public function __construct()
	{
		Breadcrumbs::register('role', function($breadcrumbs)
		{
			$breadcrumbs->parent('home');
			$breadcrumbs->push(Lang::get('menu.user role'), url('administration/role'), ['icon' => 'ace-icon fa fa-user-md']);
		});
		
		Breadcrumbs::register('role-form', function($breadcrumbs,$data)
		{
			$breadcrumbs->parent('role');
			$breadcrumbs->push(Lang::get('label.new'), url('administration/role/form'), ['icon' => 'ace-icon fa fa-file-o']);
			if($data){
				$breadcrumbs->push(Lang::get('label.edit').' > '.$data->name, url('adminisration/role/form/'.$data->id), ['icon' => 'ace-icon fa fa-newspaper-o']);
			}
		});
	}
	
	/**
	* Index Layout
	*
	* @return @Theme View
	*/
	public function index()
	{
		Meta::title(Lang::get('meta.role'));
		Meta::meta('description', Lang::get('meta.role description'));
		
		$grid = new Grid(
			 (new GridConfig)
				->setDataProvider(
					new EloquentDataProvider(\App\Models\Role::query())
				)
				->setName('grid')
				->setPageSize(15)
				->setColumns([
					(new FieldConfig)
                        ->setName('id')
                        ->setLabel(Lang::get('label.id'))
                        ->setSortable(false)
                        ->setSorting(Grid::SORT_ASC)
                    ,
					(new FieldConfig)
                        ->setName('name')
                        ->setLabel(Lang::get('label.name'))
                        ->setSortable(true)   
                    ,
					(new FieldConfig)
                        ->setName('description')
                        ->setLabel(Lang::get('label.description'))
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
                        ->setName('authorize')
                        ->setLabel(Lang::get('label.authorize'))
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
										<li><a href="'.url('administration/role/form/'.$val).'"><i class="remove glyphicon glyphicon-edit"></i> '.Lang::get('menu.edit').'</a></li>
										<li><a href="#" class="delete" id="'.$val.'" ><i class="glyphicon glyphicon-trash"></i> '.Lang::get('menu.remove').'</a></li>
									</ul>
								</div>';
                        })
                        
                    ,
				])
		);
		return Theme::view('roles.index',compact('grid', 'text'));
	}
	
	public function onForm($id = 0)
	{
		Meta::title(Lang::get('meta.role add'));
		Meta::meta('description', Lang::get('meta.role add description'));
		$Model = \App\Models\Role::select(['id','name','description','active','authorize','created_at'])
		->where('id',$id)
		->first();
		return Theme::view('roles.form',[
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
	public function onStore(\App\Http\Requests\RoleRequest $request)
	{
		$is_exist = \App\Models\Role::where('name', $request->get('name'))->where('id', '!=', $request->get('id'))->get(['id'])->first();
		
		if($is_exist)
		{
			$param['error'] =  true;
			$param['message'] = Lang::get('message.role unique name');
			return json_encode($param);
		}
		
		$role = new \App\Models\Role();
		if($request->has('id'))
		{
			$role = $role->where('id',$request->get('id'))->first();
			$role->updated_at = date('Y-m-d H:i:s');
			$role->updated_by = Auth::user()->id;
		}
		else
		{
			$role->created_at = date('Y-m-d H:i:s');
			$role->created_by = Auth::user()->id;
		}
		
		$role->name = $request->get('name');
		$role->description = $request->get('description');
		$role->active = $request->get('active')?$request->get('active'):0;
		$role->authorize = $request->get('authorize')?$request->get('authorize'):0;
		$role->save();
		
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
		$Model = \App\Models\Role::select(['id'])
		->where('id',$id)
		->first();
		
		if($Model)
		{
			\App\Models\Role::where('id', $id)->delete();
			$param['message'] = Lang::get('info.has deleted');
			$param['error'] = false;
		}
		else
		{
			$param['message'] = Lang::get('info.has error');
			$param['error'] = true;
		}
		return json_encode($param);
	}
	
}
 