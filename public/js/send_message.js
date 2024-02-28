const button_sender=document.querySelector('.chat_area button');
const form=document.querySelector('.chat_area'),input_message=document.querySelector('.chat_area .text');
const incoming_user_id=document.querySelector('.chat_area [name="incoming_user_id"]');
input_message.onkeyup=()=>{
if(input_message.value!=""){
    button_sender.classList.add("active");
}else{
    button_sender.classList.remove("active");
}
}
form.onsubmit=(e)=>{
e.preventDefault();
}
button_sender.onclick=()=>{
    fetch(`http://127.0.0.1:8000/send_message?incoming_user_id=${incoming_user_id.value}`,{method:"POST"
            ,headers:{
                'content-Type':'application/json',
                'X-CSRF-TOKEN':document.querySelector('.chat_area [name="_token"]').value
            }
        ,body:JSON.stringify({message:input_message.value,incoming_user_id:incoming_user_id.value})}).then((response)=>{
        if(response.ok){
            return response.json()
        }else{
            throw new Error("something is wrong");
        }
    }).then((data)=>{
        get_all_message()
        input_message.value=""
    }).catch((Error)=>{
        console.log(Error)
    })
  
}