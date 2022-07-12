$(document).ready(function (){
    
    let errors_fields = ["#inputITN", "#inputSumOfCredit", "#inputModeOfCredit", "#inputTime"];
    let start_errors = Array(errors_fields.length).fill(true);
    let reg_exps = [/^[\sa-zA-Zа-яА-Я-]+$/,/^[\sa-zA-Zа-яА-Я-]+$/,/^[\sa-zA-Zа-яА-Я-]+$/,/^\d+$/,/^\d+$/,/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/,/^[0-9a-zA-Z-_]+$/,/^[0-9a-zA-Z]+$/];
    let errors = Array(errors_fields.length+1).fill(true);
    let modal_flag = false;

    function printError(field, message){
        $(field).text(message);
    }

    function validate(){
        $("#inputITN").change(event => {
            start_errors[0] = false;
            let target = event.target.value;
            errors[0] = false;
            if(target === ""){
                errors[0] = true;
                printError(errors_fields[0],"Введите ваш ИНН!");
            } else if (!reg_exps[4].test(target)){
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
    }

    validate();

}
)


// $(document).ready(function (){
    
// let errors_fields = ["#inputITN", "#inputSumOfCredit", "#inputModeOfCredit", "#inputTime"];
// let start_errors = Array(errors_fields.length).fill(true);
// let reg_exps = [/^[\sa-zA-Zа-яА-Я-]+$/,/^[\sa-zA-Zа-яА-Я-]+$/,/^[\sa-zA-Zа-яА-Я-]+$/,/^\d+$/,/^\d+$/,/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/,/^[0-9a-zA-Z-_]+$/,/^[0-9a-zA-Z]+$/];
// let errors = Array(errors_fields.length+1).fill(true);
// let modal_flag = false;

// let form = document.querySelector('.js-form'),
// formInputs = document.querySelectorAll('.js-input'),
// inputEmail = document.querySelector('.js-input-email'),
// inputPhone = document.querySelector('.js-input-phone'),
// inputCheckbox = document.querySelector('.js-input-checkbox');

// function printError(field, message){
//     $(field).text(message);
// }

// function validateEmail(email) {
// let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
// return re.test(String(email).toLowerCase());
// }

// function validateCountry(country) {
// let re = new RegExp('.co$');
// return re.test(String(country).toLowerCase());
// }

// function validatePhone(phone) {
// let re = /^[0-9\s]*$/;
// return re.test(String(phone));
// }

// form.onsubmit = function () {
// let emailVal = inputEmail.value,
// phoneVal = inputPhone.value,
// emptyInputs = Array.from(formInputs).filter(input => input.value === '');

// formInputs.forEach(function (input) {
// if (input.value === '') {
// input.classList.add('error');

// } else {
// input.classList.remove('error');
// }
// });

// if (emptyInputs.length !== 0) {
// printError(errors_fields[0], "inputs not filled");
// return false;
// }

// if(!validateEmail(emailVal)) {
// console.log('email not valid');
// inputEmail.classList.add('error');
// return false;
// } else {
// inputEmail.classList.remove('error');
// }

// if (validateCountry(emailVal)) {
// console.log('email from Columbia');
// inputEmail.classList.add('error');
// return false;
// } else {
// inputEmail.classList.remove('error');
// }

// if (!validatePhone(phoneVal)) {
// console.log('phone not valid');
// inputPhone.classList.add('error');
// return false;
// } else {
// inputPhone.classList.remove('error');
// }

// if(!inputCheckbox.checked) {
// console.log('checkbox not checked');
// inputCheckbox.classList.add('error');
// return false;
// } else {
// inputCheckbox.classList.remove('error')
// }

// }
// }
// )
