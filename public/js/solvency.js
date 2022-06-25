window.addEventListener('DOMContentLoaded', function (event) {
    let b = document.getElementById("mybutt");
    b.addEventListener("click", function (event) {
        let income_var = document.getElementById("income");
        let duty_var = document.getElementById("duty");
        let solvency_var = document.getElementById("solvency");
        
        if ((income_var.value != 0)&&(duty_var.value != 0))
            solvency_var.innerHTML = income_var.value * 0.8 - duty_var.value - 14000;
        else
            alert("Введите данные!");
        });
    });
