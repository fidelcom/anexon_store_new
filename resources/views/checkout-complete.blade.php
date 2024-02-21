@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Thank You | {{config('app.name')}}</title>
	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="css/checkout.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">

</head>
@endsection

@section('main-content')
	<main class="bg_gray">
		<div class="container">
            <div class="row justify-content-center">
				<div class="col-md-5">
					<div id="confirm">
						<div class="icon icon--order-success svg add_bottom_15">
							<svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
								<g fill="none" stroke="#8EC343" stroke-width="2">
									<circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
									<path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
								</g>
							</svg>
						</div>
					<h2>Order completed!</h2>
					<p>Your order has been placed and will be processed as soon as possible.</p>
					<p class="mb-0">
		              <span class="text-muted">Order ID: </span>
		              <span class="text-pink">#zs{{$order_id}}</span>
		            </p>
		            <p>
		              <span class="text-muted">Amount: </span>
		              <span class="text-pink">&#8358;{{ number_format($received_amount/100) }}</span>
		            </p>
		            <p>A confirmation email has been sent to <u>{{$received_email}}</u></p>
		            <a href="{{ route('shop.index') }}" class="btn btn-secondary mb-5">CONTINUE SHOPPING</a>
		            <a href="{{ route('orders.index') }}" class="btn btn-success mb-5">VIEW ORDER</a>
					</div>
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
@endsection