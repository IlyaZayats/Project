//проверка DOM на готовность
$(document).ready(function (){
    //нажатие на кнопку
    $("#confirmButton").click(function (){
        let errors_fields = [".surname", ".name", ".second-name", ".passport", ".itn", ".email", ".login", ".password", ".policy"];
        let values = [$("#userSurname").val(), $("#userName").val(), $("#userSecondName").val(), $("#userPassport").val(), $("#userITN").val(), $("#userEmail").val(), $("#userLogin").val(), $("#userPassword").val()];
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
            } else if (errors_fields[i]===".login" && (values[i].length > 30 || values[i].length < 8)){
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

        let error = false;
        errors.forEach(function magic(item, index)
        {
            if(item){
                error = item;
            } else {
                $(errors_fields[index]).text("");
            }
        });

        if(!error){

            let data = document.querySelectorAll(".data");
            const ajaxSend = (formData) => {
                fetch("../registration", {
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
                        data.forEach((element) => { element.value = ""; });
                    })
                    .catch((error) => {alert(error);})
            };

            const forms = $("#registrationForm");
            for (let i = 0; i < forms.length; i++) {
                $("#confirmButton").click(function (e) {
                    e.preventDefault();

                    let formData = new FormData(forms[i]);
                    formData = Object.fromEntries(formData);

                    ajaxSend(formData);
                });
            }
        }



        /*

        //валидация фамилии
        let re = /^[\sa-zA-Zа-яА-Я-]+$/;
        let surname = $("#userSurname").val();
        if(surname === ""){
            errors_fields[0].text("Введите вашу фамилию.");
            errors = true;
        } else if (!re.test(surname)){
            errors_fields[0].text("Используются недопустимые символы!");
            errors = true;
        }

        //валидация имени
        let name = $("#userName").val();
        if(name === ""){
            errors_fields[1].text("Введите ваше имя.");
            errors = true;
        } else if (!re.test(name)){
            errors_fields[1].text("Используются недопустимые символы!");
            errors = true;
        }

        //валидация отчества
        let second_name = $("#userSecondName").val();
        if(second_name === ""){
            errors_fields[2].text("Введите ваше отчество.");
            errors = true;
        } else if (!re.test(second_name)){
            errors_fields[2].text("Используются недопустимые символы!");
            errors = true;
        }

        //валидация пасспорта
        re = /^\d+$/;
        let passport = $("#userPassport").val();
        if(passport === ""){
            errors_fields[3].text("Введите ваш пасспорт.");
            errors = true;
        } else if (!re.test(passport)){
            errors_fields[3].text("Используются недопустимые символы!");
            errors = true;
        } else if (passport.length !== 10){
            errors_fields[3].text("Длина серии(номера) пасспорта РФ - 10 цифр!");
            errors = true;
        }

        //валидация ИНН
        */



    });
});