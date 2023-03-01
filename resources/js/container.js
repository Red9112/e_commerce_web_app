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



  //-id:4-{{==Create select by click   ==}}{--Views:[product_edit,product_create,user_edit,user_create,blog_edit,blog_create]--}}

//receive objects from view :
let collection= document.getElementById('objects');
if (collection) {
  const objects = JSON.parse(collection.dataset.objects);
  console.log(objects);
  console.log(document.getElementById('objects').dataset.objects);
//end

let clc=document.getElementById('clc');
let categoryLabel=document.querySelector('#categoryLabel');
let roleLabel=document.querySelector('#roleLabel');
let allDiv=document.querySelector('#allDiv');

let count=0;
let deleteBtns;//
function addSelect(){
  let select=document.createElement("select");
  select.className="form-select";
  if (categoryLabel) {
    select.setAttribute("name","category-"+count);
    let defaultOption=document.createElement("option");
  select.appendChild(defaultOption);
  defaultOption.textContent="Choose...";
   defaultOption.setAttribute('selected', true);
  defaultOption.disabled = true;
  defaultOption.hidden = true;
  objects.forEach(item => {
    let createdOption=document.createElement("option");
    select.appendChild(createdOption);
    createdOption.value=item.id;
    createdOption.textContent=item.name;
});
  }else if(roleLabel){
    select.setAttribute("name","role-"+count);
    objects.forEach(item => {
        let rolOption=document.createElement("option");
        rolOption.value=item.id;
        rolOption.textContent=item.name;
        select.appendChild(rolOption);
 (item.name=="customer") ? rolOption.setAttribute('selected', true):null;
    });
  }

count++;

// create button to delete select
// <button type="button" class="deleteBtns btn btn-outline-danger btn-sm">del</button>
let selectDiv=document.createElement("div");
selectDiv.style.display="flex";
selectDiv.appendChild(select);
let deleteBtn=document.createElement("button");
selectDiv.appendChild(deleteBtn);
deleteBtn.type="button";
deleteBtn.className="deleteBtns btn btn-outline-danger btn-sm mx-1 my-1";
deleteBtn.textContent="del";
allDiv.appendChild(selectDiv);
deleteBtns=document.querySelectorAll(".deleteBtns");
deleteBtns.forEach(btn => {
  btn.addEventListener("click",function(){
    deleteElement(this);
  });
});
//>>end

}

if (roleLabel || categoryLabel) {
clc.addEventListener("click",function(){
  addSelect();
});
}


// delete select
function deleteElement(button) {
  var parent = button.parentNode;
  parent.remove();
}
deleteBtns=document.querySelectorAll(".deleteBtns");
if (deleteBtns) {
deleteBtns.forEach(btn => {
  btn.addEventListener("click",function(){
    deleteElement(this);
  });
});
}

}
//end delete --

 /*end id-4 */


//-id:5-{--Views:dashboard && prod_show --}}
// {{--inject product id insite the form modal--}}

 function setCookie(name,value,hours) {
    var expires = "";
    if (hours) {
        var date = new Date();
        date.setTime(date.getTime() + (hours*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
  }
   // {{{---get cookie of the product_id ---}}}
 function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length === 2) return parts.pop().split(";").shift();
  }

  let modalBtns=document.querySelectorAll('.modalBtns');
 if (modalBtns) {
     modalBtns.forEach(btn => {
         btn.addEventListener('click',function(){
 setCookie('prod_send_to_cart', btn.dataset.id,1);
         });
         });
 }

 let prdCartBtns=document.querySelectorAll('.prdCart');
 if (prdCartBtns) {
    prdCartBtns.forEach(btn => {
        btn.addEventListener('click',function(){
            let input=document.getElementById("idprd");
            let product_id = getCookie('prod_send_to_cart');
            input.value=product_id;
            });
        });
 }


 /*end id-5 */


//-id:6-{--Views: order.vendor_index  --}}
// {{--change input type from text to date --}}
 let searchTypeSelect = document.getElementById('searchTypeSelect');
 let searchInput = document.getElementById('searchInput');
 if (searchTypeSelect && searchInput) {
 searchTypeSelect.addEventListener('change', () => {
   searchInput.type = searchTypeSelect.value === 'date' ? 'date' : 'text';
 });
}
  /*end id-6 */
















