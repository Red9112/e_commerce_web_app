
// sidebar
function openNav() {
    document.getElementById("home_side_bar").style.display ="inline";
  }
  
  function closeNav() {
    document.getElementById("home_side_bar").style.display ="none";
  }
  let show_menu_home=document.getElementById("show_menu_home");
  let close_icon_btn=document.getElementById("close_icon_btn");
  close_icon_btn.addEventListener("click",()=> closeNav()); 
  show_menu_home.addEventListener("click",()=> openNav());
  