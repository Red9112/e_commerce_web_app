//-id:1-delete product picture --button--{-edit product view-}
/*  */
let ImagedeletePrd=document.querySelectorAll('#ImagedeletePrd');
if (ImagedeletePrd) {
ImagedeletePrd.forEach(image=> {
    image.addEventListener("mouseover",function(){
 let btn=image.nextElementSibling;
btn.style.display="inline";
    });
    image.addEventListener("mouseout",function(){
        let btn=image.nextElementSibling;
       btn.style.display="none";
       btn.addEventListener("mouseover",function(){   btn.style.display="inline";});
           });
});
}
  /*end id-1 */


  //-id:2-{{==Create select by click to add category to product  ==}}{--Views:product_edit &&  product_create--}}

//receive categories from view :
let categoriesCollect= document.getElementById('categories');
if (categoriesCollect) {
  const categories = JSON.parse(categoriesCollect.dataset.categories);
  console.log(categories);
  console.log(document.getElementById('categories').dataset.categories);
//end

let clc=document.getElementById('clc');
let label=document.querySelector('#label');
let cat=document.querySelector('#cat')

let count=0;
let deletecat;
function addSelect(){
  let select=document.createElement("select");
  select.className="form-select";
  select.setAttribute("name","category-"+count);
  let defaultOption=document.createElement("option");
  select.appendChild(defaultOption);
  defaultOption.textContent="Choose...";
   defaultOption.setAttribute('selected', true);
  defaultOption.disabled = true;
  defaultOption.hidden = true;
  categories.forEach(category => {
    let cat=document.createElement("option");
    select.appendChild(cat);
    cat.value=category.id;
    cat.textContent=category.name;
});
count++;

// create button to delete category
// <button type="button" class="deletecat btn btn-outline-danger btn-sm">del</button>
let div=document.createElement("div");
div.style.display="flex";
div.appendChild(select);
let del=document.createElement("button");
div.appendChild(del);
del.type="button";
del.className="deletecat btn btn-outline-danger btn-sm mx-1 my-1";
del.textContent="del";
cat.appendChild(div);
deletecat=document.querySelectorAll(".deletecat");
deletecat.forEach(btn => {
  btn.addEventListener("click",function(){
    deleteElement(this);
  });
});
//>>end

}

if (clc && label) {
clc.addEventListener("click",function(){
  addSelect();
});
}


// delete category
function deleteElement(button) {
  var parent = button.parentNode;
  parent.remove();
}
 deletecat=document.querySelectorAll(".deletecat");
 if (deletecat) {
  deletecat.forEach(btn => {
    btn.addEventListener("click",function(){
      deleteElement(this);
    });
  });
}
}
//end delete category--

 /*end id-2 */


