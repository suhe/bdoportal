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
		 <table id="tableSearchResults" class="table  table-striped">
        <thead>
            <tr>
            	<th>{!!  Lang::get('label.date') !!}</th>
                <th>{!!  Lang::get('label.name') !!}</th>
                <th>{!!  Lang::get('label.description') !!}</th>
            </tr>
        </thead>
        <tbody>
           {!! $grid !!}
        	<!-- 
            <tr id="package1" class="accordion-toggle" data-toggle="collapse" data-parent="#OrderPackages" data-target=".packageDetails1">
                <td>123456</td>
                <td>3</td>
                <td><i class="indicator glyphicon glyphicon-chevron-up pull-right"></i>

                </td>
            </tr>
            <tr>
                <td colspan="3" class="hiddenRow">
                    <div class="accordion accordion-body collapse packageDetails1" id="accordion"  toogle="package1">
                        <table class="table table-striped">
                            <tr>
                                <td>Revealed item 1</td>
                            </tr>
                            <tr>
                                <td>Revealed item 2</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            
            <tr id="package2" class="accordion-toggle" data-toggle="collapse" data-parent="#OrderPackages" data-target=".packageDetails2">
                <td>123456</td>
                <td>3</td>
                <td><i class="indicator glyphicon glyphicon-chevron-up pull-right"></i>

                </td>
            </tr>
            <tr>
                <td colspan="3" class="hiddenRow">
                    <div class="accordion accordion-body collapse packageDetails2" id="accordion"  toogle="package2">
                        <table class="table table-striped">
                            <tr>
                                <td>Revealed item 1</td>
                            </tr>
                            <tr>
                                <td>Revealed item 2</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr> -->
            
        </tbody>
    </table>																
	</div>
</div>	
@endsection

@push("css")

@endpush
@push("scripts")

<script type="text/javascript">
$(function(){
	$('.accordion').on('shown.bs.collapse', function () {
		var id = $(this).attr("toogle");
	    $("#"+ id +" i.indicator").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
	});

	$('.accordion').on('hidden.bs.collapse', function () {
		var id = $(this).attr("toogle");
		 $("#"+ id +" i.indicator").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
	});
	
	
});
</script>
@endpush
