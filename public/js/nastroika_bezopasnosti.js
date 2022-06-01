function checkmailandpass()
{
var txt = document.form_pr.address.value;
if(txt.length>0){
	if (txt.indexOf(".") == -1) {
		alert("Нет символа\".\" в поле адреса новой электронной почты");
		return false
		}
	if((txt.indexOf(",")>=0)||(txt.indexOf(";")>=0)||(txt.indexOf(" ")>=0)){
		alert("Адрес электронной почты был введен неправильно.");
		return false
		}
	dog = txt.indexOf("@");
		if (dog == -1) {
		alert("Нет символа\"@\" в поле адреса новой электронной почты");
		return false
		}
	if ((dog < 1) || (dog > txt.length - 5)) {
		alert("Адрес электронной почты был введен неправильно.");
		return false
		}
	if ((txt.charAt(dog - 1) == '.') || (txt.charAt(dog + 1) == '.')) {
	alert("Адрес электронной почты был введен неправильно.");
		return false
		}
}

var p1 = document.form_pr.new_pass.value;
var p2 = document.form_pr.new_pass_povt.value;
if(p1.length>0 || p2.length>0){
	if(p1==""){
		alert("Вы не заполнили поле для нового пароля!");
		return false;
	}
		if(p2==""){
		alert("Вы не заполнили поле для повторного пароля!");
		return false;
	}
	if(p1!=p2){
		alert("Пароли не совпадают");
		return false;
	}
}
}