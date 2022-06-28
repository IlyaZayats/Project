window.addEventListener('DOMContentLoaded', function (event) {
    let b = document.getElementById("mybutt");
    b.addEventListener("click", function (event) {
        let inn_var = document.getElementById("inn");
        let chs_var = document.getElementById("chs");
        
        if (inn_var.value == 0)
		showError('inn', 'Заполните поле!');
        if (chs_var.value == 0)
                chsError('chs', 'Заполните поле!');
        if ((inn_var.value != 0)&&(inn_var.value.length != 12))
		showError('inn', 'Проверьте ИНН!');
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


function chsError(field, chserrorMessage) {
	var errorSpan = document.createElement("span");
	var chserrorMessage = document.createTextNode(chserrorMessage);

	errorSpan.appendChild(chserrorMessage);
	errorSpan.className = "chserrorMsg";

	var fieldLabel = document.getElementById(field).previousSibling;
	while (fieldLabel.nodeName.toLowerCase() != "label") {
		fieldLabel = fieldLabel.previousSibling;
	}
	fieldLabel.appendChild(errorSpan);
}
