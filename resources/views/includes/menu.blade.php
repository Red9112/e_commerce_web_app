
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
        <form class="d-flex">
          <input class="form-control me-2" type="text" placeholder="Search">
          <button class="btn btn-primary" type="button">Search</button>
        </form>






      </div>
    </div>
  </nav>
