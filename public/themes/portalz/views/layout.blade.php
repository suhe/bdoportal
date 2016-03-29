<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>{!!  Lang::get('meta.app name').' '.Meta::meta('title') !!}</title>
		{!! Meta::tagMetaName('robots'); !!}
		{!! Meta::tagMetaProperty('site_name', Lang::get('app.inventory management system')) !!}
        {!! Meta::tagMetaProperty('url', Request::url()) !!}
        {!! Meta::tagMetaProperty('locale', Lang::getLocale()) !!}
		{!! Meta::tag('title') !!}
        {!! Meta::tag('description') !!}
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<meta name="_token" content="{{ csrf_token() }}" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{!! asset('themes/portalz/assets/css/bootstrap.css') !!}" />
		<link rel="stylesheet" href="{!! asset('themes/portalz/assets/css/font-awesome.css') !!}" />
		<!-- page specific plugin styles -->
		<!-- text fonts -->
		<link rel="stylesheet" href="{!! asset('themes/portalz/assets/css/ace-fonts.css') !!}" />
		<!-- ace styles -->
		<link rel="stylesheet" href="{!! asset('themes/portalz/assets/css/ace.css') !!}" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="{!! asset('themes/portalz/assets/css/custom.css') !!}" />
		<!--[if lte IE 9]>
		<link rel="stylesheet" href="{!! asset('themes/portalz/assets/css/ace-part2.css') !!}" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="{!! asset('themes/portalz/assets/css/ace-ie.css') !!}" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="{!! asset('themes/portalz/assets/js/ace-extra.js') !!}"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="{!! asset('themes/portalz/assets/js/html5shiv.js') !!}"></script>
		<script src="{!! asset('themes/portalz/assets/js/respond.js') !!}"></script>
		<![endif]-->
		@stack('css')
		<link rel="stylesheet" href="{!! asset('vendor/notify/pnotify.custom.css') !!}" />
	</head>

	<body class="no-skin">
		<!-- #section:basics/navbar.layout -->
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="{!! url('/') !!}" class="navbar-brand">
						<img src="{!! asset('themes/portalz/assets/img/logo.png') !!}" class="img-responsive"/>
						
					</a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<!-- #section:basics/navbar.user_menu -->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="{!! asset('themes/portalz/assets/avatars/avatar.png') !!}" alt="Jason's Photo" />
								<span class="user-info">
									<small>{!! Lang::get('label.welcome') !!},</small>
									{!! Auth::user()->last_name !!}
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="{!! url('setting/change-password') !!}">
										<i class="ace-icon fa fa-key"></i>
										{!! Lang::get('label.change password') !!}
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="{!! url('logout') !!}">
										<i class="ace-icon fa fa-power-off"></i>
										{!! Lang::get('label.logout') !!}
									</a>
								</li>
							</ul>
						</li>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>

		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>
			
			

			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>
				
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<a href="{!! url('setting/change-pasword') !!}" class="btn btn-success">
							<i class="ace-icon fa fa-key"></i>
						</a>
							
						<a href="{!! url('file/download') !!}" class="btn btn-warning">
							<i class="ace-icon fa fa-download"></i>
						</a>	

						<a href="{!! url('setting/information') !!}" class="btn btn-info">
							<i class="ace-icon fa fa-info"></i>
						</a>
							
						<a href="{!! url('logout') !!}" class="btn btn-danger">
							<i class="ace-icon fa fa-power-off"></i>
						</a>

						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				

				<ul class="nav nav-list">
					<li class="{!! (Request::segment(2) == 'change-password') || (Request::segment(1) == '') ? 'active' : '' !!}">
						<a href="{!! url('setting/change-password') !!}">
							<i class="menu-icon fa fa-key"></i>
							<span class="menu-text"> {!! Lang::get("menu.change password") !!}  </span>
						</a>

						<b class="arrow"></b>
					</li>
					
					<li class="{!! Request::segment(2) == 'download' ? 'active' : '' !!}">
						<a href="{!! url('file/download') !!}">
							<i class="menu-icon fa fa-download"></i>
							<span class="menu-text"> {!! Lang::get("menu.downloads") !!}</span>
						</a>

						<b class="arrow"></b>
					</li>
					
					@if(Auth::user()->authorize() == 0)
						<li class="{!! Request::segment(2) == 'information' ? 'active' : '' !!}">
							<a href="{!! url('setting/information') !!}">
								<i class="menu-icon fa fa-info"></i>
								<span class="menu-text"> {!! Lang::get("menu.information") !!} </span>
							</a>
	
							<b class="arrow"></b>
						</li>	
					@else	
						<li class="{!!  Request::segment(1) == 'user' &&  Request::segment(2) == 'information' ? 'active' : '' !!}">
							<a href="{!! url('user/information') !!}">
								<i class="menu-icon fa fa-info"></i>
								<span class="menu-text"> {!! Lang::get("menu.information") !!} </span>
							</a>
	
							<b class="arrow"></b>
						</li>	
					@endif	
					
					@if(Auth::user()->authorize() == 1)	
					<li class="{!! Request::segment(1) == 'management' ? 'active' : '' !!}">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file-o"></i>
							<span class="menu-text"> {!! Lang::get("menu.management") !!} </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="{!! Request::segment(2) == 'file' ? 'active' : '' !!}">
								<a href="{!! url('management/file') !!}">
									<i class="menu-icon fa fa-caret-right"></i>
									{!! Lang::get("menu.file management") !!}
								</a>

								<b class="arrow"></b>
							</li>
							<li class="{!! Request::segment(1) == 'management' && Request::segment(2) == 'information' ? 'active' : '' !!}">
								<a href="{!! url('management/information') !!}">
									<i class="menu-icon fa fa-caret-right"></i>
									{!! Lang::get("menu.information") !!}
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>	
						
					<li class="{!! Request::segment(1) == 'administration' ? 'active' : '' !!}">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-wrench"></i>
							<span class="menu-text"> {!! Lang::get("menu.administration") !!} </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="{!! Request::segment(2) == 'user' ? 'active' : '' !!}">
								<a href="{!! url('administration/user') !!}">
									<i class="menu-icon fa fa-caret-right"></i>
									{!! Lang::get("menu.users") !!}
								</a>

								<b class="arrow"></b>
							</li>
							<li class="{!! Request::segment(2) == 'companies' ? 'active' : '' !!}">
								<a href="{!! url('administration/companies') !!}">
									<i class="menu-icon fa fa-caret-right"></i>
									{!! Lang::get("menu.companies") !!}
								</a>

								<b class="arrow"></b>
							</li>	
							<li class="{!! Request::segment(2) == 'role' ? 'active' : '' !!}">
								<a href="{!! url('administration/role') !!}">
									<i class="menu-icon fa fa-caret-right"></i>
									{!! Lang::get("menu.user role") !!}
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					@endif	

					
				</ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
						@yield('breadcrumbs')	
						<!--
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb -->
						
						<!-- #section:basics/content.searchbox -
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
						<div class="page-header">
							<h1>
								{!! Meta::meta('title') !!}
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 {!! Meta::meta('description') !!}
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
						
						<!-- Content Here -->
						
						<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
							@yield('content')
							<div class="loader"></div>
						</div>		
						
						<!-- Content Here -->
							
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							PT.BDO Konsultan Indonesia 
						</span>

						&nbsp; &nbsp;
						<!--  <span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>-->
					</div>

					<!-- /section:basics/footer -->
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='{{ asset('themes/portalz/assets/js/jquery.js') }}'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='{{ asset('themes/portalz/assets/js/jquery1x.js') }}'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('themes/portalz/assets/js/jquery.mobile.custom.js') }}'>"+"<"+"/script>");
		</script>
		<script src="{{ asset('themes/portalz/assets/js/bootstrap.js') }}"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		<script src="{{ asset('themes/portalz/assets/js/excanvas.js') }}"></script>
		<![endif]-->
		<script src="{{ asset('themes/portalz/assets/js/jquery-ui.custom.js') }}"></script>
		<script src="{{ asset('vendor/notify/pnotify.custom.js') }}"></script>	
		<!--<script src="../assets/js/jquery.ui.touch-punch.js"></script>
		<script src="../assets/js/jquery.easypiechart.js"></script>
		<script src="../assets/js/jquery.sparkline.js"></script>
		<script src="../assets/js/flot/jquery.flot.js"></script>
		<script src="../assets/js/flot/jquery.flot.pie.js"></script>
		<script src="../assets/js/flot/jquery.flot.resize.js"></script>-->

		<!-- ace scripts -->
		<!--<script src="../assets/js/ace/elements.scroller.js"></script>
		<script src="../assets/js/ace/elements.colorpicker.js"></script>
		<script src="../assets/js/ace/elements.fileinput.js"></script>
		<script src="../assets/js/ace/elements.typeahead.js"></script>
		<script src="../assets/js/ace/elements.wysiwyg.js"></script>
		<script src="../assets/js/ace/elements.spinner.js"></script>
		<script src="../assets/js/ace/elements.treeview.js"></script>
		<script src="../assets/js/ace/elements.wizard.js"></script>
		<script src="../assets/js/ace/elements.aside.js"></script>-->
		<script src="{{ asset('themes/portalz/assets/js/ace/ace.js') }}"></script>
		<!--<script src="../assets/js/ace/ace.ajax-content.js"></script>
		<script src="../assets/js/ace/ace.touch-drag.js"></script>-->
		<script src="{{ asset('themes/portalz/assets/js/ace/ace.sidebar.js') }}"></script>
		<script src="{{ asset('themes/portalz/assets/js/ace/ace.sidebar-scroll.js') }}"></script>
		<script src="{{ asset('themes/portalz/assets/js/ace/ace.submenu-hover.js') }}"></script>
		@stack('scripts')
		<!--<script src="../assets/js/ace/ace.widget-box.js"></script>
		<script src="../assets/js/ace/ace.settings.js"></script>
		<script src="../assets/js/ace/ace.settings-rtl.js"></script>
		<script src="../assets/js/ace/ace.settings-skin.js"></script>
		<script src="../assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="../assets/js/ace/ace.searchbox-autocomplete.js"></script>-->
	</body>
</html>
