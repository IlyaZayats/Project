window.addEventListener("DOMContentLoaded",function(){
    const calculable = {
        "credit-cash":{
            "precent": 0.11,
        },
        "credit-dream":{
            "precent": 0.09,
        }
    };

    const sendApplication = (input) => {
        fetch("http://194.67.116.171/application/send", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(input)
        })
            .then(function (response){
                if(!response.ok)
                {
                    throw new Error(response.status);
                }
                return response.json();
            })
            .then(function (result){
                alert(result['msg']);
            })
            .catch((error) => {
                alert(error);
            })

    }


    const formc = document.getElementById('credit-calculation');
    const allBlocks= document.querySelectorAll('.calculator-credit-block');
    const calc_selector = document.getElementById("credit-type-selector");
    const ranges= document.querySelectorAll(".calculator-ranges");
    const fields = document.querySelectorAll(".calculator-numeric-fields");
    formc.classList.add('was-validated');
    let monthPrecent;
    function monthlyPayEval(){
        if(!formc.checkValidity()) return;
        const type = document.getElementById("credit-type-selector").value;
        if(calculable[type]==undefined) return;
        const perc = calculable[type]["precent"]/12;
        const activeBlock = Array.from(document.querySelectorAll('.calculator-credit-block')).filter(element=>element.style.display !== "none")[0];
        const amount = activeBlock.querySelector(".calculator-credit-amount input[type='number']").value;
        const dur = activeBlock.querySelector(".calculator-credit-period input[type='number']").value;
        monthPrecent = (amount*perc)/(1-(Math.pow((1+perc),-dur)));
        activeBlock.querySelector('.calculator-monthly').value = Math.round(monthPrecent);
        
    };
    function creditTypeChange(stringcomp){
        allBlocks.forEach((element)=>{
            if(element.classList.contains(`calculator-${stringcomp}-block`)) element.style.display="block";
            else element.style.display="none";
        });
        monthlyPayEval();
    };
    formc.addEventListener('submit', function (event) {
      event.preventDefault();
      if (!formc.checkValidity()) {
        event.stopPropagation();
        return;
    }
    let input = Object.fromEntries(new FormData(event.target));
    const creType = input['credit-type'];
    let filteredInput = {};
    filteredInput['credit-type']= creType;
    for (const [key,value] of Object.entries(input)){
        if (key.includes(creType)){
            filteredInput[key]=value;
        }
    }
    if(calculable[creType]!= undefined){
        filteredInput['monthlyPayment']= monthPrecent.toFixed();
    }
    filteredInput['_token'] = document.querySelector('#calculatorModal').querySelector('input[name="_token"]').value;
    console.log(filteredInput);

    sendApplication(filteredInput);

    }, false);

    creditTypeChange(calc_selector.value);
    const btn_toggle= document.querySelectorAll(".btn-calculator-toggle");
    btn_toggle.forEach((element)=>{
        const reg=/^credit|card|cash|dream$/;
        element.addEventListener('click',(e)=>{
           const template= e.target.name.split('-').filter((elem)=>elem.match(reg)).join('-');
           calc_selector.value=template;
           creditTypeChange(template);
        });
    });
    calc_selector.addEventListener('change',(e)=>{
        creditTypeChange(e.target.value);
    });
    ranges.forEach((element)=>{
        element.addEventListener('input',(e)=>{
           const field = e.target.closest(".calculator-input-group").querySelector("input[type='number']");
           (field.value!==e.target.value)? field.value=e.target.value : '';
           monthlyPayEval();
        })
    });
    fields.forEach((element)=>{
        element.addEventListener('change',(e)=>{
            const field = e.target.closest(".calculator-input-group").querySelector("input[type='range']");
            if(!(e.target.value)) return;
            (parseInt(e.target.value) < parseInt(field.attributes.getNamedItem('min').value))? e.target.value = field.attributes.getNamedItem('min').value: null;
            (parseInt(e.target.value) > parseInt(field.attributes.getNamedItem('max').value))? e.target.value = field.attributes.getNamedItem('max').value: null;
            (field.value!==e.target.value)? field.value=e.target.value : '';
            monthlyPayEval();
            
        })
    });

});
