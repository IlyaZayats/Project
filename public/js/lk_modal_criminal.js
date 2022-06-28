/*  M O D A L   W I N D O W   F O R   C R I M I N A L   R E C O R D   I N F O R M A T I O N  */

  window.addEventListener("DOMContentLoaded", function(event){

    let modal = {
        closeModal: ()=>{
          this.wrapper_criminal.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_new_dopdan.html");
        },
        closeModal_delete: ()=>{
          this.wrapper_criminal_delete.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_new_dopdan.html");
        },
        openModal: ()=>{
          this.wrapper_criminal.style.display = "flex";
          window.history.pushState({"formtoggle": true},"","#form");
        },
        openModal_delete: ()=>{
          this.wrapper_criminal_delete.style.display = "flex";
          window.history.pushState({"formtoggle": true},"","#form");
        }
      };

    modal["show_button_criminal"] = document.getElementById("add-button-5");
    modal["delete_button_criminal"] = document.getElementById("delete-button-5");
    modal["wrapper_criminal"] = document.getElementById("wrapper_criminal");
    modal["wrapper_criminal_delete"] = document.getElementById("wrapper_criminal_delete");                                                    
    modal["close_criminal"] = document.getElementById("close_5"); //закрытие X 
    modal["close_delete"] = document.getElementById("close_5_delete"); //закрытие X                                 
    modal["criminal_record"] = document.getElementById("criminal_record");
    modal["submit_button_2"] = document.getElementById("submit_button_5");
    modal["checkmark_2"] = document.querySelector('input[name="check-5"]');
    modal["sms_criminal"] = document.getElementById("sms_criminal");
    modal["yes_criminal"] = document.getElementById("yes_criminal");    
    modal["no_criminal"] = document.getElementById("no_criminal");

  
    modal.close_criminal.addEventListener("click",modal.closeModal);
    modal.close_delete.addEventListener("click",modal.closeModal_delete);
    modal.no_criminal.addEventListener("click",modal.closeModal_delete);
    modal.show_button_criminal.onclick = modal.openModal;
    modal.delete_button_criminal.onclick = modal.openModal_delete;
  
    function onClick_criminal() {
      if (document.getElementById("criminal_id").files.length) {
        modal.checkmark_2.checked = true; //появляется галочка у справки о судимости
        modal.show_button_criminal.style.display = "none";//пропадает кнопка "добавить" у справки о судимости
        modal.delete_button_criminal.style.display = "block";// появляется кнопка "удалить" у справки о судимости
      }
      else modal.sms_criminal.innerHTML = "ВЫ НЕ ДОБАВИЛИ ФАЙЛ!";
    }

   function fromClick_criminal() {
      modal.checkmark_2.checked = false; // пропадает галочка у справки о судимости
      modal.delete_button_criminal.style.display = "none";//пропадает кнопка "удалить" у справки о судимости
      modal.show_button_criminal.style.display = "block";// появляется кнопка "добавить" у справки о судимости
 }
  
    modal.submit_button_2.addEventListener("click", onClick_criminal);
    modal.yes_criminal.addEventListener("click", fromClick_criminal);
    
  }); 
