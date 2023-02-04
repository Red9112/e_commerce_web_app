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

//=============End ==>{id-1}=============


