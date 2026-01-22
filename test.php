<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="icon" href="./resources/test/logo_white.png">
  <style>
    @font-face {
      font-family: "medium";
      src: url("fonts/test/Inter_28pt-Medium.ttf");
    }

    @font-face {
      font-family: "bold";
      src: url("fonts/test/Inter_28pt-SemiBold.ttf");
    }

    @font-face {
      font-family: "regular";
      src: url("fonts/test/Inter_28pt-Regular.ttf");
    }

    .medium {
      font-family: "medium";
    }

    .bold {
      font-family: "bold";
    }

    .regular {
      font-family: "regular";
    }

    body,
    html {
      height: 100%;
      margin: 0;
      overflow: hidden;
    }

    .container-fluid {
      height: 100vh;
    }

    .left-side {
      background-color: #ffffff;
      height: 100%;
      display: flex;
      flex-direction: column;
      padding: 25px;
    }

    .right-side {
      position: relative;
      height: 100%;
      display: flex;
      flex-direction: column;
      color: white;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    .bg-image {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: cover;
      background-position: center;
      opacity: 0;
      transition: opacity 1s ease-in-out;
      z-index: -1;
      filter: brightness(35%);
    }

    .bg-image.active {
      opacity: 1;
    }

    .logo {
      max-width: 180px;
      filter: brightness(170%);
    }

    .login-form {
      max-width: 500px;
      width: 100%;
    }

    .right-side-half {
      text-align: center;
      display: flex;
      flex: 1;
      align-items: center;
      justify-content: center;
    }

    .description {
      max-width: 450px;
      font-size: 20px;
    }

    .footer-text {
      font-size: 0.8rem;
      color: #6c757d;
    }

    .input-container {
      position: relative;
      width: 380px;
      margin-bottom: 10px;
    }

    .buttons {
      width: 380px;
      margin-bottom: 10px;
      display: flex;
      flex-direction: column;
      color: #ffffff;
    }

    .log-btn {
      background-image: linear-gradient(#42A1EC, #0070C9);
      border: 1px solid #0077CC;
      color: #FFFFFF;
      direction: ltr;
      overflow: visible;
    }

    .animated-input {
      width: 100%;
      height: 50px;
      padding: 10px;
      font-size: 17px;
      border: 2px solid #e9e9e9ff;
      border-radius: 10px;
      outline: none;
      background: #f5f5f5;
      transition: border-color 0.3s ease;
    }

    .animated-input:focus {
      border-color: #007bff;
      box-shadow: none;

    }

    .input-label {
      position: absolute;
      top: 50%;
      left: 6px;
      transform: translateY(-50%);
      font-size: 17px;
      color: #6c757d;
      pointer-events: none;
      transition: all 0.3s ease;
    }

    .animated-input:focus+.input-label,
    .animated-input:not(:placeholder-shown)+.input-label {
      top: 0;
      transform: translateY(-1%);
      font-size: 12px;
      padding: 0 5px;
    }

    .animated-input:focus+.input-label {
      color: #007bff;
    }

    .error-msg {
      color: red;
    }

    .details-div {
      display: block;
    }

    .passwords-div {
      display: none;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row h-100">
      <!-- Left Side -->
      <div class="col-md-6 left-side">
        <div style="width: 100%; height: 100%; display: flex; flex-direction: column; justify-content: space-around;">
          <div style="width: 100%; height: 22%; display: flex; flex-direction: column; justify-content: space-between;">
            <img style="width: 42px; height: 42px;" src="./resources/test/logo.png" alt="">
            <span class="bold" style="font-size: 46px; padding-left: 38px;">Customer Registration</span>

          </div>
          <div style="width: 100%; height: 73%; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <span class="regular error-msg" id="error-msg" style="margin-bottom: 10px;"><i class="bi bi-exclamation-circle"></i> Email cannot be empty</span>

            <div class="details-div">
              <div class="input-container">
                <input spellcheck="false" type="text" class="form-control animated-input" id="name" placeholder=" ">
                <label class="input-label">Full Name</label>
              </div>
              <div class="input-container">
                <input spellcheck="false" type="text" class="form-control animated-input" id="email" placeholder=" ">
                <label class="input-label">Email Address</label>
              </div>
              <div class="input-container">
                <input spellcheck="false" type="text" maxlength="10" class="form-control animated-input" id="mobile" placeholder=" ">
                <label class="input-label">Mobile Number</label>
              </div>
              <div class="input-container">
                <input spellcheck="false" type="number" class="form-control animated-input" id="amount" placeholder=" ">
                <label class="input-label">Initial Amount</label>
              </div>
              <div class="buttons medium">
                <button class="log-btn" style="height: 50px; font-size: 17px; border: none; border-radius: 10px; margin-bottom: 10px;" onclick="showPasswordDiv()">Continue</button>
                <button style="height: 50px; font-size: 17px; border: none; border-radius: 10px; color: #007bff; margin-bottom: 10px; background-color: rgba(0, 123, 255, 0.05);">I already have an Account</button>
              </div>
            </div>

            <div class="passwords-div">
              <div class="input-container">
                <input type="password" class="form-control animated-input" id="password" placeholder=" ">
                <label for="inputField" class="input-label">Password</label>
              </div>
              <div class="input-container">
                <input type="password" class="form-control animated-input" id="confirm-password" placeholder=" ">
                <label for="inputField" class="input-label">Confirm Password</label>
              </div>
              <div class="buttons medium">
                <button class="log-btn" style="height: 50px; font-size: 17px; border: none; border-radius: 10px; margin-bottom: 10px;">Create Account</button>
                <button style="height: 50px; font-size: 17px; border: none; border-radius: 10px; color: #007bff; margin-bottom: 10px; background-color: rgba(0, 123, 255, 0.05);">I already have an Account</button>
              </div>
            </div>


          </div>
          <div class="regular footer-text text-center" style="width: 100%; height: 5%;">
            © 2025 Musashi Financial Group, All Rights Reserved
          </div>
        </div>
      </div>
      <!-- Right Side -->
      <div class="col-md-6 right-side">
        <div class="bg-image active" style="background-image: url('resources/test/319.jpg')"></div>
        <div class="bg-image" style="background-image: url('resources/test/6117.jpg')"></div>
        <div class="bg-image" style="background-image: url('resources/test/30165.jpg')"></div>
        <div class="right-side-half">
          <img src="./resources/test/logo_white.png" alt="Company Logo" class="logo">
        </div>

        <div class="right-side-half">
          <div class="description medium">
            <p>Welcome to Musashi Financial Group! Seamlessly send money to bank accounts with instant or scheduled transactions.
              Log in to experience secure, fast, and reliable financial services tailored to your needs.</p>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const images = document.querySelectorAll('.bg-image');
    let currentImage = 0;

    function changeBackground() {
      const nextImage = (currentImage + 1) % images.length;

      images[nextImage].classList.add('active');

      setTimeout(() => {
        images[currentImage].classList.remove('active');
        currentImage = nextImage;
      }, 1000);
    }
    setInterval(changeBackground, 5000);

    function showPasswordDiv() {

      const detailsDiv = document.getElementsByClassName("details-div")[0];
      const passwordsDiv = document.getElementsByClassName("passwords-div")[0];

      if (detailsDiv.style.display === 'none') {
        detailsDiv.style.display = 'block';
        passwordsDiv.style.display = 'none';
      } else {
        detailsDiv.style.display = 'none';
        passwordsDiv.style.display = 'block';
      }


    }
  </script>
</body>

</html>