// This file contain code  that may've been executed in many views indicated below:

//-id:1-{--Views:category_index && role_index --}}
// {{--display && hide =>create_form--}}
let btnCreate=document.querySelector("#createBtn");
let createForm=document.querySelector("#createForm");
if (btnCreate && createForm) {
btnCreate.addEventListener("click",function(){
 (createForm.style.display=="inline")?createForm.style.display="none":createForm.style.display="inline";

  });

}
//-End id:1--------------

//-id:2-{--Views:category_index --}}
// {{--Import--}}
let btnimport=document.querySelector("#import");
let importForm=document.querySelector("#importForm");
if (btnimport && importForm) {
btnimport.addEventListener("click",function(){
(importForm.style.display=="inline")?importForm.style.display="none":importForm.style.display="inline";
});
}
//-End id:2--------------



//-id:3-{--Views:blog index and show--}}
//  {{{--for add comment--}}}
let addComment=document.querySelectorAll(".addComment");
let signToAddCom=document.querySelector("#addComment");
let signToAddComment=document.querySelector("#signToAddCom");

addComment.forEach(label => {
  let comment=label.nextElementSibling;
if (comment && addComment) {
  label.addEventListener("click",function(){
(comment.style.display=="inline")?comment.style.display="none":comment.style.display="inline";
});
}

if (signToAddComment) {
label.addEventListener("click",function(){
  let commentForm=label.parentElement.parentElement;
  let signToAddCom=commentForm.nextElementSibling;
  signToAddCom.style.display="inline";
});
}

});

//-End id:3--------------



