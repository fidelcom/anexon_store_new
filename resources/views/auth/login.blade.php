<?php
  use App\Category;
  $categories = Category::all();
?>
@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Login | {{config('app.name')}}</title>
	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="css/account.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">

</head>
@endsection  
  
@section('main-content')

	
	<main class="bg_gray">
		
	<div class="container margin_30">
		<div class="page_header">
			<div class="breadcrumbs">
				<ul>
					<li><a href="{{ route('landing-page') }}">Home</a></li>
					<li>Login</li>
				</ul>
		</div>
		<h1>Sign In</h1>
	</div>
	<!-- /page_header -->
			<div class="row justify-content-center">
				@include('inc.messages')
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="client">Already Client</h3>
					<div class="form_container">
						{{-- <div class="row no-gutters">
							<div class="col-lg-6 pr-lg-1">
								<a href="/login/facebook" class="social_bt facebook">Login with Facebook</a>
							</div>
							<div class="col-lg-6 pl-lg-1">
								<a href="/login/google" class="social_bt google">Login with Google</a>
							</div>
						</div>
						<div class="divider"><span>Or</span></div> --}}
						<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                             @csrf
							<div class="form-group">
								<input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="Email*" value="{{ old('email') }}" required>
								@if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="password" id="password_in" required placeholder="Password*">
								@if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="clearfix add_bottom_15">
								<div class="checkboxes float-left">
									<label class="container_check">Remember me
										<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="float-right"><a id="forgot" href="{{ route('password.request') }}">Lost Password?</a></div>
							</div>
							<div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
						</form>
						<p>Not Registered? click <a href="/register">Here</a> to register</p>
						{{-- <div id="forgot_pw">
							<div class="form-group">
								<input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Type your email">
							</div>
							<p>A new password will be sent shortly.</p>
							<div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
						</div> --}}
					</div>
					<!-- /form_container -->
				</div>
				<!-- /box_account -->
				{{-- <div class="row">
					<div class="col-md-6 d-none d-lg-block">
						<ul class="list_ok">
							<li>Find Locations</li>
							<li>Quality Location check</li>
							<li>Data Protection</li>
						</ul>
					</div>
					<div class="col-md-6 d-none d-lg-block">
						<ul class="list_ok">
							<li>Secure Payments</li>
							<li>H24 Support</li>
						</ul>
					</div>
				</div> --}}
				<!-- /row -->
			</div>
			
		</div>
		<!-- /row -->
		</div>
		<!-- /container -->
	</main>
	<!--/main-->
@endsection
@section('script')
	<!-- COMMON SCRIPTS -->
    <script src="js/common_scripts.min.js"></script>
    <script src="js/main.js"></script>

    <script>
    	// Client type Panel
		$('input[name="client_type"]').on("click", function() {
		    var inputValue = $(this).attr("value");
		    var targetBox = $("." + inputValue);
		    $(".box").not(targetBox).hide();
		    $(targetBox).show();
		});
	</script>
@endsection