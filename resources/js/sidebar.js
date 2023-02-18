let show_menu=document.getElementById("show_menu");
let hide_menu=document.getElementById("hide_menu");
let sidebar=document.getElementById("sidebar");


show_menu.addEventListener("click",function(){
        this.style.display="none";
        hide_menu.style.display="inline";
        sidebar.classList.add("active");
});
hide_menu.addEventListener("click",function(){
    this.style.display="none";
    show_menu.style.display="inline";
    sidebar.classList.remove("active");
});






















