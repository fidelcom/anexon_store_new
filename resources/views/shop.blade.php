@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>{{ $categoryName }} | {{config('app.name')}}</title>

	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="css/listing.css" rel="stylesheet">

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
		<div class="top_banner">
			<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
				<div class="container">
					<div class="breadcrumbs">
						<ul>
							<li><a href="{{ route('landing-page') }}">Home</a></li>
							<li>{{ $categoryName }}</li>
						</ul>
					</div>
					<h1>{{ $categoryName }}</h1>
				</div>
			</div>
			<img src="{{asset('')}}img/banner1.jpg" class="img-fluid" alt="">
		</div>
		<!-- /top_banner -->
			<div id="stick_here"></div>		
			<div class="toolbox elemento_stick">
				<div class="container">
				<ul class="clearfix">
					<li>
							<a {{-- class="btn btn-default btn-primary" --}} href="{{ route('shop.index', ['category' => request()->category, 'subCategory' => request()->subCategory, 'sort' => 'low_high']) }}">Low to High</a>
					</li>
					<li>
                			<a {{-- class="btn btn-default btn-primary" --}} href="{{ route('shop.index', ['category' => request()->category, 'subCategory' => request()->subCategory, 'sort' => 'high_low']) }}">High to Low</a>
							{{-- <select name="sort" id="sort">
                                    <option value="popularity" selected="selected">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by newness</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to 
							</select> --}}
					</li>
					{{-- <li>
						<a href="#0"><i class="ti-view-grid"></i></a>
						<a href="#"><i class="ti-view-list"></i></a>
					</li>
					<li>
						<a href="#0" class="open_filters">
							<i class="ti-filter"></i><span>Filters</span>
						</a>
					</li> --}}
				</ul>
				</div>
			</div>
			<!-- /toolbox -->
			
			<div class="container margin_30">
			
			<div class="row">
				{{-- <aside class="col-lg-3" id="sidebar_fixed">
				    <div class="filter_col">
				        <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
				        <div class="filter_type version_2">
				            <h4><a href="#filter_1" data-toggle="collapse" class="opened">Categories</a></h4>
				            <div class="collapse show" id="filter_1">
				                <ul>
				                    <li>
				                        <label class="container_check">Men <small>12</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">Women <small>24</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">Running <small>23</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">Training <small>11</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                </ul>
				            </div>
				            <!-- /filter_type -->
				        </div>
				        <!-- /filter_type -->
				        <div class="filter_type version_2">
				            <h4><a href="#filter_2" data-toggle="collapse" class="opened">Color</a></h4>
				            <div class="collapse show" id="filter_2">
				                <ul>
				                    <li>
				                        <label class="container_check">Blue <small>06</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">Red <small>12</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">Orange <small>17</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">Black <small>43</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                </ul>
				            </div>
				        </div>
				        <!-- /filter_type -->
				        <div class="filter_type version_2">
				            <h4><a href="#filter_3" data-toggle="collapse" class="closed">Brands</a></h4>
				            <div class="collapse" id="filter_3">
				                <ul>
				                    <li>
				                        <label class="container_check">Adidas <small>11</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">Nike <small>08</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">Vans <small>05</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">Puma <small>18</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                </ul>
				            </div>
				        </div>
				        <!-- /filter_type -->
				        <div class="filter_type version_2">
				            <h4><a href="#filter_4" data-toggle="collapse" class="closed">Price</a></h4>
				            <div class="collapse" id="filter_4">
				                <ul>
				                    <li>
				                        <label class="container_check">$0 — $50<small>11</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">$50 — $100<small>08</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">$100 — $150<small>05</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">$150 — $200<small>18</small>
				                            <input type="checkbox">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                </ul>
				            </div>
				        </div>
				        <!-- /filter_type -->
				        <div class="buttons">
				            <a href="#0" class="btn_1">Filter</a> <a href="#0" class="btn_1 gray">Reset</a>
				        </div>
				    </div>
				</aside> --}}
				<!-- /col -->
				<div class="col-lg-12">
					@include('inc.messages')
					<div class="row small-gutters">
						@if($products->count() > 0)
              			@foreach($products as $product)
						<div class="col-6 col-md-3 card">
							<div class="grid_item">
								{!! $product->quantity < setting('site.stock_threshold') ? '<span class="ribbon off">Only '.$product->quantity.' left</span>' : ''!!}
								<figure>
									<a href="{{ route('shop.show', $product->slug) }}">
										<img class="img-fluid lazy dimg" src="{{ productImage($product->image) }}" data-src="{{ productImage($product->image) }}" alt="">
									</a>
									{{-- <div data-countdown="2019/05/15" class="countdown"></div> --}}
								</figure>
								<a href="{{ route('shop.show', $product->slug) }}">
									<h3>{{ $product->name}}</h3>
								</a>
								<div class="price_box">
									<span class="new_price">&#8358;{{ number_format( totalcash($product->price))}}</span>
									<span class="old_price">&#8358;{{ number_format( slash($product->price) )}}</span>
								</div>
								<ul>
									{{-- <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li> --}}
									<li>
										<form action="{{ route('compare.store') }}" method="POST">
					                        @csrf
					                        <input type="hidden" name="id" value="{{ $product->id }}">
					                        <input type="hidden" name="name" value="{{ $product->name }}">
					                        <input type="hidden" name="price" value="{{ totalcash($product->price) }}">
					                          <div class="form-group">
					                            <button type="submit" class="btn btn-info" ><i class="ti-control-shuffle"></i>{{-- <span>Add to Compare</span> --}}</button>
					                          </div>
					                      </form>
									</li>
									
									<li>
										<form action="{{ route('cart.store') }}" method="POST">
				                            @csrf
				                            <input type="hidden" name="id" value="{{ $product->id }}">
				                            <input type="hidden" name="name" value="{{ $product->name }}">
				                            <input type="hidden" name="price" value="{{ totalcash($product->price) }}">
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
					<div class="pagination__wrapper">
						<ul class="pagination">
							{{ $products->appends(request()->input())->onEachSide(1)->links() }}
						</ul>
					</div>
				</div>
				<!-- /col -->
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
	<script src="js/sticky_sidebar.min.js"></script>
	<script src="js/specific_listing.js"></script>
@endsection