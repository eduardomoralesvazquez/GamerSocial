let postBtn = document.getElementById("post-btn");
let projectBtn = document.getElementById("project-btn");
    
postBtn.addEventListener("click", toogleActive);
projectBtn.addEventListener("click", toogleActive);

function toogleActive(e){
    let postBtn = document.getElementById("post-btn");
    let projectBtn = document.getElementById("project-btn");
    let postContainer = document.getElementById("post-container");
    let projectContainer = document.getElementById("project-container");
    if(e.target.id == "post-btn"){
        e.target.classList.add("active");
        projectContainer.classList.add("hide");
        postContainer.classList.remove("hide");
        projectBtn.classList.remove("active");
    }else{
        e.target.classList.add("active");
        postContainer.classList.add("hide");
        projectContainer.classList.remove("hide");
        postBtn.classList.remove("active");
    }
    
}