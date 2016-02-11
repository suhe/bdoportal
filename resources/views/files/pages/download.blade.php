@extends('portalz::layout')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('downloads'))	
<div class="row">
	<div class="col-md-12 margin-bottom-10">
		<div class="row">
			<div class="col-md-2">
				
			</div>
		</div>	
	</div>
	
	<div class="col-md-12">
		{!! $grid !!}																	
	</div>
</div>	
@endsection