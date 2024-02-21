@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Wishlist | {{config('app.name')}}</title>

	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="css/error_track.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">

</head>
@endsection

@section('main-content')
	
	<main class="bg_gray">
		<div class="container">
			<h4>Wishlist</h4>
			 @include('inc.messages')

          <div class="card user-card">
            <div class="card-body">
              <div class="media">
                @include('inc.account')
              <hr>
              @if(Cart::instance('wishlist')->count())
              <table class="table table-cart">
                <tbody>
                  
                  @foreach(Cart::instance('wishlist')->content() as $item)
                  <tr>
                    <td>                      
                      {{--<form action="{{ route('wishlist.destroy', $item->rowId) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-sm btn-outline-warning rounded-circle" title="Remove"><i class="fa fa-close"></i></button>
                      </form>--}}
                    </td>
                    <td>
                      <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ productImage($item->model->image) }}" width="50" height="50" alt="{{ $item->model->name}} - {!! $item->model->details!!}"></a>         
                      <form action="{{ route('wishlist.destroy', $item->rowId) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-sm btn-outline-warning rounded">Remove</button>
                      </form>
                    </td>
                    <td>
                      <h6><a href="{{ route('shop.show', $item->model->slug) }}" class="text-body">{{ $item->model->name}} - {!! $item->model->details!!}</a></h6>
                      <h6 class="text-muted">&#8358;{{ number_format( totalcash($item->model->price, $item->model->profit) )}}</h6>
                      
                        {!!getStockLevel($item->model->quantity)!!}
                      
                    </td>
                    <td>
                      <form action="{{ route('wishlist.switchToCart', $item->rowId) }}" method="POST">
                          {{ csrf_field() }}
                        <button type="submit" class="btn btn-info btn-sm">Move to cart</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach

                  
                  {{--<tr>
                    <td colspan="4">
                      <button class="btn btn-outline-secondary">CLEAR ALL</button>
                    </td>
                  </tr>--}}
                </tbody>
              </table>
              @endif
            </div>
          </div>
      </div>
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