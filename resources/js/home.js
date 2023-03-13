// {id:1} :sidebar
function openNav() {
    document.getElementById("home_side_bar").style.display ="inline";
  }

function closeNav() {
    document.getElementById("home_side_bar").style.display ="none";
  }
  let show_menu_home=document.getElementById("show_menu_home");
  let close_icon_btn=document.getElementById("close_icon_btn");
  (close_icon_btn)?close_icon_btn.addEventListener("click",()=> closeNav()):null;
  (show_menu_home)?show_menu_home.addEventListener("click",()=> openNav()):null;



 // {id:2} :slider of search by category
  let slider = document.querySelector('.slider');
  let prevBtn = document.querySelector('.prev');
  let nextBtn = document.querySelector('.next');
  let slideWidth = document.querySelector('.slide1').clientWidth;
  let slideIndex = 0;
  let  count = Math.floor(slider.children.length - 4);
  if(slider){
  prevBtn.addEventListener('click', () => {
    slideIndex = (slideIndex === 0) ? 0: slideIndex - 1;
    slider.style.transform = `translateX(-${slideIndex * slideWidth}px)`;
  });
  nextBtn.addEventListener('click', () => {
    console.log(count);
    console.log(slideIndex);
(slideIndex === count) ? slideIndex =0 : slideIndex ++;
    slider.style.transform = `translateX(-${slideIndex * slideWidth}px)`;
  });


  let slideInterval = 3000;
  function startSlider1() {
    intervalId1=setInterval(() => {
      (slideIndex === count) ? slideIndex =0 : slideIndex ++;
      slider.style.transform = `translateX(-${slideWidth * slideIndex}px)`;
    }, slideInterval);
    }
    slider.addEventListener('mouseover', () => {
     clearInterval(intervalId1);
   });
   
   slider.addEventListener('mouseout', () => {
     startSlider1();
   });
   startSlider1();
  }

  // end_of slider of search by category

 // {id:2} :slider of products with offers
 let slider2 = document.querySelector('.slider2');
 let prevBtn2 = document.querySelector('.prev2');
 let nextBtn2 = document.querySelector('.next2');
 let  slideWidth2 = document.querySelector('.slide2').clientWidth;
 let slideIndex2 = 0;
 let  count2 = Math.floor(slider2.children.length - 3);
 if(slider2){
  prevBtn2.addEventListener('click', () => {
    slideIndex2 = (slideIndex2 === 0) ? 0: slideIndex2 - 1;
    slider2.style.transform = `translateX(-${slideIndex2 * slideWidth2}px)`;
  });
  nextBtn2.addEventListener('click', () => {
 (slideIndex2 === count2) ? slideIndex2 =0 : slideIndex2 ++;
    slider2.style.transform = `translateX(-${slideIndex2 * slideWidth2}px)`;
  });
 
  let slideInterval2 = 3000;
  function startSlider2() {
  intervalId2=setInterval(() => {
    (slideIndex2 === count2) ? slideIndex2 =0 : slideIndex2 ++;
    slider2.style.transform = `translateX(-${slideWidth2 * slideIndex2}px)`;
  },slideInterval2);
  }
  slider2.addEventListener('mouseover', () => {
   clearInterval(intervalId2);
 });
 
 slider2.addEventListener('mouseout', () => {
   startSlider2();
 });
 startSlider2();
 }
 
   // end_of slider of products with offers


   