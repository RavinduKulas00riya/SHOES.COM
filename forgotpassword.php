<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shoes</title>
    <link rel="stylesheet" href="forgotpassword.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fonts.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="body">

    <div class="main-div">

        <div class="sub-div justify-content-center align-items-center">

            <img src="resources/logo1.png" alt="">
        </div>
        <div class="sub-div">

            <h3 class=" bold align-self-center">Forgot Password</h3>
        </div>

        <div class="sub-div flex-column">

            <h6 class=" align-self-start medium" id="title">Enter Your Email</h6>
            <input type="text" class="text-input regular" id="input">

        </div>
        <div class="sub-div bold justify-content-center align-items-center">

            <button class="sign-btn" id="login" onclick="forgotpassword()">Login</button>
        </div>

    </div>

    <script src="forgotpassword.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>