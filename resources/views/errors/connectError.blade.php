@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>OOPS! CONNECTION ERROR | {{config('app.name')}}</title>

	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="css/error_track.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">

</head>
@endsection

@section('main-content')
	
	<main class="bg_gray">
		<div class="container">
			 <!-- 404 Content -->
		          <div class="text-center">
		            <div class="display-2"><i class="fa fa-signal"></i></div>
		            <h1>OOPS! CONNECTION ERROR</h1>
		            <h4>Please try again. Your connection is not strong</h4>
		            <div class="btn-group btn-group-sm mt-3 mb-5" role="group">
		              <a class="btn btn-outline-info" href="javascript:history.back()" role="button"><i class="fa fa-arrow-left"></i> Go Back</a>
		              <a class="btn btn-info" href="{{ route('landing-page') }}" role="button"><i class="fa fa-home"></i> Home</a>
		            </div>
		            <p>Think this is an error? Please <a href="{{ route('contact') }}"><u>let us know.</u></a></p>
		          </div>
		          <!-- /404 Content -->
		</div>
		<!-- /container -->
	</main>
	<!--/main-->
@endsection	
@section('script')
	<!-- COMMON SCRIPTS -->
    <script src="js/common_scripts.min.js"></script>
    <script src="js/main.js"></script>
		
@endsection