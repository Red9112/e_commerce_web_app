let show_menu=document.getElementById("show_menu");
let hide_menu=document.getElementById("hide_menu");
let sidebar=document.getElementById("sidebar");

let menu_content =document.getElementById("menu_content");
let yield_content =document.getElementById("yield_content");
let menu_parent=document.getElementById("menu_parent");


if (show_menu && hide_menu ) {
        show_menu.addEventListener("click",function(){
            this.style.display="none";
            hide_menu.style.display="inline";
            sidebar.classList.add("active");
            menu_content.setAttribute("style", "display: flex;flex-wrap: wrap;");
            yield_content.setAttribute("style", "flex: 15;");
            menu_parent.setAttribute("style", "position: relative;flex: 2;");
    });
    hide_menu.addEventListener("click",function(){
        this.style.display="none";
        show_menu.style.display="inline";
        sidebar.classList.remove("active");

        menu_content.setAttribute("style", "");
        yield_content.setAttribute("style", "");
        menu_parent.setAttribute("style", "position: relative;");
    });
}























