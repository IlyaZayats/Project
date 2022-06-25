window.addEventListener('DOMContentLoaded', function (event) {
    let b = document.getElementById("mybutt");
    b.addEventListener("click", function (event) {
        let inn_var = document.getElementById("inn");
        let chs_var = document.getElementById("chs");
        
        if ((inn_var.value != 0)&&(chs_var.value != 0)&&(inn_var.value.length == 12))
            alert("Успешно!")
        else
            if ((inn_var.value != 0)&&(chs_var.value != 0))
                alert("Проверьте ИНН!")
            else
                alert("Введите данные!");
        });
    });
