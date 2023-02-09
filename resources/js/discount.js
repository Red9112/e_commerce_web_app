//-id:1-{--Views:discount.affect_to_products --}}
// {{--display && hide content--}}

let disAllProducts=document.querySelector("#disAllProducts");
let disAllProdForm=document.querySelector("#disAllProdForm");
if (disAllProducts && disAllProdForm) {
    disAllProducts.addEventListener("click",function(){
 (disAllProdForm.style.display=="inline")?disAllProdForm.style.display="none":disAllProdForm.style.display="inline";

  });

}
////
let disSpecific=document.querySelector("#disSpecific");
let disSpecificForm=document.querySelector("#disSpecificForm");
if (disSpecific && disSpecificForm) {
    disSpecific.addEventListener("click",function(){
 (disSpecificForm.style.display=="inline")?disSpecificForm.style.display="none":disSpecificForm.style.display="inline";

  });

}
////
let disByCatgr=document.querySelector("#disByCatgr");
let disByCatgrForm=document.querySelector("#disByCatgrForm");
if (disByCatgr && disByCatgrForm) {
    disByCatgr.addEventListener("click",function(){
 (disByCatgrForm.style.display=="inline")?disByCatgrForm.style.display="none":disByCatgrForm.style.display="inline";

  });

}
let my_products=document.querySelector("#my_products");
let my_productsForm=document.querySelector("#my_productsForm");
if (my_products && my_productsForm) {
    my_products.addEventListener("click",function(){
 (my_productsForm.style.display=="inline")?my_productsForm.style.display="none":my_productsForm.style.display="inline";

  });

}
let disByCatgrToAllPrd=document.querySelector("#disByCatgrToAllPrd");
let disByCatgrToAllPrdForm=document.querySelector("#disByCatgrToAllPrdForm");
if (disByCatgrToAllPrd && disByCatgrToAllPrdForm) {
    disByCatgrToAllPrd.addEventListener("click",function(){
 (disByCatgrToAllPrdForm.style.display=="inline")?disByCatgrToAllPrdForm.style.display="none":disByCatgrToAllPrdForm.style.display="inline";

  });

}


//=============End ==>{id-1}=============


//-id:2-{--Views:cart --}}
// {{--display && hide discount card--}}
let discountDropdown=document.querySelectorAll(".discountDropdown");
console.log(discountDropdown);
discountDropdown.forEach(elm => {
    let divNext=elm.nextElementSibling;
    console.log(divNext);
    elm.addEventListener("mouseover",function(){
        (divNext.style.display=="inline")?divNext.style.display="none":divNext.style.display="inline";
         });
         elm.addEventListener("mouseout",function(){
        (divNext.style.display=="inline")?divNext.style.display="none":divNext.style.display="inline";
         });
});

//=============End ==>{id-2}=============

//-id:3-{--Views:checkout_process --}}
// {{--display && hide discounts details--}}
let discountsDetailsBtn=document.querySelector("#discountsDetailsBtn");
let discountsDetailsTable=document.querySelector("#discountsDetailsTable");
if (discountsDetailsBtn) {
    discountsDetailsBtn.addEventListener("click",function(){
        (discountsDetailsTable.style.display=="inline")?discountsDetailsTable.style.display="none":discountsDetailsTable.style.display="inline";
         });
}

//=============End ==>{id-3}=============

