
$(document).ready( function (){

    const ajaxSend = (formData) => {
        fetch("http://194.67.116.171/cabinet/notifications", {
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
            })
            .catch((error) => {
                alert(error);
            })
    }

    let msg_elems = document.querySelectorAll('.message-wrapper');
    console.log(msg_elems[0].querySelector('.msg-main-text').innerHTML);

    msg_elems.forEach(function (item){
        let flag = true;
        let id = item.querySelector('.msg-id').innerHTML;
        item.querySelector('.delete').addEventListener('click', function (event){
            flag = false;
            item.classList.add('d-none');
            document.querySelector('.id_s').value = id;
            document.querySelector('.type_s').value = 'shown';
            const forms = $("#shown");
            for(let i=0; i<forms.length; i++){
                event.preventDefault();

                let formData = new FormData(forms[i]);
                formData = Object.fromEntries(formData);

                if(item.querySelector('#headerMsg').classList.contains('new-msg')){
                    let amount_value = $('.badge').text();
                    $('.badge').text(amount_value - 1);
                }

                ajaxSend(formData);
            }

        });
        if(flag) {
            item.addEventListener('click', function (event) {
                let msg_header = item.querySelector('.text-msg-header').innerHTML;
                let msg_title = item.querySelector('.text-msg-body').innerHTML;
                let msg_body = item.querySelector('.msg-main-text').innerHTML;
                let msg_date = item.querySelector('.send-date').innerHTML;

                if(!item.classList.contains('d-none')) {
                    const modal = new bootstrap.Modal(document.querySelector('#msgModal'));

                    if(item.querySelector('#headerMsg').classList.contains('new-msg')) {
                        let amount_value = $('.badge').text();
                        $('.badge').text(amount_value - 1);
                    }

                    item.querySelector('#headerMsg').classList.remove("new-msg");

                    $(".msg-title").text(msg_header+':');
                    $(".msg-extra").text(msg_title);
                    $(".msg-body").text(msg_body);
                    $(".msg-date").text(msg_date);
                    modal.show();

                    $('.msg-close').click( e =>{
                        modal.hide();
                    });
                }

                if(!item.querySelector('.message-header').classList.contains('old-msg')) {
                    document.querySelector('.id_v').value = id;
                    document.querySelector('.type_v').value = 'viewed';
                    const forms = $("#viewed");
                    for (let i = 0; i < forms.length; i++) {
                        event.preventDefault();

                        let formData = new FormData(forms[i]);
                        formData = Object.fromEntries(formData);

                        ajaxSend(formData);
                    }
                }
                item.querySelector('#headerMsg').classList.add('old-msg');
            });
        }
    });
});