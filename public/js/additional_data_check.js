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

	let errors_fields = [".age", ".doki"];
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
		$("#userAge").change(event => {
			start_errors[0] = false;
			let target = event.target.value;
			errors[0] = false;
			if(target === "") {
				errors[0] = true;
				printError(errors_fields[0], "Введите ваш возраст!");
			} else if(!re.test(target)) {
				errors[0] = true;
				printError(errors_fields[0], "Используются недопустимые символы!");
			} else if (target<14){
				errors[0] = true;
				printError(errors_fields[0],"Возраст не может быть меньше 14!");
			}
			else if (target>150){
				errors[0] = true;
				printError(errors_fields[0],"Возраст не может быть больше 150!");
			}
			if(!errors[0]){
				printError(errors_fields[0],"");
			}
		});

		$("#userDoc").change(event => {
			start_errors[1] = false;
			let target = event.target.value;
			errors[1] = false;
			if(target === ""){
				errors[1] = true;
				printError(errors_fields[1],"Выберите ответ на результат проверки документов!");
			} else if(!re.test(target)) {
				errors[1] = true;
				printError(errors_fields[1], "Используются недопустимые символы!");
			} else if (target===-1){
				errors[1] = true;
				printError(errors_fields[1],"Не выбран ответ на результат проверки документов!");
			}
			if(!errors[1]){
				printError(errors_fields[1],"");
			}
		});
	}

	validate();

	let data = document.querySelectorAll(".data");
	const ajaxSend = (formData) => {
		fetch("http://194.67.116.171/additional_data_check", {
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
				let modal_title_arr = ['Данные добавлены!', 'Данные изменены!', 'Ошибка!'];
				let modal_body_arr = ['Вы успешно добавили данные в БД!', 'Вы успешно обновили данные в БД!', 'Произошла ошибка! Данные не прошли валидацию, попробуйте еще раз.'];
				let modal_data = Array(2).fill('');
				switch (result['msg']){
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
				$(".response-body").text(modal_data[1]+' Code: '+result['msg'] + "DB-code:" + result['code']);

				errors = Array(errors_fields.length).fill(true);
				start_errors = Array(errors_fields.length).fill(true);
				modal.show();

				$('.modal-button').click(event => {
					modal.hide();
				});



			})
			.catch((error) => {
				alert(error);
			})
	};

	const empty_msg = new Map ([
		[".age", "Введите возраст!"],
		[".doki", "Выберите ответ на результат проверки документов!"]
	]);

	/*
	const forms = $("#insertIntoDB");
	for (let i = 0; i < forms.length; i++) {
		$("#vnesti_dannie_v_bd").click(function (e) {
			if(!error){
			e.preventDefault();
			let formData = new FormData(forms[i]);
			formData = Object.fromEntries(formData);
			ajaxSend(formData);
			}
			
		});
	}
	*/


	const forms = $("#insertIntoDB");
	for (let i = 0; i < forms.length; i++) {
		$("#vnesti_dannie_v_bd").click(function (e) {

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