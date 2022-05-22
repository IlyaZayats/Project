/*  M O D A L   W I N D O W   F O R   C R I M I N A L   R E C O R D   I N F O R M A T I O N  */

  window.addEventListener("DOMContentLoaded", function(event){

    let modal_criminal = {
        closeModal_criminal: ()=>{
          this.wrapper_criminal.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_additional_data.html");
        },
        openModal_criminal: ()=>{
          this.wrapper_criminal.style.display = "flex";
          window.history.pushState({"formtoggle": true},"","#form");
        }
      };

    modal_criminal["show_button_criminal"] = document.getElementById("add-button-5");
    modal_criminal["delete_button_criminal"] = document.getElementById("delete-button-5");
    modal_criminal["wrapper_criminal"] = document.getElementById("wrapper_criminal");                          
    modal_criminal["close_criminal"] = document.getElementById("close_2"); //закрытие X                 
    modal_criminal["criminal_record"] = document.querySelectorAll(".criminal_record");
    modal_criminal["submit_button_2"] = document.getElementById("submit_button_2");
    modal_criminal["checkmark_2"] = document.querySelector('input[name="check-5"]');
  
    modal_criminal.close_criminal.addEventListener("click",modal_criminal.closeModal_criminal);
    modal_criminal.show_button_criminal.onclick = modal_criminal.openModal_criminal;
  
    function onClick_criminal() {
      modal_criminal.checkmark_2.checked = true; //появляется галочка у справки о судимости
      modal_criminal.show_button_criminal.style.display = "none";//пропадает кнопка "добавить" у справки о судимости
      modal_criminal.delete_button_criminal.style.display = "block";// появляется кнопка "удалить" у справки о судимости
   }
  
    let button_criminal = modal_criminal.submit_button_2;
    button_criminal.addEventListener("click", onClick_criminal);
    
  }); 
