const form=document.querySelector('.sign_up form'),button_submit=document.querySelector('.button input');
const csrfToken ='{{ csrf_token() }}'; 
console.log(csrfToken)
form.onsubmit=(e)=>{
e.preventDefault();
}
button_submit.onclick=()=>{
   formdata=new FormData(form)
   const mainurl='http://127.0.0.1:8000/api/'
   fetch(`${mainurl}inscription`, {
      method: 'post',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
      },
  })
  .then(response => {if(response.ok){
            console.log("ok")
  }else{
    throw "wroong"
  }})
  .then(data => console.log(data))
  .catch(error => console.error('Error:', error));
}