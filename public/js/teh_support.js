window.addEventListener('DOMContentLoaded', function (event) {
    let b = document.getElementById("mybutt");
    b.addEventListener("click", function (event) {
        let topic_var = document.getElementById("topic");
        let description_var = document.getElementById("description");
        
        if (topic_var.value == 0)
            showError('topic', 'Заполните поле!');
        if (description_var.value == 0)
            chsError('description', 'Заполните поле!');
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
