let add_dis_code_btn=document.querySelector("#add_dis_code_btn");
let add_dis_code_inpt=document.querySelector("#add_dis_code_inpt");
if (add_dis_code_btn && add_dis_code_inpt) {
    add_dis_code_btn.addEventListener("click",function(){
 this.style.display="none";
 add_dis_code_inpt.style.display="inline";
  });


}