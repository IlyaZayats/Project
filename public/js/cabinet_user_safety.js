$(document).ready(function (){

    let errors_fields = [".password-old", ".password", ".password-check"];
    let start_errors = Array(errors_fields.length).fill(true);
    let errors = Array(errors_fields.length).fill(true);
    let erf = ".email";
    let err = true;
    let ste = true;
    let re2 = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
    let re1 = /^[0-9a-zA-Z]+$/;
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

        $("#userPasswordOld").change(event => {
            start_errors[0] = false;
            let target = event.target.value;
            errors[0] = false;
            if(target === ""){
                errors[0] = true;
                printError(errors_fields[0],"Введите ваш текущий пароль!");
            } else if (!re1.test(target)){
                errors[0] = true;
                printError(errors_fields[0],"Используются недопустимые символы!");
            } else if (target.length > 30 || target.length < 8){
                errors[0] = true;
                printError(errors_fields[0],"Длина пароля должна быть не менее 8 и не более 70 символов!");
            }			
            if(!errors[0]){
                printError(errors_fields[0],"");
            }
        });
		
		$("#userPassword").change(event => {
            start_errors[1] = false;
            let target = event.target.value;
            errors[1] = false;
			if(target === ""){//if(target > 0 && $("#userPasswordOld").val().length==0){
                errors[1] = true;
                printError(errors_fields[1],"Укажите новый пароль!");
            } else if (!re1.test(target)){
                errors[1] = true;
                printError(errors_fields[1],"Используются недопустимые символы!");
            } else if(target == $("#userPasswordOld").val()){
				errors[1] = true;
                printError(errors_fields[1],"Новый пароль не должен совпадать со старым!");
			} else if (target.length > 30 || target.length < 8){
                errors[1] = true;
                printError(errors_fields[1],"Длина пароля должна быть не менее 8 и не более 70 символов!");
            }
            if(!errors[1]){
                printError(errors_fields[1],"");
            }
        });

        $("#userPasswordCheck").change(event => {
			start_errors[2] = false;
            let target = event.target.value;
            errors[2] = false;
			if(target === ""){
                errors[2] = true;
                printError(errors_fields[2],"Подтвердите пароль!");
			} else if(target !== $("#userPassword").val()){
                errors[2] = true;
                printError(errors_fields[2],"Пароли не совпадают!");
            }
            if(!errors[2] && !errors[1]){
                printError(errors_fields[2],"");
            }
        });
		
		
        $("#userEmail").change(event => {
            ste = false;
            let target = event.target.value;
            err = false;
            if(target === ""){
                err = true;
                printError(erf,"Введите ваш адрес электронной почты!");
            } else if (!re2.test(target)){
                err = true;
                printError(erf,"Неккоретный адрес электронной почты!");
            } else if (target.length > 255){
                err = true;
                printError(erf,"Длина адреса электронной почты не может превышать 255 символов!");
            }
            if(!err){
                printError(erf,"");
            }
        });
		
    }
	
	validate();
	
	let data = document.querySelectorAll(".data");
	const ajaxSend = (formData) => {
		fetch("http://194.67.116.171/cabinet/safety", {
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
                ste = true;
                data.forEach((element) => { element.value = ""; });
                return response.json();
			})
			.then(result => {
                const modal = new bootstrap.Modal(document.querySelector('#responseModal'));

                let modal_title, modal_body, button_text;

                if(result['msg']===1){
                    modal_title = 'Успешно!';
                    modal_body = 'Данные были изменены'+' Code: '+result['code'];
                    button_text = 'Понятно';
                } else if(result['msg']===0){
                    modal_title = 'Ошибка!';
                    modal_body = 'Произошла ошибка! Старые пароли не совпадают!'+' Code: '+result['code'];
                    button_text = 'Понятно';
                }  else {
                    modal_title = 'Ошибка!';
                    modal_body = 'Произошла ошибка! Попробуйте еще раз!'+' Code: '+result['code'];
                    button_text = 'Понятно';
                }
                $(".response-title").text(modal_title);
                $(".response-body").text(modal_body);
                $(".modal-button").html(button_text);

                modal.show();

                errors = Array(errors_fields.length).fill(true);
                err = true;
                start_errors = Array(errors_fields.length).fill(true);
                ste = true;
                $('.modal-button').click(event => {
                        modal.hide();
                });
			})
			.catch((error) => {
				alert(error);
			})
	};
	
	const empty_msg1 = new Map ([
		[".password-old", "Введите текущий пароль!"],
		[".password", "Введите новый пароль!"],
		[".password-check", "Подтвердите пароль"]
	]);
	
	const empty_msg2 = new Map ([
		[".email", "Введите текущий email!"]
	]);
	
	let forms_p = $("#changePassForm");
    for (let i = 0; i < forms_p.length; i++) {
        $("#changePass").click(function (e) {

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
                let formData = new FormData(forms_p[i]);
                formData = Object.fromEntries(formData);
                ajaxSend(formData);
            } else {
                start_errors.forEach(function startValid(item, index){
                    if(item){
                        printError(errors_fields[index], empty_msg1.get(errors_fields[index]));
                    }
                });
            }
        });
    }
	
	let forms_e = $("#changeEmailForm");
    for (let i = 0; i < forms_e.length; i++) {
        $("#changeEmail").click(function (e) {
            if(!err) {
                e.preventDefault();
                $(erf).text("");
                let formData = new FormData(forms_e[i]);
                formData = Object.fromEntries(formData);
                ajaxSend(formData);
            } else {
                if(ste){
                    printError(erf, empty_msg2.get(erf));
                }
            }
        });
    }
	
});