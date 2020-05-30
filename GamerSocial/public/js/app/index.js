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
        postIcon.addEventListener("click", changePostFormVisibility);
        close.addEventListener("click", changePostFormVisibility);
    }
    if(document.querySelector(".close-project-form")!=undefined){
        let close = document.querySelector(".close-project-form");
        let projectIcon = document.querySelector(".project-form-icon");
        projectIcon.addEventListener("click", changeProjectFormVisibility);
        close.addEventListener("click", changeProjectFormVisibility);
    }
}
function changePostFormVisibility(){
    let dark = document.getElementById("dark");
    let postForm = document.querySelector(".post-form");
    let postFormIcon = document.querySelector(".post-form-icon-container");
    postFormIcon.classList.toggle("hide");
    postForm.classList.toggle("hide");
    dark.classList.toggle("darked");
}
function changeProjectFormVisibility(){
    let dark = document.getElementById("dark");
    let projectForm = document.querySelector(".project-form");
    let projectFormIcon = document.querySelector(".project-form-icon-container");
    projectFormIcon.classList.toggle("hide");
    projectForm.classList.toggle("hide");
    dark.classList.toggle("darked");
}
function changeMenu(e){
    if(document.querySelector(".close-post-form")!=undefined){
        let postFormIcon = document.querySelector(".post-form-icon-container");
        postFormIcon.classList.toggle("hide");
    }
    if(document.querySelector(".close-project-form")!=undefined){
        let projectFormIcon = document.querySelector(".project-form-icon-container");
        projectFormIcon.classList.toggle("hide");
    }
    let menu = document.getElementById("menu");
    let dark = document.getElementById("dark");
    menu.classList.toggle("hide-menu");
    dark.classList.toggle("darked");
}
function changeDark(e){
    if(document.querySelector(".close-post-form")!=undefined && !document.querySelector(".post-form").classList.contains("hide")){
        changePostFormVisibility();
    }else if(document.querySelector(".close-project-form")!=undefined && !document.querySelector(".project-form").classList.contains("hide")){
        changeProjectFormVisibility();
    }else{
        changeMenu();
    }
}