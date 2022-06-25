window.addEventListener('DOMContentLoaded', function (event) {
    let b = document.getElementById("mybutt");
    b.addEventListener("click", function (event) {
        let topic_var = document.getElementById("topic");
        let description_var = document.getElementById("description");
        
        if ((topic.value != 0)&&(description_var.value != 0))
            alert("Успешно!")
        else
            alert("Введите данные!");
        });
    });
