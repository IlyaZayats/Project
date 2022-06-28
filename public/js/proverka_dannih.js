function sendform() {

let select = document.getElementById("doki");
let val = select.value;

if ((document.forms[0].vozrast_klienta.value < 1) || (document.forms[0].vozrast_klienta.value > 150)){
	document.getElementById("err").innerHTML = "Неверно указан возраст!";
	return false
}

if (document.forms[0].vozrast_klienta.value == "" || val=="nol") {
	document.getElementById("err").innerHTML = "Необходимо заполнить поле возраст и/или выбрать ответ на результат проверки документов";
	return false
}

return true;
}

