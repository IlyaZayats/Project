function sendform() {
		let iin = document.getElementById("need_to_check").value;
		if((iin == 'e') || (iin<100000000000) || (iin > 999999999999)){
			document.getElementById("msg").innerHTML = "Неверно указан ИНН";
			document.getElementById("editing").style.visibility = "hidden";
			document.getElementById("deleting").style.visibility = "hidden";
			return false;
		}
		
		document.getElementById("editing").style.visibility = "visible";
		document.getElementById("deleting").style.visibility = "visible";
		document.getElementById("msg").innerHTML = "";
		return false
}