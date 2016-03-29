@extends('portalz::layout')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('user-information'))	
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#leave">{!! Lang::get("label.leave entitlement") !!}</a></li>
		  <li><a data-toggle="tab" href="#file">{!! Lang::get("label.file information") !!}</a></li>
		</ul>
		
		<div class="tab-content">
		  <div id="leave" class="tab-pane fade in active">
		    <h3>{!! Lang::get("label.leave entitlement") !!}</h3>
		    {!! $grid !!}
		  </div>
		  <div id="file" class="tab-pane fade">
		    <h3>{!! Lang::get("label.file information") !!}</h3>
		    {!! $grid2 !!}
		  </div>
		</div>

																	
	</div>
	
</div>	
@endsection
@endpush