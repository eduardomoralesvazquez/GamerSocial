window.onload = ()=>{
    let menuBtn = document.getElementById("menu-btn");
    menuBtn.addEventListener("click", changeMenu);
    let closeMenu = document.getElementById("close-menu");
    closeMenu.addEventListener("click", changeMenu);
    let dark = document.getElementById("dark");
    dark.addEventListener("click", changeDark);

    if(document.querySelector(".close-post-form")!=undefined){
        let close = document.querySelector(".close-post-form");
        let postIcon = document.querySelector(".post-form-icon");
        postIcon.addEventListener("click", changeFormVisibility);
        close.addEventListener("click", changeFormVisibility);
    }
}
function changeFormVisibility(){
    let dark = document.getElementById("dark");
    let postForm = document.querySelector(".post-form");
    let postFormIcon = document.querySelector(".post-form-icon-container");
    postFormIcon.classList.toggle("hide");
    postForm.classList.toggle("hide");
    dark.classList.toggle("darked");
}
function changeMenu(e){
    if(document.querySelector(".close-post-form")!=undefined){
        let postFormIcon = document.querySelector(".post-form-icon-container");
        postFormIcon.classList.toggle("hide");

    }
    let menu = document.getElementById("menu");
    let dark = document.getElementById("dark");
    menu.classList.toggle("hide-menu");
    dark.classList.toggle("darked");
}
function changeDark(e){
    if(document.querySelector(".close-post-form")!=undefined && !document.querySelector(".post-form").classList.contains("hide")){
        changeFormVisibility();
    }else{
        changeMenu();
    }
}