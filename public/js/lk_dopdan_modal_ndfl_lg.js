/*  M O D A L   W I N D O W   F O R   C R I M I N A L   R E C O R D   I N F O R M A T I O N  */
// when large screen

    window.addEventListener("DOMContentLoaded", function(event){

    let modal_ndfl = {
        closeModal_ndfl: ()=>{
          this.wrapper_ndfl_lg.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_additional_data.html");
        },
        openModal_ndfl_lg: ()=>{
          this.wrapper_ndfl_lg.style.display = "flex";
          window.history.pushState({"formtoggle": true},"","#form");
        }
    };

    modal_ndfl["show_button_ndfl_lg"] = document.getElementById("add-button-lg-3");
    modal_ndfl["delete_button_ndfl_lg"] = document.getElementById("delete-button-3-lg");
    modal_ndfl["wrapper_ndfl_lg"] = document.getElementById("wrapper_ndfl_lg");                          
    modal_ndfl["close_ndfl_lg"] = document.getElementById("close_3-lg"); //закрытие X                 
    modal_ndfl["ndfl_lg"] = document.getElementById("ndfl-lg");
    modal_ndfl["submit_button_3_lg"] = document.getElementById("submit_button_3-lg");
    modal_ndfl["checkmark_3_lg"] = document.querySelector('input[name="check-3-lg"]');

    modal_ndfl.close_ndfl_lg.addEventListener("click",modal_ndfl.closeModal_ndfl);
    modal_ndfl.show_button_ndfl_lg.onclick = modal_ndfl.openModal_ndfl_lg;

    function onClick_ndfl_lg() {
      modal_ndfl.checkmark_3_lg.checked = true; //появляется галочка у 2-ндфл
      modal_ndfl.show_button_ndfl_lg.style.display = "none";//пропадает кнопка "добавить" у 2-ндфл
      modal_ndfl.delete_button_ndfl_lg.style.display = "block";// появляется кнопка "удалить" у 2-ндфл
   }

    let button_ndfl_lg = modal_ndfl.submit_button_3_lg;
    button_ndfl_lg.addEventListener("click", onClick_ndfl_lg);
    
  }); 