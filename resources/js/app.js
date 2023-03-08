const { received } = require('laravel-mix/src/Log');
import Swal from 'sweetalert2';
window.Swal=Swal;

require('./bootstrap');
require('./products');
require('./users');
require('./container');
require('./discount');
require('./checkout');
require('./sidebar');
require('./cart');


// fontawsome
require('@fortawesome/fontawesome-free/js/brands');
require('@fortawesome/fontawesome-free/js/solid');
require('@fortawesome/fontawesome-free/js/fontawesome');











//-------------------------------------------//
// {{------Light && Dark Mode js_code-----}}//
let lightLink = document.querySelector("#lightLink");
let darkLink = document.querySelector("#darkLink");
let themeCss='/css/theme.css';
let darkCss='/css/Darklyy.css';

let lightBtn = document.querySelector("#lightBtn");
let darkBtn = document.querySelector("#darkBtn");
  function darkMode()
  {
      lightBtn.classList.remove("active");
      darkBtn.classList.add("active");
    window.localStorage.setItem("modeHref",darkCss);
    lightLink.removeAttribute("href");
    darkLink.setAttribute("href",darkCss);
    lightBtn.style.display="inline";
    darkBtn.style.display="none";
  }
  function lightMode()
  {
    darkBtn.classList.remove("active");
    lightBtn.classList.add("active");
    window.localStorage.setItem("modeHref",themeCss);
    darkLink.removeAttribute("href");
    lightLink.setAttribute("href",themeCss);
    lightBtn.style.display="none";
    darkBtn.style.display="inline";
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
// {{{---set cookies to get the language value---}}}

function setCookieLanguage(name,value,days) {
  var expires = "";
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days*24*60*60*1000));
      expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}



// -----------------------------






