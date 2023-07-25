<div id="category_products">
      <section>
        <div class="container py-5">
          @foreach ($products as $product)
          <div class="row justify-content-center mb-3">
            <div class="col-md-12 col-xl-10">
              <div class="card shadow-0 border rounded-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                      <div class="bg-image hover-zoom ripple rounded ripple-surface">
                        <img src="{{$product->getFirstImage()}}"
                          class="w-100" />
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                      <h5>{{$product->name}}</h5>
                      <x-category :cat="$product->categories"></x-category>

                      <div class="mb-2">
             <span class="text-primary">Quantity: </span><span>{{$product->qty_in_stock}}</span>
                      </div>
                      <p class="text-truncate mb-4 mb-md-0">
                        {{$product->description}}
                      </p>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                      <div class="d-flex flex-row align-items-center mb-1">
                        @if ($product->discounts)
                        <h4 class="mb-1 me-1">{{ \App\Helpers\Helper::displayPrice($product->discountedPrice()['discountedPrice'])}}</h4>
                        <span class="text-danger"><s>{{\App\Helpers\Helper::displayPrice($product->price)}}</s></span>
                        @endif
                      </div>
                        @if ($product->discountedPrice()['bonusQuantity'])
                        <div class="text-success ">buy one get one free{{$product->discountedPrice()['bonusQuantity']}}</div>
                        @endif
                      <div class="d-flex flex-column mt-4">
                        <a  href="{{route('product.show',['product'=>$product->id])}}" class="btn bg-info    btn-sm" type="button">Details</a>
                        <button   class="modalBtns btn btn-outline-danger btn-sm my-2"  type="button" data-id="{{ $product->id }}"  data-bs-toggle="modal" data-bs-target="#myModal">
                            Add to cart
                          </button>
                        @include('includes.addToCart')
                        @auth
                        <a href="{{route('wishlist.store',['id'=>$product->id])}}" class="btn btn-warning btn-sm" type="button"> Save for later</a>
                      @endauth
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </section>

    </div>





