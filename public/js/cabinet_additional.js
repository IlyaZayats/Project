
let field_current = new Map();

//мапа с полями
const fields_all = new Map([
    ['passport_data', [
        [0, 'input[name="check-1"]'],
        [1, 'add-button-1'],
        [2, 'delete-button-1']
    ]],
    ['INIPA', [
        [0, 'input[name="check-4"]'],
        [1, 'add-button-4'],
        [2, 'add-button-5'],
        [3, 'add-button-3']
    ]],
    ['income_statement', [
        [0, 'input[name="check-3"]'],
        [1, 'add-button-3'],
        [2, 'delete-button-3']
    ]],
    ['criminal_record', [
        [0, 'input[name="check-5"]'],
        [1, 'add-button-5'],
        [2, 'delete-button-5']
    ]]
]);

//допустимые типы данных
const file_types = [
    'image/png',
    'image/jpeg',
    'application/pdf'
];

//fetch снилса либо паспорта
const addAdditional = (formData) => {
    fetch("http://194.67.116.171/cabinet/additional_data/add", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(formData)
    })
        .then(function (response) {
            if (!response.ok) {
                throw new Error(response.status);
            }
            return response.json();
        })
        .then(result =>{
            if(result['msg'] === 1 || result['msg']===0) {
                switch (result['additional_type']) {
                    case 'passport_data': {
                        field_current = fields_all.get('passport_data');
                        break;
                    }
                    case 'INIPA': {
                        field_current = fields_all.get('INIPA');
                        break;
                    }
                    default :{
                        throw new Error(result['additional_type']);
                    }
                }

                //alert(field_current[0][1]);

                document.querySelector(field_current[0][1]).checked = true;
                document.getElementById(field_current[1][1]).style.display = "none";
                document.getElementById(field_current[2][1]).style.display = "block";
                if(result['additional_type'] === 'INIPA'){
                    document.getElementById(field_current[3][1]).style.display = "block";
                }
            } else {
                throw new Error(result['msg']);
            }
        })
        .catch((error) => {
            alert(error);
        })
}

//удаление доп данных
const removeAdditional = (formData) => {
    fetch("http://194.67.116.171/cabinet/additional_data/delete", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(formData)
    })
        .then(function (response) {
            if (!response.ok) {
                throw new Error(response.status);
            }
            return response.json();
        })
        .then( result =>{
            if(result['msg'] === 1 || result['msg']===0) {
                switch (result['additional_type']) {
                    case 'passport_data': {
                        field_current = fields_all.get('passport_data');
                        break;
                    }
                    case 'income_statement': {
                        field_current = fields_all.get('income_statement');
                        break;
                    }
                    case 'criminal_record': {
                        field_current = fields_all.get('criminal_record');
                        break;
                    }
                    default :{
                        throw new Error(result['additional_type']);
                    }
                }
                document.querySelector(field_current[0][1]).checked = false;
                document.getElementById(field_current[2][1]).style.display = "none";
                document.getElementById(field_current[1][1]).style.display = "block";
            } else {
                throw new Error(result['msg']);
            }
        })
        .catch((error) => {
            alert(error);
        })
}

//добавление криминала или ндфл
const addAdditionalFile = (formData) => {
    fetch("http://194.67.116.171/cabinet/additional_data/addFile", {
        method: "POST",
        body: formData
    })
        .then(function (response) {
            if (!response.ok) {
                throw new Error(response.status);
            }
            return response.json();
        })
        .then(function (result){
            //alert(result['msg']);
            if(result['msg'] === 1 || result['msg']===0) {
                switch (result['additional_type']) {
                    case 'income_statement': {
                        field_current = fields_all.get('income_statement');
                        break;
                    }
                    case 'criminal_record': {
                        field_current = fields_all.get('criminal_record');
                        break;
                    }
                    default :{
                        throw new Error(result['additional_type']);
                    }
                }
                console.log(field_current);
                document.querySelector(field_current[0][1]).checked = true;
                document.getElementById(field_current[1][1]).style.display = "none";
                document.getElementById(field_current[2][1]).style.display = "block";
            } else {
                throw new Error(result['msg']);
            }
        })
        .catch((error) => {
            alert(error);
        })
}

