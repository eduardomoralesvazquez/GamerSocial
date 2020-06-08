
    let page = 2;
    window.onscroll = ()=>{
        if((window.innerHeight + window.scrollY) >= document.body.offsetHeight){
            
            const container = document.querySelector(".container");
            
            fetch("/home/paginate?page="+page, {
                    method:"get"
            })
            .then(response =>{
                return response.text();
                
            })
            .then(htmlContent => {
                container.innerHTML += htmlContent;
                page++;
                if(htmlContent == ""){
                    window.onscroll = ()=>{};
                }
                let close = document.querySelector(".close-post-form");
                let postIcon = document.querySelector(".post-form-icon");
                postIcon.addEventListener("click", changePostFormVisibility);
                close.addEventListener("click", changePostFormVisibility);
                
            })
            .catch(err => console.log(err));
        }
        
    }