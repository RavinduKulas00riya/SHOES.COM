payhere.onCompleted = function onCompleted(orderId) {
    console.log("Payment completed. OrderID:" + orderId);
    placeOrder(orderId);
    // Note: validate the payment and show success or failure page to the customer
};

// Payment window closed
payhere.onDismissed = function onDismissed() {
    // Note: Prompt user to pay again or show an error page
    console.log("Payment dismissed");
};

// Error occurred
payhere.onError = function onError(error) {
    // Note: show an error page
    console.log("Error:" + error);
};

const provinceSelect = document.getElementById('province');
const citySelect = document.getElementById('city');
const street = document.getElementById('street');
const postal = document.getElementById('postal');
const fname = document.getElementById("fname");
const lname = document.getElementById("lname");

provinceSelect.addEventListener('change', function () {
    if (this.value !== '0') { // Check if an option other than "Select an option..." is selected
        citySelect.disabled = false;
        citySelect.style.cursor = 'pointer';
        loadCities();
    } else {
        citySelect.disabled = true;
        citySelect.style.cursor = 'not-allowed';

    }
});

function loadCities(callback) {
    let id = provinceSelect.selectedIndex;
    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            if (r.status == 200) {
                let t = r.responseText;
                let array = JSON.parse(t);

                citySelect.innerHTML = "";
                let option = document.createElement('option');
                option.value = 0;
                option.innerHTML = "Select an option...";
                option.className = 'text-muted';
                citySelect.appendChild(option);

                array.forEach(element => {
                    option = document.createElement('option');
                    option.value = element['id'];
                    option.innerHTML = element['name'];
                    citySelect.appendChild(option);
                });

                if (callback) {
                    callback();
                }
            } else {
                console.log(r.status + " " + r.responseText);
            }
        }
    };

    r.open("GET", "loadCitiesProcess.php?id=" + id, true);
    r.send();
}


const currentAddress = document.getElementById('current-address');

currentAddress.addEventListener('change', function () {

    if (currentAddress.checked) {

        loadAddress();
    } else {

        street.value = "";
        provinceSelect.selectedIndex = 0;
        citySelect.selectedIndex = 0;
        citySelect.disabled = true;
        citySelect.style.cursor = 'not-allowed';
        postal.value = "";
    }
});

function loadAddress() {

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {

            if (r.status == 200) {

                let t = r.responseText;
                if (t == "null") {
                    alert("No Address was found.");
                    currentAddress.checked = false;
                } else {
                    let address_data = JSON.parse(t);
                    street.value = address_data["street"];
                    provinceSelect.selectedIndex = address_data["province_id"];
                    citySelect.disabled = false;
                    citySelect.style.cursor = 'pointer';
                    loadCities(function () {
                        citySelect.value = address_data["city_id"];
                    });
                    postal.value = address_data["postal_code"];
                }
            }
        }
    }

    r.open("GET", "loadCurrentAddressProcess.php", true);
    r.send();
}


function placeOrder(orderId) {

    let saveAddress = document.getElementById("save-address");

    let f = new FormData();
    f.append('fname', fname.value);
    f.append('lname', lname.value);
    f.append('order_id', orderId);
    f.append('street', street.value);
    f.append('city', citySelect.options[citySelect.selectedIndex].text);
    f.append('postal', postal.value);

    if (saveAddress.checked) {

        f.append('saveAddress', true);
    }

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {

            if (r.status == 200) {

                let t = r.responseText;
                // if (t == "success") {
                //     window.location.href = 'home.php';
                // } else {
                     console.log(t);
                // }
                
            }
        }
    }

    r.open("POST", "placeOrderProcess.php", true);
    r.send(f);

}


// Show the payhere.js popup, when "PayHere Pay" is clicked
function openSandbox(products, total) {

    // console.log(products);

    // console.log(products.map(product => product[0]).join(", "));

    // console.log(new Intl.NumberFormat('en-US', {
    //     style: 'decimal',
    //     minimumFractionDigits: 2,
    //     maximumFractionDigits: 2
    // }).format(total));

    // console.log(user.email);

    if (fname.value == "") {

        alert("First name cannot be empty.");
    } else if (lname.value == "") {

        alert("Last name cannot be empty.");
    } else if (street.value == "") {

        alert("Address cannot be empty.");
    } else if (provinceSelect.selectedIndex == 0) {

        alert("Please select a province");
    } else if (citySelect.selectedIndex == 0) {

        alert("Please select a city.");
    } else if (postal.value == "") {

        alert("Postal Code cannot be empty.");
    } else {

        let f = new FormData();
        f.append("products", products.map(product => product[0]).join(", "));
        f.append("total", total);
        f.append("fname", fname.value);
        f.append("lname", lname.value);
        f.append("street", street.value);
        f.append("city", citySelect.options[citySelect.selectedIndex].text);

        let r = new XMLHttpRequest();

        r.onreadystatechange = function () {

            if (r.readyState == 4) {

                if (r.status == 200) {

                    let t = r.responseText;
                    let payment = JSON.parse(t);
                    payhere.startPayment(payment);
                }
            }
        }

        r.open("POST", "paymentProcess.php", true);
        r.send(f);

        // var hash = to_upper_case(md5(merchant_id + order_id + amount + currency + to_upper_case(md5(merchant_secret))));

        // Put the payment variables here
        // var payment = {
        //     "sandbox": true,
        //     "merchant_id": "1228954",    // Replace your Merchant ID
        //     "return_url": "http://localhost/shoes/home.php",     // Important
        //     "cancel_url": "http://localhost/shoes/cart.php",     // Important
        //     "notify_url": "http://sample.com/notify",
        //     "order_id": "ItemNo12345",
        //     "items": products.map(product => product[0]).join(", "),
        //     "amount": new Intl.NumberFormat('en-US', {
        //         style: 'decimal',
        //         minimumFractionDigits: 2,
        //         maximumFractionDigits: 2
        //     }).format(total),
        //     "currency": "LKR",
        //     "hash": "45D3CBA93E9F2189BD630ADFE19AA6DC", // *Replace with generated hash retrieved from backend
        //     "first_name": fname.value,
        //     "last_name": lname.value,
        //     "email": user.email,
        //     "phone": user.mobile,
        //     "address": "No.1, Galle Road",
        //     "city": "Colombo",
        //     "country": "Sri Lanka",
        //     "delivery_address": street.value,
        //     "delivery_city": provinceSelect.options[provinceSelect.selectedIndex].text,
        //     "delivery_country": "Sri Lanka",
        // };

        

    }
};