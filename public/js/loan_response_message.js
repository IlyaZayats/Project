$(document).ready(function (){
    let errors_field = ".text";
    let start_error = true;
    let reg_exp = /^[0-9a-zA-Z-_а-яА-Я]+$/;
    let error = true;

    function printError(field, message){
        $(field).text(message);
    }

    function validate(){
        $("#text").change(event => {
            start_error = false;
            let target = event.target.value;
            error = false;
            if(target === ""){
                error = true;
                printError(errors_field,"Введите текст!");
            }else if (!reg_exp.test(target)){
                error = true;
                printError(errors_field,"Используются недопустимые символы!");
            }
            if(!error){
                printError(errors_field,"");
            }
        });
    }

    validate();

    let data = document.querySelectorAll(".data");
    const ajaxSend = (formData) => {
        fetch("http://194.67.116.171/loan_response_message", {
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
                start_error = true;
                data.value = "";
                return response.json();
            })
            .then(result => {
                const modal = new bootstrap.Modal(document.querySelector('#responseModal'));

                let modal_title, modal_body, button_text;

                if(result['msg']===1){
                    modal_title = 'Успешно!';
                    modal_body = 'Клиенту был отправлен ответ!'+' Code: '+result['code'];
                    button_text = 'К формированию ответа';
                } else {
                    modal_title = 'Ошибка!';
                    modal_body = 'Произошла ошибка! Попробуйте еще раз!'+' Code: '+result['code'];
                    button_text = 'Понятно';
                }
                $(".response-title").text(modal_title);
                $(".response-body").text(modal_body);
                $(".modal-button").html(button_text);

                modal.show();

                error = true;
                start_error = true;
                $('.modal-button').click(event => {
                    if(result['msg']===1){
                        location.href = 'http://194.67.116.171/loan_response';
                    } else {
                        modal.hide();
                    }
                });
                let modalElement = document.getElementById('responseModal');
                modalElement.addEventListener('hidden.bs.modal', event => {
                    if(result['msg']===1)
                        location.href = 'http://194.67.116.171/loan_response';
                });


            })
            .catch((error_code) => {
                if(error_code===422){
                    const modal = new bootstrap.Modal(document.querySelector('#responseModal'));
                    $(".response-title").text('Ошибка!');
                    $(".response-body").text('Произошла ошибка валидации!'+' Code: '+error_code);
                    $(".modal-button").html('Понятно');
                    modal.show();
                    error = true;
                    start_error = true;
                    $('.modal-button').click(event => {
                        modal.hide();
                    });
                } else {
                    alert(error_code);
                }
            })
    };


    const forms = $("#messageForm");
    for (let i = 0; i < forms.length; i++) {
        $("#messageFormButton").click(function (e) {
            if(!error) {
                e.preventDefault();
                $(errors_field).text("");
                let formData = new FormData(forms[i]);
                formData = Object.fromEntries(formData);

                ajaxSend(formData);
            } else {
                if(start_error){
                    printError(errors_field, "Введите текст!");
                }
            }
        });
    }

});