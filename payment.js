// Payment completed. It can be a successful failure.
payhere.onCompleted = function onCompleted(orderId) {
    console.log("Payment completed. OrderID:" + orderId);
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

// Show the payhere.js popup, when "PayHere Pay" is clicked
document.getElementById('payhere-payment').onclick = function (e) {

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {

            if (r.status == 200) {

                let t = r.responseText;
                let payment = JSON.parse(t);
                console.log(payment);
                console.log("Generated Hash:", payment.hash);
                payhere.startPayment(payment);
            }
        }
    }

    r.open("POST", "paymentProcess.php", true);
    r.send();


};