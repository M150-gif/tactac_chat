const eye=document.querySelector('.form .filed i'),input_password=document.querySelector('.form input[type="password"]');
eye.onclick=()=>{
   if(input_password.type==="password"){
    input_password.type="text"
    eye.classList.remove("fa-eye-slash")
    eye.classList.add("fa-eye");
   }else{
    input_password.type="password"
    eye.classList.remove("fa-eye")
    eye.classList.add("fa-eye-slash");
   }
}