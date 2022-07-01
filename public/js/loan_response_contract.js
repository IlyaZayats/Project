
$(document).ready(function (){

    let errors_fields = [".loan-itn", ".loan-sum", ".loan-type", ".loan-term"];
    let start_errors = Array(errors_fields.length).fill(true);
    let reg_exp = /^\d+$/;
    let errors = Array(errors_fields.length).fill(true);

    function printError(field, message){
        $(field).text(message);
    }

    function validate(){
        $("#userITN").change(event => {
            start_errors[0] = false;
            let target = event.target.value;
            errors[0] = false;
            if(target === ""){
                errors[0] = true;
                printError(errors_fields[0],"Введите ИНН!");
            } else if (!reg_exp.test(target)){
                errors[0] = true;
                printError(errors_fields[0],"Используются недопустимые символы!");
            } else if (target.length!==12){
                errors[0] = true;
                printError(errors_fields[0],"Длина ИНН РФ - 12 цифр!");
            }
            if(!errors[0]){
                printError(errors_fields[0],"");
            }
        });

        $("#sumLoan").change(event => {
            start_errors[1] = false;
            let target = event.target.value;
            errors[1] = false;
            if(target === ""){
                errors[1] = true;
                printError(errors_fields[1],"Введите сумму кредита!");
            } else if (!reg_exp.test(target)){
                errors[1] = true;
                printError(errors_fields[1],"Используются недопустимые символы!");
            }
            if(!errors[1]){
                printError(errors_fields[1],"");
            }
        });

        $("#loanType").change(event => {
            start_errors[2] = false;
            let target = event.target.value;
            errors[2] = false;
            if(target === ""){
                errors[2] = true;
                printError(errors_fields[2],"Выбирите тип кредита!");
            } else if (!reg_exp.test(target)){
                errors[2] = true;
                printError(errors_fields[2],"Используются недопустимые символы!");
            }
            if(!errors[2]){
                printError(errors_fields[2],"");
            }
        });

        $("#termLoan").change(event => {
            start_errors[3] = false;
            let target = event.target.value;
            errors[3] = false;
            if(target === ""){
                errors[3] = true;
                printError(errors_fields[3],"Введите период кредитования!");
            } else if (!reg_exp.test(target)){
                errors[3] = true;
                printError(errors_fields[3],"Используются недопустимые символы!");
            }
            if(!errors[3]){
                printError(errors_fields[3],"");
            }
        });
    }

    validate();

    let data = document.querySelectorAll(".data");
    const ajaxSend = (formData) => {
        fetch("http://194.67.116.171/loan_response_contract", {
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
                const modal = new bootstrap.Modal(document.querySelector('#responseModal'));

                let modal_title, modal_body, button_text;

                if(result['msg']===1){
                    modal_title = 'Отлично!';
                    modal_body = 'Договор с клиентом был заключен!'+' Code: '+result['code'];
                    button_text = 'Перейти к другим заявкам';
                } else {
                    modal_title = 'Ошибка!';
                    modal_body = 'Произошла ошибка! Попробуйте еще раз!'+' Code: '+result['code'];
                    button_text = 'Понятно';
                }
                $(".response-title").text(modal_title);
                $(".response-body").text(modal_body);
                $(".modal-button").html(button_text);

                modal.show();

                errors = Array(errors_fields.length).fill(true);
                start_errors = Array(errors_fields.length).fill(true);
                $('.modal-button').click(event => {
                    if(result['msg']===1){
                        location.href = 'http://194.67.116.171/cabinet';
                    } else {
                        modal.hide();
                    }
                });
                let modalElement = document.getElementById('responseModal');
                modalElement.addEventListener('hidden.bs.modal', event => {
                    if(result['msg']===1)
                    location.href = 'http://194.67.116.171/cabinet';
                });

            })
            .catch((error) => {
                if(error===422){
                    const modal = new bootstrap.Modal(document.querySelector('#responseModal'));
                    $(".response-title").text('Ошибка!');
                    $(".response-body").text('Произошла ошибка валидации!'+' Code: '+error);
                    $(".modal-button").html('Понятно');
                    modal.show();
                    errors = Array(errors_fields.length).fill(true);
                    start_errors = Array(errors_fields.length).fill(true);
                    $('.modal-button').click(event => {
                            modal.hide();
                    });
                } else {
                    alert(error);
                }
            })
    };

    const empty_msg = new Map ([
        [".loan-itn", "Введите ИНН!"],
        [".loan-sum", "Введите сумму кредита!"],
        [".loan-type", "Выбирите тип кредита!"],
        [".loan-term", "Введите период кредитования!"]
    ]);

    const forms = $("#contractForm");
    for (let i = 0; i < forms.length; i++) {
        $("#contractButton").click(function (e) {

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