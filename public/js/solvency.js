
$(document).ready(function (){

    let start_errors = Array(2).fill(true);
    let reg_exp = /^\d+$/;
    let errors = Array(2).fill(true);

    function printError(field, message){
        $(field).text(message);
    }

    function validate(){
        $("#inputIncome").change(event => {
            start_errors[0] = false;
            let target = event.target.value;
            errors[0] = false;
            if(target === ""){
                errors[0] = true;
                printError(".income","Введите ежемесячный доход!");
            } else if (!reg_exp.test(target)){
                errors[0] = true;
                printError(".income","Используются недопустимые символы!");
            }
            if(!errors[0]){
                printError(".income","");
            }
        });

        $("#inputDuty").change(event => {
            start_errors[1] = false;
            let target = event.target.value;
            errors[1] = false;
            if(target === ""){
                errors[1] = true;
                printError(".duty","Введите ежемесячный долг!");
            } else if (!reg_exp.test(target)){
                errors[1] = true;
                printError(".duty","Используются недопустимые символы!");
            }
            if(!errors[1]){
                printError(".duty","");
            }
        });
    }

    validate();

    let data = document.querySelectorAll(".data");
    const ajaxSend = (formData) => {
        fetch("http://194.67.116.171/solvency", {
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
                start_errors = Array(2).fill(true);
                data.forEach((element) => { element.value = ""; });
                return response.json();
            })
            .then(result => {
                if(result['msg']===1){
                    $('#outputSolvency').val(result['solvency']);
                } else{
                    const modal = new bootstrap.Modal(document.querySelector('#responseModal'));
                    $(".response-title").text('Ошибка!');
                    $(".response-body").text('Произошла ошибка! Данные не прошли валидацию, попробуйте еще раз.'+' Code: '+result['msg']);
                    $(".modal-button").html('Понятно');
                    modal.show();
                    errors = Array(errors_fields.length).fill(true);
                    start_errors = Array(errors_fields.length).fill(true);
                }


                $('.modal-button').click(event => {
                    modal.hide();
                });



            })
            .catch((error) => {
                alert(error);
            })
    };

    const empty_msg = new Map ([
        [".income", "Введите ежемесячный доход!"],
        [".duty", "Введите ежемесячный долг!"]
    ]);

    const errors_fields=[".income", ".duty"];

    const forms = $("#solvencyForm");
    for (let i = 0; i < forms.length; i++) {
        $("#getSolvencyButton").click(function (e) {

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