@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{!! str_limit($post->meta_keywords, 60) !!}">
    <meta name="description" content="{!! str_limit($post->body, 150) !!}">
    <meta name="author" content="Ansonika">
    <title>{!!$post->title!!} | {{config('app.name')}}</title>
	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('')}}css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="{{asset('')}}css/style.css" rel="stylesheet">
	
	<!-- SPECIFIC CSS -->
    <link href="{{asset('')}}css/blog.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('')}}css/custom.css" rel="stylesheet">

</head>
@endsection

@section('main-content')	
	<main class="bg_gray">
		<div class="container margin_30">
			<div class="page_header">
				<div class="breadcrumbs">
					<ul>
						<li><a href="{{ route('landing-page') }}">Home</a></li>
						<li>{!!$post->title!!}</li>
					</ul>
				</div>
			</div>
			<!-- /page_header -->
			<div class="row">
				<div class="col-lg-9">
					<div class="singlepost">
						<figure><img alt="{!!$post->title!!}" class="img-fluid" src="{{ productImage($post->image) }}"></figure>
						<h1>{!!$post->title!!}</h1>
						<div class="postmeta">
							<ul>
								<li><a href="#"><i class="ti-folder"></i> Category</a></li>
								<li><i class="ti-calendar"></i> {{$post->created_at->format('d M, Y')}}</li>
								<li><a href="#"><i class="ti-user"></i> Admin</a></li>
								<li><a href="#"><i class="ti-comment"></i> ({{$comments->count()}}) Comments</a></li>
							</ul>
						</div>
						<!-- /post meta -->
						<div class="post-content">
							<div class="dropcaps">
								{!!$post->body!!}
							</div>

							
						</div>
						<!-- /post -->
					</div>
					<!-- /single-post -->

					<div id="comments">
						<h5>Comments</h5>
						<ul>
							@if($comments->count() > 0)
              					@foreach($comments as $comment)
									<li>
										<div class="avatar">
											<a href="#"><img src="img/avatar3.jpg" alt="">
											</a>
										</div>

										<div class="comment_right clearfix">
											<div class="comment_info">
												By <a href="#">{{$comment->name}}</a><span>|</span>{{$comment->created_at}}<span>|</span><a href="#"><i class="icon-reply"></i></a>
											</div>
											<p>
												{{$comment->body}}
											</p>
										</div>
									</li>
							@endforeach
			              @else
			              <p>No Comment yet!</p>
			              @endif
						</ul>
					</div>

					<hr>

					<h5>Login to Leave a comment</h5>
					@auth
					<form action="{{ route('blog.store') }}" method="POST">
                    	@csrf
						<div class="form-group">
							<textarea class="form-control" name="body" id="comments2" rows="6" placeholder="Comment"></textarea>
						</div>
						<input type="hidden" name="post_id" value="{{$post->id}}">
						<div class="form-group">
							<button type="submit" id="submit2" class="btn_1 add_bottom_15">Submit</button>
						</div>
					</form>
					@endauth
					
				</div>
				<!-- /col -->

				<aside class="col-lg-3">
					{{-- <div class="widget search_blog">
						<div class="form-group">
							<input type="text" name="search" id="search" class="form-control" placeholder="Search..">
							<button type="submit"><i class="ti-search"></i><span class="sr-only">Search</span></button>
						</div>
					</div> --}}
					<!-- /widget -->
					<div class="widget">
						<div class="widget-title">
							<h4>POPULAR POST</h4>
						</div>
						<ul class="comments-list">
							@if($populars->count() > 0)
	               				 @foreach($populars as $popular)
									<li>
										<div class="alignleft">
											<a href="{{ route('blog.show', $popular->slug) }}"><img src="{{ productImage($popular->image) }}" alt="{!!$popular->title!!}"></a>
										</div>
										<small>{{$popular->created_at->format('d M, Y')}}</small>
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
    <script src="{{asset('')}}js/common_scripts.min.js"></script>
    <script src="{{asset('')}}js/main.js"></script>
@endsection