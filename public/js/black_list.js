$(document).ready(function (){
	
	/*
	let age = $('#userAge');
	let error = false;
	age.change(event=>{
		let value = event.target.value;
		let re = /^\d+$/;
		if(value=="" || !(re.test(value))){
			document.getElementById("err").innerHTML = "Необходимо заполнить поле возраст";
			error = true;
		}
		if(value < 14 || value > 150){
			document.getElementById("err").innerHTML = "Необходимо ввести корректный возраст";
			error = true;			
		}
		else document.getElementById("err").innerHTML = "";
	});
	
	let doki = $('#userProsr');
	doki.change(event=>{
		let prov = event.target.value;
		if(prov == -1){
			document.getElementById("err").innerHTML = "Необходимо выбрать ответ на результат проверки документов";
			error = true;
		}
		else document.getElementById("err").innerHTML = "";
	});
	*/
	
	let errors_fields = [".itn", ".text"];
    let start_errors = Array(errors_fields.length).fill(true);
	let reg_exps = [/^\d+$/,/^[0-9a-zA-Z-_а-яА-Я]+$/];
    let errors = Array(errors_fields.length).fill(true);
    let modal_flag = false;
	let re = /^\d+$/;
	
	function printError(field, message){
      $(field).text(message);
    }

	function validate(){
		$("#userInn").change(event => {
            start_errors[0] = false;
            let target = event.target.value;
            errors[0] = false;
            if(target === ""){
                errors[0] = true;
                printError(errors_fields[0],"Введите ИНН!");
            }else if (!reg_exps[0].test(target)){
                errors[0] = true;
                printError(errors_fields[0],"Используются недопустимые символы!");
			}
			else if(target.length !== 12){
				errors[0] = true;
                printError(errors_fields[0],"В ИНН 12 цифр!");
			}
            if(!errors[0]){
                printError(errors_fields[0],"");
            }
        });
		
		$("#userText").change(event => {
            start_errors[1] = false;
            let target = event.target.value;
            errors[1] = false;
            if(target === ""){
                errors[1] = true;
                printError(errors_fields[1],"Введите текст!");
            }else if (!reg_exps[1].test(target)){
				errors[1] = true;
				printError(errors_fields[1],"Используются недопустимые символы!");
			}
            if(!errors[1]){
                printError(errors_fields[1],"");
            }
        });
	}
	
	validate();
	
	let data = document.querySelectorAll(".data");
	const ajaxSend = (formData) => {
		fetch("http://194.67.116.171/black_list", {
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
				start_errors = Array(errors_fields.length).fill(true);
				data.forEach((element) => { element.value = ""; });
				return response.json();
			})
			.then(result => {
				const modal = new bootstrap.Modal(document.querySelector('#responseModal'));

				let modal_title, modal_body, button_text;

				if(result['msg']===1){
					modal_title = 'Успешно!';
					modal_body = 'Клиент был добавлен в афроамериканский(осуждаем чёрных) список!'+' Code: '+result['code'];
					button_text = 'Перейти к другим заявкам';
				} else {
					modal_title = 'Ошибка!';
					modal_body = 'Произошла ошибка! Попробуйте еще раз!'+' Code: '+result['code'];
					button_text = 'Понятно';
				}
				$(".response-title").text(modal_title);
				$(".response-body").text(modal_body);
				$(".modal-button").html(button_text);

				modal.show();

				errors = Array(errors_fields.length).fill(true);
				start_errors = Array(errors_fields.length).fill(true);
				$('.modal-button').click(event => {
					if(result['msg']===1){
						location.href = 'http://194.67.116.171/cabinet';
					} else {
						modal.hide();
					}
				});
				let modalElement = document.getElementById('responseModal');
				modalElement.addEventListener('hidden.bs.modal', event => {
					if(result['msg']===1)
						location.href = 'http://194.67.116.171/cabinet';
				});


			})
			.catch((error) => {
				if(error===422){
					const modal = new bootstrap.Modal(document.querySelector('#responseModal'));
					$(".response-title").text('Ошибка!');
					$(".response-body").text('Произошла ошибка валидации!'+' Code: '+error);
					$(".modal-button").html('Понятно');
					modal.show();
					errors = Array(errors_fields.length).fill(true);
					start_errors = Array(errors_fields.length).fill(true);
					$('.modal-button').click(event => {
						modal.hide();
					});
				} else {
					alert(error);
				}
			})
	};
	
	const empty_msg = new Map ([
		[".inn", "Введите ИНН!"],
		[".text", "Введите текст!"]
	]);
	
	const forms = $("#addToBlackList");
    for (let i = 0; i < forms.length; i++) {
        $("#addIntoBlackList").click(function (e) {

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