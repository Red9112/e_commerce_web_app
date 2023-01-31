<div id="category_products">
      <section class="bg-success">
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
                      <div class="d-flex flex-row">
                        <div class="text-danger mb-1 me-2">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </div>
                        <span>310</span>
                      </div>
                      <div class="mt-1 mb-0 text-muted small">
                        <span>100% cotton</span>
                        <span class="text-primary"> • </span>
                        <span>Light weight</span>
                        <span class="text-primary"> • </span>
                        <span>Best finish<br /></span>
                      </div>
                      <div class="mb-2 text-muted small">
                        <span>Unique design</span>
                        <span class="text-primary"> • </span>
                        <span>For men</span>
                        <span class="text-primary"> • </span>
                        <span>Casual<br /></span>
                      </div>
                      <div class="mb-2">
             <span class="text-primary">Quantity: </span><span class="text-dark">{{$product->qty_in_stock}}</span>
                      </div>
                      <p class="text-truncate mb-4 mb-md-0">
                        {{$product->description}}
                      </p>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                      <div class="d-flex flex-row align-items-center mb-1">
                        <h4 class="mb-1 me-1">{{$product->price}}</h4>
                        <span class="text-danger"><s>$20.99</s></span>
                      </div>
                      <h6 class="text-success">Free shipping</h6>
                      <div class="d-flex flex-column mt-4">
                        <a href="{{route('product.show',['product'=>$product->id])}}" class="btn btn-primary btn-sm" type="button">Details</a>
                        @auth
                        @include('includes.addToCart')
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





