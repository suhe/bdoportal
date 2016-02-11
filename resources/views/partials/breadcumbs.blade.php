@if ($breadcrumbs)
    <ul class="breadcrumb no-print">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$breadcrumb->last)
                <li>
					<i class="ace-icon {!! $breadcrumb->icon !!}"></i>
					<a href="{!! $breadcrumb->url !!}">{!! $breadcrumb->title !!}</a>
				</li>
            @else
                <li class="active">
					<i class="ace-icon {!! $breadcrumb->icon !!}"></i>
					<a href="{!! $breadcrumb->url !!}">
						{!! $breadcrumb->title !!}
					</a>
				</li>
            @endif
        @endforeach
    </ul>
@endif