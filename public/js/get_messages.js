const chat_box=document.querySelector(".chat_box");
let all_messages="";
chat_box.onmouseenter=()=>{
    chat_box.classList.add('active');
}
chat_box.onmouseleave=()=>{
    chat_box.classList.remove('active');
    chat_box.scrollTop=chat_box.scrollHeight
}
function get_all_message(){
    fetch(`http://127.0.0.1:8000/get_messages?other_user_id=${incoming_user_id.value}`,{method:"get"}).then((response)=>{
        if(response.ok){
           return response.json()
        }else{
            throw new Error("something is wroong")
        }
    }).then((data)=>{
        all_messages = "";
        if(data.messages.length==0){
            all_messages+=`<div class="text">no message avaible now!</div>`
        }else{
            data.messages.forEach(message => {
                if(message.user_outgoing_id==incoming_user_id.value){
                    all_messages+=`<div class="message incoming">
                    <img src="${message.image}" alt="">
                    <div class="details"><p>${message.message}</p></div>
                </div>`
                }else{
                    all_messages+=`<div class="message outgoing">
                    <div class="details"><p>${message.message}</p></div>
                </div>`
                }
        });
        }
        chat_box.innerHTML=all_messages;
    }).catch((error)=>{
        console.log(error);
    })
}
get_all_message();