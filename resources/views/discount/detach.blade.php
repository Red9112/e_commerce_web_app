<div class="my-3 p-3">
    <h3 class="m-3"><span class="text-danger">Detach</span> discount from products: </h3>
    @if ($products!=null)
    <button type="button" id="detach_my_products" class=" btn btn-outline-info btn-lg mx-2">My products</button>
    <form id="detach_my_productsForm" style="display:none" method="GET" action="{{route('discount_product',['discountId'=>$discount->id])}}" enctype="multipart/form-data" >
    <input type="hidden" name="detach">
    <div class="mx-5 my-4 p-3 bg-light rounded w-50 border">
    <div class="form-check">
     <h4>
    <input class="selectProduct form-check-input" type="checkbox" name="my_products" value="1">
    <label for="my_products">detach this discount from my all products</label>
    </h4>
    </div>
    <button type="submit" class="btn btn-success">detach</button>
    </div>
    </form>


    <button type="button" id="detachDisSpecific" class=" btn btn-outline-info btn-lg ">specify products</button>
    <form id="detachDisSpecificForm" style="display:none"  method="GET" action="{{route('discount_product',['discountId'=>$discount->id])}}" enctype="multipart/form-data" >
    @csrf
    <input type="hidden" name="detach">
    <div   class=" mx-5 my-4 p-3 bg-light text-white rounded w-50 border">
    <div class="col-md-12">
    <table class="table">
    <thead>
    <tr>
    <th>Name</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
    <tr>
    <td>
    <div class="form-check">
    <input class="selectProduct form-check-input" type="checkbox" name="products[]" value="{{ $product->id }}">
    <label>{{$product->name}}</label>
    </div>
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>
              </div>
              <button type="submit" class="btn btn-success">detach</button>
            </div>
        </form>

        <button type="button" id="detachDisByCatgr" class=" btn btn-outline-info btn-lg mx-2">detach by category</button>
        <form  id="detachDisByCatgrForm" style="display: none"  method="GET" action="{{route('discount_product',['discountId'=>$discount->id])}}" enctype="multipart/form-data" >
            @csrf
            <input type="hidden" name="detach">
            <div   class="mx-5 my-4 p-3 bg-light text-white rounded w-50 border">
                  <div class="col-md-12">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                        </tr>
                      </thead>
                      <tbody>
                     @foreach ($categories  as $cat)
                          <tr>
                            <td>
                               <div class="form-check">
                                    <input class="selectProduct form-check-input" type="checkbox" name="cats[]" value="{{ $cat->id }}">
                                 <label>{{$cat->name}}</label>
                                </div>
                            </td>
                        </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>

                  <button type="submit" class="btn btn-success">detach</button>
                </div>
                </form>
                @endif
    {{-- Admin Discount: --}}
    @if (auth()->user()->hasRole('admin'))

    <button type="button" id="detachDisAllProducts" class=" btn btn-outline-warning btn-lg mx-2">all products</button>
    <form id="detachDisAllProdForm" style="display:none" method="GET" action="{{route('discount_product',['discountId'=>$discount->id])}}" enctype="multipart/form-data" >
        <input type="hidden" name="detach">
        <div class="mx-5 my-4 p-3 bg-light rounded w-50 border">
    <div class="form-check">
        <h4>
    <input class="selectProduct form-check-input" type="checkbox" name="applyToAll" value="1">
    <label for="applyToAll">detach this discount from all stores  products</label>
        </h4>
    </div>
    <button type="submit" class="btn btn-success">detach</button>
        </div>
    </form>

        <button type="button" id="detachDisByCatgrToAllPrd" class=" btn btn-outline-warning btn-lg mx-2">By category (all products)</button>
        <form  id="detachDisByCatgrToAllPrdForm" style="display: none"  method="GET" action="{{route('discount_product',['discountId'=>$discount->id])}}" enctype="multipart/form-data" >
            @csrf
            <input type="hidden" name="detach">
            <div   class="mx-5 my-4 p-3 bg-light text-white rounded w-50 border">
                  <div class="col-md-12">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                        </tr>
                      </thead>
                      <tbody>
                     @foreach ($categories  as $cat)
                          <tr>
                            <td>
                               <div class="form-check">
                                    <input class="selectProduct form-check-input" type="checkbox" name="catsToAll[]" value="{{ $cat->id }}">
                                 <label>{{$cat->name}}</label>
                                </div>
                            </td>
                        </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>

                  <button type="submit" class="btn btn-success">detach</button>
                </div>
                </form>
                @endif
            </div>
