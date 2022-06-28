/*  M O D A L   W I N D O W   F O R   S N I L S  */

window.addEventListener("DOMContentLoaded", function(event){

    let modal = {
        closeModal: ()=>{
          this.wrapper_snils.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_new_dopdan.html");
        },
        openModal: ()=>{
          this.wrapper_snils.style.display = "flex";
          window.history.pushState({"formtoggle": true},"","#form");
        }
      };

  modal["show_button_snils"] = document.getElementById("add-button-4");
  modal["wrapper_snils"] = document.getElementById("wrapper_snils");
  modal["show_button_criminal"] = document.getElementById("add-button-5")
  modal["show_button_ndfl"] = document.getElementById("add-button-3")
  modal["close_snils"] = document.getElementById("close_4"); //закрытие X
  modal["snils"] = document.getElementById("snils");
  modal["submit_button_1"] = document.getElementById("submit_button_4");
  modal["checkmark_1"] = document.querySelector('input[name="check-4"]');
  modal["sms_snils"] = document.getElementById("sms_snils");

  modal.close_snils.addEventListener("click",modal.closeModal);
  modal.show_button_snils.onclick = modal.openModal;

  function onClick_snils() { 
    if ( modal.snils.value.length === 11){
      modal.checkmark_1.checked = true; // появляется галочка у снилс
      modal.show_button_snils.style.display = "none";// пропадает кнопка "добавить" 
      modal.show_button_criminal.style.display = "block";// появляется доступ к кнопкe "добавить" у справки о судимости 
      modal.show_button_ndfl.style.display = "block";// и 2-ндфл
    }
    else modal.sms_snils.innerHTML = "* Вам необходимо ввести 11 цифр!";
  }

  let button_snils = modal.submit_button_1;
  button_snils.addEventListener("click", onClick_snils);
  
}); 


