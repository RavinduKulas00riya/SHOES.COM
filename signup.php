<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shoes</title>
    <link rel="stylesheet" href="signup.css" />
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

            <h3 class=" bold align-self-center">Sign Up</h3>
        </div>

        <div class="sub-div flex-row gap-4">

            <div class="sub-div flex-column">

                <h6 class=" align-self-start medium">First Name</h6>
                <input type="text" class="text-input regular" id="fname">

            </div>
            <div class="sub-div flex-column">

                <h6 class=" align-self-start medium">Last Name</h6>
                <input type="text" class="text-input regular" id="lname">

            </div>

        </div>

        <div class="sub-div flex-column">

            <h6 class=" align-self-start medium">Email</h6>
            <input type="text" class="text-input regular" id="email">

        </div>

        <div class="sub-div flex-column">

            <h6 class=" align-self-start medium">Mobile</h6>
            <input type="text" class="text-input regular" id="mobile">

        </div>
        <div class="sub-div flex-row">

            <div class=" sub-div flex-column position-relative">
                <h6 class=" align-self-start medium">Password</h6>

                <div class=" position-relative">

                    <input type="password" class="text-input regular" id="password">
                    <button class="show-pw" id="show-pw"><i id="show-icon" class="bi bi-eye-fill"></i></button>
                </div>


            </div>


        </div>
        <div class="sub-div bold justify-content-center align-items-center">

            <button class="sign-btn" id="signup" onclick="signup()">Sign Up</button>
        </div>

        <div class="sub-div fs-6 regular justify-content-center align-items-center">

            <span>Already Registered? </span>
            <button class="redirect-btn" onclick="window.location.href='index.php'"> Go to Login</button>
        </div>

    </div>

    <script src="signup.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>