<!DOCTYPE html>
<html>
    <head>
	<title></title>
        <link type="text/css" href="{!! asset('vendor/login/style/reset.css') !!}" rel="Stylesheet" media="screen" />
        <link type="text/css" href="{!! asset('vendor/login/style/global.css') !!}" rel="Stylesheet" media="screen" />
    </head>
	<body>
		<div class="External-Header">
			<a href="/">
				<img src="{!! asset('vendor/login/images/bdo.png') !!}" alt="BDO Logo" />
			</a>
		</div>
	
		<div class="External-HeaderBorder"></div>

		<div class="GlobalBodyContainer">
			<div class="GlobalBodyTop"></div>
			<div class="GlobalBodyLeft">
				<div class="GlobalBodyRight">
<div class="Login-Title">
    <h1 style="padding: 35px 0 0 0;">
        {!! Lang::get('meta.app name') !!}
    </h1>
</div>
	
<div class="msg-error" style="padding:20px 60px">
	@if (Session::has('msg_error'))
		<div class="alert alert-info">{{ Session::get('msg_error') }}</div>
	@endif

</div>	
	
<div class="Login-Content">
    <div class="Left">
		{!! Form::open(['url' => 'login/auth','id'=>'storeForm','class'=>'form-horizontal']) !!}
            <table>
                <tr>
                    <td>
                        <label for="email">{!! Lang::get('label.email') !!}</label>
                    </td>
                    <td>
                       {!! Form::text('email',null, ['maxlength' => 100, 'class' => 'Text','id'=>'name','placeholder'=>lang::get('label.email')]) !!}
                       @if($errors->has('email'))
							<p class="msg-error">{!! $errors->first('email') !!}</p>
						@endif
                    </td>
                </tr>
				<tr>
                    <td>
                        <label for="email">{!! Lang::get('label.company id') !!}</label>
                    </td>
                    <td>
                       {!! Form::text('company_id',null, ['maxlength' => 10 ,'class' => 'Text','id'=>'company_id','placeholder'=>lang::get('label.company id')]) !!}
                       @if($errors->has('email'))
							<p class="msg-error">{!! $errors->first('company_id') !!}</p>
						@endif
                    </td>
                </tr>	
				
                <tr>
                    <td>
                        <label for="Password">Password</label>
                    </td>
                    <td>
                        {!! Form::password('password', ['maxlength' => 100, 'class' => 'Text','id'=>'name','placeholder'=>lang::get('label.password')]) !!}
						@if($errors->has('password'))
							<p class="msg-error">{!! $errors->first('password') !!}</p> 
						@endif
					</td>
                </tr>
                <tr>
                    <td></td>
            
                    <td>
                        <a class="ResetPassword" href="#"></a>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" id="btnSubmit" style="border: 0; padding: 0; background-color: transparent; cursor: pointer; margin-left: -10px;">
                            <span id="spnSubmit" style="padding-left: 42px; width: 105px;" class="Button" tabindex="3">Login</span>
                        </button>  
                    </td>
                </tr>
            </table>
		{!! Form::close() !!}
	</div>
    <div class="Right">
        <img src="{!! asset('vendor/login/images/group.png') !!}"  />
    </div>
    <div class="Footer">
            <span style="font-weight: bold;"></span>
    </div>
</div>
            </div>
        </div>
        <div class="GlobalBodyBottom"></div>
    </div>
</body>
</html>
