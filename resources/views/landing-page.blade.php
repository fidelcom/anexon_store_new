@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>{{strtoupper(config('app.name'))}}</title>
	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="css/home_1.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">
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
		<div id="carousel-home">
			<div class="owl-carousel owl-theme">
				@if($banners->count() > 0)
                @foreach($banners as $banner)
				<div class="owl-slide cover" style="background-image: url({!! productImage($banner->image) !!});">
					<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<div class="container">
							<div class="row justify-content-center justify-content-md-end">
								<div class="col-lg-6 static">
									<div class="slide-text text-right white">
										<h2 class="owl-slide-animated owl-slide-title">Attack Air<br>Max 720 Sage Low</h2>
										<p class="owl-slide-animated owl-slide-subtitle">
											Limited items available at this price
										</p>
										<div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="{{ $banner->routes }}" role="button">Shop Now</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				 @endforeach  
              @endif
				
			</div>
			<div id="icon_drag_mobile"></div>
		</div>
		<!--/carousel-->

		{{-- <ul id="banners_grid" class="clearfix">
			<li>
				<a href="#0" class="img_container">
					<img src="img/banners_cat_placeholder.jpg" data-src="img/banner_1.jpg" alt="" class="lazy">
					<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<h3>Men's Collection</h3>
						<div><span class="btn_1">Shop Now</span></div>
					</div>
				</a>
			</li>
			<li>
				<a href="#0" class="img_container">
					<img src="img/banners_cat_placeholder.jpg" data-src="img/banner_2.jpg" alt="" class="lazy">
					<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<h3>Womens's Collection</h3>
						<div><span class="btn_1">Shop Now</span></div>
					</div>
				</a>
			</li>
			<li>
				<a href="#0" class="img_container">
					<img src="img/banners_cat_placeholder.jpg" data-src="img/banner_3.jpg" alt="" class="lazy">
					<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<h3>Kids's Collection</h3>
						<div><span class="btn_1">Shop Now</span></div>
					</div>
				</a>
			</li>
		</ul> --}}
		<!--/banners_grid -->
		
		<div class="container margin_60_35">
			<div class="main_title">
				<h2>Top Selling</h2>
				<span>Products</span>
				{{-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p> --}}
			</div>
			<div class="row small-gutters">
				@if($latests->count() > 0)
          			@foreach($latests as $latest)
					<div class="col-6 col-md-3 card">
						<div class="grid_item">
							{!! $latest->quantity < setting('site.stock_threshold') ? '<span class="ribbon off">Only '.$latest->quantity.' left</span>' : ''!!}
							<figure>
								<a href="{{ route('shop.show', $latest->slug) }}">
									<img class="img-fluid lazy dimg" src="{{ productImage($latest->image) }}" data-src="{{ productImage($latest->image) }}" alt="">
								</a>
								{{-- <div data-countdown="2019/05/15" class="countdown"></div> --}}
							</figure>
							<a href="{{ route('shop.show', $latest->slug) }}">
								<h3>{{ $latest->name}}</h3>
							</a>
							<div class="price_box">
								<span class="new_price">&#8358;{{ number_format( totalcash($latest->price))}}</span>
								<span class="old_price">&#8358;{{ number_format( slash($latest->price) )}}</span>
							</div>
							<ul>
								{{-- <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li> --}}
								<li>
									<form action="{{ route('compare.store') }}" method="POST">
				                        @csrf
				                        <input type="hidden" name="id" value="{{ $latest->id }}">
				                        <input type="hidden" name="name" value="{{ $latest->name }}">
				                        <input type="hidden" name="price" value="{{ totalcash($latest->price, $latest->profit) }}">
				                          <div class="form-group">
				                            <button type="submit" class="btn btn-info" ><i class="ti-control-shuffle"></i>{{-- <span>Add to Compare</span> --}}</button>
				                          </div>
				                      </form>
								</li>
								
								<li>
									<form action="{{ route('cart.store') }}" method="POST">
			                            @csrf
			                            <input type="hidden" name="id" value="{{ $latest->id }}">
			                            <input type="hidden" name="name" value="{{ $latest->name }}">
			                            <input type="hidden" name="price" value="{{ totalcash($latest->price, $latest->profit) }}">
			                              <div class="d-flex justify-content-between align-items-center">
			                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i>{{-- <span>Add to cart</span> --}}</button>
			                              </div>
			                          </form>
								</li>
							</ul>
						</div>
						<!-- /grid_item -->
					</div>
					<!-- /col -->
					@endforeach
		            @else
		              <p>No product Found</p>
		            @endif 
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->

		<div class="featured lazy" data-bg="url(img/3.jpeg)">
			<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
				<div class="container margin_60">
					<div class="row justify-content-center justify-content-md-start">
						<div class="col-lg-6 wow" data-wow-offset="150">
							<h3>Armor<br>Air Color 720</h3>
							<p>Lightweight cushioning and durable support with a Phylon midsole</p>
							<div class="feat_text_block">
								<div class="price_box">
									<span class="new_price">$90.00</span>
									<span class="old_price">$170.00</span>
								</div>
								<a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /featured -->

		<div class="container margin_60_35">
			<div class="main_title">
				<h2>Featured</h2>
				<span>Products</span>
				{{-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p> --}}
			</div>
			<div class="owl-carousel owl-theme products_carousel">
				@if($boosteds->count() > 0)
				@foreach($boosteds as $boosted)
	            <div class="item card" >
	                <div class="grid_item">
	                    {!! $boosted->quantity < setting('site.stock_threshold') ? '<span class="ribbon off">Only '.$boosted->quantity.' left</span>' : ''!!}
	                    <figure>
	                        <a href="{{ route('shop.show', $boosted->slug) }}">
	                            <img class="owl-lazy dimg" src="{{ productImage($boosted->image) }}" data-src="{{ productImage($boosted->image) }}" alt="{{ $boosted->name}} :- {!! str_limit($boosted->details, 30) !!}">
	                        </a>
	                    </figure>
	                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
	                    <a href="{{ route('shop.show', $boosted->slug) }}">
	                        <h3>{{ $boosted->name}}</h3>
	                    </a>
	                    <div class="price_box">
	                        <span class="new_price">&#8358;{{ number_format( totalcash($boosted->price))}}</span>
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
	            @endif
				
				<!-- /item -->
			</div>
			<!-- /products_carousel -->
		</div>
		<!-- /container -->
		
		<div class="bg_gray">
			<div class="container margin_30">
				<div id="brands" class="owl-carousel owl-theme">
					<div class="item">
						<a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_1.png" alt="" class="owl-lazy"></a>
					</div><!-- /item -->
					<div class="item">
						<a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_2.png" alt="" class="owl-lazy"></a>
					</div><!-- /item -->
					<div class="item">
						<a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_3.png" alt="" class="owl-lazy"></a>
					</div><!-- /item -->
					<div class="item">
						<a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_4.png" alt="" class="owl-lazy"></a>
					</div><!-- /item -->
					<div class="item">
						<a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_5.png" alt="" class="owl-lazy"></a>
					</div><!-- /item -->
					<div class="item">
						<a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_6.png" alt="" class="owl-lazy"></a>
					</div><!-- /item --> 
				</div><!-- /carousel -->
			</div><!-- /container -->
		</div>
		<!-- /bg_gray -->

		<div class="container margin_60_35">
			<div class="main_title">
				<h2>Latest News</h2>
				<span>Blog</span>
				{{-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p> --}}
			</div>
			<div class="row">
				@if($posts->count() > 0)
	          	@foreach($posts as $post)
				<div class="col-lg-6">
					<a class="box_news" href="{{ route('blog.show', $post->slug) }}">
						<figure>
							<img src="{{ productImage($post->image) }}" data-src="{{ productImage($post->image) }}" alt="{!! $post->title !!}" width="400" height="266" class="lazy">
							<figcaption><strong>28</strong>Dec</figcaption>
						</figure>
						<ul>
							<li>by Admin</li>
							<li>{!! $post->created_at->format('d M, Y') !!}</li>
						</ul>
						<h4>{!! $post->title !!}</h4>
						<p>{!! strip_tags(str_limit($post->body, $limit = 100, $end = '...')) !!}</p>
					</a>
				</div>
				@endforeach

		          @else
		          <p>No Post yet!</p>
		          @endif
				<!-- /box_news -->
				
				
				
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</main>
	<!-- /main -->
@endsection	
@section('script')
	<!-- COMMON SCRIPTS -->
    <script src="js/common_scripts.min.js"></script>
    <script src="js/main.js"></script>
	
	<!-- SPECIFIC SCRIPTS -->
	<script src="js/carousel-home.min.js"></script>
@endsection