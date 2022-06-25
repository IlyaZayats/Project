/*  M O D A L   W I N D O W   F O R   C R I M I N A L   R E C O R D   I N F O R M A T I O N  */
// when large screen

  window.addEventListener("DOMContentLoaded", function(event){

    let modal_criminal = {
        closeModal_criminal: ()=>{
          this.wrapper_criminal_lg.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_additional_data.html");
        },
        openModal_criminal_lg: ()=>{
          this.wrapper_criminal_lg.style.display = "flex";
          window.history.pushState({"formtoggle": true},"","#form");
        }
      };

    modal_criminal["show_button_criminal_lg"] = document.getElementById("add-button-lg-5");
    modal_criminal["delete_button_criminal_lg"] = document.getElementById("delete-button-5-lg");
    modal_criminal["wrapper_criminal_lg"] = document.getElementById("wrapper_criminal_lg");                          
    modal_criminal["close_criminal_lg"] = document.getElementById("close_2-lg"); //закрытие X                 
    modal_criminal["criminal_record_lg"] = document.getElementById("criminal_record-lg");
    modal_criminal["submit_button_2_lg"] = document.getElementById("submit_button_2-lg");
    modal_criminal["checkmark_2_lg"] = document.querySelector('input[name="check-5"]');

    modal_criminal.close_criminal_lg.addEventListener("click",modal_criminal.closeModal_criminal);
    modal_criminal.show_button_criminal_lg.onclick = modal_criminal.openModal_criminal_lg;

    function onClick_criminal_lg() {
      modal_criminal.checkmark_2_lg.checked = true; //появляется галочка у справки о судимости
      modal_criminal.show_button_criminal_lg.style.display = "none";//пропадает кнопка "добавить" у справки о судимости
      modal_criminal.delete_button_criminal_lg.style.display = "block";// появляется кнопка "удалить" у справки о судимости
    }

    let button_criminal_lg = modal_criminal.submit_button_2_lg;
    button_criminal_lg.addEventListener("click", onClick_criminal_lg);
    
  }); 
