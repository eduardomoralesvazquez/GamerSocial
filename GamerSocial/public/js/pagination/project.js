
    let page = 2;
    window.onscroll = ()=>{
        if((window.innerHeight + window.scrollY) >= document.body.offsetHeight){
            
            const container = document.querySelector(".container");
            
            fetch("/project/paginate?page="+page, {
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
                let close = document.querySelector(".close-project-form");
                let projectIcon = document.querySelector(".project-form-icon");
                projectIcon.addEventListener("click", changeProjectFormVisibility);
                close.addEventListener("click", changeProjectFormVisibility);
                
            })
            .catch(err => console.log(err));
        }
        
    }