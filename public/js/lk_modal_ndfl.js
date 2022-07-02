/*  M O D A L   W I N D O W   F O R   2 - N D F L  */

window.addEventListener("DOMContentLoaded", function(event){

  function onClick_ndfl() {
    if (document.getElementById("ndfl_id").files.length) {
      document.querySelector('input[name="check-3"]').checked = true; //появляется галочка у 2-ндфл
      document.getElementById("add-button-3").style.display = "none";//пропадает кнопка "добавить" у 2-ндфл
      document.getElementById("delete-button-3").style.display = "block";// появляется кнопка "удалить" у 2-ндфл
    }
    else document.getElementById("sms_ndfl").innerHTML = "ВЫ НЕ ДОБАВИЛИ ФАЙЛ!";
  }

  function fromClick_ndfl() {
    document.querySelector('input[name="check-3"]').checked = false; //пропадает галочка у 2-ндфл
    document.getElementById("delete-button-3").style.display = "none";//пропадает кнопка "удалить" у 2-ндфл
    document.getElementById("add-button-3").style.display = "block";// появляется кнопка "добавить" у 2-ндфл
  }
   
  document.getElementById("submit_button_3").addEventListener("click", onClick_ndfl);
  document.getElementById("yes_ndfl").addEventListener("click", fromClick_ndfl);

});

/*
window.addEventListener("DOMContentLoaded", function(event){

    let modal = {
        closeModal: ()=>{
          this.wrapper_ndfl.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_new_dopdan.html");
        },
        closeModal_delete: ()=>{
          this.wrapper_ndfl_delete.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_new_dopdan.html");
        },
        openModal: ()=>{
          this.wrapper_ndfl.style.display = "flex";
          window.history.pushState({"formtoggle": true},"","#form");
        },
        openModal_delete: ()=>{
          this.wrapper_ndfl_delete.style.display = "flex";
          window.history.pushState({"formtoggle": true},"","#form");
        }
    };
    
    modal["show_button_ndfl"] = document.getElementById("add-button-3");
    modal["delete_button_ndfl"] = document.getElementById("delete-button-3");
    modal["wrapper_ndfl"] = document.getElementById("wrapper_ndfl"); 
    modal["wrapper_ndfl_delete"] = document.getElementById("wrapper_ndfl_delete");                                                   
    modal["close_ndfl"] = document.getElementById("close_3"); //закрытие X
    modal["close_delete"] = document.getElementById("close_3_delete"); //закрытие X                                  
    modal["ndfl"] = document.getElementById(".ndfl");
    modal["submit_button_3"] = document.getElementById("submit_button_3");
    modal["checkmark_3"] = document.querySelector('input[name="check-3"]');
    modal["sms_ndfl"] = document.getElementById("sms_ndfl");
    modal["yes_ndfl"] = document.getElementById("yes_ndfl");    
    modal["no_ndfl"] = document.getElementById("no_ndfl");
  
    modal.close_ndfl.addEventListener("click",modal.closeModal);
    modal.close_delete.addEventListener("click",modal.closeModal_delete);
    modal.no_ndfl.addEventListener("click",modal.closeModal_delete);
    modal.show_button_ndfl.onclick = modal.openModal;
    modal.delete_button_ndfl.onclick = modal.openModal_delete;
  
   function onClick_ndfl() {
    if (document.getElementById("ndfl_id").files.length) {
      modal.checkmark_3.checked = true; //появляется галочка у 2-ндфл
      modal.show_button_ndfl.style.display = "none";//пропадает кнопка "добавить" у 2-ндфл
      modal.delete_button_ndfl.style.display = "block";// появляется кнопка "удалить" у 2-ндфл
    }
    else modal.sms_ndfl.innerHTML = "ВЫ НЕ ДОБАВИЛИ ФАЙЛ!";
  }

  function fromClick_ndfl() {
    modal.checkmark_3.checked = false; //пропадает галочка у 2-ндфл
    modal.delete_button_ndfl.style.display = "none";//пропадает кнопка "удалить" у 2-ндфл
    modal.show_button_ndfl.style.display = "block";// появляется кнопка "добавить" у 2-ндфл
}
  
    modal.submit_button_3.addEventListener("click", onClick_ndfl);
    modal.yes_ndfl.addEventListener("click", fromClick_ndfl);
    
  }); */
