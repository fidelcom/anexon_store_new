@extends('layouts.app')
@section('head')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>My Profile | {{config('app.name')}}</title>

	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    {{-- <link href="css/bootstrap.custom.min.css" rel="stylesheet"> --}}
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="css/error_track.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 

</head>
@endsection

@section('main-content')
	
	<main class="bg_gray">
		<div class="container">
			<h4>My Profile</h4>
			@include('inc.messages')

          <div class="card user-card">
            <div class="card-body">
              <div class="media">
               @include('inc.account')
              <hr>
              <form action="{{ route('users.update') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <label for="profileFirstName">First Name</label>
                    <input name="name" type="text" class="form-control" id="profileFirstName" value="{{ old('name', $user->name) }}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="profileLastName">Last Name</label>
                    <input name="lname" type="text" class="form-control" id="profileLastName" value="{{ old('name', $user->lname) }}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="profileEmail">Email address</label>
                    <input type="email" name="email" class="form-control" id="profileEmail" value="{{ old('email', $user->email) }}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="profilePhone">Phone Number</label>
                    <input name="phone" type="number" class="form-control" id="profilePhone" value="{{ old('phone', $user->phone) }}">
                  </div>
                  <div class="form-group col-sm-12">
                    <label for="profilePhone">Address</label>
                    <input name="address" type="text" class="form-control" id="profileAddress" value="{{ old('phone', $user->address) }}">
                  </div>
                  {{-- <div class="row"> --}}
                    <div class="col-md-6">
                      <div class="form-group">
                          <select class="form-control dynamic" name="state" id="ng_state_id" data-dependent="lga" required="">
                              <option>Select State</option>
                              @foreach($states as $state)
                                  <option value="{{$state->name}}" {{ $state->name == $user->state ? 'selected' : '' }}>{{$state->name}}</option>
                              @endforeach
                          </select>
                          
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <select id="lga" name="lga" class="form-control" required="">
                              <option >Select Local Government</option>
                              @foreach($lgas as $lga)
                                  <option value="{{$lga->name}}" {{ $lga->name == $user->lga ? 'selected' :  '' }}>{{$lga->name}}</option>
                              @endforeach
                          </select>
                          
                      </div>
                      {{-- {{ csrf_field() }} --}}
                    </div>
                  {{-- </div> --}}
                  <div class="form-group col-sm-6">
                    <label for="profilePassword">Password</label>
                    <input type="password" name="password" class="form-control" id="profilePassword">
                    <p><i>Leave password blank to keep current password</i></p>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="profileConfirmPassword">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="profileConfirmPassword">
                  </div>
                  <div class="form-group col-12">
                  
                    <button type="submit" class="btn btn-success btn-block">SAVE</button>
                  </div>
                </div>
              </form>
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
      <script>
        $(document).ready(function(){

          $('.dynamic').change(function(){
              if($(this).val() != '')
              {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                  url:"{{ route('lga.fetch') }}",
                  method:"POST",
                  data:{select:select, value:value, _token:_token, dependent:dependent},
                  success:function(result)
                    {
                         $('#'+dependent).html(result);
                    }

                })
              }
          });

        });
        </script>
		
@endsection