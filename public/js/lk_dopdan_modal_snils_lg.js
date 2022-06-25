/*  M O D A L   W I N D O W   F O R   S N I L S  */
// when large screen

window.addEventListener("DOMContentLoaded", function(event){

    let modal_snils = {
        closeModal_snils: ()=>{
          this.wrapper_snils_lg.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_additional_data.html");
        },
        openModal_snils_lg: ()=>{
          this.wrapper_snils_lg.style.display = "flex";
          window.history.pushState({"formtoggle": true},"","#form");
        }
      };

  modal_snils["show_button_snils_lg"] = document.getElementById("add-button-lg-4");
  modal_snils["wrapper_snils_lg"] = document.getElementById("wrapper_snils_lg");
  modal_snils["show_button_criminal_lg"] = document.getElementById("add-button-lg-5")
  modal_snils["show_button_ndfl_lg"] = document.getElementById("add-button-lg-3")
  //modal_snils["main_snils"] = document.getElementById("main_snils");
  //modal_snils["back-end-snils"] = document.getElementById("back-end-snils");
  modal_snils["close_snils_lg"] = document.getElementById("close_1-lg"); //закрытие X
  modal_snils["snils_lg"] = document.getElementById("snils-lg");
  modal_snils["submit_button_1_lg"] = document.getElementById("submit_button_1-lg");
  modal_snils["checkmark_1_lg"] = document.querySelector('input[name="check-4-lg"]');
  modal_snils["sms_lg"] = document.getElementById("sms_lg");

  modal_snils.close_snils_lg.addEventListener("click",modal_snils.closeModal_snils);
  modal_snils.show_button_snils_lg.onclick = modal_snils.openModal_snils_lg;

  function onClick_snils_lg() { 
    if ( modal_snils.snils_lg.value.length === 11){
      modal_snils.checkmark_1_lg.checked = true; //появляется галочка у снилс
      modal_snils.show_button_snils_lg.style.display = "none";//тут ещё пропадает кнопка "добавить" 
      modal_snils.show_button_criminal_lg.style.display = "block";//появляется доступ к кнопкe "добавить" у справки о судимости 
      modal_snils.show_button_ndfl_lg.style.display = "block";//и 2-ндфл
    }
    else modal_snils.sms_lg.innerHTML = "* Вам необходимо ввести 11 цифр!"
  }

  let button_snils_lg = modal_snils.submit_button_1_lg;
  button_snils_lg.addEventListener("click", onClick_snils_lg);

}); 


