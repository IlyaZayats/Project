function checkmailandpass()
{
var txt = document.form_pr.address.value;
if(txt.length>0){
	if (txt.indexOf(".") == -1) {
		document.getElementById("ema").innerHTML = "Нет символа\".\" в поле адреса новой электронной почты";
		return false
		}
	if((txt.indexOf(",")>=0)||(txt.indexOf(";")>=0)||(txt.indexOf(" ")>=0)){
		document.getElementById("ema").innerHTML = "Адрес электронной почты был введен неправильно.";
		return false
		}
	dog = txt.indexOf("@");
		if (dog == -1) {
		document.getElementById("ema").innerHTML = "Нет символа\"@\" в поле адреса новой электронной почты";
		return false
		}
	if ((dog < 1) || (dog > txt.length - 5)) {
		document.getElementById("ema").innerHTML = "Адрес электронной почты был введен неправильно.";
		return false
		}
	if ((txt.charAt(dog - 1) == '.') || (txt.charAt(dog + 1) == '.')) {
		document.getElementById("ema").innerHTML = "Адрес электронной почты был введен неправильно.";
		return false
		}
}

var p = document.form_pr.tek_pass.value;
var p1 = document.form_pr.new_pass.value;
var p2 = document.form_pr.new_pass_povt.value;

	if((p1.length>0 || p2.length>0) && (p.length == 0)){
		document.getElementById("pass").innerHTML = "Вы не ввели действующий пароль!";
		return false;
	}
	
	if((p1.length==0 || p2.length==0) && (p.length > 0)){
		if(p1==""){
			document.getElementById("pass1").innerHTML = "Вы не заполнили поле для нового пароля!";
			return false;
		}
			if(p2==""){
			document.getElementById("pass2").innerHTML = "Вы не заполнили поле для повторного пароля!";
			return false;
		}
	}

	if(p1.length>0 || p2.length>0){
		if(p1==""){
			document.getElementById("pass1").innerHTML = "Вы не заполнили поле для нового пароля!";
			return false;
		}
			if(p2==""){
			document.getElementById("pass2").innerHTML = "Вы не заполнили поле для повторного пароля!";
			return false;
		}
		if(p1!=p2){
			document.getElementById("pass2").innerHTML = "Пароли не совпадают";
			return false;
		}
	}

}