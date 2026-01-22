let fn = document.getElementById("fname");
let ln = document.getElementById("lname");
let e = document.getElementById("email");
let m = document.getElementById("mobile");
let p = document.getElementById("password");

let togglepw = document.getElementById("show-pw");
let toggleicon = document.getElementById("show-icon");

togglepw.addEventListener('click', () => {
    if (p.type === 'password') {
        p.type = 'text';
        toggleicon.className = 'bi bi-eye-slash-fill';
    } else {
        p.type = 'password';
        toggleicon.className = 'bi bi-eye-fill';
    }
});

let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
let mobileRegex = /^(?:\+?\d{1,3})?[ -]?\d{10}$/;

let button = document.getElementById("signup");

fn.addEventListener("keyup", checkValidation);
ln.addEventListener("keyup", checkValidation);
e.addEventListener("keyup", checkValidation);
m.addEventListener("keyup", checkValidation);
p.addEventListener("keyup", checkValidation);

function checkValidation() {

    if (emailRegex.test(e.value) && p.value.length > 4 && fn.value.length > 1 && ln.value.length > 1 && mobileRegex.test(m.value)) {

        button.style.opacity = '1';
        button.style.fontSize = '16.5px';
        button.style.transform = 'scale(1.05)';
    } else {

        button.style.opacity = '0.6';
        button.style.fontSize = '16px';
        button.style.transform = 'scale(1)';
    }
}

function signup() {

    if (!fn.value) {
        alert("First name field is empty");
    } else if (!ln.value) {
        alert("Last name field is empty");
    } else if (!emailRegex.test(e.value)) {
        alert("Please enter a valid email address");
    } else if (!mobileRegex.test(m.value)) {
        alert("Please enter a valid mobile number");
    } else if (p.value.length < 5) {
        alert("Password should be at least 5 characters");
    } else {

        var f = new FormData();
        f.append("fn", fn.value);
        f.append("ln", ln.value);
        f.append("e", e.value);
        f.append("m", m.value);
        f.append("p", p.value);

        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "success") {
                    window.location.href = "index.php";
                } else {
                    alert(t);
                }
            }
        }

        r.open("POST", "signupprocess.php", true);
        r.send(f);

    }
}