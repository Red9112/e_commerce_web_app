<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Do you want to check the cart now ?</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body d-flex justify-content-center">
            <form method="GET" action="{{route('addToCart')}}">
                <input hidden  type="text" name="idprd" id="idprd" value="">
                <button  name="redirect" value="cart" class="prdCart btn btn-dark mt-2" type="submit" >
                    View Shopping Cart
                  </button>
                  <button name="redirect" value="back" class="prdCart btn btn-dark mt-2" type="submit">
                    Continue Shopping
                  </button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
 

