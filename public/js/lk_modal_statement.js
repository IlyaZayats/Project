/*  M O D A L   W I N D O W   F O R   S T A T E M E N T   for lk_add_guarantor.html  */

window.addEventListener("DOMContentLoaded", function(event){

  function onClick_statement() {
    if (document.getElementById("statement_id").files.length) {
      document.querySelector('input[name="check-2"]').checked = true; //появляется галочка у "заявлениие"
      document.getElementById("add-button-2").style.display = "none";//пропадает кнопка "добавить" у "заявление"
      document.getElementById("delete-button-2").style.display = "block";// появляется кнопка "удалить" у "заявление"
    }
    else document.getElementById("sms_statement").innerHTML = "ВЫ НЕ ДОБАВИЛИ ФАЙЛ!";
  }
  
    document.getElementById("submit_button_2").addEventListener("click", onClick_statement);


});

/*
window.addEventListener("DOMContentLoaded", function(event){

    let modal_statement = {
        closeModal_statement: ()=>{
          this.wrapper_statement.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_add_guarantor.html");
        },
        openModal_statement: ()=>{
          this.wrapper_statement.style.display = "flex";
          window.history.pushState({"formtoggle": true},"","#form");
      }
    };
    
    modal_statement["show_button_statement"] = document.getElementById("add-button-2");
    modal_statement["delete_button_statement"] = document.getElementById("delete-button-2");
    modal_statement["wrapper_statement"] = document.getElementById("wrapper_statement");                          
    modal_statement["close_statement"] = document.getElementById("close_2"); //закрытие X                 
    modal_statement["statement"] = document.getElementById(".statement");
    modal_statement["submit_button_2"] = document.getElementById("submit_button_2");
    modal_statement["checkmark_2"] = document.querySelector('input[name="check-2"]');
    modal_statement["sms_statement"] = document.getElementById("sms_statement");
  
    modal_statement.close_statement.addEventListener("click",modal_statement.closeModal_statement);
    modal_statement.show_button_statement.onclick = modal_statement.openModal_statement;
  
   function onClick_statement() {
    if (document.getElementById("statement_id").files.length) {
      modal_statement.checkmark_2.checked = true; //появляется галочка у "заявлениие"
      modal_statement.show_button_statement.style.display = "none";//пропадает кнопка "добавить" у "заявление"
      modal_statement.delete_button_statement.style.display = "block";// появляется кнопка "удалить" у "заявление"
    }
    else modal_statement.sms_statement.innerHTML = "ВЫ НЕ ДОБАВИЛИ ФАЙЛ!";
  }
  
    let button_statement = modal_statement.submit_button_2;
    button_statement.addEventListener("click", onClick_statement);
    
  }); */
