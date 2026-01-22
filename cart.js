function increaseQty(button) {
    let input = button.previousElementSibling;
    let max = parseInt(input.max);
    let currentValue = parseInt(input.value);

    if (currentValue < max) {
        input.value = currentValue + 1;
    }
}

function decreaseQty(button) {
    let input = button.nextElementSibling;
    let min = parseInt(input.min);
    let currentValue = parseInt(input.value);

    if (currentValue > min) {
        input.value = currentValue - 1;
    }
}

function updateCart(param) {

    let obj = {};

    param.forEach(key => {

        let value = document.getElementById(key).value;

        obj[key] = value;
    });

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState === 4) { 
            if (r.status === 200) {
                console.log("Success:", r.responseText);
                window.location.reload(true);
            } else {
                alert("Please try again later");
                console.log("Error:", r.status, r.responseText);
            }
        }
    };

    r.open("POST", "updateCartProcess.php", true);
    r.setRequestHeader("Content-Type", "application/json");
    r.send(JSON.stringify(obj));
}

function removeFromCart(id){

    let r = new XMLHttpRequest();

    r.onreadystatechange = function(){

        if(r.readyState == 4){

            if(r.status == 200){

                let t = r.responseText;
                if(t == "success"){
                    window.location.reload(true);
                }else{
                    alert(t);
                }
            }
        }
    }

    r.open("GET","removeFromCartProcess.php?id="+id, true);
    r.send();
}