function sendform() {
		let rating = document.getElementById("rating").value;
		if(rating == 2){
			document.getElementById("rat_cl").style.visibility = "visible";
			document.getElementById("new_predl").style.visibility = "visible";
			document.getElementById("table").style.visibility = "visible";
			document.getElementById("input_bd").style.visibility = "visible";
			document.getElementById("send_otch").style.visibility = "visible";
			return false;
		}
		
		document.getElementById("rat_cl").style.visibility = "visible";
		document.getElementById("input_bd").style.visibility = "visible";
		document.getElementById("send_otch").style.visibility = "visible";
		return false;
}