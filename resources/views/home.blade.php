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
                </div>
                        <div id="user_dropdown" class="ml-auto">
                            <ul class="nav ">
                              @guest
                      @if (Route::has('login'))
                              <li class="nav-item">
                                <a class="nav-link text-success " href="{{ route('login') }}" >{{__('Login')}}</a>
                              </li>
                              @endif
                              @if (Route::has('register'))
                              <li class="nav-item">
                                <a class="nav-link text-success" href="{{ route('user.create') }}" >{{__('Register')}}</a>
                              </li>
                              @endif
                              @else
                      
                      <li class="nav-item dropdown ">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle text-success " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
    </div>
</header>




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