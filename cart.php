<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="cart.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fonts.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>

<body class="body">

    <?php include "header.php"; ?>

    <div class="main">

        <?php
        $id = $_SESSION["user"]["id"];

        $shoe_ids = [];

        $rs = Database::search("SELECT * FROM cart WHERE user_id = '".$id."' ");
        $n = $rs->num_rows;

        if ($n != 0) {

        ?>

            <div class="titles bold fs-6">
                <div class="remove-btn-div">

                </div>
                <div class=" product-img">

                </div>
                <div class="product-name">
                    <span>Product</span>
                </div>
                <div class="product-price">
                    <span>Price</span>
                </div>
                <div class="product-qty">
                    <span>Quantity</span>
                </div>
                <div class="product-subtotal">
                    <span>Subtotal</span>
                </div>
            </div>

            <?php

            $total = 0;

            for ($i = 0; $i < $n; $i++) {

                $d = $rs->fetch_assoc();
                $shoe_rs = Database::search("SELECT * FROM shoe WHERE id = '" . $d['shoe_id'] . "' ");
                $shoe_data = $shoe_rs->fetch_assoc();
                $qty_rs = Database::search("SELECT * FROM shoe_has_size WHERE shoe_id = '" . $d['shoe_id'] . "' AND size_id = '" . $d['size_id'] . "' ");
                $qty_data = $qty_rs->fetch_assoc();
                $size_rs = Database::search("SELECT * FROM `size` WHERE id = '" . $qty_data['size_id'] . "' ");
                $size_data = $size_rs->fetch_assoc();

                $shoe_ids[] = $d['id'];
            ?>

                <div class="product-item medium">

                    <div class="remove-btn-div">
                        <button class="remove-btn" onclick="removeFromCart(<?php echo $d['id'] ?>)"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class=" product-img">
                        <img src="resources/<?php echo $d['shoe_id'] ?>.jpg">
                    </div>
                    <div class="product-name">
                        <span><?php echo $shoe_data['name'] ?> - <?php echo $size_data['name'] ?></span>
                    </div>
                    <div class="product-price">
                        <span>LKR <?php echo number_format($shoe_data["price"], 2) ?></span>
                    </div>
                    <div class="product-qty">
                        <button onclick="decreaseQty(this)"><i class="bi bi-dash-lg"></i></button>
                        <input id="<?php echo $d['id'] ?>" type="number" min="1" max="<?php echo $qty_data['qty'] ?>" value="<?php echo $d['qty'] ?>" readonly onkeydown="return false;">
                        <button onclick="increaseQty(this)"><i class="bi bi-plus-lg"></i></button>
                    </div>
                    <div class="product-subtotal">
                        <span>LKR <?php echo number_format($shoe_data["price"] * $d['qty'], 2);
                                    $total += $shoe_data["price"] * $d['qty']; ?></span>
                    </div>
                </div>

            <?php
            }

            // $shoe_ids_json = json_encode($shoe_ids);

            ?>

            <div class="cart-footer bold">
                <div class="cart-footer-1">
                    <button onclick='updateCart(<?php echo json_encode($shoe_ids, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>)'>Update Cart</button>
                    <button onclick="removeFromCart('all')">Remove All</button>
                </div>
                <div class="cart-footer-2 fs-6">
                    <div>
                        <span>Subtotal</span>
                        <span>LKR <?php echo number_format($total, 2); ?></span>
                    </div>
                    <button class=" w-50" onclick="window.location.href='checkout.php'">Proceed to Checkout</button>
                </div>
            </div>

        <?php
        } else {

        ?>
            <!--cart empty message -->
            <div class="empty-cart">

                <img src="resources/empty-cart.png" alt="">
                <span class=" text-muted fs-1 regular">Your Cart is Empty.</span>
            </div>

        <?php
        }
        ?>

    </div>

    <?php include "footer.php" ?>
    <script src="cart.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>