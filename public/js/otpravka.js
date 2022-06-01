let button = document.querySelector('.sendButton');
let textField = document.querySelector('.textField');

button.addEventListener("click", function() {
    if (textField.value === "")
    {
    alert("Заполните текстовое поле!");
    }
    textField.focus();
});