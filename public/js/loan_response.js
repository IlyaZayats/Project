$(document).ready(function(){
    let data = document.querySelectorAll(".data");
    const ajaxSend = (formData) => {
        fetch("http://194.67.116.171/rating", {
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
                let modal_title = $(".response-title");
                let modal_body =  $(".response-body");
                switch (result['msg']){
                    case -1:
                        modal_title.text('Ошибка!');
                        modal_body.text('Произошла ошибка, попробуйте еще раз.'+' Code: '+result['msg']+'. DB-code: ' +result['code']);
                        break;
                    case 0:
                        modal_title.text('Пользователю отказано в кредитовании!');
                        modal_body.text('Данный пользователь не удовлетворяет условиям нашего банка.'+' Code: '+result['msg']+'. DB-code: ' +result['code']);
                        break;
                    case 1:
                        if(result['rating'] === 2){
                            $("#newLoans").removeClass('d-none');
                            $(".sum-table").text(result['sum']);
                            $(".term-new-table").text(result['term_new']);
                            $(".fee-max-table").text(result['fee_max']);
                            $(".sum-new-table").text(result['sum_new']);
                            $(".term-table").text(result['term']);
                        }
                        $("#buttonDB").removeClass('d-none');
                        $("#buttonContract").removeClass('d-none');
                        break;
                    default:
                        alert("Ълядь!");
                }
                if(result['msg']!==1){
                    modal.show();
                }
                if(result['msg']!==-1){
                    $('#rating').val(result['rating']);
                    $("#ratingWrapper").removeClass('d-none');
                    $("#buttonMessage").removeClass('d-none');
                }
                $('.modal-button').click(event => {
                    modal.hide();
                });
            })
            .catch((error) => {
                alert(error);
            })
    };

    const forms = $("#getRatingForm");
    for (let i = 0; i < forms.length; i++) {
        $("#calculate").click(function (e) {
            e.preventDefault();
            $("#newLoans").addClass('d-none');
            $("#buttonContract").addClass('d-none');
            $("#buttonDB").addClass('d-none');
            $("#ratingWrapper").addClass('d-none');
            $("#buttonMessage").addClass('d-none');
            let formData = new FormData(forms[i]);
            formData = Object.fromEntries(formData);
            ajaxSend(formData);
        });
    }
});