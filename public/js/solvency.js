window.addEventListener('DOMContentLoaded', function (event) {
    let b = document.getElementById("mybutt");
    b.addEventListener("click", function (event) {
        let income_var = document.getElementById("income");
        let duty_var = document.getElementById("duty");
        let solvency_var = document.getElementById("solvency");
        
	if (income_var.value == 0)
            showError('income', 'Заполните поле!');
        if (duty_var.value == 0)
            showError('duty', 'Заполните поле!');
        if ((income_var.value != 0)&&(duty_var.value != 0))
            solvency_var.innerHTML = Math.ceil(income_var.value * 0.8 - duty_var.value - 14000);
        });
    });


function showError(field, errorMessage) {
	var errorSpan = document.createElement("span");
	var errorMessage = document.createTextNode(errorMessage);

	errorSpan.appendChild(errorMessage);
	errorSpan.className = "errorMsg";

	var fieldLabel = document.getElementById(field).previousSibling;
	while (fieldLabel.nodeName.toLowerCase() != "label") {
		fieldLabel = fieldLabel.previousSibling;
	}
	fieldLabel.appendChild(errorSpan);
}
