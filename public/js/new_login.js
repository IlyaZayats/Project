
$(document).ready(function (){

    let errors_fields = [".login", ".password"];
    let start_errors = Array(errors_fields.length).fill(true);
    let reg_exps = [/^[0-9a-zA-Z-_]+$/,/^[0-9a-zA-Z]+$/];
    let errors = Array(errors_fields.length).fill(true);

    function printError(field, message){
        $(field).text(message);
    }

    function reloadScript(url) {
        let script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = url;
        document.documentElement.appendChild(script);
    }

    function validate(){
        $("#userLogin").change(event => {
            start_errors[0] = false;
            let target = event.target.value;
            errors[0] = false;
            if(target === ""){
                errors[0] = true;
                printError(errors_fields[0],"Введите ваш логин!");
            } else if (!reg_exps[0].test(target)){
                errors[0] = true;
                printError(errors_fields[0],"Используются недопустимые символы!");
            } else if (target.length > 30 || target.length < 8){
                errors[0] = true;
                printError(errors_fields[0],"Длина логина должна быть не менее 8 и не более 30 символов!");
            }
            if(!errors[0]){
                printError(errors_fields[0],"");
            }
        });

        $("#userPassword").change(event => {
            start_errors[1] = false;
            let target = event.target.value;
            errors[1] = false;
            if(target === ""){
                errors[1] = true;
                printError(errors_fields[1],"Введите ваш пароль!");
            } else if (!reg_exps[1].test(target)){
                errors[1] = true;
                printError(errors_fields[1],"Используются недопустимые символы!");
            } else if (target.length > 30 || target.length < 8){
                errors[1] = true;
                printError(errors_fields[1],"Длина пароля должна быть не менее 8 и не более 70 символов!");
            }
            if(!errors[1]){
                printError(errors_fields[1],"");
            }
        });
    }

    validate();

    let data = document.querySelectorAll(".data");
    const ajaxSend = (formData) => {
        fetch("http://194.67.116.171/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(formData)
        })
            .then(function (response) {
                if(!response.ok)
                {
                    throw new Error(response.status);
                }
                start_errors = Array(errors_fields.length).fill(true);
                data.forEach((element) => { element.value = ""; });
                return response.json();
            })
            .then(result => {
                if(result['type']===0){
                    location.href="http://194.67.116.171/cabinet";
                } else {
                    $('.login-error').text("Пользователь с таким логином/паролем не найден!");
                }
                errors = Array(errors_fields.length).fill(true);
                start_errors = Array(errors_fields.length).fill(true);

            })
            .catch((error) => {
                alert(error);
            })
    };

    const empty_msg = new Map ([
        [".login", "Введите ваш логин!"],
        [".password", "Введите ваш пароль!"],
    ]);

    const forms = $("#loginForm");
    for (let i = 0; i < forms.length; i++) {
        $("#confirmButton").click(function (e) {

            let final_error = false;
            errors.forEach(function magic(item, index)
            {
                if(item){
                    final_error = item;
                } else {
                    $(errors_fields[index]).text("");
                }
            });
            if(!final_error) {
                e.preventDefault();

                let formData = new FormData(forms[i]);
                formData = Object.fromEntries(formData);

                ajaxSend(formData);
            } else {
                start_errors.forEach(function startValid(item, index){
                    if(item){
                        printError(errors_fields[index], empty_msg.get(errors_fields[index]));
                    }
                });
            }
        });
    }

});