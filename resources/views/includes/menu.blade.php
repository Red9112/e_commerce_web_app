
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
            <a  id="plus" class="nav-link" href="{{route('user.index')}}">Users</a>
          </li>
          <li class="nav-item">
            <a  id="plus" class="nav-link" href="{{route('shop.index')}}">Shops</a>
          </li>
          <li class="nav-item">
            <a  id="plus" class="nav-link" href="{{route('blog.index')}}">Blogs</a>
          </li>
          <li class="nav-item">
            <a  id="plus" class="nav-link" href="{{route('product.index')}}">My products</a>
          </li>
          <li class="nav-item">
            <a  id="plus" class="nav-link" href="{{route('category.index')}}">Categories</a>
          </li>
          <li class="nav-item">
            <a  id="plus" class="nav-link" href="{{route('role.index')}}">Roles</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="text" placeholder="Search">
          <button class="btn btn-primary" type="button">Search</button>
        </form>
      </div>
    </div>
  </nav>
  