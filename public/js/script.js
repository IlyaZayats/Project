$(document).ready(function () {
    
  
    var acc = document.getElementsByClassName("accordion");
    var i;
  
    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function () {
        this.classList.toggle("accordion-active");
        var our_text = this.lastElementChild;
        if (our_text.style.maxHeight) {
          our_text.style.maxHeight = null;
        } else {
          our_text.style.maxHeight = our_text.scrollHeight + "px";
        }
      });
    }
  });