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
use File;
use Request;
use Response;

class FileController extends Controller {
	/**
	* Constructor of Brand Controller
	*
	* @Auth User Permission / Check 	
	* @Breadcumbs 
	*/
	public function __construct()
	{
		Breadcrumbs::register('file-management', function($breadcrumbs)
		{
			$breadcrumbs->parent('home');
			$breadcrumbs->push(Lang::get('menu.file management'), url('management/file'), ['icon' => 'ace-icon fa fa-file-o']);
		});
		
		Breadcrumbs::register('file-management-form', function($breadcrumbs,$data)
		{
			$breadcrumbs->parent('file-management');
			$breadcrumbs->push(Lang::get('label.new'), url('management/file/form'), ['icon' => 'ace-icon fa fa-file-o']);
			if($data){
				$breadcrumbs->push(Lang::get('label.edit').' > '.$data->name, url('management/file/form/'.$data->id), ['icon' => 'ace-icon fa fa-newspaper-o']);
			}
		});
		
		Breadcrumbs::register('downloads', function($breadcrumbs)
		{
			$breadcrumbs->parent('home');
			$breadcrumbs->push(Lang::get('menu.downloads'), url('file/download'), ['icon' => 'ace-icon fa fa-download']);
		});
	}
	
	/**
	* Index Layout
	*
	* @return @Theme View
	*/
	public function index()
	{
		Meta::title(Lang::get('meta.file management'));
		Meta::meta('description', Lang::get('meta.file management description'));
		
		$grid = new Grid(
			 (new GridConfig)
				->setDataProvider(
					new EloquentDataProvider (
						\App\Models\File::leftJoin('users', 'users.id', '=' ,'files.created_by')
						->leftJoin('companies', 'companies.id', '=' ,'files.company_id')
						->select('files.*')
						->addSelect("users.first_name as upload_name")
						->addSelect("files.created_at as upload_at")
						->addSelect("companies._id as company_id")
						->addSelect("companies.name as company_name")
						
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
							return '<a href="'.url('file/download/'.$val).'">'.$val.'</a>';
						})
                    ,
					(new FieldConfig)
                        ->setName('description')
                        ->setLabel(Lang::get('label.description'))
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
                        ->setName('upload_name')
                        ->setLabel(Lang::get('label.upload by'))
                        ->setSortable(true)   
                    ,
					(new FieldConfig)
                        ->setName('upload_at')
                        ->setLabel(Lang::get('label.upload at'))
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
										<li><a href="'.url('management/file/form/'.$val).'"><i class="remove glyphicon glyphicon-edit"></i> '.Lang::get('menu.edit').'</a></li>
										<li><a href="#" class="delete" id="'.$val.'" ><i class="glyphicon glyphicon-trash"></i> '.Lang::get('menu.remove').'</a></li>
									</ul>
								</div>';
                        })
                        
