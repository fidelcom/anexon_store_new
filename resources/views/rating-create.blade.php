@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Rate your Order | {{config('app.name')}}</title>

	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('')}}css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('')}}css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="{{asset('')}}css/error_track.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('')}}css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/starability-minified/starability-all.min.css') }}"/>


</head>
@endsection

@section('main-content')
	
	<main class="bg_gray">
		<div class="container">
			@include('inc.messages')
            <h4>We would love your ratings and review for {{getProduct($rating->product_id)->name}}</h4>

	          <div class="text-center py-5 my-5">
	            <div class="row">
	              <div class="col-md-8">
	                <form action="{{ route('review.store') }}" method="POST" class="form-group">
	                  @csrf
	                  @captcha

	                  <fieldset class="starability-basic">
	                    <legend>Your rating:</legend>
	                    <input type="radio" id="no-rate" class="input-no-rate" name="rating" value="0" checked aria-label="No rating." />

	                    <input type="radio" id="rate1" name="rating" value="1" />
	                    <label for="rate1">1 star.</label>

	                    <input type="radio" id="rate2" name="rating" value="2" />
	                    <label for="rate2">2 stars.</label>

	                    <input type="radio" id="rate3" name="rating" value="3" />
	                    <label for="rate3">3 stars.</label>

	                    <input type="radio" id="rate4" name="rating" value="4" />
	                    <label for="rate4">4 stars.</label>

	                    <input type="radio" id="rate5" name="rating" value="5" />
	                    <label for="rate5">5 stars.</label>

	                    <span class="starability-focus-ring"></span>
	                  </fieldset><br>

	                  <textarea class="form-control" name="review" placeholder="Review..."></textarea><br>
	                  <input type="hidden" name="Thetoken" value="{{$rating->token}}">
	                  <button class="btn btn-info" type="submit">Submit</button>

	              </form>
	              </div>
	            </div>
	            
	          </div>
		</div>
		<!-- /container -->
	</main>
	<!--/main-->
@endsection	
@section('script')
	<!-- COMMON SCRIPTS -->
    <script src="{{asset('')}}js/common_scripts.min.js"></script>
    <script src="{{asset('')}}js/main.js"></script>
		
@endsection