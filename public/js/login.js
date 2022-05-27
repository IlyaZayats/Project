window.addEventListener('DOMContentLoaded', function(event){
    const errorField = document.querySelector('.login-invalid-message');
    const form = document.getElementById('loginForm');
    form.addEventListener('submit',(e)=>{
        errorField.classList.add('d-none');
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
                throw new Error(response);
            }
            return response.json();
        }).then((response)=>{
            console.log(response);
            //...Do something 
        })
        .catch((error)=>{
            errorField.classList.remove('d-none');
            errorField.innerHTML = error.body['errors'] ?? 'Big error';
        });
        form.classList.add('was-validated');
    });
});