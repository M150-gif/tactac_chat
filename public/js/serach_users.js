const button_search=document.querySelector('.serach_users button'),list_users=document.querySelector('.user .list_users'),input_search=document.querySelector('.serach_input');
button_search.onclick=()=>{
    button_search.classList.toggle("active");
    if(button_search.classList.contains("active")){
        input_search.classList.add("show")
    }else{
        input_search.classList.remove("show")
        input_search.value=""
        return get_all_users()
    }
}
   function get_all_users(){
    fetch("http://127.0.0.1:8000/get_users")
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error("Il y a un problème avec la réponse du serveur.");
        }
    })
    .then(data => {
       const users=data.message;
       let list="";
       users.forEach(user => {
            list+=`<a href="http://127.0.0.1:8000/chat?user_id_chat=${user.id}">
            <div class="content">
                <img src="${user.image}" alt="">
                <div class="content_details">
                    <span>${user.fname} ${user.lname}</span>
                    <p><span>${user.statu}</span>${user.last_message}</p>
                </div>
            </div>
            <div class="status ${user.status}"><i class="fa-solid fa-circle"></i></div>
        </a>`
       });
       if(!button_search.classList.contains("active")){
        list_users.innerHTML=list;
       }
       
    })
    .catch(error => {
        console.error(error);
    });
    }
    get_all_users()
input_search.onkeyup=()=>{
    if(input_search.value!=""){
    list_users.innerHTML="";
    let list="";
    fetch(`http://127.0.0.1:8000/search_users/?users_searching=${input_search.value}`)
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error("Il y a un problème avec la réponse du serveur.");
        }
    })
    .then(data => {
       const users=data.message;
       if(users[0]==null){
       list="No user found related to your search!"
       }else{
        users.forEach(user => {
            list+=`<a href="http://127.0.0.1:8000/chat?user_id_chat=${user.id}">
            <div class="content">
                <img src="${user.image}" alt="">
                <div class="content_details">
                    <span>${user.fname} ${user.lname}</span>
                    <p>${user.last_message}</p>
                </div>
            </div>
            <div class="status ${user.status}"><i class="fa-solid fa-circle"></i></div>
        </a>`
       });
       }
       list_users.innerHTML=list;
    })
    .catch(error => {
        console.error(error);
    });
}else{
    button_search.classList.remove("active")
    input_search.classList.remove("show")
    get_all_users()
}  
}