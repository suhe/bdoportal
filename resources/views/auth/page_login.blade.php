<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<title>{!! Lang::get("label.login") !!}</title>
	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="{!! asset('themes/portalz/assets/css/bootstrap.css') !!}" />
	<link rel="stylesheet" href="{!! asset('themes/portalz/assets/css/font-awesome.css') !!}" />
	<link rel="stylesheet" href="{!! asset('themes/portalz/assets/css/login.css') !!}" />
</head>
<body class="bg-grey">
	<div class="container-full">
		<nav id="top" class="bg-white hg-80 navbar navbar-default">
			<div class="top-divider"></div>
		</nav>
		
		<section id="login-panel">
			<div class="panel panel-default">
			  <div class="panel-body">
			  	<div class="row" id="top-login">
			  		<div class="col-sm-12" id="logo">
			  			<div class="logo">
			  				<img src="{!! asset('themes/portalz/assets/img/login-logo.png') !!}" />
			  			</div>
			  		</div>
			  	</div>
			  	<div class="row" id="tag-login">
			  		<div class="col-sm-5" id="tag-company">
			  			<h4>PT. BDO KONSULTAN INDONESIA</h4>
			  		</div>
			  		<div class="col-sm-7" id="tag-title">
			  			<h1>Employee Self Service</h1>
			  		</div>
			  	</div>
			  	
			  	<div class="row" id="page-login">
			  		<div class="col-sm-5">
			  			@if (Session::has('message'))
						<div class="alert alert-danger">{{ Session::get('message') }}</div>
						@endif

			  			{!! Form::open(['url' => 'login/post','id'=>'storeForm','class'=>'form-horizontal','role' => 'form']) !!}
			  			<div class="form-group">
						    <label class="control-label col-sm-4 text-left" for="email">{!! Lang::get('label.email') !!}</label>
						    <div class="col-sm-8">
						       	{!! Form::text('email',null, ['maxlength' => 100, 'class' => 'form-control','id'=>'name','placeholder'=>lang::get('label.email')]) !!}
						    </div>
					  	</div>
					  	<div class="form-group">
						    <label class="control-label col-sm-4 text-left" for="company_id">{!! Lang::get('label.company id') !!}</label>
						    <div class="col-sm-8">
						       	{!! Form::text('company_id',null, ['maxlength' => 10, 'class' => 'form-control','id'=>'company_id','placeholder'=>lang::get('label.company id')]) !!}
						    </div>
					  	</div>
					  	<div class="form-group">
						    <label class="control-label col-sm-4 text-left" for="company_id">{!! Lang::get('label.password') !!}</label>
						    <div class="col-sm-8">
						       	{!! Form::password('password', ['maxlength' => 18, 'class' => 'form-control','id'=>'password']) !!}
						    </div>
					  	</div>
					  	
					  	<div class="form-group">
						    <div class="col-sm-12">
						    	<div class="pull-right">
						    		<button type="submit" class="btn btn-primary bg-red">{!! Lang::get("label.login") !!} <i class="fa fa-arrow-right"></i></button>
						    	</div>
						      
						    </div>
						 </div>
  
			  			{!! Form::close() !!}
			  		</div>
			  	</div>
			  	
			  </div>
			</div>
		</section>
		
		<footer>
			<div class="bottom-divider"></div>
		</footer>
	</div>
	<script src="{{ asset('vendor/jquery/jquery-1.12.2.min.js') }}"></script>
	<script src="{{ asset('themes/portalz/assets/js/bootstrap.js') }}"></script>
	<script src="{!! asset('vendor/jsvalidation/js/jsvalidation.js') !!}"></script>
	{!! JsValidate::formRequest('\App\Http\Requests\AuthRequest', '#storeForm') !!}
</body>
</html>
