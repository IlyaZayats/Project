/*  M O D A L   W I N D O W   F O R   S N I L S  */
//when small screen

window.addEventListener("DOMContentLoaded", function(event){

    let modal_snils = {
        closeModal_snils: ()=>{
          this.wrapper_snils.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_additional_data.html");
        },
        openModal_snils: ()=>{
          this.wrapper_snils.style.display = "flex";
          window.history.pushState({"formtoggle": true},"","#form");
        }
      };

  modal_snils["show_button_snils"] = document.getElementById("add-button-4");
  modal_snils["show_button_criminal"] = document.getElementById("add-button-5");
  modal_snils["show_button_ndfl"] = document.getElementById("add-button-3");
  modal_snils["wrapper_snils"] = document.getElementById("wrapper_snils");
  //modal_snils["main_snils"] = document.getElementById("main_snils");
  //modal_snils["back-end-snils"] = document.getElementById("back-end-snils");
  modal_snils["close_snils"] = document.getElementById("close_1"); //закрытие X
  modal_snils["snils"] = document.querySelectorAll(".snils");
  modal_snils["submit_button_1"] = document.getElementById("submit_button_1");
  modal_snils["checkmark_1"] = document.querySelector('input[name="check-4"]');
  modal_snils["sms"] = document.getElementById("sms");

  modal_snils.close_snils.addEventListener("click",modal_snils.closeModal_snils);
  modal_snils.show_button_snils.onclick = modal_snils.openModal_snils;

  function onClick_snils() {
    if ( modal_snils.snils.value.length === 11){
      modal_snils.checkmark_1.checked = true; //появляется галочка у снилс
      modal_snils.show_button_snils.style.display = "none";//тут ещё пропадает кнопка "добавить" 
      modal_snils.show_button_criminal.style.display = "block";//появляется доступ к кнопкe "добавить" у справки о судимости 
      modal_snils.show_button_ndfl.style.display = "block";//и 2-ндфл
    }
    else modal_snils.sms.innerHTML = "* Вам необходимо ввести 11 цифр!"
  }

  let button_snils = modal_snils.submit_button_1;
  button_snils.addEventListener("click", onClick_snils);
  
}); 
