<!DOCTYPE html>
<html lang="en">

<script src="https://kit.fontawesome.com/dfbe4c7cae.js" crossorigin="anonymous"></script>
@yield('head')

<body>
	
	<div id="page">
	
	<header class="version_1">
		<div class="layer"></div><!-- Mobile menu overlay mask -->
		<div class="main_header">
			<div class="container">
				<div class="row small-gutters">
					<div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
						<div id="logo">
							{{-- <a href="{{ route('landing-page') }}"><div class="row"><img class="col-md-6" src="{{asset('img/logo.png')}}" alt="" width="100" height="40"><p class="col-md-6 text-white text-left h5">ANEXON</p></div></a> --}}
							<a class="row" href="{{ route('landing-page') }}"><img  src="{{asset('img/logo.png')}}" alt="ANEXON GLOBAL VENTURES" height=""></a>
						</div>
					</div>
					<nav class="col-xl-6 col-lg-7">
						<a class="open_close" href="javascript:void(0);">
							<div class="hamburger hamburger--spin">
								<div class="hamburger-box">
									<div class="hamburger-inner"></div>
								</div>
							</div>
						</a>
						<!-- Mobile menu button -->
						<div class="main-menu">
							<div id="header_menu">
								<a href="{{ route('landing-page') }}"><img src="{{asset('img/logo.png')}}" alt="" width="100" height="35"></a>
								<a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
							</div>
							<ul>
								<li>
									<a href="{{ route('landing-page') }}">Home</a>
								</li>
								<li>
									<a href="{{ route('about') }}">About Us</a>
								</li>
								<li>
									<a href="{{ route('blog.index') }}">Blog</a>
								</li>
								<li>
									<a href="{{ route('faq') }}">FAQ</a>
								</li>
								<li>
									<a href="{{ route('contact') }}">Contact Us</a>
								</li>
								
							</ul>
						</div>
						<!--/main-menu -->
					</nav>
					<div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-right">
						<a class="phone_top" href="tel:+2348055815035"><strong><span>Need Help?</span>+2348055815035</strong></a>
					</div>
				</div>
				<!-- /row -->
			</div>
		</div>
		<!-- /main_header -->

		<div class="main_nav inner">
			<div class="container">
				<div class="row small-gutters">
					<div class="col-xl-3 col-lg-3 col-md-3">
						<nav class="categories">
							<ul class="clearfix">
								<li><span>
										<a href="#">
											<span class="hamburger hamburger--spin">
												<span class="hamburger-box">
													<span class="hamburger-inner"></span>
												</span>
											</span>
											Categories
										</a>
									</span>
									<div id="menu">
										<ul>
											<?php $i = 0; ?>
								              @foreach($categories as $category)
								              <?php $i++;?>
											<li><span class="{{ request()->category == $category->slug ? 'active' : ''}}"><a href="#0"><i class="fa fa-{{$category->icon}} fa-lg"></i> &nbsp;{{$category->name}}</a></span>
												<ul>
													@foreach($allSubCategories as $allSubCategory)
                      									@if($category->id == $allSubCategory->category_id)
															<li><a href="{{ route('shop.index', ['subCategory' => $allSubCategory->name]) }}"><i class="fa fa-certificate "></i> &nbsp;{{$allSubCategory->name}}</a></li>
														@endif
                    								@endforeach
												</ul>
											</li>
											@endforeach

											
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</div>
					<div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
						<div class="custom-search-input">
							<form action="{{ route('search') }}" method="GET" {{-- class="form-inline form-search d-none d-sm-inline" --}}>
								@csrf
						          <input type="text" name="item" value="{{ request()->input('item')}}" class="form-control" placeholder="Search over 10.000 products" aria-label="Search ...">
						          <button type="submit"><i class="header-icon_search_custom"></i></button>			        
						      </form>
						</div>
					</div>
					<div class="col-xl-3 col-lg-2 col-md-3">
						<ul class="top_tools">
							<li>
								<div class="dropdown dropdown-cart">
									<a href="{{ route('cart.index') }}" class="cart_bt">
										<strong>
										@if(Cart::instance('default')->count() > 0)
							              {{ Cart::instance('default')->count() }}
						              	@else
						              		0
							            @endif  
										</strong>
									</a>
									<div class="dropdown-menu">
										<ul>
											@if(Cart::instance('default')->count() > 0)
            								@foreach(Cart::content() as $item)
											<li>
												<a href="{{ route('shop.show', $item->model->slug) }}">
													<figure><img src="{{ productImage($item->model->image) }}" data-src="{{ productImage($item->model->image) }}" alt="" width="50" height="50" class="lazy"></figure>
													<strong><span>{{$item->qty}} x {{ $item->model->name}}</span>&#8358;{{ number_format($item->model->price)}}</strong>
												</a>
												<a href="#0" class="action"></a>
												<form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
								                      @csrf
								                      {{ method_field('DELETE') }}
								                      <button type="submit" class="close" aria-label="Close"><i class="ti-trash"></i></button>
								                  </form>
											</li>
											@endforeach
            								@endif
										</ul>
										<div class="total_drop">
											<div class="clearfix"><strong>Total</strong><span>&#8358;{{ session()->has('coupon') ? number_format(session()->get('newTotal')) : number_format(Cart::total()) }}</span></div>
											<a href="{{ route('cart.index') }}" class="btn_1 outline">View Cart</a><a href="{{ route('checkout.index') }}" class="btn_1">Checkout</a>
										</div>
									</div>
								</div>
								<!-- /dropdown-cart-->
							</li>
							<li>
								<a href="{{ route('wishlist.index') }}" class="wishlist"><span>Wishlist</span></a>
							</li>
							<li>
								<div class="dropdown dropdown-access">
									<a href="{{ route('users.edit') }}" class="access_link"><span>Account</span></a>
									<div class="dropdown-menu">
										@guest
											<a href="/login" class="btn_1">Sign In or Sign Up</a>
										@else
											<a href="{{ route('users.edit') }}" class="btn_1">Dashboard</a>
										@endguest
										<ul>
											{{-- <li>
												<a href="#"><i class="ti-truck"></i>Track your Order</a>
											</li> --}}
											<li>
												<a href="{{ route('users.edit') }}"><i class="ti-user"></i>My Profile</a>
											</li>
											<li>
												<a href="{{ route('faq') }}"><i class="ti-help-alt"></i>Help and Faq</a>
											</li>
											@auth
											<li>
												<a href="{{ route('orders.index') }}"><i class="ti-package"></i>My Orders</a>
											</li>
											<li>
												<a href="{{ route('wishlist.index') }}"><i class="ti-heart"></i>Wishlist ({{Cart::instance('wishlist')->count()}})</a>
											</li>
											<li>
												<a href="{{ route('logout') }}" onclick="event.preventDefault();             document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt"></i>Logout</a>
											</li>
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								              @csrf
								          </form>
								          @endauth
										</ul>
									</div>
								</div>
								<!-- /dropdown-access-->
							</li>
							<li>
								<a href="javascript:void(0);" class="btn_search_mob"><span>Search</span></a>
							</li>
							<li>
								<a href="#menu" class="btn_cat_mob">
									<div class="hamburger hamburger--spin" id="hamburger">
										<div class="hamburger-box">
											<div class="hamburger-inner"></div>
										</div>
									</div>
									Categories
								</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<div class="search_mob_wp">
				<input type="text" class="form-control" placeholder="Search over 10.000 products">
				<input type="submit" class="btn_1 full-width" value="Search">
			</div>
			<!-- /search_mobile -->
		</div>
		<!-- /main_nav -->
	</header>
	<!-- /header -->
	
