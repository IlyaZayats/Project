$(document).ready(function (){

    let errors_fields = [".surname", ".name", ".second-name", ".passport", ".itn", ".snils"];
    let start_errors = Array(errors_fields.length).fill(true);
    let reg_exps = [/^[\sa-zA-Zа-яА-Я-]+$/,/^[\sa-zA-Zа-яА-Я-]+$/,/^[\sa-zA-Zа-яА-Я-]+$/,/^\d+$/,/^\d+$/,/^\d+$/];
    let errors = Array(errors_fields.length+1).fill(true);
    let modal_flag = false;

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
        $("#userSurname").change(event => {
            start_errors[0] = false;
            let target = event.target.value;
            errors[0] = false;
            if (!reg_exps[0].test(target)){
                errors[0] = true;
                printError(errors_fields[0],"Используются недопустимые символы!");
            } else if (target.length>30){
                errors[0] = true;
                printError(errors_fields[0],"Длина фамилии не может превышать 30 сиволов!");
            }
            if(!errors[0]){
                printError(errors_fields[0],"");
            }
        });

        $("#userName").change(event => {
            start_errors[1] = false;
            let target = event.target.value;
            errors[1] = false;
            if (!reg_exps[1].test(target)){
                errors[1] = true;
                printError(errors_fields[1],"Используются недопустимые символы!");
            } else if (target.length>30){
                errors[1] = true;
                printError(errors_fields[1],"Длина имени не может превышать 30 сиволов!");
            }
            if(!errors[1]){
                printError(errors_fields[1],"");
            }
        });

        $("#userSecondName").change(event => {
            start_errors[2] = false;
            let target = event.target.value;
            errors[2] = false;
            if (!reg_exps[2].test(target)){
                errors[2] = true;
                printError(errors_fields[2],"Используются недопустимые символы!");
            } else if (target.length>30){
                errors[2] = true;
                printError(errors_fields[2],"Длина отчества не может превышать 30 сиволов!");
            }
            if(!errors[2]){
                printError(errors_fields[2],"");
            }
        });

        $("#userPassport").change(event => {
            start_errors[3] = false;
            let target = event.target.value;
            errors[3] = false;
            if (!reg_exps[3].test(target)){
                errors[3] = true;
                printError(errors_fields[3],"Используются недопустимые символы!");
            } else if (target.length!==10){
                errors[3] = true;
                printError(errors_fields[3],"Длина паспорта(серия,номер) РФ - 10 цифр!");
            }
            if(!errors[3]){
                printError(errors_fields[3],"");
            }
        });

        $("#userITN").change(event => {
            start_errors[4] = false;
            let target = event.target.value;
            errors[4] = false;
            if (!reg_exps[4].test(target)){
                errors[4] = true;
                printError(errors_fields[4],"Используются недопустимые символы!");
            } else if (target.length!==12){
                errors[4] = true;
                printError(errors_fields[4],"Длина ИНН РФ - 12 цифр!");
            }
            if(!errors[4]){
                printError(errors_fields[4],"");
            }
        });

        $("#userSnils").change(event => {
            start_errors[5] = false;
            let target = event.target.value;
            errors[5] = false;
            if (!reg_exps[5].test(target)){
                errors[5] = true;
                printError(errors_fields[5],"Используются недопустимые символы!");
            } else if (target.length!==11){
                errors[5] = true;
                printError(errors_fields[5],"Длина СНИЛС РФ - 11 цифр!");
            }
            if(!errors[5]){
                printError(errors_fields[5],"");
            }
        });

    }

    validate();

    /*let data = document.querySelectorAll(".data");
    const ajaxSend = (formData) => {
        fetch("http://194.67.116.171/registration", { // поменять 
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
                return response.json();
            })
             .then(result => {
                 const modal = new bootstrap.Modal(document.querySelector('#responseModal'));
                 let modal_title_arr = ['Отлично!', 'Ошибка!', 'Ошибка!'];
                 let modal_body_arr = ['Вы успешно зарегистрировались!', 'Произошла ошибка! Пользователь с таким ИНН/логином уже зарегистрирован.', 'Произошла ошибка! Данные не прошли валидацию, попробуйте еще раз.'];
                 let button_text_arr = ['Перейти на главную', 'Понятно', 'Понятно'];
                 let modal_data = Array(3).fill('');
                 switch (result['type']){
                     case 0:
                         modal_data[0] = modal_title_arr[0];
                         modal_data[1] = modal_body_arr[0];
                         modal_data[2] = button_text_arr[0];
                         break;
                     case 1:
                         modal_data[0] = modal_title_arr[1];
                         modal_data[1] = modal_body_arr[1];
                         modal_data[2] = button_text_arr[1];
                         break;
                     case 2:
                         modal_data[0] = modal_title_arr[2];
                         modal_data[1] = modal_body_arr[2];
                         modal_data[2] = button_text_arr[2];
                         break;
                     default:
                         alert("Ълядь!");
                 }
                 $(".response-title").text(modal_data[0]);
                 $(".response-body").text(modal_data[1]+' Code: '+result['code']);
                 $(".modal-button").html(modal_data[2]);

                 modal.show();
                 window.history.pushState({ "isActive": true }, "", "#modal");

                 $('.modal-button').click(event => {
                     if(result['type']===0){
                         location.href = 'http://194.67.116.171/';
                     } else {
                         window.history.pushState({ "isActive": false }, "", "registration");
                         modal.hide();
                     }
                 });

                 modal.addEventListener('hide.bs.modal', event => {
                     errors = Array(errors_fields.length+1).fill(true);
                     start_errors = Array(errors_fields.length).fill(true);
                 });

            })
            .catch((error) => {
                alert(error);
            })
    }; */

    const empty_msg = new Map ([
        [".surname", "Введите фамилию!"],
        [".name", "Введите имя!"],
        [".second-name", "Введите отчество!"],
        [".itn", "Введите ИНН!"],
        [".passport", "Введите паспорт(серия,номер)!"],
		[".snils", "Введите снилс!"],
    ]);

    const forms = $("#registrationForm");
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