function sendform() {

var select = document.getElementById("doki");
var val = select.value;

if (document.forms[0].vozrast_klienta.value == "" || val=="nol") {
	document.getElementById("err").innerHTML = "Необходимо заполнить поле возраст и/или выбрать ответ на результат проверки документов";
	return false
}

return true;
}

