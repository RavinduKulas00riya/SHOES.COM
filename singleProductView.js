const boxes = document.querySelectorAll("ul li");
let size_id = 0;

let countDiv = document.getElementById("count-div");
let count = document.getElementById("count");

let urlParams = new URLSearchParams(window.location.search);
let shoe_id = urlParams.get('id');


boxes.forEach(box => {
    box.addEventListener("click", () => {

        countDiv.style.display = 'flex';

        boxes.forEach(b => b.classList.remove("active"));
        box.classList.add("active");
        let qty = box.getAttribute('data-qty');
        size_id = box.id;

        var amount = document.getElementById("amount");

        if (qty == 0) {
            count.textContent = "Out of Stock";
            count.style.color = "red";
            amount.disabled = true;
            amount.value = 1;
        } else {
            count.innerHTML = qty + " Available";
            count.style.color = "black";
            amount.disabled = false;
            amount.value = 1;
            amount.max = qty;
        }

    });
});

function increaseQty(button) {

    if (size_id == 0) {
        alert('Please Choose a Size First');
    } else if (count.textContent == "Out of Stock") {
        alert('This product is Out of Stock');
    } else {

        let input = button.previousElementSibling;
        let max = parseInt(input.max);
        let currentValue = parseInt(input.value);

        if (currentValue < max) {
            input.value = currentValue + 1;
        }
    }
}

function decreaseQty(button) {

    if (size_id == 0) {
        alert('Please Choose a Size First');
    } else if (count.textContent == "Out of Stock") {
        alert('This product is Out of Stock');
    } else {

        let input = button.nextElementSibling;
        let min = parseInt(input.min);
        let currentValue = parseInt(input.value);

        if (currentValue > min) {
            input.value = currentValue - 1;
        }
    }
}

function addToCart() {

    if (size_id == 0) {
        alert('Please Choose a Size First');
    } else if (count.textContent == "Out of Stock") {
        alert('This product is Out of Stock');
    } else {

        let amount = document.getElementById('amount').value;

        let f = new FormData();
        f.append("amount", amount);
        f.append("shoe_id", shoe_id);
        f.append('size_id', size_id);

        let r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.readyState == 4) {
                if (r.status == 200) {

                    let t = r.responseText;
                    alert(t);
                } else {
                    console.log(r.readyState);
                }
            }
        }

        r.open("POST", "addToCartProcess.php", true);
        r.send(f);
    }
}