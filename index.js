let email = document.getElementById("email");
let password = document.getElementById("password");
let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

let button = document.getElementById("login");

email.addEventListener("keyup", checkValidation);
password.addEventListener("keyup", checkValidation);

function checkValidation() {

    if (emailRegex.test(email.value) && password.value.length > 4) {

        button.style.opacity = '1';
        button.style.fontSize = '16.5px';
        button.style.transform = 'scale(1.05)';
    }else{

        button.style.opacity = '0.6';
        button.style.fontSize = '16px';
        button.style.transform = 'scale(1)';
    }
}

function login() {
    var rememberMe = document.getElementById("rm").checked;

    if (!email.value) {
        alert("Email field is empty.");
    } else if (!emailRegex.test(email.value)) {
        alert("Please enter a valid email address.");
    } else if (password.value.length < 4) {
        alert("Invalid Password.");
    } else {

        var f = new FormData();
        f.append("email", email.value);
        f.append("password", password.value);
        f.append("rememberMe", rememberMe);

        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "success") {

                    window.location.href = "home.php";
                } else {
                    alert(t);
                }
            }
        };

        r.open("POST", "loginProcess.php", true);
        r.send(f);

    }

}