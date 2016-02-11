@extends('portalz::layout')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('information',$data))
<div class="row">
	<div class="col-md-12">
		{!! Form::open(['url' => 'administration/user/store','id'=>'storeForm','class'=>'form-horizontal']) !!}
		{!!Form::hidden('id', isset($data)?$data->id:0, ['id' => 'id']) !!}
		
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="name">{!! Lang::get('label.information') !!} *</label>
			<div class="col-xs-12 col-sm-9">
				<div class="clearfix">
					{!!Form::text('information',isset($data)?$data->information:null, ['maxlength' => 100, 'class' => 'form-control col-xs-12 col-sm-6','id'=>'first_name','placeholder'=>lang::get('label.first name')]) !!}
				</div>
			</div>		
		</div>
			
		
		{!! Form::close() !!}
	</div>
</div>
@endsection
