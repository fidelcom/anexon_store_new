              @auth
                {{-- <img src="../img/user.png" class="img-thumbnail rounded-circle" alt="John Thor"> --}}
                <div class="media-body ml-3 pt-4">
                  <h4>{{$user->name." ".$user->lname}}</h4>
                  <div class="small text-muted">Joined {{$user->created_at}}</div>
                  
                  
                </div>
              </div>
              <hr>
              <ul class="nav nav-pills">
                <li class="nav-item" style="margin: 5px;">
                  <a class="nav-link btn btn-primary {{-- {{url()->current() == 'https://anexon.org/my-profile' ? 'active' : ''}} --}}" href="{{ route('users.edit') }}">Profile</a>
                </li>
                <li class="nav-item" style="margin: 5px;">
                  <a class="nav-link btn btn-primary {{-- {{url()->current() == 'https://anexon.org/my-orders' ? 'active' : ''}} --}}" href="{{ route('orders.index') }}">Orders</a>
                </li>
                <li class="nav-item" style="margin: 5px;">
                  <a class="nav-link btn btn-primary {{-- {{url()->current() == 'https://anexon.org/wishlist' ? 'active' : ''}} --}}" href="{{ route('wishlist.index') }}">Wishlist</a>
                </li>
                 
              </ul>
                @endauth