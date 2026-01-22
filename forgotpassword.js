function forgotpassword() {


    if (document.getElementById("title").innerHTML == "Enter Your Email") {

        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "Success") {
                    alert("A verification code has been sent to your Email");
                    document.getElementById("title").innerHTML = "Enter the Verification Code";
                    document.getElementById("input").value = "";
                } else {
                    alert(t);
                }
            }
        };

        r.open("GET", "forgotpasswordprocess.php?e=" + document.getElementById("input").value, true);
        r.send();

    } else if (document.getElementById("title").innerHTML == "Enter the Verification Code") {

        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "Success") {
                    document.getElementById("title").innerHTML = "Reset Your Password";
                    document.getElementById("div1").style.display = "none";
                    document.getElementById("div2").style.display = "flex";
                } else {
                    alert(t);
                }
            }
        };

        r.open("GET", "forgotpasswordprocess.php?vc=" + document.getElementById("input").value, true);
        r.send();

    } else if(document.getElementById("title").innerHTML == "Reset Your Password"){

        if(document.getElementById("pw1").value.length < 5){

            alert("Please type a longer password");

        }else if (document.getElementById("pw1").value != document.getElementById("pw2").value) {

            alert("The Passwords Do Not Match");
            
        } else {

            var f = new FormData();
            f.append("p",document.getElementById("pw1").value);

            var r = new XMLHttpRequest();

            r.onreadystatechange = function () {
                if (r.readyState == 4) {
                    var t = r.responseText;
                    if (t == "Success") {
                        window.location.href = "index.php";
                    } else {
                        alert(t);
                    }
                }
            };
    
            r.open("POST", "forgotpasswordprocess.php", true);
            r.send(f);
            
        }

        

    }
}