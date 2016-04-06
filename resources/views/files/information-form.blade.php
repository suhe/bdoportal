@extends('portalz::layout')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('information-management-form',$data))
<div class="row">
	<div class="col-md-12">
		{!! Form::open(['url' => 'management/information/store','files' => true,'id'=>'storeForm','class'=>'form-horizontal']) !!}
		{!!	Form::hidden('id', isset($data)?$data->id:null, ['id' => 'id']) !!}
		{!! Form::file('image',['class'=>'form-control','style' => 'visibility:hidden','id'=>'filename']) !!}
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="name">{!! Lang::get('label.file name') !!} *</label>
			<div class="col-xs-12 col-sm-9">
				<div class="input-group input-group-sm">
					{!!Form::text('name',isset($data)?$data->name:null, ['readonly'=>true,'maxlength' => 100, 'class' => 'form-control','id'=>'name','placeholder'=>lang::get('label.file name')]) !!}
					<span class="input-group-btn btn-group-custom">
					  <button type="button" id="ButtonSearch" class="btn btn-default btn-sm" onclick="$('#filename').click();" title="Suchen"><span class="glyphicon glyphicon-search"></span></button>
					</span>  
				</div>	
			</div>		
		</div>
		
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="name">{!! Lang::get('label.description') !!} *</label>
			<div class="col-xs-12 col-sm-9">
				<div class="clearfix">
					{!!Form::textarea('description',isset($data)?$data->description:null, ['rows'=>3,'maxlength' => 100, 'class' => 'form-control col-xs-12 col-sm-6','id'=>'description','placeholder'=>lang::get('label.description')]) !!}
				</div>
			</div>		
		</div>
		
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="name">{!! Lang::get('label.users') !!} </label>
			<div class="col-xs-12 col-sm-9">
				<div class="row">
					<div class="col-xs-5">
						{!!Form::select('company_from[]',\App\Models\Company::select(['companies.id','companies.name'])->where('companies.active',1)->lists('name','id'),null, ['multiple'=>'multiple','size' => 8,'class' => 'form-control','id'=>'multiselect','placeholder'=>lang::get('label.select company')]) !!}	
					</div>
	
					<div class="col-xs-2">
						<button type="button" id="multiselect_rightAll" class="btn btn-sm btn-block btn-primary"><i class="glyphicon glyphicon-forward"></i></button>
						<button type="button" id="multiselect_rightSelected" class="btn btn-sm btn-sm btn-block btn-primary"><i class="glyphicon glyphicon-chevron-right"></i></button>
						<button type="button" id="multiselect_leftSelected" class="btn btn-sm btn-block btn-primary"><i class="glyphicon glyphicon-chevron-left"></i></button>
						<button type="button" id="multiselect_leftAll" class="btn btn-sm btn-block btn-primary"><i class="glyphicon glyphicon-backward"></i></button>
					</div>
	
					<div class="col-xs-5">
						{!!Form::select('companies[]',\App\Models\InformationCompany::join('companies','companies.id','=','information_companies.company_id')->select(['companies.id','companies.name'])->where('companies.active',1)->where('information_companies.information_id',$data?$data->id:0)->lists('name','id'),\App\Models\InformationCompany::join('companies','companies.id','=','information_companies.company_id')->select(['companies.id','companies.name'])->where('companies.active',1)->where('information_companies.information_id',$data?$data->id:0)->lists('id'), ['multiple'=>'multiple','size' => 8,'class' => 'form-control','id'=>'multiselect_to','placeholder'=>lang::get('label.selected company')]) !!}	
					</div>
					
				</div>
			</div>	
		</div>	
		
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="active">{!! Lang::get('label.active') !!}:</label>
			<div class="col-xs-11 col-sm-1">
				<div class="clearfix">
					{!!Form::checkbox('active',1,isset($data)?$data->active==1?true:false:true, ['id'=>'active']) !!}
				</div>
			</div>
		</div>
					
		
		<div class="form-group">	
			<div class="col-md-offset-7 col-md-4">
				<div class="pull-right">
					<button type="submit" class="btn btn-md btn-primary">
						<i class="ace-icon fa fa-check bigger-110"></i>
						{!! Lang::get('label.submit') !!}
					</button>
					<a href="{!! url('management/information') !!}" class="btn btn-md btn-primary">
						<i class="ace-icon fa fa-mail-forward bigger-110"></i>
						{!! Lang::get('label.back') !!}
					</a>	
				</div>
				<div class="clearfix"></div>		
			</div>
		</div>	
		{!! Form::close() !!}
	</div>
</div>
@endsection

@push('css')
@endpush
@push('scripts')
<script>
 	$(document).ready(function(){
 		// This is the simple bit of jquery to duplicate the hidden field to subfile
 		$('#filename').change(function(){
			$('#name').val($(this).val());
		});
 	});
</script>
<script src="{!! asset('vendor/jsvalidation/js/jsvalidation.js') !!}"></script>
{!! JsValidate::formRequest('\App\Http\Requests\InformationRequest', '#storeForm') !!}
<script type="text/javascript" src="{!! asset('vendor/multiselect-1.0.4/js/multiselect.min.js') !!}"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var multiselect = $('#multiselect');
	loadMultiSelect(multiselect);
	function loadMultiSelect(args) {
		args.multiselect();
	}
});
</script>
<script type="text/javascript">
	$('#storeForm').on('submit', function(event) {
		//alert("x");
		event.preventDefault();
		$(".loader").fadeIn("slow");
		
		//var formData = $(this).serialize();
		var formData = new FormData($(this)[0]);
		var formAction = $(this).attr('action'); // form handler url
		var formMethod = $(this).attr('method'); // GET, POST
		
		$.ajax({
            type  : formMethod,
            url   : formAction,
            data  : formData,
			async: false,
			cache: false,
			contentType: false,
			processData: false,
            beforeSend : function (xhr) {
					var token = $('meta[name="_token"]').attr('content');
					if (token) {
						return xhr.setRequestHeader('X-CSRF-TOKEN', token);
					}
            },
            success : function(data) {
				var json = jQuery.parseJSON(data);
				var loc = window.location;
				if(json.error == false) {
					window.location = loc.protocol+"//"+loc.hostname+"/management/information/";
				}
				else {
					new PNotify({
						title: '{!! Lang::get("label.error notification") !!}',
						text: json.message,
						type: 'error',
						styling: "bootstrap3",
					});	
				}
            },
            error : function() {
						
            }
        });
		
		$(".loader").fadeOut("slow");
		return false; // prevent send form
	});
</script>
@endpush