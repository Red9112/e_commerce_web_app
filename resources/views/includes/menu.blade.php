
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('dashboard')}}">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav me-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Categories</a>
                <ul class="dropdown-menu">
                    @foreach ($categories as $cat)
                    <li> <a class="dropdown-item" href="{{route('prodByCat',['id'=>$cat])}}"><h6>{{$cat->name}}</h6></a></li>
                    @endforeach
                </ul>
              </li>
          <li class="nav-item">
            <a   class="nav-link" href="{{route('user.index')}}">Users</a>
          </li>
          <li class="nav-item">
            <a   class="nav-link" href="{{route('shop.index')}}">Shops</a>
          </li>
          <li class="nav-item">
            <a   class="nav-link" href="{{route('blog.index')}}">Blogs</a>
          </li>
          <li class="nav-item">
            <a   class="nav-link" href="{{route('product.index')}}">My products</a>
          </li>
          <li class="nav-item">
            <a   class="nav-link" href="{{route('category.index')}}">Categories</a>
          </li>
          <li class="nav-item">
            <a   class="nav-link" href="{{route('discount.index')}}">Discounts</a>
          </li>
          <li class="nav-item">
            <a   class="nav-link" href="{{route('address.index')}}">Address</a>
          </li>
          <li class="nav-item">
            <a   class="nav-link" href="{{route('shipping.index')}}">Shipping</a>
          </li>
          <li class="nav-item">
            <a   class="nav-link" href="{{route('orderStatus.index')}}">Order Status</a>
          </li>
          <li class="nav-item">
            <a   class="nav-link" href="{{route('role.index')}}">Roles</a>
          </li>
        </ul>
        @auth
        @if (auth()->user()->hasRole('admin'))
        <div class="dropdown">
            <svg id="bell-svg" type="button" data-bs-toggle="dropdown" width="40" height="40" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 47.5 47.5" viewBox="0 0 47.5 47.5">
            <defs><clipPath id="a"><path d="M0 38h38V0H0v38Z"/></clipPath></defs>
            <g clip-path="url(#a)"
              transform="matrix(1.25 0 0 -1.25 0 47.5)"><path fill="#ffac33"
              d="M0 0c0-11 5-10 5-15 0 0 0-2-2-2h-26c-2 0-2 2-2 2 0 5 5 4 5 15 0 5.522 4.478 10 10 10S0 5.522 0 0"
              transform="translate(29 24)"/><path fill="#ffac33" d="M0 0a3 3 0 1 1-6 0 3 3 0 0 1 6 0"
              transform="translate(22 34)"/><path fill="#ffac33" d="M0 0a4 4 0 0 1 4 4h-8a4 4 0 0 1 4-4"
              transform="translate(19 1)"/><span id="notfcount" class="badge bg-danger">{{auth()->user()->unreadNotifications->count()}}</span></g></svg>

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
        @endauth
<a class="mx-3" href="{{route('cart.index')}}">
<?xml version="1.0" encoding="utf-8"?><svg width="38" height="38" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.9 107.5" style="enable-background:new 0 0 122.9 107.5" xml:space="preserve"><g><path d="M3.9,7.9C1.8,7.9,0,6.1,0,3.9C0,1.8,1.8,0,3.9,0h10.2c0.1,0,0.3,0,0.4,0c3.6,0.1,6.8,0.8,9.5,2.5c3,1.9,5.2,4.8,6.4,9.1 c0,0.1,0,0.2,0.1,0.3l1,4H119c2.2,0,3.9,1.8,3.9,3.9c0,0.4-0.1,0.8-0.2,1.2l-10.2,41.1c-0.4,1.8-2,3-3.8,3v0H44.7 c1.4,5.2,2.8,8,4.7,9.3c2.3,1.5,6.3,1.6,13,1.5h0.1v0h45.2c2.2,0,3.9,1.8,3.9,3.9c0,2.2-1.8,3.9-3.9,3.9H62.5v0 c-8.3,0.1-13.4-0.1-17.5-2.8c-4.2-2.8-6.4-7.6-8.6-16.3l0,0L23,13.9c0-0.1,0-0.1-0.1-0.2c-0.6-2.2-1.6-3.7-3-4.5 c-1.4-0.9-3.3-1.3-5.5-1.3c-0.1,0-0.2,0-0.3,0H3.9L3.9,7.9z M96,88.3c5.3,0,9.6,4.3,9.6,9.6c0,5.3-4.3,9.6-9.6,9.6 c-5.3,0-9.6-4.3-9.6-9.6C86.4,92.6,90.7,88.3,96,88.3L96,88.3z M53.9,88.3c5.3,0,9.6,4.3,9.6,9.6c0,5.3-4.3,9.6-9.6,9.6 c-5.3,0-9.6-4.3-9.6-9.6C44.3,92.6,48.6,88.3,53.9,88.3L53.9,88.3z M33.7,23.7l8.9,33.5h63.1l8.3-33.5H33.7L33.7,23.7z"/></g></svg>
</a>
<form class="d-flex">
          <input class="form-control me-2" type="text" placeholder="Search">
          <button class="btn btn-primary" type="button">Search</button>
        </form>







      </div>
    </div>
  </nav>
