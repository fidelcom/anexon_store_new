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
    <title>Register | {{config('app.name')}}</title>
	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="css/account.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 

</head>
@endsection

@section('main-content')
	<main class="bg_gray">
		@include('inc.messages')
	<div class="container margin_30">
		<div class="page_header">
			<div class="breadcrumbs">
				<ul>
					<li><a href="{{ route('landing-page') }}">Home</a></li>
					<li>Register</li>
				</ul>
		</div>
		<h1>Create an Account</h1>
	</div>
	<!-- /page_header -->
	@include('inc.messages')
		<form method="POST" action="{{ route('register') }}">
			@csrf
          {{-- @captcha
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            @endif --}}
			<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="new_client">New Client</h3> <small class="float-right pt-2">* Required Fields</small>
					<div class="form_container">
						<div class="form-group">
							<label>First Name</label>
							<input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"  id="name" value="{{ old('name') }}" required placeholder="First Name*">
							@if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" name="lname" class="form-control {{ $errors->has('lname') ? ' is-invalid' : '' }}"  id="lname" value="{{ old('lname') }}" required placeholder="Last name*">
							@if ($errors->has('lname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lname') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group">
							<label>Email address</label>
							<input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"  id="email" value="{{ old('email') }}" required placeholder="Email address*">
							@if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group">
							<label>Phone Number</label>
							<input type="text" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"  id="phone" value="{{ old('phone') }}" required placeholder="Phone Number*">
							@if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
						</div>
						
						<div class="form-group">
							<label>Address</label>
							<input type="text" name="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"  id="address" value="{{ old('address') }}" required placeholder="Address*">
							@if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
                                    <select class="form-control dynamic" name="state" id="ng_state_id" data-dependent="lga" required="">
                                        <option>Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->name}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
                                    <select id="lga" name="lga" class="form-control" required="">
                                        <option >Select Local Government</option>
                                    </select>
                                    
                                </div>
                                {{-- {{ csrf_field() }} --}}
							</div>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"  id="password" required placeholder="Password*">
							@if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group">
							<label>Confirm Password</label>
							<input type="password" name="password_confirmation" class="form-control"  id="name"  required placeholder="Confirm Password*">
						</div>
						<input type="hidden" name="referrer" value="{{session()->get('refId') ? session()->get('refId') : 'NoRef' }}">
						
						
						
						<hr>
						<div class="form-group">
							<label class="container_check">Accept <a href="#0">Terms and conditions</a>
								<input type="checkbox" name="terms-condition" required>
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="text-center"><input type="submit" value="Register" class="btn_1 full-width"></div>
						<p>Already registered? click <a href="/login">Here</a> to Login</p>
					</div>
					<!-- /form_container -->
				</div>
				<!-- /box_account -->
			</div>
		</div>
		</form>
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
	<script>
    $(document).ready(function(){

      $('.dynamic').change(function(){
          if($(this).val() != '')
          {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{ route('lga.fetch') }}",
              method:"POST",
              data:{select:select, value:value, _token:_token, dependent:dependent},
              success:function(result)
                {
                     $('#'+dependent).html(result);
                }

            })
          }
      });

    });
    </script>
@endsection