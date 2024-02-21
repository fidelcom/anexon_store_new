@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>My Cart | {{config('app.name')}}</title>
	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="css/cart.css" rel="stylesheet">

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
					<li>My Cart</li>
				</ul>
			</div>
			<h1>
				@if(Cart::count() > 0)
					You have {{Cart::count()}} item(s) in your cart
				@else
					Cart page
				@endif
			</h1>
		</div>
		<!-- /page_header -->
		<table class="table table-striped cart-list">
							<thead>
								<tr>
									<th>
										Product
									</th>
									<th>
										Price
									</th>
									<th>
										Quantity
									</th>
									<th>
										Subtotal
									</th>
									<th>
										
									</th>
								</tr>
							</thead>
							<tbody>
								@if(Cart::count() > 0)
								@foreach(Cart::content() as $item)
								<tr>
									<td>
										<div class="thumb_cart">
											<img src="{{ productImage($item->model->image) }}" data-src="{{ productImage($item->model->image) }}" class="lazy" alt="Image">
										</div>
										<span class="item_cart">{{ $item->model->name}}</span>
									</td>
									<td>
										<strong>&#8358;{{ number_format( totalcash($item->model->price) )}}</strong>
									</td>
									<td>
										<div class="">
											<select class="quantity form-control" data-id="{{ $item->rowId }}" data-productQuantity="{{$item->model->quantity}}">
	                        @for($i = 1; $i < 5 + 1; $i++)
	                            <option {{ $item->qty == $i ? 'selected' : '' }} >{{$i}}</option>
	                        @endfor
	                    </select>
												{{-- <input type="text" value="1" id="quantity_1" class="qty2" name="quantity_1">
											<div class="inc button_inc">+</div><div class="dec button_inc">-</div> --}}
										</div>
									</td>
									<td>
										<strong>&#8358;{{ number_format( $item->subtotal)}}</strong>
									</td>
									<td class="options">
										<form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
						                      {{ csrf_field() }}
						                      {{ method_field('DELETE') }}
						                      <button type="submit" {{-- class="btn btn-sm btn-outline-warning rounded" --}}><i class="ti-trash"></i></button>
						                  </form>
						                  <form action="{{ route('cart.wishlist', $item->rowId) }}" method="POST">
						                      {{ csrf_field() }}
						                      <button type="submit" {{-- class="btn btn-primary btn-sm" --}}><i class="ti-heart"></i></button>
						                  </form>
									</td>
								</tr>
								@endforeach
								@endif
								
								
							</tbody>
						</table>

						<div class="row add_top_30 flex-sm-row-reverse cart_actions">
						<div class="col-sm-4 text-right">
							<a href="{{ route('shop.index') }}" class="btn_1 gray">Continue Shopping</a>
						</div>
						<div class="col-sm-8">
							<div class="apply-coupon">
								@if(! session()->has('coupon'))
								<form action="{{ route('coupon.store') }}"  method="POST">
									@csrf
									<div class="form-group form-inline">
										<input type="text" name="coupon_code" value="" placeholder="Promo code" class="form-control"><button type="submit" class="btn_1 outline">Apply Coupon</button>
									</div>
								</form>
								@else
									<form action="{{ route('coupon.destroy') }}"  method="POST">
										@csrf
										{{ method_field('delete') }}
										<div class="form-group form-inline">
											<button type="submit" class="btn_1 outline">Remove Coupon</button>
										</div>
									</form>
								@endif
							</div>
						</div>
					</div>
					<!-- /cart_actions -->
	
		</div>
		<!-- /container -->
		
		<div class="box_cart">
			<div class="container">
			<div class="row justify-content-end">
				<div class="col-xl-4 col-lg-4 col-md-6">
			<ul>
				{{-- <li>
					<span>Subtotal</span> $240.00
				</li>
				<li>
					<span>Shipping</span> $7.00
				</li> --}}
				<li>
					<span>Total</span> &#8358;{{number_format($newTotal)}}
				</li>
			</ul>
			<a href="{{ route('checkout.index') }}" class="btn_1 full-width cart">Proceed to Checkout</a>
					</div>
				</div>
			</div>
		</div>
		<!-- /box_cart -->
		
	</main>
	<!--/main-->
@endsection	
@section('script')
	<!-- COMMON SCRIPTS -->
    <script src="js/common_scripts.min.js"></script>
    <script src="js/main.js"></script>
    <!--extra js-->
    <script src="js/app.js"></script>
     <script >

        (function(){
          const classname = document.querySelectorAll('.quantity')

          Array.from(classname).forEach(function(element){
              element.addEventListener('change', function(){
                  const id = element.getAttribute('data-id')
                  const productQuantity = element.getAttribute('data-productQuantity')
                  
                    axios.patch(`/cart/${id}`, {
                    quantity: this.value,
                    productQuantity: productQuantity
                  })
                  .then(function (response) {
                    //console.log(response);
                    window.location.href = '{{ route('cart.index') }}'
                  })
                  .catch(function (error) {
                    //console.log(error);
                    window.location.href = '{{ route('cart.index') }}'
                  });
              })
          })

        })();
    </script>
@endsection