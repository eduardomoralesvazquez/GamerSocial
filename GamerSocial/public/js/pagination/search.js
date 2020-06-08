
    let page = 2;
    
    function getFirstGet(){
        let url = window.location.href.split("=")[1];
        if( url != undefined){
            
            let dec = decodeURIComponent(url);    
            return dec;

        }
        return "";
    }
    window.onscroll = ()=>{
        if((window.innerHeight + window.scrollY) >= document.body.offsetHeight){
            
            const userContainer = document.getElementById("post-container");
            const projectContainer = document.getElementById("project-container");
            
            fetch("/search/paginate/user?page="+page+"&search="+getFirstGet(), {
                    method:"get"
            })
            .then(response =>{
                return response.text();
                
            })
            .then(htmlContent => {
                userContainer.innerHTML += htmlContent;
                page++;
                if(htmlContent == ""){
                    window.onscroll = ()=>{};
                }
                
            })
            .catch(err => console.log(err));
            
            fetch("/search/paginate/project?page="+page+"&search="+getFirstGet(), {
                    method:"get"
            })
            .then(response =>{
                return response.text();
                
            })
            .then(htmlContent => {
                projectContainer.innerHTML += htmlContent;
                page++;
                if(htmlContent == ""){
                    window.onscroll = ()=>{};
                }
                
            })
            .catch(err => console.log(err));
        }
        
    }