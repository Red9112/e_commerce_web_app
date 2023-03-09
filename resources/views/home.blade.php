@extends('layouts.home_layout')
@section('content')
{{-- header --}}
<header>
    <div id="header_home">
    <div class="container">
      <div id="header_top">
           <div class="row">
              <div class="col-sm-12">
                <div class="d-flex">
                     <ul class="nav">
                            <li class="nav-item p-1">
                                @include('includes.icons.light_mode')
                                @include('includes.icons.dark_mode')
                                </li>
                        </ul>
                        <div class="mx-1 my-1">
                            <select id="languageSelect" class="form-select bg-light">
                            @foreach(App\Models\User::LANGUAGE as $lg=>$language)
                            <option value="{{$lg}}">{{$language}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div id="user_dropdown" class="ml-auto">
                            <ul class="nav ">
                              @guest
                      @if (Route::has('login'))
                              <li class="nav-item">
                                <a class="nav-link " href="{{ route('login') }}" >{{__('Login')}}</a>
                              </li>
                              @endif
                              @if (Route::has('register'))
                              <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.create') }}" >{{__('Register')}}</a>
                              </li>
                              @endif
                              @else

                      <li class="nav-item dropdown ">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->name }}
                          </a>
                          <div class="text-center dropdown-menu dropdown-menu-end aria-labelledby="navbarDropdown">
                              <a class="dropdown-item text-success" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                 Logout @include('includes.icons.logout')</a>
                              <a class="dropdown-item text-success" href="{{route('user.show',['user'=>Auth::user()])}}">
                                Profile @include('includes.icons.profile')</a>
                               <a class="dropdown-item text-success" href="{{route('user.edit',['user'=>Auth::user()])}}">
                                Edit  @include('includes.icons.profile_edit')</a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
                          </div>
                      </li>
                        @endguest
                            </ul>
                          </div>

                        </div>
                </div>
            </div>
        </div>






            <div class="d-flex justify-content-center">

<div class="p-3 my-3">
@auth
<a id="show_menu_home" class="navbar-brand" href="#">
  @include('includes.icons.show_menu')
 </a>
@endauth
</div>

                <div id="search_by_cat_home" class="p-3 my-3">
                    <button class="btn rounded btn-sm my-0 px-3 py-0 " type="button">
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
                <div class="input-group w-50 py-3 my-3 mx-0">
                    <form method="GET" action="{{ route('dashboard') }}">
                        <div class="input-group d-flex ">
                         <input style="width: 450px" type="text" class="form-control" placeholder="i'm shopping for..."
                            id="search_products" name="search_products" value="{{ request()->input('search_products') }}">
                         <div class="input-group-append">
                             <button id="search_btn" class="btn btn-secondary" type="submit" style="background-color: #f26522; border-color:#f26522 ">
                              <i class="fa fa-search"></i>
                             </button>
                            </div>
                        </div>
                        </form>
                 </div>

                 <div id="cart_wishlist" class=" d-flex justify-content-end py-3 my-3 mx-0">
                    <ul class="nav mx-0">
                        <li class="nav-item">
                          <a class="nav-link" href="#" >
                            <i style="color:#f26522" class="fa fa-shopping-cart fa-2xl" aria-hidden="true"></i> Cart</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#" >
                            <i style="color:#f26522" class="fa-solid fa-heart fa-2xl" aria-hidden="true"></i> Wishlist</a>
                        </li>
                    </ul>
                 </div>
                </div>










     </div>
    </div>
</header>

{{-- sidebar --}}
<div style="display: none" id="home_side_bar" class="container">
  <div style="display: relative;margin-bottom: 10px;">
    <a  id="close_icon_btn" class="link"><i id="close_icon" class="fa fa-close fa-2xl" aria-hidden="true"></i></a>
  </div>
  
  <div id="home_sidebar_links">
  <ul class="nav flex-column mt-5 pt-5">
    <li class="nav-item">
      <a class="nav-link" href="{{route('My_addresses')}}" >My address</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('user_cards')}}" >My cards</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('customer.orders')}}" >My orders</a>
    </li>
  </ul>
  
  </div>
</div>
{{-- end_side_bar --}}

<div id="content">
  
</div>










{{-- footer --}}
<footer>
    <div id="footer_home">
     <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h4>About Us</h4>
          <p>Our e-commerce website is your one-stop-shop for all your online shopping needs.We offer a wide variety of products.With a user-friendly interface and simple navigation,shopping has never been easier.We strive to provide excellent customer service, so you can shop with confidence.Explore our website and find the perfect products to fit your lifestyle and needs.Happy shopping!</p>
        </div>
        <div class="col-md-6">
          <h4>Contact Us</h4>
          <ul>
            <li><i class="fas fa-envelope"></i> info@example.com</li>
            <li><i class="fas fa-phone"></i> (+212) 456-7890</li>
            <li><i class="fas fa-map-marker-alt"></i>  123 Main St, Tangier Morocco</li>
          </ul>
        </div>
      </div>
      <p class="text-center">
        <i class="fa-brands fa-github"></i>
        <a id="github_link" class="btn" href="http://github.com/Red9112"> compte github</a>
      </p>
      <hr>
      <p class="text-center">Copyright &copy; 2023</p>
    </div>
    </div>
  </footer>

{{-- End__footer --}}












































































@endsection
