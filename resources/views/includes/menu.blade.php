
 <nav class="navbar navbar-expand-sm navbar-dark " style="background-color: #609EA2;">
    <div class="container-fluid">
        <a style="display:inline;padding:0px" id="show_menu" class="navbar-brand" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="35" height="35">
            <path fill="currentColor" d="M21,6H3A1,1,0,0,1,3,4H21a1,1,0,0,1,0,2Z"/>
            <path fill="currentColor" d="M21,11H3a1,1,0,0,1,0-2H21a1,1,0,0,1,0,2Z"/>
            <path fill="currentColor" d="M21,16H3a1,1,0,0,1,0-2H21a1,1,0,0,1,0,2Z"/>
            </svg>
        </a>
      <a style="display:none" id="hide_menu" class="navbar-brand" href="#">
        <svg class="svg-icon" style="width: 45; height: 45;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M445.1328 325.8368a35.3792 35.3792 0 0 1-35.84-34.9184c0-19.3024 16.0256-34.9184 35.84-34.9184H732.16c19.8144 0 35.8912 15.616 35.8912 34.9184a35.3792 35.3792 0 0 1-35.84 34.9184H445.0816z m-14.336 195.4816a35.3792 35.3792 0 0 1-35.84-34.9184c0-19.3024 16.0256-34.9184 35.84-34.9184h301.312c19.8144 0 35.8912 15.616 35.8912 34.9184a35.3792 35.3792 0 0 1-35.84 34.9184H430.7456zM283.0336 388.608l44.3392 68.7104a34.3552 34.3552 0 0 1-11.264 48.128 36.4544 36.4544 0 0 1-49.5104-11.008l-56.32-87.2448a34.0992 34.0992 0 0 1 0-37.1712l56.32-87.2448a36.4544 36.4544 0 0 1 49.4592-11.008c16.7936 10.24 21.8624 31.7952 11.264 48.128l-44.288 68.7104zM251.4432 716.8a35.3792 35.3792 0 0 1-35.84-34.9184c0-19.2512 16.0256-34.9184 35.84-34.9184h480.6656c19.8144 0 35.8912 15.6672 35.8912 34.9184a35.3792 35.3792 0 0 1-35.84 34.9184H251.392z"  /></svg>
      </a>
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
            <a   class="nav-link" href="{{route('blog.index')}}">Blogs</a>
          </li>
          <li class="nav-item">
            <a   class="nav-link" href="{{route('address.index')}}">Address</a>
          </li>
          <li class="nav-item">
            <a   class="nav-link" href="{{route('payment.index')}}">Payment</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('customer.orders')}}">My orders</a>
          </li>
        </ul>

        <div class="container-fluid w-25 justify-content-center" id="navbarNav">
            <form>
              <div class="form-group d-flex">
                <input type="text" class="form-control me-2" placeholder="Search...">
                <button id="search_btn" class="btn rounded" type="button">
                    <svg width="34px" height="34px" viewBox="0 0 1024 1024" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M492.5 917.7c-247 0-447.9-200.9-447.9-447.9s200.9-448 447.9-448 447.9 200.9 447.9 447.9-200.9 448-447.9 448z m0-810.6c-200 0-362.6 162.7-362.6 362.6s162.7 362.6 362.6 362.6 362.6-162.7 362.6-362.6-162.6-362.6-362.6-362.6z" fill="#3688FF" /><path d="M951.1 971c-10.9 0-21.8-4.2-30.2-12.5l-96-96c-16.7-16.7-16.7-43.7 0-60.3 16.6-16.7 43.7-16.7 60.3 0l96 96c16.7 16.7 16.7 43.7 0 60.3-8.2 8.4-19.2 12.5-30.1 12.5z" fill="#5F6379" /></svg>
                </button>
              </div>
            </form>
        </div>

        <span class="mx-5 d-flex">
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
</span>
      </div>
    </div>
  </nav>



