/* ----{-View:checkout_process -} */
let selectAdre=document.querySelector("#selectAdre");
if (selectAdre) {
    let selectAdreSelect=selectAdre.nextElementSibling;
    selectAdre.addEventListener("click",function(){
        (selectAdreSelect.style.display=="inline")?selectAdreSelect.style.display="none":selectAdreSelect.style.display="inline";
         });
}
let selectpaymentBtn=document.querySelector("#selectpaymentBtn");
if (selectpaymentBtn) {
    let selectpayment=selectpaymentBtn.nextElementSibling;
    selectpaymentBtn.addEventListener("click",function(){
        (selectpayment.style.display=="inline")?selectpayment.style.display="none":selectpayment.style.display="inline";
         });
}

/*-------------------------------------*/
