$(document).ready(function (){

    let errors_fields = [".surname", ".name", ".second-name", ".passport", ".itn", ".inipa", ".income", ".statement"];
    let start_errors = Array(errors_fields.length).fill(true);
    let reg_exps = [/^[\sa-zA-Zа-яА-Я-]+$/,/^[\sa-zA-Zа-яА-Я-]+$/,/^[\sa-zA-Zа-яА-Я-]+$/,/^\d+$/,/^\d+$/,/^\d+$/];
    let errors = Array(errors_fields.length).fill(true);

    function printError(field, message){
        $(field).text(message);
    }

    //допустимые типы данных
    const file_types = [
        'image/png',
        'image/jpeg',
        'application/pdf'
    ];

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
                printError(errors_fields[1],"Введите имя!");
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
            if(target === ""){
                errors[3] = true;
                printError(errors_fields[3],"Введите паспорт(серия,номер)!");
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
                printError(errors_fields[4],"Введите ИНН!");
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

        $("#userINIPA").change(event => {
            start_errors[5] = false;
            let target = event.target.value;
            errors[5] = false;
            if(target === ""){
                errors[5] = true;
                printError(errors_fields[5],"Введите СНИЛС!");
            } else if (!reg_exps[5].test(target)){
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

        $("#userIncome").change(event => {
            start_errors[6] = false;
            errors[6] = false;
            if(document.getElementById("userIncome").files[0].length){
                errors[6] = true;
                printError(errors_fields[6],"Загрузите файл!");
            } else if(!file_types.includes(document.getElementById("userIncome").files[0].type)){
                errors[6] = true;
                printError(errors_fields[6],"Допустимые форматы: .jpeg, .png, .pdf!");
            }
            if(!errors[6]){
                printError(errors_fields[6],"");
            }
        });

        $("#userStatement").change(event => {
            start_errors[7] = false;
            errors[7] = false;
            if(document.getElementById("userStatement").files[0].length){
                errors[7] = true;
                printError(errors_fields[7],"Загрузите файл!");
            } else if(!file_types.includes(document.getElementById("userStatement").files[0].type)){
                errors[7] = true;
                printError(errors_fields[7],"Допустимые форматы: .jpeg, .png, .pdf!");
            }
            if(!errors[7]){
                printError(errors_fields[7],"");
            }
        });

    }

    validate();

    let data = document.querySelectorAll(".data");
    const ajaxSend = (formData) => {
        fetch("http://194.67.116.171/cabinet/additional_data/guarantor", {
            method: "POST",
            body: formData
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
                const modal = new bootstrap.Modal(document.querySelector('#responseModal'));
                if(result['msg']===0 || result['msg']===1){
                    $(".response-title").text('Отлично!');
                    $(".response-body").text('Вы успешно добавили поручителя!'+' Code: '+result['code']);
                    $(".modal-button").html('Вернуться в личный кабинет');
                } else {
                    $(".response-title").text('Ошибка!');
                    $(".response-body").text('Произошла ошибка! Данные не прошли валидацию, попробуйте еще раз.'+' Code: '+result['code']);
                    $(".modal-button").html('Понятно');
                }
                modal.show();

                errors = Array(errors_fields.length).fill(true);
                start_errors = Array(errors_fields.length).fill(true);
                $('.modal-button').click(event => {
                    if(result['msg']===0 || result['msg']===1){
                        location.href = 'http://194.67.116.171/cabinet/additional_data';
                    } else {
                        modal.hide();
                    }
                });

            })
            .catch((error) => {
                alert(error);
            })
    };

    const empty_msg = new Map ([
        [".surname", "Введите фамилию!"],
        [".name", "Введите имя!"],
        [".second-name", "Введите отчество!"],
        [".itn", "Введите ИНН!"],
        [".passport", "Введите паспорт(серия,номер)!"],
        [".inipa", "Введите снилс!"],
        [".income", "Загрузите файл!"],
        [".statement", "Загрузите файл!"]
    ]);

    const forms = $("#registrationForm");
    for (let i = 0; i < forms.length; i++) {
        $("#confirmButton").click(function (e) {
            console.log('bruh');
            let final_error = false;
            errors.forEach(function magic(item, index)
            {
                if(item){
                    final_error = item;
                } else {
                    $(errors_fields[index]).text("");
                }
            });
            console.log('bruh1');
            console.log(final_error);
            if(!final_error) {
                console.log('bruh2');
                e.preventDefault();

                let formData = new FormData(forms[i]);

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