
$(document).ready(function (){

    let errors_fields = [".surname", ".name", ".second-name", ".passport", ".itn", ".email", ".login", ".password", ".policy"];
    let start_errors = Array(errors_fields.length).fill(true);
    let reg_exps = [/^[\sa-zA-Zа-яА-Я-]+$/,/^[\sa-zA-Zа-яА-Я-]+$/,/^[\sa-zA-Zа-яА-Я-]+$/,/^\d+$/,/^\d+$/,/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/,/^[0-9a-zA-Z-_]+$/,/^[0-9a-zA-Z]+$/];
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
            if(target === ""){
                errors[0] = true;
                printError(errors_fields[0],"Введите вашу фамилию!");
            } else if (!reg_exps[0].test(target)){
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
            if(target === ""){
                errors[1] = true;
                printError(errors_fields[1],"Введите ваше имя!");
            } else if (!reg_exps[1].test(target)){
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
            if(target === ""){
                errors[2] = true;
                printError(errors_fields[2],"Введите ваше отчество!");
            } else if (!reg_exps[2].test(target)){
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
            if(target === ""){
                errors[3] = true;
                printError(errors_fields[3],"Введите ваш паспорт(серия,номер)!");
            } else if (!reg_exps[3].test(target)){
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
            if(target === ""){
                errors[4] = true;
                printError(errors_fields[4],"Введите ваш ИНН!");
            } else if (!reg_exps[4].test(target)){
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

        $("#userEmail").change(event => {
            start_errors[5] = false;
            let target = event.target.value;
            errors[5] = false;
            if(target === ""){
                errors[5] = true;
                printError(errors_fields[5],"Введите ваш адрес электронной почты!");
            } else if (!reg_exps[5].test(target)){
                errors[5] = true;
                printError(errors_fields[5],"Неккоретный адрес электронной почты!");
            } else if (target.length > 255){
                errors[5] = true;
                printError(errors_fields[5],"Длина адреса электронной почты не может превышать 255 символов!");
            }
            if(!errors[5]){
                printError(errors_fields[5],"");
            }
        });

        $("#userLogin").change(event => {
            start_errors[6] = false;
            let target = event.target.value;
            errors[6] = false;
            if(target === ""){
                errors[6] = true;
                printError(errors_fields[6],"Введите ваш логин!");
            } else if (!reg_exps[6].test(target)){
                errors[6] = true;
                printError(errors_fields[6],"Используются недопустимые символы!");
            } else if (target.length > 30 || target.length < 8){
                errors[6] = true;
                printError(errors_fields[6],"Длина логина должна быть не менее 8 и не более 30 символов!");
            }
            if(!errors[6]){
                printError(errors_fields[6],"");
            }
        });

        $("#userPassword").change(event => {
            start_errors[7] = false;
            let target = event.target.value;
            errors[7] = false;
            if(target === ""){
                errors[7] = true;
                printError(errors_fields[7],"Введите ваш пароль!");
            } else if (!reg_exps[7].test(target)){
                errors[7] = true;
                printError(errors_fields[7],"Используются недопустимые символы!");
            } else if (target.length > 30 || target.length < 8){
                errors[7] = true;
                printError(errors_fields[7],"Длина пароля должна быть не менее 8 и не более 30 символов!");
            }
            if(!errors[7]){
                printError(errors_fields[7],"");
            }
        });

        $("#userPolicy").change(event => {
            start_errors[8] = false;
            errors[8] = false;
            if(!$("#userPolicy").is(":checked")){
                errors[8] = true;
                printError(errors_fields[8],"Вы не согласились на обработку персональных данных!");
            }
            if(!errors[8]){
                printError(errors_fields[8],"");
            }
        });

        $("#userPasswordCheck").change(event => {
            let target = event.target.value;
            errors[9] = false;
            if(target !== $("#userPassword").val()){
                errors[9] = true;
                printError(errors_fields[7],"Пароли не совпадают!");
            }
            if(!errors[9] && !errors[7]){
                printError(errors_fields[7],"");
            }
        });
    }

    validate();

    let data = document.querySelectorAll(".data");
    const ajaxSend = (formData) => {
        fetch("http://194.67.116.171/registration", {
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
                $("#userPolicy").prop("checked", false);
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
                         errors = Array(errors_fields.length+1).fill(true);
                         start_errors = Array(errors_fields.length).fill(true);
                         modal_flag = true;

                     }
                 });

            })
            .catch((error) => {
                alert(error);
            })
    };

    const empty_msg = new Map ([
        [".surname", "Введите вашу фамилию!"],
        [".name", "Введите ваше имя!"],
        [".second-name", "Введите ваше отчество!"],
        [".passport", "Введите ваш паспорт(серия,номер)!"],
        [".itn", "Введите ваш ИНН!"],
        [".email", "Введите ваш адрес электронной почты!"],
        [".login", "Введите ваш логин!"],
        [".password", "Введите ваш пароль!"],
        [".policy", "Вы не согласились на обработку персональных данных!"]
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

    //let values = [$("#userSurname").val(), $("#userName").val(), $("#userSecondName").val(), $("#userPassport").val(), $("#userITN").val(), $("#userEmail").val(), $("#userLogin").val(), $("#userPassword").val()];
    //let values_id = [$("#userSurname"), $("#userName"), $("#userSecondName"), $("#userPassport"), $("#userITN"), $("#userEmail"), $("#userLogin"), $("#userPassword")];

    // values.forEach(function validate(value, index){
    //     values_id[index].change(event => {
    //         if(errors[index]){
    //             errors[index] = false;
    //         }
    //         if(value === ""){
    //             errors[index] = true;
    //             $(errors_fields[index]).text("Данное поле не должно быть пустым!");
    //         }
    //         if(!reg_exps[index].test(value)){
    //             errors[index] = true;
    //             $(errors_fields[index]).text("Используются недопустимые символы!");
    //         }
    //         if(errors_fields[index]===".itn" && values[index].length !== 12){
    //             errors[index] = true;
    //             $(errors_fields[index]).text("ИНН РФ содержит 12 цифр!");
    //         }
    //         if(errors_fields[index]===".passport" && values[index].length !== 10){
    //             errors[index] = true;
    //             $(errors_fields[index]).text("Серия, номер паспорта РФ содержит 10 цифр!");
    //         }
    //         if(errors_fields[index]===".login" && (values[index].length > 30 || values[index].length < 8)){
    //             errors[index] = true;
    //             $(errors_fields[index]).text("Длина логина должна быть не менее 8 и не более 30 символов!");
    //         }
    //         if(errors_fields[index]===".password" && (values[index].length > 30 || values[index].length < 10)){
    //             errors[index] = true;
    //             $(errors_fields[index]).text("Длина логина должна быть не менее 10 и не более 30 символов!");
    //         }
    //     });
    //     errors.forEach(function getFinalError(item, index)
    //     {
    //         if(item){
    //             final_error = item;
    //         } else {
    //             $(errors_fields[index]).text("");
    //         }
    //     });
    //
    // });
    //
    //
    // $("#userPasswordCheck").change(event => {
    //     if($("#userPasswordCheck").val() !== values[values.length-1]){
    //         errors[errors_fields.length-2] = true;
    //         $(errors_fields[errors_fields.length-2]).text("Пароли не совпадают!");
    //     }
    //     if(errors[errors_fields.length-2]){
    //         final_error = errors[errors_fields.length-2];
    //     } else {
    //         $(errors_fields[errors_fields.length-2]).text("");
    //     }
    // });

    // $("#userPolicy").change(event => {
    //     if(!$("#userPolicy").is(":checked")){
    //         errors[errors_fields.length-1] = true;
    //         $(errors_fields[errors_fields.length-1]).text("Вы не согласились на обработку персональных данных!");
    //     }
    //     if(errors[errors_fields.length-1]){
    //         final_error = errors[errors_fields.length-1];
    //     } else {
    //         $(errors_fields[errors_fields.length-1]).text("");
    //     }
    // });




    /*
    $("#confirmButton").click(function (){
        let errors_fields = [".surname", ".name", ".second-name", ".passport", ".itn", ".email", ".login", ".password", ".policy"];

        let reg_exps = [/^[\sa-zA-Zа-яА-Я-]+$/,/^[\sa-zA-Zа-яА-Я-]+$/,/^[\sa-zA-Zа-яА-Я-]+$/,/^\d+$/,/^\d+$/,/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/,/^[0-9a-zA-Z-_]/,/^[0-9a-zA-Z]/];

        let errors = Array(errors_fields.length).fill(false);


        for(let i=0; i<values.length; i++){
            if(values[i] === ""){
                errors[i] = true;
                $(errors_fields[i]).text("Данное поле не должно быть пустым!");
            } else if (!reg_exps[i].test(values[i])){
                errors[i] = true;
                $(errors_fields[i]).text("Используются недопустимые символы!");
            } else if (errors_fields[i]===".itn" && values[i].length !== 12){
                errors[i] = true;
                $(errors_fields[i]).text("ИНН РФ содержит 12 цифр!");
            } else if (errors_fields[i]===".login" && (values[i].length >= 30 || values[i].length <= 8)){
                errors[i] = true;
                $(errors_fields[i]).text("Длина логина должна быть не менее 8 и не более 30 символов!");
            } else if (errors_fields[i]===".passport" && values[i].length !== 10){
                errors[i] = true;
                $(errors_fields[i]).text("Серия(номер) пасспорта РФ содержит 10 цифр!");
            }
        }

        if(values[values.length-1] !== $("#userPasswordCheck").val()){
            errors[errors_fields.length-2] = true;
            $(errors_fields[errors_fields.length-2]).text("Пароли не совпадают!");
        }

        if(!$("#userPolicy").is(":checked")){
            errors[errors_fields.length-1] = true;
            $(errors_fields[errors_fields.length-1]).text("Вы не согласились на обработку персональных данных!");
        }

        errors.forEach(function magic(item, index)
        {
            if(item){
                error1 = item;
            } else {
                $(errors_fields[index]).text("");
            }
        });




    });
*/


});