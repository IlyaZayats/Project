/*  M O D A L   W I N D O W   F O R   C R I M I N A L   R E C O R D   I N F O R M A T I O N  */
//when small screen  

  window.addEventListener("DOMContentLoaded", function(event){

    let modal_ndfl = {
        closeModal_ndfl: ()=>{
          this.wrapper_ndfl.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_additional_data.html");
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
    modal_ndfl["ndfl"] = document.querySelectorAll(".ndfl");
    modal_ndfl["submit_button_3"] = document.getElementById("submit_button_3");
    modal_ndfl["checkmark_3"] = document.querySelector('input[name="check-3"]');
  
    modal_ndfl.close_ndfl.addEventListener("click",modal_ndfl.closeModal_ndfl);
    modal_ndfl.show_button_ndfl.onclick = modal_ndfl.openModal_ndfl;
  
    function onClick_ndfl() {
      modal_ndfl.checkmark_3.checked = true; //появляется галочка у 2-ндфл
      modal_ndfl.show_button_ndfl.style.display = "none";//пропадает кнопка "добавить" у 2-ндфл
      modal_ndfl.delete_button_ndfl.style.display = "block";// появляется кнопка "удалить" у 2-ндфл
   }
  
    let button_ndfl = modal_ndfl.submit_button_3;
    button_ndfl.addEventListener("click", onClick_ndfl);
    
  }); 
