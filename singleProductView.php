<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="singleProductView.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fonts.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="body">

    <?php include "header.php" ?>

    <div class="product-main">

        <?php

        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: home.php");
            exit();
        } else {
            $rs0 = Database::search("SELECT * FROM shoe WHERE id='" . $_GET['id'] . "'");
            if ($rs0->num_rows == 0) {
                header("Location: home.php");
                exit();
            }
        }

        $rs1 = Database::search("SELECT shoe.name AS shoe_name, brand.name AS brand, shoe.price AS price, category.name AS category, 
gender.name AS gender FROM shoe 
INNER JOIN brand ON `shoe`.`brand_id`=`brand`.`id` 
INNER JOIN category ON `shoe`.`category_id`=`category`.`id` 
INNER JOIN gender ON `shoe`.`gender_id`=`gender`.`id` 
WHERE shoe.id='" . $_GET['id'] . "' ");

        $rs2 = Database::search("SELECT size.name AS size_name, shoe_has_size.qty AS qty, shoe_has_size.size_id AS size_id FROM shoe_has_size 
INNER JOIN `size` ON `size`.`id` = shoe_has_size.size_id WHERE shoe_id='" . $_GET['id'] . "' ORDER BY size_id ASC ");

        $rs3 = Database::search("SELECT color.name AS color_name FROM shoe_has_color 
INNER JOIN `color` ON `color`.`id` = shoe_has_color.color_id WHERE shoe_id='" . $_GET['id'] . "' ");

        $d1 = $rs1->fetch_assoc();

        ?>

        <div class="product-img">
            <img src="resources/<?php echo $_GET['id'] ?>.jpg" alt="">
        </div>

        <div class="product-content">
            <div class="product-content-div">
                <span class="bold fs-4"><?php echo $d1["shoe_name"] ?></span>
            </div>
            <div class="product-content-div">
                <span class="bold fs-5 text-muted">LKR <?php echo number_format($d1["price"], 2) ?></span>
            </div>
            <div class="product-content-div align-items-center">
                <span class="medium">Pick a Size</span>
                <ul class="medium">

                    <?php
                    for ($i = 0; $i < $rs2->num_rows; $i++) {
                        $d2 = $rs2->fetch_assoc();
                    ?>

                        <li data-qty="<?php echo $d2["qty"] ?>" id="<?php echo $d2["size_id"] ?>"><?php echo $d2["size_name"] ?></li>

                    <?php
                    }

                    ?>
                </ul>
            </div>

            <div class="count-div twelve" id="count-div">

                <span class="bold" id="count"></span>

            </div>

            <div class="product-content-div align-items-center ">
                <button class="qty-btn" onclick="decreaseQty(this)"><i class="bi bi-dash-lg"></i></button>
                <input type="number" id="amount" disabled class="qty-input medium" value="1" min="1" max="1">
                <button class="qty-btn" onclick="increaseQty(this)"><i class="bi bi-plus-lg"></i></button>
            </div>
            <div class="product-content-div align-items-center bold">

                <button id="cart" class="add-to-cart-btn" onclick="addToCart()">Add to Cart</button>

            </div>
            <div class="product-info">
                <div class="product-info-title">
                    <span class="bold fs-5">Additional Information</span>
                </div>

                <div class="product-info-content medium">
                    <div class="product-info-content-sub">

                        <span>Brand</span>
                        <span>Category</span>
                        <span>Gender</span>
                        <span>Color(s)</span>

                    </div>
                    <div class="product-info-content-sub">

                        <span><?php echo $d1["brand"] ?></span>
                        <span><?php echo $d1["category"] ?></span>
                        <span><?php echo $d1["gender"] ?></span>
                        <div class="colors">
                            <?php
                            for ($i = 0; $i < $rs3->num_rows; $i++) {
                                $d3 = $rs3->fetch_assoc();
                            ?>
                                <div class="<?php echo $d3["color_name"] ?>"></div>
                            <?php
                            }

                            ?>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>



    <?php include "footer.php" ?>

    <script src="singleProductView.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>