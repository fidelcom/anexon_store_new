@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Contact Us | {{config('app.name')}}</title>
	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="css/contact.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">

</head>
@endsection

@section('main-content')
	
	<main class="bg_gray">
			@include('inc.messages')
			<div class="container margin_60">
				<div class="main_title">
					<h2>Contact {{config('app.name')}}</h2>
				</div>
				<div class="row justify-content-center">
					<div class="col-lg-4">
						<div class="box_contacts">
							<i class="ti-support"></i>
							<h2>{{config('app.name')}} Help Center</h2> 
							<small>24/7</small>
							<a href="tel:+2349088810001">09088810001</a>  <br>
							<a href="tel:+2348057129306">08057129306</a>   <br> 
							<a href="tel:+2348127200062">08127200062</a>   <br> 
							<a href="tel:+2348062765449">08062765449</a>   <br> 
							<a href="mailto:contact@anexon.org">contact@anexon.org</a>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="box_contacts">
							<i class="ti-map-alt"></i>
							<h2>Our Office Address</h2>
							<div>KM 36, LEKKI/EPE EXPRESSWAY, OPPOSITE OGUNFAYO ROAD, EPUTE, IBEJU, LAGOS STATE</div>
							<small>24/7</small>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="box_contacts">
							<i class="ti-package"></i>
							<h2>{{config('app.name')}} Orders</h2>
							<small>27/7</small>
							<a href="tel:+2349088810001">09088810001</a>  <br>
							<a href="tel:+2348057129306">08057129306</a>   <br> 
							<a href="tel:+2348127200062">08127200062</a>   <br> 
							<a href="tel:+2348062765449">08062765449</a>   <br> 
							<a href="mailto:contact@anexon.org">contact@anexon.org</a>
						</div>
					</div>
				</div>
				<!-- /row -->				
			</div>
			<!-- /container -->
		<div class="bg_white">
			<div class="container margin_60_35">
				<h4 class="pb-3">Drop Us a Line</h4>
				<div class="row">
					<div class="col-md-12">
						<form action="{{ route('contact.store') }}" method="POST">
							@csrf
							@if(count($errors) > 0)
				                @foreach($errors->all() as $error)
				                    {{ $error }}
				                @endforeach
				            @endif
							<div class="add_bottom_25">
								<div class="form-group">
									<input name="name" class="form-control" type="text" placeholder="Name *">
								</div>
								<div class="form-group">
									<input name="phone" class="form-control" type="text" placeholder="Phone number *">
								</div>
								<div class="form-group">
									<input name="email" class="form-control" type="email" placeholder="Email *">
								</div>
								<div class="form-group">
									<textarea name="body" class="form-control" style="height: 150px;" placeholder="Message *"></textarea>
								</div>
								<div class="form-group">
									<input class="btn_1 full-width" type="submit" value="Submit">
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-12">
						<div class="mapouter"><div class="gmap_canvas"><iframe style="width: 100%;" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=KM%2036,%20LEKKI/EPE%20EXPRESSWAY,%20OPPOSITE%20OGUNFAYO%20ROAD,%20EPUTE,%20IBEJU,%20LAGOS%20STATE&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org">123 movies</a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:100%;}</style><a href="https://www.embedgooglemap.net"></a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div></div>
					</div>
					
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_white -->
	</main>
	<!--/main-->
@endsection	
@section('script')
	<!-- COMMON SCRIPTS -->
    <script src="js/common_scripts.min.js"></script>
    <script src="js/main.js"></script>
@endsection