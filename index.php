<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shoes</title>
    <link rel="stylesheet" href="index.css" />
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

            <h3 class=" bold align-self-center">Login</h3>
        </div>

        <?php

        $email = "";
        $password = "";

        if (isset($_COOKIE["email"])) {
            $email = $_COOKIE["email"];
        }

        if (isset($_COOKIE["password"])) {
            $password = $_COOKIE["password"];
        }

        ?>

        <div class="sub-div flex-column">

            <h6 class=" align-self-start medium">Email</h6>
            <input type="text" class="text-input regular" id="email" value="<?php echo $email ?>">

        </div>
        <div class="sub-div flex-column">

            <h6 class=" align-self-start medium">Password</h6>
            <input type="password" class="text-input regular" id="password" value="<?php echo $password ?>">

        </div>
        <div class="sub-div">

            <input type="checkbox" name="" id="rm" class=" mb-1 me-1">
            <h6 class=" regular align-self-center">Remember me</h6>
        </div>
        <div class="sub-div bold justify-content-center align-items-center">

            <button class="sign-btn" id="login" onclick="login()">Login</button>
        </div>

        <div class="sub-div fs-6 regular justify-content-center align-items-center">

            <button class="redirect-btn" onclick="window.location.href='forgotpassword.php'">Forgot password?</button>
        </div>

        <div class="sub-div fs-6 regular justify-content-center align-items-center">

            <span>Don't have an account? </span>
            <button class="redirect-btn" onclick="window.location.href='signup.php'"> Go to Sign up <i class="bi bi-arrow-up-right"></i></button>
        </div>

    </div>

    <script src="index.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>