<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="home.css" />
    <link rel="stylesheet" href="fonts.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<?php include "header.php";
// $user = isset($_SESSION["user"]) ? $_SESSION["user"]["email"] : 'not found';
$user;

if (isset($_SESSION["user"])) {

    $user = $_SESSION["user"];
} else {
    $user = "not found";
}

?>

<body class="body" onload="checkUser('<?php echo $user['id']; ?>')">

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="resources/carousel1.png" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="resources/carousel2.png" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="resources/carousel3.png" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="trending">
        <div class="trending-title">
            <span class="medium">Today's trends</span>
            <button class="medium">Shop all<i class="bi bi-arrow-right-short"></i></button>
        </div>

        <div class="trending-list">
            <?php

            $rs1 = Database::search("SELECT shoe.id AS shoe_id, shoe.name AS shoe_name, brand.name AS brand_name, shoe.price AS price FROM shoe INNER JOIN brand ON `shoe`.`brand_id`=`brand`.`id` ORDER BY shoe.id LIMIT 5");
            for ($i = 0; $i < $rs1->num_rows; $i++) {
                $d1 = $rs1->fetch_assoc();
                $rs2 = Database::search("SELECT SUM(shoe_has_size.qty) AS qty FROM shoe_has_size WHERE shoe_id='" . $d1["shoe_id"] . "'");
                $d2 = $rs2->fetch_assoc();
            ?>

                <div class="trending-shoe-div" onclick="window.location.href='singleProductView.php?id=<?php echo $d1['shoe_id']; ?>'">
                    <img src="resources/<?php echo $d1['shoe_id']; ?>.jpg" />
                    <div class="details">
                        <span class="bold"><?php echo $d1["shoe_name"] ?></span>
                        <span class="medium text-muted"><?php echo $d1["brand_name"] ?></span>
                        <span class="bold">LKR <?php echo number_format($d1["price"], 2) ?></span>
                        <span class="medium text-muted"><?php echo $d2["qty"] ?> Available</span>
                        <!-- <button class="medium text-white"><i class="bi bi-cart-fill text-white fs-4"></i></button> -->
                    </div>
                </div>

            <?php

            }

            ?>
        </div>


    </div>

    <div class="trending">
        <div class="trending-title">
            <span class="medium">Brand new</span>
            <button class="medium">Shop all<i class="bi bi-arrow-right-short"></i></button>
        </div>

        <div class="trending-list">
            <?php

            $rs1 = Database::search("SELECT shoe.id AS shoe_id, shoe.name AS shoe_name, brand.name AS brand_name, shoe.price AS price FROM shoe INNER JOIN brand ON `shoe`.`brand_id`=`brand`.`id` ORDER BY shoe.id DESC LIMIT 5");
            for ($i = 0; $i < $rs1->num_rows; $i++) {
                $d1 = $rs1->fetch_assoc();
                $rs2 = Database::search("SELECT SUM(shoe_has_size.qty) AS qty FROM shoe_has_size WHERE shoe_id='" . $d1["shoe_id"] . "'");
                $d2 = $rs2->fetch_assoc();
            ?>

                <div class="trending-shoe-div" onclick="window.location.href='singleProductView.php?id=<?php echo $d1['shoe_id']; ?>'">
                    <img src="resources/<?php echo $d1['shoe_id']; ?>.jpg" />
                    <div class="details">
                        <span class="bold"><?php echo $d1["shoe_name"] ?></span>
                        <span class="medium text-muted"><?php echo $d1["brand_name"] ?></span>
                        <span class="bold">LKR <?php echo number_format($d1["price"], 2) ?></span>
                        <span class="medium text-muted"><?php echo $d2["qty"] ?> Available</span>
                        <!-- <button class="medium text-white"><i class="bi bi-cart-fill text-white fs-4"></i></button> -->
                    </div>
                </div>

            <?php

            }

            ?>
        </div>


    </div>

    <div class=" col-9 brands-div">
        <img src="resources/adidas.png" alt="">
        <img src="resources/puma.png" alt="">
        <img src="resources/nike.png" alt="">
        <img src="resources/reebok.png" alt="">
    </div>

    <?php include "footer.php" ?>

    <script src="home.js"></script>
    <script src="bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>