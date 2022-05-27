window.addEventListener('DOMContentLoaded', function(event){
    const button = document.getElementById('loginButton');
    const form = document.getElementById('loginForm');
    form.addEventListener('submit',(e)=>{
        e.preventDefault();
        if(!form.checkValidity()){
            form.classList.add('was-validated');
            event.stopPropagation();
            return;
        }
        console.log(e.target);
        fetch('http://194.67.116.171/login',
        {
            method:'POST',
            headers:
            {
                "Content-type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(Object.fromEntries(new FormData(form)))

        }
        
        ).then((response)=>{
            if(!response.ok){
                throw new Error(response.status);
            }
            return response.json();
        }).then((response)=>{
            console.log(response);
            //...Do something 
        })
        .catch((error)=>console.log(error));
        form.classList.add('was-validated');
    });
});