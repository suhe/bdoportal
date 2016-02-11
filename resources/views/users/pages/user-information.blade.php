@extends('portalz::layout')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('user-information'))	
<div class="row">
	
	<div class="col-md-12">
		{!! $grid !!}																	
	</div>
</div>	
@endsection
@endpush