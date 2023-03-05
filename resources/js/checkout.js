/* ----id:1-{-View:checkout_process -} */
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

/* ----id:2-{-View:checkout_process -} */

let  prices_select = document.getElementById("prices_select");
let  prices = document.getElementById("prices");
let  prices_dh = document.getElementById("prices_dh");
if (prices_select && prices && prices_dh) {
    prices_select.addEventListener("change", (event) => {
        if (prices_select.value=="$") {
            prices.style.display="inline";
            prices_dh.style.display="none";
        }else{
            prices_dh.style.display="inline";
            prices.style.display="none"; 
        }
        });
}

/*-------------------------------------*/

