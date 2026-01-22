<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="header.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fonts.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>

<body class="header-body">

    <?php
    session_start();
    require "connection.php";
    $id = $_SESSION["user"]["id"];
    $rs = Database::search("SELECT * FROM cart WHERE user_id='" . $id . "' ");
    $n = $rs->num_rows;

    $total = 0;

    for ($i = 0; $i < $n; $i++) {

        $d = $rs->fetch_assoc();
        $shoe_rs = Database::search("SELECT * FROM shoe WHERE id='" . $d["shoe_id"] . "' ");

        $shoe_data = $shoe_rs->fetch_assoc();
        // $price = $shoe_data["price"];
        $total += $shoe_data["price"] * $d["qty"];
    }
    ?>

    <div class="header-top regular">
        <span>HOTLINE: +94 112 148 400 | +94 777 815 815</span>
        <button class=" clear-btn text-white"><i class="bi bi-person-fill me-1"></i>ACCOUNT | PROFILE</button>
    </div>
    <div class="header-bottom">
        <div class="header-img-div">
            <img src="resources/logo2.png" alt="">
        </div>
        <div class="header-menus-div medium">
            <button class="clear-btn" onclick="window.location.href='home.php'">Home</button>
            <button class="clear-btn">Men</button>
            <button class="clear-btn">Women</button>
            <button class="clear-btn" onclick="window.location.href='shop.php'">Shop</button>
            <button class="clear-btn">About Us</button>
            <button class="clear-btn">Contact Us</button>
        </div>
        <div class="header-search-div">

            <div class="header-search-container regular">

                <input type="text" class="clear-btn" placeholder="Search anything...">
                <button><i class="bi bi-search"></i></button>

            </div>

            <button class="header-search-btn" onclick="searchBar()"><i class="bi bi-search"></i></button>

        </div>
        <div class="header-cart-div">

            <button class="header-cart-btn" onclick="window.location.href='cart.php'"><i class="bi bi-cart-fill text-black fs-6"></i></button>
            <div class=" header-cart-item-count regular">
                <span><?php echo $n ?></span>
            </div>
            <span class="header-cart-total regular">LKR <?php echo number_format($total, 2); ?></span>

        </div>
        <div class="header-list-div regular">
            <button class="header-list-btn" onclick="dropdown()"><i class="bi bi-list"></i></button>
        </div>
    </div>

    <div class="header-sm-search-div regular" id="search-bar">
        <input type="text" class="header-sm-search"  placeholder="Search anything..."/>
    </div>

    <div class="header-sm-list-div medium" id="header-list">
        <button class="clear-btn" onclick="window.location.href='home.php'">Home</button>
        <button class="clear-btn">Men</button>
        <button class="clear-btn">Women</button>
        <button class="clear-btn" onclick="window.location.href='shop.php'">Shop</button>
        <button class="clear-btn">About Us</button>
        <button class="clear-btn">Contact Us</button>
    </div>


    <script src="header.js"></script>
</body>

</html>