function sendform() {

var select = document.getElementById("doki");
var val = select.value;

if (document.forms[0].vozrast_klienta.value == "" || val=="nol") {
alert('Необходимо заполнить поле возраст и/или выбрать ответ на результат проверки документов');
document.mailform.vozrast_klienta.focus();
return false
}

return true;
}

