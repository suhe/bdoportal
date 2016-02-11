<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>{!! Meta::meta('title') !!}</title>
		{!! Meta::tagMetaName('robots'); !!}
		{!! Meta::tagMetaProperty('site_name', Lang::get('app.inventory management system')) !!}
        {!! Meta::tagMetaProperty('url', Request::url()) !!}
        {!! Meta::tagMetaProperty('locale', Lang::getLocale()) !!}
		{!! Meta::tag('title') !!}
        {!! Meta::tag('description') !!}	
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />	
		<meta name="csrf_token" content="{{ csrf_token() }}" />
		<!-- vendor css / core css -->
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap-theme.min.css') }}" />
		@stack('css')
		<link rel="stylesheet" href="{{ asset('vendor/jquery-gritter/css/jquery.gritter.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}" />
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/chosen.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/jquery.gritter.css') }}" />
		<!-- text fonts -->
		<link rel="stylesheet" href="{{ asset('assets/css/ace-fonts.css') }}" />
		<!-- ace styles -->
		<link rel="stylesheet" href="{{ asset('assets/css/ace.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="{{ asset('assets/css/_custom.css') }}" />
		<!--[if lte IE 9]>
		<link rel="stylesheet" href="{{ asset('assets/css/ace-part2.css') }}" class="ace-main-stylesheet" />
		<![endif]-->
		<!--[if lte IE 9]>
		<link rel="stylesheet" href="{{ asset('/assets/css/ace-ie.css') }}" />
		<![endif]-->
		<!-- inline styles related to this page -->
		<!-- ace settings handler -->
		<script src="{{ asset('/assets/js/ace-extra.js') }}"></script>
		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
		<!--[if lte IE 8]>
		<script src="{{ asset('/assets/js/html5shiv.js') }}"></script>
		<script src="{{ asset('/assets/js/respond.js') }}"></script>
		<![endif]-->
		<!-- basic scripts -->
	</head>
	 @yield('body')
</html>