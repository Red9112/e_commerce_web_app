const { received } = require('laravel-mix/src/Log');

require('./bootstrap');


// {--Category --}}
// let btnCreate=document.querySelector("#plus");
let btnCreate=document.querySelector("#createBtn");
let createForm=document.querySelector("#createForm");
if (btnCreate && createForm) {
btnCreate.addEventListener("click",function(){
 (createForm.style.display=="inline")?createForm.style.display="none":createForm.style.display="inline";

  });

}

//---------------------------------

// {--Import Category --}}
let btnimport=document.querySelector("#import");

let importForm=document.querySelector("#importForm");

if (btnimport && importForm) {
btnimport.addEventListener("click",function(){
 
(importForm.style.display=="inline")?importForm.style.display="none":importForm.style.display="inline";
        
});
}
//---------------------------
/* delete product picture --button--{-edit product view-} */
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
  /*end delete picture*/

  /* blogs index */
let blogindex=document.querySelectorAll('.blogIndex');
blogindex.forEach(blog => {
    blog.addEventListener("click",function(){
    let elm=blog.nextElementSibling;
    (elm.style.display=="inline")?elm.style.display="none":elm.style.display="inline";
    });
});
////////////





//////////////////////////////////////////////////////////////////////
// {{==create select with options by click ==}}
// receive categories from view :
let categoriesCollect= document.getElementById('categories'); 
if (categoriesCollect) {
  const categories = JSON.parse(categoriesCollect.dataset.categories);
  console.log(categories);
  console.log(document.getElementById('categories').dataset.categories);


console.log(categories);
///////////////////////////////////////////////////////

let clc=document.getElementById('clc');
let label=document.querySelector('#label');
let cat=document.querySelector('#cat')
console.log(clc);
console.log(label);
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
  console.log(select);
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
    console.log("azert");
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
//end>> delete category--
////////////////////////////////////////////////

// in blog index and show for add comment
let addComment=document.querySelectorAll(".addComment");
let signToAddCom=document.querySelector("#addComment");
let signToAddComment=document.querySelector("#signToAddCom");
console.log(signToAddCom);
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


/////////////////////end 

// {{------Light && Dark Mode-----}}
let lightBtn = document.querySelector("#lightBtn");
let darkBtn = document.querySelector("#darkBtn");
let lightLink = document.querySelector("#lightLink");
let darkLink = document.querySelector("#darkLink");
let themeCss='/css/theme.css';
  let darkCss='/css/Darklyy.css';
  console.log(lightBtn);
  console.log(darkBtn);

  function darkMode()
  {
      lightBtn.classList.remove("active");
      darkBtn.classList.add("active");
    window.localStorage.setItem("modeHref",darkCss);
    lightLink.removeAttribute("href");
    darkLink.setAttribute("href",darkCss);
  }
  function lightMode()
  {
    darkBtn.classList.remove("active");
    lightBtn.classList.add("active");
    window.localStorage.setItem("modeHref",themeCss);
    darkLink.removeAttribute("href");
    lightLink.setAttribute("href",themeCss);
  }
  darkBtn.addEventListener("click",()=>{darkMode();});
  lightBtn.addEventListener("click",()=>{lightMode();});

  let dark=window.localStorage.getItem("modeHref");
 (dark==darkCss)?darkMode():lightMode();
 
// -------------End setting Mode---------------

// {{------set language of app------}}

let languageSelect=document.getElementById('languageSelect');
let languageoptions=languageSelect.querySelectorAll('option');
let language=localStorage.getItem('language');
languageoptions.forEach(op => {
  op.removeAttribute("selected");
  if (language==op.value) {
    op.selected=true;
  }
});

console.log(languageoptions);
console.log(language);
if (languageSelect) {
  languageSelect.addEventListener('change', (event) => {
    localStorage.setItem('language',event.target.value);
    language=localStorage.getItem('language');
    setCookieLanguage('language', language, 7);
    console.log(language);
  });
  
}
// set cookies to get the language value
//define a function to set cookies
function setCookieLanguage(name,value,days) {
  var expires = "";
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days*24*60*60*1000));
      expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}



