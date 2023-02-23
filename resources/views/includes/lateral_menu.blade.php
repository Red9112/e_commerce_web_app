<div id="sidebar">
<nav class="nav flex-column sidebar">


    <ul class="list-group">

      <h5>User Space</h5>
      <div id="user_space">
      <li class="list-group-item"><a href="{{route('My_addresses')}}">My address</a></li>
      <li class="list-group-item"><a href="{{route('user_cards')}}">My cards</a></li>
      <li class="list-group-item"><a href="{{route('customer.orders')}}">My orders</a></li>
      </div>


      <h5>Vendor Space</h5>
      <div id="vendor_space">
      <li class="list-group-item"><a href="#">My shop</a></li>
      <li class="list-group-item"><a href="{{route('product.index')}}">My products</a></li>
      <li class="list-group-item"><a href="{{route('vendor.orders')}}">My shop orders</a></li>
      </div>

     <h5>Admin Space</h5>
     <div id="admin_space">
      <li class="list-group-item"><a href="{{route('admin.orders')}}">All orders</a></li>
      <li class="list-group-item" ><a href="{{route('user.index')}}">Users</a></li>
      <li class="list-group-item"><a href="{{route('shop.index')}}">Shops</a></li>
      <li class="list-group-item"><a href="{{route('category.index')}}">Categories</a></li>
      <li class="list-group-item"><a href="{{route('discount.index')}}">Discounts</a></li>
      <li class="list-group-item"><a href="{{route('shipping.index')}}">Shipping</a></li>
      <li class="list-group-item"><a href="{{route('payment.index')}}">Payment</a></li>
      <li class="list-group-item"><a href="{{route('address.index')}}">Addresses</a></li>
      <li class="list-group-item"><a href="{{route('orderStatus.index')}}">Order Status</a></li>
      <li class="list-group-item"><a href="{{route('role.index')}}">Roles</a></li>
     </div>

     </ul>

  </nav>

</div>



