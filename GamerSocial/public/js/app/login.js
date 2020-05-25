

function changePass(){
    let pass = document.getElementById("password");
    let eye = document.getElementById("show");
    if(pass.type=="password"){
        pass.type="text";
    }else{
        pass.type="password";
    }
    if(eye.classList[1]=="fa-eye"){
        eye.classList.remove("fa-eye");
        eye.classList.add("fa-eye-slash");
    }else{
        eye.classList.remove("fa-eye-slash");
        eye.classList.add("fa-eye");
    }
    pass.focus();
}