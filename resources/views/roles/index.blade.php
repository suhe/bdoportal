@extends('portalz::layout')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('role'))	
<div class="row">
	<div class="col-md-12 margin-bottom-10">
		<div class="row">
			<div class="col-md-2">
				<a href="{!! url('administration/role/form') !!}" class="btn btn-primary btn-md"><i class="fa fa-pencil"></i> {!! Lang::get('menu.add new') !!}</a>
			</div>
		</div>	
	</div>
		
	<div class="col-md-12">
		{!! $grid !!}																	
	</div>
</div>	
@endsection

@push('scripts')
<script type="text/javascript">
	$('.delete').on('click', function(event) {
		if (! confirm("{!! Lang::get('info.confirm delete') !!}")) return;
		var tr = $(this).closest('tr');
		var id = $(this).attr('id');
		tr.css("background-color","#FF3700");
		
		$.ajax({
			type :"POST",
			url : "{!! url('administration/role/delete') !!}",
			data : {id: id},
			cache : false,
			beforeSend: 
				function (xhr) {
					var token = $('meta[name="_token"]').attr('content');
					if (token) {
						return xhr.setRequestHeader('X-CSRF-TOKEN', token);
					}
			},
			success : function(data) {
				var json = jQuery.parseJSON(data);
				if(json.error == false)
				{
					tr.fadeOut(400, function(){
						tr.remove();
					});
					
					new PNotify({
						title: '{!! Lang::get("label.delete notification") !!}',
						text: json.message,
						styling: "bootstrap3",
					});
					
					return false;
				}
				else {
					
				}
			},
			error : function() {
					
			}
		});
		return false;
	});
</script>
@endpush