                    ,
				])
		);
		return Theme::view('files.index',compact('grid', 'text'));
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
		Meta::title(Lang::get('meta.file add'));
		Meta::meta('description', Lang::get('meta.file add description'));
		$Model = \App\Models\File::select(['id','name','description','company_id','active','created_by'])
		->where('id',$id)
		->first();
		return Theme::view('files.form',[
			'data' => $Model,
		]);	
	}
	
	/** Function Dependent Dropdown
	 *
	 */
	public function onCompanyList()
	{
		$input = Input::get('option');
		$users = \App\Models\User::join('roles','roles.id','=','users.role_id')->where(['users.company_id' => $input,'roles.authorize' => 0]);
		return Response::make($users->get(['users.id','first_name']));
	}
	
	
	/**
	* Function Store
	* to Save/Update Brand From Brand Form
	* @Request @Name,@Code etc
	*
	* @return json
	*/
	public function onStore(\App\Http\Requests\FileRequest $request)
	{
		$filename = "";
		if($request->file('image')!= null)
		{
			$file = $request->file('image');
			$filename = $file->getClientOriginalName();
			$upload = $file->move(base_path() . '/public/uploads/',$filename);
		}
		
		$files = new \App\Models\File();
		if($request->has('id'))
		{
			$files = $files->where('id',$request->get('id'))->first();
			//delete file exists
			\App\Models\FileUser::where('file_id', $request->get('id'))->delete();
			$files->updated_at = date('Y-m-d H:i:s');
			$files->updated_by = Auth::user()->id;
		}
		else
		{
			$files->created_at = date('Y-m-d H:i:s');
			$files->created_by = Auth::user()->id;
		}
		
		if($filename != "")
		{
			$files->name = $filename;
			$files->mime = $file->getClientMimeType();
		}
		$files->user_access = "";
		$files->description = $request->get('description');
		$files->company_id = $request->get('company_id');
		$files->active = $request->get('active') ? $request->get('active') : 0 ;
		
		$files->save();
		
		//User Files	
		$user = $request->get('users');
		$user_selected = count($user);
		if($user_selected > 0)
		{
			$user_access = "";
			for($i=0;$i<$user_selected;$i++)
			{
				if(isset($user[$i]))
				{
					$file_users = new \App\Models\FileUser();
					$file_users->user_id = $user[$i];
					$file_users->file_id = $files->id;
					$file_users->save();
					
					//Search User
					$User = \App\Models\User::where('id',$user[$i])->first();
					if($i>0)
						$user_access.=',';
						
					if($User)
						$user_access.= $User->first_name;
				}	
			}
			
			$ufile = \App\Models\File::where('id',$files->id)->first();
			$ufile->user_access = $user_access;
			$ufile->save();		
		}
		
		if($files)
		{
			$param['message'] =  Lang::get('info.inserted');
			$param['error'] = false; 
		}
		else
		{
			$param['message'] = Lang::get('message.file error');
			$param['error'] =  true;
		}
		
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
		$Model = \App\Models\File::select(['id','name'])
		->where('id',$id)
		->first();
		
		$path = base_path() . '/public/uploads/';
		
		if($Model)
		{
			File::delete($path.$Model->name);
			\App\Models\File::where('id', $id)->delete();
			\App\Models\FileUser::where('file_id', $id)->delete();
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
	* Function Download File
	* to Response Form User
	* @Request @Name,@Code etc
	*
	* @return response ajax
	*/
	public function onDownload($id)
	{
		$path = base_path() . '/public/uploads/';
		$id = $id;
		$row = \App\Models\File::select(['name'])
		->where('name',$id)
		->first();
		
		if($row)
		{
			$file = $path.$row->name;
			return response()->download($file);
		}
		else
		{
			
		}
		
	}
	
	
	/**
	* Index ONDownloadPage
	*
	* @return @Theme View
	*/
	public function onPageDownload()
	{
		Meta::title(Lang::get('meta.file download'));
		Meta::meta('description', Lang::get('meta.file download description'));
		
		$query = \App\Models\File::leftJoin('users', 'users.id', '=' ,'files.created_by')
		->leftJoin('companies', 'companies.id', '=' ,'files.company_id')
		->select('files.*')
		->addSelect("users.first_name as upload_name")
		->addSelect("files.created_at as upload_at")
		->addSelect("companies._id as company_id")
		->addSelect("companies.name as company_name")
		->where('files.active', '=', '1');
		
		if(Auth::user()->authorize() == 0)
		{
			$query = $query->leftJoin('file_users', 'file_users.file_id', '=' ,'files.id')
			->where('file_users.user_id','=',Auth::user()->id)
			->where('files.company_id','=',Auth::user()->company_id);
		}
		else if(Auth::user()->authorize() == 2)
		{
			$query = $query->where('files.company_id','=',Auth::user()->company_id);
		}
		
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
							return '<a href="'.url('file/download/'.$val).'">'.$val.'</a>';
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
		
		$grid2 = new Grid(
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
							return '<a href="'.url('file/download/'.$val).'">'.$val.'</a>';
						})
                    ,
					(new FieldConfig)
                        ->setName('description')
                        ->setLabel(Lang::get('label.description'))
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
                        ->setName('upload_name')
                        ->setLabel(Lang::get('label.upload by'))
                        ->setSortable(true)   
                    ,
					(new FieldConfig)
                        ->setName('upload_at')
                        ->setLabel(Lang::get('label.upload at'))
                        ->setSortable(true)   
                    , 
					(new FieldConfig)
                        ->setName('user_access')
                        ->setLabel(Lang::get('label.users'))
                        ->setSortable(true)   
                    ,
				])
		);
		$grid = Auth::user()->authorize() == 0 ? $grid : $grid2;
		return Theme::view('files.pages.download',['grid'=>$grid]);
	}

}
 