<?php
/**
 * Copyright 2015, IMS Application
 *
 * IMS CompanyController @App\Modules\Company\
 * Licensed under The MIT License
 * Author : Suhendar
 * Email : hendarsyahss@gmail.com
 * Redistributions of files inventory management system (ims)
 *
 * @copyright Copyright 2015, IMS Company Controller @App\Modules\Company\ 
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

class CompanyController extends Controller {
	/**
	* Constructor of Brand Controller
	*
	* @Auth User Permission / Check 	
	* @Breadcumbs 
	*/
	public function __construct()
	{
		Breadcrumbs::register('companies', function($breadcrumbs)
		{
			$breadcrumbs->parent('home');
			$breadcrumbs->push(Lang::get('menu.companies'), url('administration/companies'), ['icon' => 'ace-icon fa fa-user-md']);
		});
		
		Breadcrumbs::register('companies-form', function($breadcrumbs,$data)
		{
			$breadcrumbs->parent('companies');
			$breadcrumbs->push(Lang::get('label.new'), url('administration/companies/form'), ['icon' => 'ace-icon fa fa-file-o']);
			if($data){
				$breadcrumbs->push(Lang::get('label.edit').' > '.$data->name, url('adminisration/companies/form/'.$data->id), ['icon' => 'ace-icon fa fa-newspaper-o']);
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
		Meta::title(Lang::get('meta.companies'));
		Meta::meta('description', Lang::get('meta.companies description'));
		
		$grid = new Grid(
			 (new GridConfig)
				->setDataProvider(
					new EloquentDataProvider(\App\Models\Company::query())
				)
				->setName('grid')
				->setPageSize(15)
				->setColumns([
					(new FieldConfig)
                        ->setName('_id')
                        ->setLabel(Lang::get('label.company id'))
                        ->setSortable(false)
                        ->setSorting(Grid::SORT_ASC)
                    ,
					(new FieldConfig)
                        ->setName('name')
                        ->setLabel(Lang::get('label.name'))
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
										<li><a href="'.url('administration/companies/form/'.$val).'"><i class="remove glyphicon glyphicon-edit"></i> '.Lang::get('menu.edit').'</a></li>
										<li><a href="#" class="delete" id="'.$val.'" ><i class="glyphicon glyphicon-trash"></i> '.Lang::get('menu.remove').'</a></li>
									</ul>
								</div>';
                        })
                        
                    ,
				])
		);
		return Theme::view('companies.index',compact('grid', 'text'));
	}
	
	public function onForm($id = 0)
	{
		Meta::title(Lang::get('meta.companies add'));
		Meta::meta('description', Lang::get('meta.companies add description'));
		$Model = \App\Models\Company::select(['id','_id','name','active'])
		->where('id',$id)
		->first();
		return Theme::view('companies.form',[
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
	public function onStore(\App\Http\Requests\CompanyRequest $request)
	{
		$is_exist = \App\Models\Company::where('name', $request->get('name'))->where('id', '!=', $request->get('id'))->get(['id'])->first();
		
		if($is_exist)
		{
			$param['error'] =  true;
			$param['message'] = Lang::get('message.companies unique name');
			return json_encode($param);
		}
		
		$companies = new \App\Models\Company();
		if($request->has('id'))
		{
			$companies = $companies->where('id',$request->get('id'))->first();
			$companies->updated_at = date('Y-m-d H:i:s');
			$companies->updated_by = Auth::user()->id;
		}
		else
		{
			$companies->created_at = date('Y-m-d H:i:s');
			$companies->created_by = Auth::user()->id;
		}
		
		$companies->_id = $request->get('company_id');
		$companies->name = $request->get('name');
		$companies->active = $request->get('active')?$request->get('active'):0;

		$companies->save();
		$param['id'] = $companies->id;
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
		$Model = \App\Models\Company::select(['id'])
		->where('id',$id)
		->first();
		
		if($Model)
		{
			\App\Models\Company::where('id', $id)->delete();
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
 