@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Checkout | {{config('app.name')}}</title>
	
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

<?php
  foreach(Cart::instance('default')->content() as $item)
    {
        $product_id[] = $item->model->id;
        $product_qty[] = $item->qty;
    }
?>

@section('main-content')	
	<main class="bg_gray">
	
		
	<div class="container margin_30">
		<div class="page_header">
			<div class="breadcrumbs">
				<ul>
					<li><a href="{{ route('landing-page') }}">Home</a></li>
					<li>Product checkout</li>
				</ul>
		</div>
		<h1>Checkout</h1>
			
	</div>
	<!-- /page_header -->
		<form method="POST" action="{{ route('pay') }}">
			@csrf
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="step first">
						<h3>Delivery address</h3>
					
					<div class="tab-content checkout">
						
						<div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
							<div class="form-group">
								<label>Full Name</label>
								<input type="text" name="name" class="form-control" placeholder="Full Name" value="{{ auth()->user()->name.' '. auth()->user()->lname}}" disabled>
							</div>
							<div class="form-group">
								<label>Phone Number</label>
								<input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ auth()->user()->phone}}" disabled>
							</div>
							<div class="form-group">
								<label>Profile Delivery Address</label>
								<input type="text" name="address" class="form-control" placeholder="Profile Delivery Address" value="{{ auth()->user()->address}}" disabled>
							</div>
							<div class="form-group">
								<label>Delivery Address (Leave blank if you want to use your profile delivery address.)</label>
								<input type="text" name="altaddress" class="form-control" placeholder="Delivery Address" value="">
								<small id="addr2Help" class="form-text text-muted">* Leave blank if you want delivery at your profile address </small>
							</div>

							<input type="hidden" name="email" value="{{auth()->user()->email}}"> {{-- required --}}
		                    {{-- <input type="hidden" name="orderID" value="555555555555"> --}}
		                    <input type="hidden"  name="amount" value="{{$newTotal}}00"> {{-- required in kobo --}}
		                    <input type="hidden" name="quantity" value="1">
		                    <input type="hidden" id="metadata" name="metadata" value="{{ json_encode($array = ['name' => auth()->user()->name,'address' => auth()->user()->address, 'phone' => auth()->user()->phone, 'delivery_fee' => $delivery_sum, 'user_id' => auth()->user()->id, 'newSubtotal' => $newSubtotal, 'discount' => $discount, 'discount_code' => $discount_code, 'product_id' => $product_id, 'product_qty' => $product_qty, 'altaddress' =>  '', ]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
		                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
		                    <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
		                    {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

							
							{{-- <hr>
							<div class="form-group">
								<label class="container_check" id="other_addr">Other billing address
								  <input type="checkbox">
								  <span class="checkmark"></span>
								</label>
							</div>
							<div id="other_addr_c" class="pt-2">
							<div class="row no-gutters">
								<div class="col-6 form-group pr-1">
									<input type="text" class="form-control" placeholder="Name">
								</div>
								<div class="col-6 form-group pl-1">
									<input type="text" class="form-control" placeholder="Last Name">
								</div>
							</div>
							<!-- /row -->
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Full Address">
							</div>
							<div class="row no-gutters">
								<div class="col-6 form-group pr-1">
									<input type="text" class="form-control" placeholder="City">
								</div>
								<div class="col-6 form-group pl-1">
									<input type="text" class="form-control" placeholder="Postal code">
								</div>
							</div>
							<!-- /row -->
							<div class="row no-gutters">
								<div class="col-md-12 form-group">
									<div class="custom-select-form">
										<select class="wide add_bottom_15" name="country" id="country_2">
											<option value="" selected>Country</option>
											<option value="Europe">Europe</option>
											<option value="United states">United states</option>
											<option value="Asia">Asia</option>
										</select>
									</div>
								</div>
							</div>
							<!-- /row -->
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Telephone">
							</div>
							</div> --}}
							<!-- /other_addr_c -->
							<hr>
						</div>
						<!-- /tab_1 -->
					  
					</div>
					</div>
					<!-- /step -->
				</div>
				{{-- <div class="col-lg-4 col-md-6">
					<div class="step middle payments">
						<h3>2. Payment and Shipping</h3>
							<ul>
								<li>
									<label class="container_radio">Credit Card<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
										<input type="radio" name="payment" checked>
										<span class="checkmark"></span>
									</label>
								</li>
								<li>
									<label class="container_radio">Paypal<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
										<input type="radio" name="payment">
										<span class="checkmark"></span>
									</label>
								</li>
								<li>
									<label class="container_radio">Cash on delivery<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
										<input type="radio" name="payment">
										<span class="checkmark"></span>
									</label>
								</li>
								<li>
									<label class="container_radio">Bank Transfer<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
										<input type="radio" name="payment">
										<span class="checkmark"></span>
									</label>
								</li>
							</ul>
							<div class="payment_info d-none d-sm-block"><figure><img src="img/cards_all.svg" alt=""></figure>	<p>Sensibus reformidans interpretaris sit ne, nec errem nostrum et, te nec meliore philosophia. At vix quidam periculis. Solet tritani ad pri, no iisque definitiones sea.</p></div>
							
							<h6 class="pb-2">Shipping Method</h6>
							
						
						<ul>
								<li>
									<label class="container_radio">Standard shipping<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
										<input type="radio" name="shipping" checked>
										<span class="checkmark"></span>
									</label>
								</li>
								<li>
									<label class="container_radio">Express shipping<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
										<input type="radio" name="shipping">
										<span class="checkmark"></span>
									</label>
								</li>
								
							</ul>
						
					</div>
					<!-- /step -->
					
				</div> --}}
				<div class="col-lg-6 col-md-6">
					<div class="step last">
						<h3>2. Order Summary</h3>
					<div class="box_general summary">
						<ul>
							@if(Cart::content()->count() > 0)
                				@foreach(Cart::content() as $item)
									<li class="clearfix"><em>{{$item->qty}} x {{ $item->model->name}}</em>  <span>&#8358;{{ number_format(totalcash($item->model->price))}}</span></li>
								@endforeach
          					@endif
						</ul>
						<ul>
							<li class="clearfix"><em><strong>Subtotal</strong></em>  <span>&#8358;{{ number_format(Cart::subtotal()) }}</span></li>
							@if(session()->has('coupon'))
								<li class="clearfix"><em><strong>Discount({{ session()->get('coupon')['name'] }})</strong></em> <span>- &#8358;{{ number_format($discount) }}</span></li>
								<li class="clearfix"><em><strong>New SubTotal</strong></em> <span>&#8358;{{ number_format($newSubtotal) }}</span></li>
							@endif
							<li class="clearfix"><em><strong>Shipping</strong></em> <span>&#8358;{{number_format($delivery_sum)}}</span></li>
							
						</ul>
						<div class="total clearfix">TOTAL <span>&#8358;{{number_format($newTotal)}}</span></div>
						{{-- <div class="form-group">
								<label class="container_check">Register to the Newsletter.
								  <input type="checkbox" checked>
								  <span class="checkmark"></span>
								</label>
							</div> --}}
						<button class="btn_1" type="submit">Confirm and Pay</button>
						<a href='tel:+2348140987860' class="btn btn-danger"><i class="fa fa-phone fa-lg"></i> Call To Order</a>
					</div>
					<!-- /box_general -->
					</div>
					<!-- /step -->
				</div>
			</div>
			<!-- /row -->
		</form>
		</div>
		<!-- /container -->
	</main>
	<!--/main-->
@endsection

@section('script')
	<!-- Modal Payments Method-->
	<div class="modal fade" id="payments_method" tabindex="-1" role="dialog" aria-labelledby="payments_method_title" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="payments_method_title">Payments Methods</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<p>Lorem ipsum dolor sit amet, oratio possim ius cu. Labore prompta nominavi sea ei. Sea no animal saperet gloriatur, ius iusto ullamcorper ad. Qui ignota reformidans ei, vix in elit conceptam adipiscing, quaestio repudiandae delicatissimi vis ei. Fabulas accusamus no has.</p>
			 <p>Et nam vidit zril, pri elaboraret suscipiantur ut. Duo mucius gloriatur at, in vis integre labitur dolores, mei omnis utinam labitur id. An eum prodesset appellantur. Ut alia nemore mei, at velit veniam vix, nonumy propriae conclusionemque ea cum.</p>
		  </div>
		</div>
	  </div>
	</div>
	
	<!-- COMMON SCRIPTS -->
    <script src="js/common_scripts.min.js"></script>
    <script src="js/main.js"></script>

    <script>
      function alty() 
        {
          var altaddress = document.getElementById('altaddress').value;
          var metadata = document.getElementById('metadata').value;
          var position = -2;
          var output = [metadata.slice(0, position), altaddress, metadata.slice(position)].join('');
          document.getElementById('metadata').value = output;
          //window.alert(output);
          //document.getElementById('demoalt').innerHTML = altaddress;
          //document.getElementById('demoamount').value = altaddress;
        }
    </script>

    <script>
    	// Other address Panel
		$('#other_addr input').on("change", function (){
	        if(this.checked)
	            $('#other_addr_c').fadeIn('fast');
	        else
	            $('#other_addr_c').fadeOut('fast');
	    });
	</script>
@endsection