
 <nav class="navbar navbar-expand-sm navbar-dark " style="background-color: #609EA2;">
    <div class="container-fluid">

@auth
<a style="display:inline;padding:0px" id="show_menu" class="navbar-brand" href="#">
  @include('includes.icons.show_menu')
 </a>
  <a style="display:none" id="hide_menu" class="navbar-brand" href="#">
    @include('includes.icons.hide_menu')
  </a>
@endauth

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
      </button>
      <a class="nav-link mx-3" href="{{route('dashboard')}}">@include('includes.icons.home')</a>
      <h5><a class="nav-link" href="{{route('blog.index')}}">Blogs</a></h5>
        <div class="container-fluid w-50  d-flex" id="navbarNav">
            <form method="GET" action="{{ route('dashboard') }}">
              <div class="form-group d-flex ">
                <input type="text" class="form-control me-2" placeholder="i'm shopping for..."
                 id="search_products" name="search_products" value="{{ request()->input('search_products') }}">
                <button id="search_btn" class="btn rounded" type="submit">
                @include('includes.icons.search')
                </button>
              </div>
            </form>
            <button id="search_btn" class="btn rounded btn-sm mx-2" type="button">
            <ul class="navbar-nav">
            <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Categories</a>
                <ul class="dropdown-menu">
                    @foreach ($categories as $cat)
                    <li> <a class="dropdown-item" href="{{route('prodByCat',['id'=>$cat])}}"><h6>{{$cat->name}}</h6></a></li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </button>
        </div>

        <span class="mx-5 d-flex">
        @auth
        @if (auth()->user()->hasRole('admin'))
        <div class="dropdown">
            @include('includes.icons.notifications')
        <ul class="dropdown-menu">
        @foreach (auth()->user()->unreadNotifications as $notification)
        {{-- {{ $notification->data['notification'] }} --}}
        <li><a class="dropdown-item" href="{{route('notification')}}">{{$notification->data['subject']}}</a></li>
        @endforeach
        @if (auth()->user()->unreadNotifications->count()==0)
        <li><a class="dropdown-item" href="{{route('notification')}}">notifications</a></li>
        @endif
          </ul>
        </div>
        @endif
        <a href="{{route('wishlist.index')}}" title="wishlist" type="button">
          @include('includes.icons.wishlist')
        </a>
        @endauth
<a class="mx-3" href="{{route('cart.index')}}"  title="cart">
@include('includes.icons.cart')
</a>
</span>






    </div>
  </nav>



