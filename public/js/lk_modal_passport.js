/*  M O D A L   W I N D O W   F O R   P A S S P O R T  */

window.addEventListener("DOMContentLoaded", function(event){

  function onClick_passport() {
      if (document.getElementById("passport").value.length === 10){
        document.querySelector('input[name="check-1"]').checked = true; //появляется галочка у "паспорт"
        document.getElementById("add-button-1").style.display = "none";//пропадает кнопка "добавить" у "паспорт"
        document.getElementById("delete-button-1").style.display = "block";// появляется кнопка "удалить" у "паспорт"
      }
      else document.getElementById("sms_passport").innerHTML = "* Вам необходимо ввести 10 цифр!";
  }
  
  function fromClick_passport() {
    document.querySelector('input[name="check-1"]').checked = false; //пропадает галочка у "паспорт"
    document.getElementById("delete-button-1").style.display = "none";//пропадает кнопка "удалить" у "паспорт"
    document.getElementById("add-button-1").style.display = "block";// появляется кнопка "добавить" у "паспорт"
  }
    
  document.getElementById("submit_button_1").addEventListener("click", onClick_passport); // добавить данные паспорта
  document.getElementById("yes_passport").addEventListener("click", fromClick_passport); // удалить данные паспорта
  

});

/*
window.addEventListener("DOMContentLoaded", function(event){

    let modal = {
        closeModal: ()=>{
          this.wrapper_passport.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_new_dopdan.html");
        },
        closeModal_delete: ()=>{
            this.wrapper_passport_delete.style.display = "none";
            window.history.pushState({"formtoggle": false},"","lk_new_dopdan.html");
          },  
        openModal: ()=>{
          this.wrapper_passport.style.display = "flex";
          window.history.pushState({"formtoggle": true},"","#form");
        },
        openModal_delete: ()=>{
            this.wrapper_passport_delete.style.display = "flex";
            window.history.pushState({"formtoggle": true},"","#form");
        }  
    };
    
    modal["show_button_passport"] = document.getElementById("add-button-1");
    modal["delete_button_passport"] = document.getElementById("delete-button-1");
    modal["wrapper_passport"] = document.getElementById("wrapper_passport"); 
    modal["wrapper_passport_delete"] = document.getElementById("wrapper_passport_delete");                                                   
    modal["close_passport"] = document.getElementById("close_1"); //закрытие X
    modal["close_delete"] = document.getElementById("close_1_delete"); //закрытие X                                  
    modal["passport"] = document.getElementById("passport");
    modal["submit_button_1"] = document.getElementById("submit_button_1");
    modal["checkmark_1"] = document.querySelector('input[name="check-1"]');
    modal["sms_passport"] = document.getElementById("sms_passport");
    modal["yes_passport"] = document.getElementById("yes_passport");    
    modal["no_passport"] = document.getElementById("no_passport");
  
    modal.close_passport.addEventListener("click",modal.closeModal);
    modal.close_delete.addEventListener("click",modal.closeModal_delete);
    modal.no_passport.addEventListener("click",modal.closeModal_delete);
    modal.show_button_passport.onclick = modal.openModal;
    modal.delete_button_passport.onclick = modal.openModal_delete;
  
   function onClick_passport() {
    if ( modal.passport.value.length === 10){
      modal.checkmark_1.checked = true; //появляется галочка у "паспорт"
      modal.show_button_passport.style.display = "none";//пропадает кнопка "добавить" у "паспорт"
      modal.delete_button_passport.style.display = "block";// появляется кнопка "удалить" у "паспорт"
    }
    else modal.sms_passport.innerHTML = "* Вам необходимо ввести 10 цифр!";
  }

  function fromClick_passport() {
    modal.checkmark_1.checked = false; //пропадает галочка у "паспорт"
    modal.delete_button_passport.style.display = "none";//пропадает кнопка "удалить" у "паспорт"
    modal.show_button_passport.style.display = "block";// появляется кнопка "добавить" у "паспорт"
}
  
    modal.submit_button_1.addEventListener("click", onClick_passport);
    modal.yes_passport.addEventListener("click", fromClick_passport);
    
  }); */
