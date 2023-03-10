<div class="header">
  <div class="d-flex flex-row justify-content-between">
    <div class="d-flex mr-auto">
      <div>
       <ul class="nav">
      <li class="nav-item p-1">
          @include('includes.icons.light_mode')
          @include('includes.icons.dark_mode')
      </li>
    </ul>
  </div>
    <div  class="p-1">
      <select id="languageSelect" class="form-select bg-light">
        @foreach(App\Models\User::LANGUAGE as $lg=>$language)
    <option value="{{$lg}}">{{$language}}</option>
        @endforeach
      </select>
   {{-- @if($item->id== $category->id) selected @endif --}}
    </div>

  </div>


    <div class="ml-auto">
      <ul class="nav">
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
    @include('includes.menu')







