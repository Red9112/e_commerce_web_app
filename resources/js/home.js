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
  const slider = document.querySelector('.slider');
  const prevBtn = document.querySelector('.prev');
  const nextBtn = document.querySelector('.next');
  const slideWidth = document.querySelector('.slide').clientWidth;
  let slideIndex = 0;
  let  count = Math.floor((slider.children.length - 1)/5);

  prevBtn.addEventListener('click', () => {
    slideIndex = (slideIndex === 0) ? 0: slideIndex - 1;
    slider.style.transform = `translateX(-${slideIndex * slideWidth}px)`;
  });
  nextBtn.addEventListener('click', () => {
(slideIndex === count) ? slideIndex =0 : slideIndex ++;
    slider.style.transform = `translateX(-${slideIndex * slideWidth}px)`;
  });


  let slideInterval = 3000;
  setInterval(() => {
    (slideIndex === count) ? slideIndex =0 : slideIndex ++;
    slider.style.transform = `translateX(-${slideWidth * slideIndex}px)`;
  }, slideInterval);

  // end_of slider of search by category
