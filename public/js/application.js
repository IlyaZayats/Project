$(document).ready(function (){

    const ajaxSend = (formData) => {
        fetch("http://194.67.116.171/drop_application", {
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
            .then(function (result){
                if(result['msg']===1){
                    location.href='http://194.67.116.171/application';
                }
            })
            .catch((error) => {
                alert(error);
            })
    };

    const forms = $("#dropForm");
    for (let i = 0; i < forms.length; i++) {
        $("#dropApplication").click(function (e) {
            e.preventDefault();
            let formData = new FormData(forms[i]);
            formData = Object.fromEntries(formData);
            ajaxSend(formData);
        });
    }

});