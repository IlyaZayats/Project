/*  M O D A L   W I N D O W   F O R   2 - N D F L  for lk_add_guarantor.html  */

window.addEventListener("DOMContentLoaded", function(event){

  function onClick_ndfl() {
    if (document.getElementById("ndfl_id").files.length) {
      document.querySelector('input[name="check-3"]').checked = true; //появляется галочка у 2-ндфл
      document.getElementById("add-button-3").style.display = "none";//пропадает кнопка "добавить" у 2-ндфл
      document.getElementById("delete-button-3").style.display = "block";// появляется кнопка "удалить" у 2-ндфл
    }
    else document.getElementById("sms_ndfl").innerHTML = "ВЫ НЕ ДОБАВИЛИ ФАЙЛ!";
  }
   
  document.getElementById("submit_button_3").addEventListener("click", onClick_ndfl);


});

/*
window.addEventListener("DOMContentLoaded", function(event){

    let modal_ndfl = {
        closeModal_ndfl: ()=>{
          this.wrapper_ndfl.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_add_guarantor.html");
        },
        openModal_ndfl: ()=>{
          this.wrapper_ndfl.style.display = "flex";
          window.history.pushState({"formtoggle": true},"","#form");
      }
    };
    
    modal_ndfl["show_button_ndfl"] = document.getElementById("add-button-3");
    modal_ndfl["delete_button_ndfl"] = document.getElementById("delete-button-3");
    modal_ndfl["wrapper_ndfl"] = document.getElementById("wrapper_ndfl");                          
    modal_ndfl["close_ndfl"] = document.getElementById("close_3"); //закрытие X                 
    modal_ndfl["ndfl"] = document.getElementById(".ndfl");
    modal_ndfl["submit_button_3"] = document.getElementById("submit_button_3");
    modal_ndfl["checkmark_3"] = document.querySelector('input[name="check-3"]');
    modal_ndfl["sms_ndfl"] = document.getElementById("sms_ndfl");
  
    modal_ndfl.close_ndfl.addEventListener("click",modal_ndfl.closeModal_ndfl);
    modal_ndfl.show_button_ndfl.onclick = modal_ndfl.openModal_ndfl;
  
   function onClick_ndfl() {
    if (document.getElementById("ndfl_id").files.length) {
      modal_ndfl.checkmark_3.checked = true; //появляется галочка у 2-ндфл
      modal_ndfl.show_button_ndfl.style.display = "none";//пропадает кнопка "добавить" у 2-ндфл
      modal_ndfl.delete_button_ndfl.style.display = "block";// появляется кнопка "удалить" у 2-ндфл
    }
    else modal_ndfl.sms_ndfl.innerHTML = "ВЫ НЕ ДОБАВИЛИ ФАЙЛ!";
  }
  
    let button_ndfl = modal_ndfl.submit_button_3;
    button_ndfl.addEventListener("click", onClick_ndfl);
    
  }); */
