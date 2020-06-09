const chatText = document.querySelector(".chat-text");
const submitBtn = document.querySelector(".submit-btn");
const msgContainer = document.querySelector(".chat");

document.querySelector(".chat").scrollTo(0,document.body.scrollHeight);

let token = document.querySelector("input[name='_token']").value;

submitBtn.addEventListener("click", sendMsg);

setInterval(receiveMsg, 3000);


function sendMsg(e){
    let msg = chatText.value;
    e.preventDefault();
    if(msg.trim() != ""){
        chatText.value = chatText.value.trim();
        let data = new FormData(document.getElementById("send-form"));
        fetch("/chat/send", {
            headers: {
                "X-CSRF-TOKEN": token
            },
            method:"post",
            body:data
        })
        .then(response =>{

            return response.text();

        })
        .then(htmlContent => {

            msgContainer.innerHTML += htmlContent;
            document.querySelector(".chat").scrollTo(0,document.body.scrollHeight);
            
        })
        .catch(err => console.log(err));
        
        chatText.value = "";
    }
}
function receiveMsg(){
    
    let data = new FormData(document.getElementById("receive-form"));
    fetch("/chat/receive", {
        headers: {
            "X-CSRF-TOKEN": token
        },
        method:"post",
        body:data
    })
    .then(response =>{

        return response.text();

    })
    .then(htmlContent => {
        
        if(htmlContent != "" && htmlContent.substr(0,5) == "<span"){
            msgContainer.innerHTML += htmlContent;
            document.querySelector(".chat").scrollTo(0,document.body.scrollHeight);
        }
    })
    .catch(err => console.log(err));
}