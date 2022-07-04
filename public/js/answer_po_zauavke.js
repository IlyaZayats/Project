$(document).ready(function (){
	
	let errors_fields = [".text"];
    let start_errors = Array(errors_fields.length).fill(true);
    let errors = Array(errors_fields.length).fill(true);
    let modal_flag = false;
	let re = /^\d+$/;
	
	function printError(field, message){
      $(field).text(message);
    }
	
	function reloadScript(url) {
        let script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = url;
        document.documentElement.appendChild(script);
    }
	
	function validate(){
		$("#userText").change(event => {
            start_errors[0] = false;
            let target = event.target.value;
            errors[0] = false;
            if(target === ""){
                errors[0] = true;
                printError(errors_fields[0],"Введите текст!");
            }
            if(!errors[0]){
                printError(errors_fields[0],"");
            }
        });
	}
	
	validate();
	
	let data = document.querySelectorAll(".data");
	const ajaxSend = (formData) => {
		fetch("http://194.67.116.171/loan_response_message", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"Accept": "application/json"
			},
			body: JSON.stringify(formData)
		})
			.then(function (response) {
				if(!response.ok)
				{
					throw new Error(response.status);
				}
				return response.json();
			})
			.then(result => {
				const modal = new bootstrap.Modal(document.querySelector('#responseModal'));
				let modal_title_arr = ['Данные добавлены!', 'Данные изменены!', 'Ошибка!'];
				let modal_body_arr = ['Вы успешно добавили данные в БД!', 'Вы успешно обновили данные в БД!', 'Произошла ошибка! Данные не прошли валидацию, попробуйте еще раз.'];
				let modal_data = Array(2).fill('');
				switch (result['type']){
					case 0:
						modal_data[0] = modal_title_arr[0];
						modal_data[1] = modal_body_arr[0];
						break;
					case 1:
						modal_data[0] = modal_title_arr[1];
						modal_data[1] = modal_body_arr[1];
						break;
					case 2:
						modal_data[0] = modal_title_arr[2];
						modal_data[1] = modal_body_arr[2];
						break;
					default:
						alert("Ълядь!");
				}
				$(".response-title").text(modal_data[0]);
				$(".response-body").text(modal_data[1]+' Code: '+result['code']);

				modal.show();
				window.history.pushState({ "isActive": true }, "", "#modal");


			})
			.catch((error) => {
				alert(error);
			})
	};
	
	const empty_msg = new Map ([
		[".text", "Введите текст!"]
	]);
	
	const forms = $("#sendAnswerToClient");
    for (let i = 0; i < forms.length; i++) {
        $("sendAnswer").click(function (e) {

            let final_error = false;
            errors.forEach(function magic(item, index)
            {
                if(item){
                    final_error = item;
                } else {
                    $(errors_fields[index]).text("");
                }
            });
            if(!final_error) {
                e.preventDefault();
                let formData = new FormData(forms[i]);
                formData = Object.fromEntries(formData);
                ajaxSend(formData);
            } else {
                start_errors.forEach(function startValid(item, index){
                    if(item){
                        printError(errors_fields[index], empty_msg.get(errors_fields[index]));
                    }
                });
            }
        });
    }

});