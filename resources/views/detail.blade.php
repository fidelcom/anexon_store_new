@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $product->keywords}}">
    <meta name="description" content="{{ $product->name}} is in {{$subName}} category and it's features are {!! $product->details !!}">
    <meta property="og:image" content="{{ productImage($product->image) }}">
    <meta name="author" content="Ansonika">
    <title>{{ $product->name}} :- {!! str_limit($product->details, 30) !!} | {{config('app.name')}}</title>
	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('')}}css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('')}}css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="{{asset('')}}css/product_page.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('')}}css/custom.css" rel="stylesheet">
    <style>
        /*width:100%;*/
        @media (max-width: 720px) {
            .dimg {
                height: 135px;
            }
        }
        @media (min-width: 730px) {
            .dimg {
                height: 250px;
            }
        }
    </style>
</head>
@endsection
@section('main-content')
	<main>
	    <div class="container margin_30">
	        {{-- <div class="countdown_inner">-20% This offer ends in <div data-countdown="2019/05/15" class="countdown"></div>
	        </div> --}}
	        <div class="row">
	            <div class="col-md-6">
	                <div class="all">
	                    <div class="slider">
	                        <div class="owl-carousel owl-theme main">
	                            <div style="background-image: url({{ productImage($product->image) }});" class="item-box"></div>
	                            @if($product->images)                    
                      				@foreach( json_decode($product->images, true) as $image)
	                            		<div style="background-image: url({{ productImage($image) }});" class="item-box"></div>
                            		@endforeach
                        		@endif
	                        </div>
	                        <div class="left nonl"><i class="ti-angle-left"></i></div>
	                        <div class="right"><i class="ti-angle-right"></i></div>
	                    </div>
	                    <div class="slider-two">
	                        <div class="owl-carousel owl-theme thumbs">
	                            <div style="background-image: url({{ productImage($product->image) }});" class="item active"></div>
	                            @if($product->images)                    
                      				@foreach( json_decode($product->images, true) as $image)
	                            		<div style="background-image: url({{ productImage($image) }});" class="item"></div>
                            		@endforeach
                        		@endif
	                        </div>
	                        <div class="left-t nonl-t"></div>
	                        <div class="right-t"></div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-6">
	                <div class="breadcrumbs">
	                    <ul>
	                        <li><a href="{{ route('landing-page') }}">Home</a></li>
	                        <li><a href="#">{{$subName}}</a></li>
	                        <li>{{$product->name}}</li>
	                    </ul>
	                </div>
	                <!-- /page_header -->
	                <div class="prod_info">
	                    <h1>{{ $product->name}}</h1>
	                    <span class="rating">
	                    	@if($reviews->count() > 0)
	                    	<?php 

	                    		$total = $reviews->sum('rating') / $reviews->count();
	                    	?>
		                    	@for($i = 0; $i < $total; $i++)
	                        		<i class="icon-star voted"></i>
	                    		@endfor
		                    	<em>{{$reviews->count()}} reviews</em></span>
	                    	@else
	                    		<em>0 reviews</em></span>
	                    	@endif
	                    <p>
	                    	<small>{!!$stockLevel!!}</small>
		                    	<br>
		                    {{-- Sed ex labitur adolescens scriptorem. Te saepe verear tibique sed. Et wisi ridens vix, lorem iudico blandit mel cu. Ex vel sint zril oportere, amet wisi aperiri te cum. --}}
		                </p>
	                    {{-- <div class="prod_options">
	                        <div class="row">
	                            <label class="col-xl-5 col-lg-5  col-md-6 col-6 pt-0"><strong>Color</strong></label>
	                            <div class="col-xl-4 col-lg-5 col-md-6 col-6 colors">
	                                <ul>
	                                    <li><a href="#0" class="color color_1 active"></a></li>
	                                    <li><a href="#0" class="color color_2"></a></li>
	                                    <li><a href="#0" class="color color_3"></a></li>
	                                    <li><a href="#0" class="color color_4"></a></li>
	                                </ul>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Size</strong> - Size Guide <a href="#0" data-toggle="modal" data-target="#size-modal"><i class="ti-help-alt"></i></a></label>
	                            <div class="col-xl-4 col-lg-5 col-md-6 col-6">
	                                <div class="custom-select-form">
	                                    <select class="wide">
	                                        <option value="" selected>Small (S)</option>
	                                        <option value="">M</option>
	                                        <option value=" ">L</option>
	                                        <option value=" ">XL</option>
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Quantity</strong></label>
	                            <div class="col-xl-4 col-lg-5 col-md-6 col-6">
	                                <div class="numbers-row">
	                                    <input type="text" value="1" id="quantity_1" class="qty2" name="quantity_1">
	                                </div>
	                            </div>
	                        </div>
	                    </div> --}}
	                    <div class="row">
	                        <div class="col-lg-12 col-md-12">
	                            <div class="price_main"><span class="new_price">&#8358;{{ number_format(totalcash($product->price)) }}</span>{{-- <span class="percentage">-20%</span> --}} <span class="old_price">&#8358;{{ number_format(slash($product->price)) }}</span></div>
	                        </div>
	                        <hr>
	                        <div class="col-lg-6 col-md-6">
	                        	 @if($product->quantity > 0)
					                <form action="{{ route('cart.store') }}" method="POST">
					                  {{ csrf_field() }}
					                  <input type="hidden" name="id" value="{{ $product->id }}">
					                  <input type="hidden" name="name" value="{{ $product->name }}">
					                  <input type="hidden" name="price" value="{{ totalcash($product->price) }}">
					                    <div class="btn_add_to_cart">
					                      <button type="submit" class="btn_1">ADD TO CART</button>
					                    </div>
					                </form>
					              @endif 
	                        </div>
	                        <div class="col-lg-6 col-md-6">
			                      <a class="btn btn-block" style="background-color: #ff6600; color:white;" href="https://wa.me/2347031382795?text=Hello Mr. Testech, I will like to order for this item {{$product->name}} - {!! str_limit($product->details, 30) !!} as seen on {{url()->current()}}"><i data-feather="whatsapp" class="fa fa-whatsapp"></i> Order on Whatsapp</a>
			                  </div>
	                    </div>
	                </div>
	                <!-- /prod_info -->
	                <div class="product_actions">
	                    <ul>
	                        {{-- <li>
	                            <a href="#"><i class="ti-heart"></i><span>Add to Wishlist</span></a>
	                        </li> --}}
	                        <li>
	                        	<form action="{{ route('compare.store') }}" method="POST">
			                        @csrf
			                        <input type="hidden" name="id" value="{{ $product->id }}">
			                        <input type="hidden" name="name" value="{{ $product->name }}">
			                        <input type="hidden" name="price" value="{{ totalcash($product->price) }}">
			                          <div class="form-group">
			                            <button type="submit" class="btn btn-block" ><i class="ti-control-shuffle"></i><span>Add to Compare</span></button>
			                          </div>
			                      </form>
	                        </li>
	                    </ul>
		              <div class="d-flex align-items-center">
		                <span class="text-muted">Share</span>
		                <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" class="btn btn-light btn-icon rounded-circle border ml-2" data-toggle="tooltip" title="Facebook" target="_blank"><i data-feather="facebook" class="fa fa-facebook"></i></a>
		                <a href="https://twitter.com/intent/tweet?text=Check out {{$product->name.' '.str_limit($product->details, 100).' - Click on the link '}}{{url()->current()}}" class="btn btn-light btn-icon rounded-circle border ml-2" data-toggle="tooltip" title="Twitter"><i data-feather="twitter" class="fa fa-twitter" target="_blank"></i></a>
		                <a href="https://wa.me/?text=Check out {{$product->name.' '.str_limit($product->details, 100).' - Click on the link '}}{{url()->current()}}" class="btn btn-light btn-icon rounded-circle border ml-2" data-toggle="tooltip" title="Whatsapp" target="_blank"><i data-feather="whatsapp" class="fa fa-whatsapp"></i></a>
		              </div>
	                </div>
	                <!-- /product_actions -->
	            </div>
	        </div>
	        <!-- /row -->
	    </div>
	    <!-- /container -->
	    
	    <div class="tabs_product">
	        <div class="container">
	            <ul class="nav nav-tabs" role="tablist">
	                <li class="nav-item">
	                    <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Description</a>
	                </li>
	                <li class="nav-item">
	                    <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Reviews</a>
	                </li>
	            </ul>
	        </div>
	    </div>
	    <!-- /tabs_product -->
	    <div class="tab_content_wrapper">
	        <div class="container">
	            <div class="tab-content" role="tablist">
	                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
	                    <div class="card-header" role="tab" id="heading-A">
	                        <h5 class="mb-0">
	                            <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
	                                Description
	                            </a>
	                        </h5>
	                    </div>
	                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
	                        <div class="card-body">
	                            <div class="row justify-content-between">
	                                <div class="col-lg-12">
	                                    <h3>Details</h3>
	                                    {!! $product->description !!}
	                                </div>
	                                {{-- <div class="col-lg-5">
	                                    <h3>Specifications</h3>
	                                    <div class="table-responsive">
	                                        <table class="table table-sm table-striped">
	                                            <tbody>
	                                                <tr>
	                                                    <td><strong>Color</strong></td>
	                                                    <td>Blue, Purple</td>
	                                                </tr>
	                                                <tr>
	                                                    <td><strong>Size</strong></td>
	                                                    <td>150x100x100</td>
	                                                </tr>
	                                                <tr>
	                                                    <td><strong>Weight</strong></td>
	                                                    <td>0.6kg</td>
	                                                </tr>
	                                                <tr>
	                                                    <td><strong>Manifacturer</strong></td>
	                                                    <td>Manifacturer</td>
	                                                </tr>
	                                            </tbody>
	                                        </table>
	                                    </div>
	                                    <!-- /table-responsive -->
	                                </div> --}}
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <!-- /TAB A -->
	                <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
	                    <div class="card-header" role="tab" id="heading-B">
	                        <h5 class="mb-0">
	                            <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
	                                Reviews
	                            </a>
	                        </h5>
	                    </div>
	                    <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
	                        <div class="card-body">
	                            <div class="row justify-content-between">
	                            	@if($reviews->count() > 0)
              						@foreach($reviews as $review)
	                                <div class="col-lg-6">
	                                    <div class="review_content">
	                                        <div class="clearfix add_bottom_10">
	                                            <span class="rating">
	                                            	@for($i = 0; $i < $review->rating; $i++)
	                                            		<i class="icon-star"></i>
                                            		@endfor
	                                            	<em>{{$review->rating}}/5.0</em>
	                                            </span>
	                                            <em>Published {{$review->created_at->format('d M, Y')}}</em>
	                                        </div>
	                                        <h4>"{{$review->user_name }}"</h4>
	                                        <p>{{$review->review}}</p>
	                                    </div>
	                                </div>
	                                @endforeach

						              @else
						                <h6>No Review yet!</h6>
						              @endif
	                                
	                            </div>
	                            <!-- /row -->
	                        </div>
	                        <!-- /card-body -->
	                    </div>
	                </div>
	                <!-- /tab B -->
	            </div>
	            <!-- /tab-content -->
	        </div>
	        <!-- /container -->
	    </div>
	    <!-- /tab_content_wrapper -->

	    <div class="container margin_60_35">
	        <div class="main_title">
	            <h2>Related</h2>
	            <span>{!!$subName!!}</span>
	        </div>
	        <div class="owl-carousel owl-theme products_carousel">
	        	@foreach($relaProducts as $relaProduct)
	            <div class="item card" >
	                <div class="grid_item">
	                    {!! $relaProduct->quantity < setting('site.stock_threshold') ? '<span class="ribbon off">Only '.$relaProduct->quantity.' left</span>' : ''!!}
	                    <figure>
	                        <a href="{{ route('shop.show', $relaProduct->slug) }}">
	                            <img class="owl-lazy dimg" src="{{ productImage($relaProduct->image) }}" data-src="{{ productImage($relaProduct->image) }}" alt="{{ $relaProduct->name}} :- {!! str_limit($relaProduct->details, 30) !!}">
	                        </a>
	                    </figure>
	                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
	                    <a href="{{ route('shop.show', $relaProduct->slug) }}">
	                        <h3>{{ $relaProduct->name}}</h3>
	                    </a>
	                    <div class="price_box">
	                        <span class="new_price">&#8358;{{ number_format( totalcash($relaProduct->price))}}</span>
	                    </div>
	                    {{-- <ul>
	                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
	                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
	                        <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
	                    </ul> --}}
	                </div>
	                <!-- /grid_item -->
	            </div>
	            <!-- /item -->
	            @endforeach

	        </div>
	        <!-- /products_carousel -->
	    </div>
	    <!-- /container -->

	    <div class="feat">
			<div class="container">
				<ul>
					<li>
						<div class="box">
							<i class="ti-gift"></i>
							<div class="justify-content-center">
								<h3>Free Shipping</h3>
								<p>For all oders over $99</p>
							</div>
						</div>
					</li>
					<li>
						<div class="box">
							<i class="ti-wallet"></i>
							<div class="justify-content-center">
								<h3>Secure Payment</h3>
								<p>100% secure payment</p>
							</div>
						</div>
					</li>
					<li>
						<div class="box">
							<i class="ti-headphone-alt"></i>
							<div class="justify-content-center">
								<h3>24/7 Support</h3>
								<p>Online top support</p>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<!--/feat-->

	</main>
	<!-- /main -->
@endsection	
@section('script')
 	<!-- COMMON SCRIPTS -->
    <script src="{{asset('')}}js/common_scripts.min.js"></script>
    <script src="{{asset('')}}js/main.js"></script>
  
    <!-- SPECIFIC SCRIPTS -->
    <script  src="{{asset('')}}js/carousel_with_thumbs.js"></script>
@endsection
