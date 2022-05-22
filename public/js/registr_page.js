let familia = document.getElementById("inputFamilia");
let imya = document.getElementById("inputName");
let otchestvo = document.getElementById("inputOtchestvo");
let passport = document.getElementById("inputPassport");
let inn = document.getElementById("inputINN");
let email = document.getElementById("inputEmail");
let login = document.getElementById("inputLogin");
let password = document.getElementById("inputPassword");
let password2 = document.getElementById("inputPassword2");
let submit = document.getElementById("submit")

let fields = [familia.value, imya.value, otchestvo.value, passport.value, inn.value, email.value, login.value, password.value, password2.value]

// проверка полей на пустоту

let fields2 = document.querySelectorAll(".input")



email.addEventListener("input", function (event) {
  if (email.validity.typeMismatch) {
    email.setCustomValidity("Введённый e-mail адрес некорректен");
  } else {
    email.setCustomValidity("");
  }
});




submit.addEventListener("click", function allLetter() { 
var letters = /^[A-Za-z]+$/;
if(!familia.value.match(letters))
{
alert('Заполните поле "Фамилия"');
familia.focus();
}
if(!imya.value.match(letters))
{
alert('Заполните поле "Имя"');
imya.focus();
}
if(!passport.value.match(letters))
{
alert('Заполните поле "Паспорт (серия, номер)"');
passport.focus();
}
if(!inn.value.match(letters))
{
alert('Заполните поле "ИНН"');
inn.focus();
}
if(!email.value.match(letters))
{
alert('Заполните поле "email"');
email.focus();
}
if(!login.value.match(letters))
{
alert('Заполните поле "Логин"');
login.focus();
}
if(!password.value.match(letters))
{
alert('Заполните поле "Пароль"');
password.focus();
}
if(!password2.value.match(letters))
{
alert('Подтвердите свой пароль');
password2.focus();
}
})


function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
submit.addEventListener("click", function Validate() {
  if(email == ''){
  email.html('You have to fill out all input boxes').css('color', 'red');
  return false;
}
}
)