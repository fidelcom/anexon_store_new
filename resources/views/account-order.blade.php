@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>My Order(s) | {{config('app.name')}}</title>

	
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
			<h4>My Order(s)</h4>
			@include('inc.messages')

          <div class="card user-card">
            <div class="card-body">
              <div class="media">
                @include('inc.account')
              <hr>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th>S/N</th>
                      <th scope="col">Order ID</th>
                      <th scope="col">Items</th>
                      <th scope="col">Date</th>
                      <th scope="col">Price</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>

                    @if($orders->count() > 0)
                      <?php $i = 0;?>
                      @foreach($orders as $order)
                      <?php $i++;?>
                      <tr>
                        <td>{{$i}}</td>
                        <th scope="row"><a href="{{ route('orders.show', $order->id) }}" class="text-info">ZS{{$order->id}}</a></th>
                        <td>
                            @foreach($order->products as $product) 
                               {{$product->name}} - <img style="width: 30px; height: 40px;" src="{{ productImage($product->image) }}"><br>
                            @endforeach   
                         </td>
                        <td>{{$order->created_at}}</td>
                        <td>&#8358;{{ number_format( $order->billing_total)}}</td>
                        <td>
                            {!!$order->shipped == 0 ? '<span class="badge badge-primary">In Progress</span>' : '<span class="badge badge-success">Delivered</span>' !!}
                        </td>
                      </tr>
                      @endforeach

                      @else
                        <p>No Order.</p>
                    @endif
                    
                  </tbody>
                </table>
              </div>
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