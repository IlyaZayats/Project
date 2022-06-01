window.addEventListener("DOMContentLoaded", function(event){

    let modal = {
        closeModal: ()=>{
          this.wrapper_1.style.display = "none";
          this.wrapper_2.style.display = "none";
          this.wrapper_3.style.display = "none";
          window.history.pushState({"formtoggle": false},"","lk_view_notifications.html");
        },
        openModal_1: ()=>{
          this.wrapper_1.style.display = "flex";
          window.history.pushState({"formtoggle": true},"","#form");
        },
        openModal_2: ()=>{
            this.wrapper_2.style.display = "flex";          
            window.history.pushState({"formtoggle": true},"","#form");
          },
        openModal_3: ()=>{
            this.wrapper_3.style.display = "flex";
            window.history.pushState({"formtoggle": true},"","#form");
        }
      };

  modal["show_button_1"] = document.getElementById("show_button_1");
  modal["wrapper_1"] = document.getElementById("wrapper_1");
  modal["close_1"] = document.getElementById("close_1"); //закрытие X

  modal["show_button_2"] = document.getElementById("show_button_2");
  modal["wrapper_2"] = document.getElementById("wrapper_2");
  modal["close_2"] = document.getElementById("close_2"); //закрытие X

  modal["show_button_3"] = document.getElementById("show_button_3");
  modal["wrapper_3"] = document.getElementById("wrapper_3");
  modal["close_3"] = document.getElementById("close_3"); //закрытие X


  modal.close_1.addEventListener("click",modal.closeModal);
  modal.show_button_1.onclick = modal.openModal_1;
  
  modal.close_2.addEventListener("click",modal.closeModal);
  modal.show_button_2.onclick = modal.openModal_2;

  modal.close_3.addEventListener("click",modal.closeModal);
  modal.show_button_3.onclick = modal.openModal_3;

}); 