@yield('main-content')
	
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<h3 data-target="#collapse_1">Quick Links</h3>
					<div class="collapse dont-collapse-sm links" id="collapse_1">
						<ul>
							<li><a href="{{ route('about') }}">About us</a></li>
							<li><a href="{{ route('faq') }}">Faq</a></li>
							@auth
							<li><a href="{{ route('users.edit') }}">My account</a></li>
							@else
							<li><a href="/login">Login</a></li>
							@endauth
							<li><a href="{{ route('blog.index') }}">Blog</a></li>
							<li><a href="{{ route('contact') }}">Contacts</a></li>
							<li><a href="{{ route('policy') }}">Privacy Policy</a></li>
							<li><a href="{{ route('tandc') }}">Terms and Conditions</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3 data-target="#collapse_2">Categories</h3>
					<div class="collapse dont-collapse-sm links" id="collapse_2">
						<ul>
							<?php $i = 0; ?>
				              @foreach($categories as $category)
				              <?php $i++;?>
							<li><a href="#">{{$category->name}}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
						<h3 data-target="#collapse_3">Contacts</h3>
					<div class="collapse dont-collapse-sm contacts" id="collapse_3">
						<ul>
							<li><i class="ti-home"></i>3, Ayangburen Road, Ikorodu, Lagos 1, Dominion Plaza, Yellow Sign Board, Off Ijede Road, 1 Alh. Azeez St, Ikorodu 102222, Lagos</li>
							<li><i class="ti-headphone-alt"></i>0805 581 5035</li>
							<li><i class="ti-email"></i><a href="mailto:contact@anexon.org">contact@anexon.org</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
						<h3 data-target="#collapse_4">Keep in touch</h3>
					<div class="collapse dont-collapse-sm" id="collapse_4">
						<div id="newsletter">
						    <div class="form-group">
						        <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
						        <button type="submit" id="submit-newsletter"><i class="ti-angle-double-right"></i></button>
						    </div>
						</div>
						<div class="follow_us">
							<h5>Follow Us</h5>
							<ul>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/twitter_icon.svg" alt="" class="lazy"></a></li>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/facebook_icon.svg" alt="" class="lazy"></a></li>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/instagram_icon.svg" alt="" class="lazy"></a></li>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/youtube_icon.svg" alt="" class="lazy"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /row-->
			<hr>
			<div class="row add_bottom_25">
				<div class="col-lg-6">
					<ul class="footer-selector clearfix">
						<li>
							<div class="styled-select lang-selector">
								<select>
									<option value="English" selected>English</option>
									<option value="French">French</option>
									<option value="Spanish">Spanish</option>
									<option value="Russian">Russian</option>
								</select>
							</div>
						</li>
						<li>
							<div class="styled-select currency-selector">
								<select>
								<option value="US Dollars" selected>Naira</option>
									<option value="US Dollars" >US Dollars</option>
									<option value="Euro">Euro</option>
								</select>
							</div>
						</li>
						<li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/cards_all.svg" alt="" width="198" height="30" class="lazy"></li>
					</ul>
				</div>
				<div class="col-lg-6">
					<ul class="additional_links">
						<li><a href="#0">Terms and conditions</a></li>
						<li><a href="#0">Privacy</a></li>
						<li><span>© {{date('Y')}} {{config('app.name')}}</span></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!--/footer-->
	</div>
	<!-- page -->
	
	<div id="toTop"></div><!-- Back to top button -->
	
	@yield('script')
		
</body>
</html>