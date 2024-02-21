@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Blog | {{config('app.name')}}</title>
	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
	<!-- SPECIFIC CSS -->
    <link href="css/blog.css" rel="stylesheet">

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
						<li>Blog</li>
					</ul>
				</div>
				<h1>{{config('app.name')}} &amp; News</h1>
			</div>
			<!-- /page_header -->
			<div class="row">
				<div class="col-md-9">
					{{-- <div class="widget search_blog d-block d-sm-block d-md-block d-lg-none">
						<div class="form-group">
							<input type="text" name="search" id="search" class="form-control" placeholder="Search..">
							<button type="submit"><i class="ti-search"></i><span class="sr-only">Search</span></button>
						</div>
					</div> --}}
					<!-- /widget -->
					<div class="row">
						@if($posts->count() > 0)
	          				@foreach($posts as $post)
							<div class="col-md-6">
								<article class="blog">
									<figure>
										<a href="{{ route('blog.show', $post->slug) }}"><img src="{{ productImage($post->image) }}" alt="">
											<div class="preview"><span>Read more</span></div>
										</a>
									</figure>
									<div class="post_info">
										<small>{!! $post->created_at->format('d M, Y') !!}</small>
										<h2><a href="{{ route('blog.show', $post->slug) }}">{!! $post->title !!}</a></h2>
										{{-- <p>{!! str_limit($post->body, 150) !!}</p> --}}
										{{-- <ul>
											<li>
												<div class="thumb"><img src="img/avatar.jpg" style="width: 20px;" alt=""></div> Admin
											</li>
											<li><i class="ti-comment"></i>{{countComment($post->id)}}</li>
										</ul> --}}
									</div>
								</article>
								<!-- /article -->
							</div>
							@endforeach

					          @else
					          <p>No Post yet!</p>
					          @endif
					</div>
					

					<div class="pagination__wrapper no_border add_bottom_30">
						<ul class="pagination">
							{{ $posts->appends(request()->input())->links() }}
						</ul>
					</div>
					<!-- /pagination -->

				</div>
				<!-- /col -->

				<aside class="col-md-3">
					{{-- <div class="widget search_blog d-none d-sm-none d-md-none d-lg-block">
						<div class="form-group">
							<input type="text" name="search" id="search_blog" class="form-control" placeholder="Search..">
							<button type="submit"><i class="ti-search"></i><span class="sr-only">Search</span></button>
						</div>
					</div> --}}
					<!-- /widget -->
					<div class="widget">
						<div class="widget-title">
							<h4>Latest Post</h4>
						</div>
						<ul class="comments-list">
							@if($populars->count() > 0)
                				@foreach($populars as $popular)
									<li>
										<div class="alignleft">
											<a href="{{ route('blog.show', $popular->slug) }}"><img src="img/blog-5.jpg" alt="{!!$popular->title!!}"></a>
										</div>
										<small>{!! $popular->created_at->format('d M, Y') !!}</small>
										<h3><a href="{{ route('blog.show', $popular->slug) }}" title="">{!!$popular->title!!}</a></h3>
									</li>
								@endforeach
			                @else
			                <p>No Popular Post this week</p>
			                @endif
						</ul>
					</div>
					
				</aside>
				<!-- /aside -->
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