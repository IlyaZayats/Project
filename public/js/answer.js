function sendform() {
	let infa = document.getElementById("answer");
	if(!infa.value.trim()){
		document.getElementById("err").innerHTML = "Заполните поле!";
		infa.style.borderColor="#FF0000";
		return false;
	}
	return true;
}