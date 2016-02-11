@extends('portalz::layout')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('user-form',$data))
<div class="row">
	<div class="col-md-12">
		{!! Form::open(['url' => 'administration/user/reset-password/store','id'=>'storeForm','class'=>'form-horizontal']) !!}
		{!!Form::hidden('id', isset($data)?$data->id:0, ['id' => 'id']) !!}
		
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="name">{!! Lang::get('label.first name') !!} *</label>
			<div class="col-xs-12 col-sm-9">
				<div class="clearfix">
					{!!Form::text('first_name',isset($data)?$data->first_name:null, ['readonly'=>true,'maxlength' => 100, 'class' => 'form-control col-xs-12 col-sm-6','id'=>'first_name','placeholder'=>lang::get('label.first name')]) !!}
				</div>
			</div>		
		</div>
			
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="name">{!! Lang::get('label.last name') !!} *</label>
			<div class="col-xs-12 col-sm-9">
				<div class="clearfix">
					{!!Form::text('last_name',isset($data)?$data->last_name:null, ['readonly'=>true,'maxlength' => 100, 'class' => 'form-control col-xs-12 col-sm-6','id'=>'last_name','placeholder'=>lang::get('label.last name')]) !!}
				</div>
			</div>		
		</div>
			
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="email">{!! Lang::get('label.email') !!} *</label>
			<div class="col-xs-12 col-sm-9">
				<div class="clearfix">
					{!!Form::text('email',isset($data)?$data->email:null, ['readonly'=>true,'maxlength' => 100, 'class' => 'form-control col-xs-12 col-sm-6','id'=>'email','placeholder'=>lang::get('label.email')]) !!}
				</div>
			</div>		
		</div>
		
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="password">{!! Lang::get('label.password') !!} *</label>
			<div class="col-xs-12 col-sm-9">
				<div class="clearfix">
					{!!Form::password('password', ['maxlength' => 100, 'class' => 'form-control col-xs-12 col-sm-6','id'=>'password','placeholder'=>lang::get('label.password')]) !!}
				</div>
			</div>		
		</div>
			
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="password">{!! Lang::get('label.repeat password') !!} *</label>
			<div class="col-xs-12 col-sm-9">
				<div class="clearfix">
					{!!Form::password('repeat_password', ['maxlength' => 100, 'class' => 'form-control col-xs-12 col-sm-6','id'=>'repeat_password','placeholder'=>lang::get('label.repeat password')]) !!}
				</div>
			</div>		
		</div>
		
					
		<div class="form-group">	
			<div class="col-md-offset-7 col-md-4">
				<div class="pull-right">
					<button type="submit" class="btn btn-md btn-primary">
						<i class="ace-icon fa fa-check bigger-110"></i>
						{!! Lang::get('label.change password') !!}
					</button>
					<a href="{!! url('administration/user') !!}" class="btn btn-md btn-primary">
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
<link rel="stylesheet" href="{{ asset('themes/portalz/assets/css/chosen.css') }}" />
@endpush
@push('scripts')
<script src="{!! asset('themes/portalz/assets/js/chosen.jquery.js') !!}"></script>
<script src="{!! asset('vendor/jsvalidation/js/jsvalidation.js') !!}"></script>
{!! JsValidate::formRequest('\App\Http\Requests\ResetPasswordRequest', '#storeForm') !!}	
<script type="text/javascript">
	$(".chosen").chosen();
	$('#storeForm').on('submit', function(event) {
		event.preventDefault();
		$(".loader").fadeIn("slow");
		
		var formData = $(this).serialize(); // form data as string
		var formAction = $(this).attr('action'); // form handler url
		var formMethod = $(this).attr('method'); // GET, POST
		
		$.ajaxSetup({
            headers: {
                'X-XSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });
		
		$.ajax({
            type  : formMethod,
            url   : formAction,
            data  : formData,
            cache : false,
            beforeSend : function() {
                console.log(formData);
            },
            success : function(data) {
				var json = jQuery.parseJSON(data);
				var loc = window.location;
				if(json.error == false) {
					window.location = loc.protocol+"//"+loc.hostname+"/administration/user/";
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