//формирование данных
function formDataAdd(data_type){
    const form = $('#'+data_type+'ID');
    for(let i=0; i<form.length; i++){
        let formData = new FormData(form[i]);
        formData = Object.fromEntries(formData);
        addAdditional(formData);
    }
}

//формирование файловых данных
function formDataAddFile(data_type){
    //const form = $('#'+data_type+'ID');
    console.log(document.querySelector('#'+data_type+'ID'));
    const formData = new FormData(document.querySelector('#'+data_type+'ID'));
    console.log(formData);
    addAdditionalFile(formData);
    // for(let i=0; i<form.length; i++){
    //
    // }
}

//формирование данных на удаление
function formDataDelete(data_type){
    const form = $('#deleteForm');
    $('.remove-type').val(data_type);
    for(let i=0; i<form.length; i++){
        let formData = new FormData(form[i]);
        formData = Object.fromEntries(formData);
        removeAdditional(formData);
    }
}

$(document).ready(function (){
    //criminal/////////////////////////////////////////////////////////////////////////////////////////////
    //add
    document.getElementById("submit_button_5").addEventListener("click", function (event){
        event.preventDefault();
        if (document.getElementById("criminal_id").files.length && file_types.includes(document.getElementById("criminal_id").files[0].type)) {
            formDataAddFile('criminal_record');
        }
        else document.getElementById("sms_criminal").innerHTML = "Файл должен быть формата .jpg, .png, .pdf!";
    });
    //delete
    document.getElementById("yes_criminal").addEventListener("click", function (event){
        event.preventDefault();
        const modal = new bootstrap.Modal(document.querySelector('#CriminalDelete'));
        modal.hide();
        formDataDelete('criminal_record');
    });
    //////////////////////////////////////////////////////////////////////////////////////////////////////

    //ndfl////////////////////////////////////////////////////////////////////////////////////////////////
    //add
    document.getElementById("submit_button_3").addEventListener("click", function (event){
        event.preventDefault();
        if (document.getElementById("ndfl_id").files.length && file_types.includes(document.getElementById("ndfl_id").files[0].type)) {
            formDataAddFile('income_statement');
        }
        else document.getElementById("sms_ndfl").innerHTML = "Файл должен быть формата .jpg, .png, .pdf!";
    });
    //delete
    document.getElementById("yes_ndfl").addEventListener("click", function (event){
        event.preventDefault();
        const modal = new bootstrap.Modal(document.querySelector('#NdflDelete'));
        modal.hide();
        formDataDelete('income_statement');
    });
    //////////////////////////////////////////////////////////////////////////////////////////////////////

    //passport//////////////////////////////////////////////////////////////////////////////////////////////
    //add
    document.getElementById("submit_button_1").addEventListener("click", function (event){
        event.preventDefault();
        let re = /^\d+$/;
        const modal = new bootstrap.Modal(document.querySelector('#PassportAdd'));
        if (document.getElementById("passport").value.length === 10 && re.test(document.getElementById("passport").value)){
            modal.hide();
            $('.passport-output').text(document.getElementById("passport").value);
            formDataAdd('passport_data', document.getElementById("passport").value, '');
        }
        else document.getElementById("sms_passport").innerHTML = "Неверно введён паспорт!";
    });
    //delete
    document.getElementById("yes_passport").addEventListener("click", function (event){
        event.preventDefault();
        const modal = new bootstrap.Modal(document.querySelector('#PassportDelete'));
        modal.hide();
        $('.passport-output').text('');
        formDataDelete('passport_data');

    });
    //////////////////////////////////////////////////////////////////////////////////////////////////////

    //INIPA////////////////////////////////////////////////////////////////////////////////////////////////
    document.getElementById("submit_button_4").addEventListener("click", function (event){
        event.preventDefault();
        let re = /^\d+$/;
        if (document.getElementById("snils").value.length === 11 && re.test(document.getElementById("snils").value)){
            formDataAdd('INIPA', document.getElementById("snils").value, '');
        }
        else document.getElementById("sms_snils").innerHTML = "Неверно введён СНИЛС!";
    });
    //////////////////////////////////////////////////////////////////////////////////////////////////////

    document.querySelectorAll('.btn-close').forEach(function (item){
        item.addEventListener('click', function (event){
            event.preventDefault();
            const modal = new bootstrap.Modal(item.closest('.modal'));
            modal.hide();
        });
    });

});