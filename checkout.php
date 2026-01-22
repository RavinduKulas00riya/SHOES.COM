<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="checkout.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fonts.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>

<body class="body">

    <?php include "header.php"; ?>

    <div class="main-div">

        <?php

        $id = $_SESSION["user"]["id"];
        $user_rs = Database::search("SELECT * FROM user WHERE id = '" . $id . "' ");
        $user_data = $user_rs->fetch_assoc();

        $total = 0;
        $products = [];

        $cart_rs = Database::search("SELECT * FROM cart WHERE user_id='" . $id . "' ");
        $cart_n = $cart_rs->num_rows;

        for ($i = 0; $i < $cart_n; $i++) {

            $cart_data = $cart_rs->fetch_assoc();

            $shoe_rs = Database::search("SELECT * FROM shoe WHERE id='" . $cart_data["shoe_id"] . "' ");
            $shoe_data = $shoe_rs->fetch_assoc();

            $size_rs = Database::search("SELECT * FROM `size` WHERE id='" . $cart_data["size_id"] . "' ");
            $size_data = $size_rs->fetch_assoc();

            $price = $shoe_data["price"];
            $qty = $cart_data["qty"];

            $products[] = [$shoe_data["name"],$size_data["name"], $qty, $price];

            $total += $price * $qty;
        }
        ?>

        <div class=" w-50 h-auto d-flex align-items-center flex-column gap-5">

            <div class="sub-div">

                <span class=" bold fs-4">Billing Address</span>

                <div class=" d-flex flex-row gap-2 align-items-center">
                    <input type="checkbox" name="" id="current-address">
                    <span class=" regular fourteen">Same as Your Current Address?</span>
                </div>

                <div class=" d-flex flex-row gap-5 regular fontsize">
                    <div class=" d-flex flex-column gap-4 w-50">
                        <span>First Name</span>
                        <input type="text" id="fname" value="<?php echo $user_data["fname"] ?>">
                    </div>
                    <div class=" d-flex flex-column gap-4 w-50">
                        <span>Last Name</span>
                        <input type="text" id="lname" value="<?php echo $user_data["lname"] ?>">
                    </div>
                </div>
                <div class=" d-flex flex-column gap-4 regular fontsize">
                    <span>Street Address</span>
                    <input type="text" placeholder="House Number and Street Name" id="street">
                    <input type="text" placeholder="Apartment, suite, unit, etc. (optional)">
                </div>
                <div class=" d-flex flex-column gap-4 regular fontsize">
                    <span>Province</span>
                    <select name="" id="province">
                        <option value="0" class=" text-muted">Select an option...</option>

                        <?php

                        $province_rs = Database::search("SELECT * FROM province");
                        $province_n = $province_rs->num_rows;

                        for ($i = 0; $i < $province_n; $i++) {
                            $province_data = $province_rs->fetch_assoc();
                        ?>
                            <option value="<?php echo $province_data["id"] ?>"><?php echo $province_data["name"] ?></option>

                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class=" d-flex flex-column gap-4 regular fontsize">
                    <span>City <span class=" regular mx-2"> (Please select a province first)</span></span>
                    <select name="city" id="city" disabled style="cursor: not-allowed;">
                        <option value="0" class=" text-muted">Select an option...</option>
                    </select>
                </div>
                <div class=" d-flex flex-column gap-4 regular fontsize">
                    <span>Postal Code / Zip</span>
                    <input type="text" id="postal">
                </div>
            </div>
            <div class="place-order">

                <span class=" bold fs-1">Payment</span>

                <div class=" d-flex flex-row justify-content-between align-items-center">
                    <span class="regular fontsize">Choose a payment method</span>
                    <div class=" bg-black" style=" height: 1px; width:300px;"></div>
                </div>

                <div class=" d-flex flex-row gap-2 align-items-center fontsize">
                    <input type="radio" name="method" id="1">
                    <span class=" regular pt-1">Payment Gateway</span>
                    <img src="resources/cards.png" alt="" class="credit-cards ms-4">
                </div>
                <div class=" d-flex flex-row gap-2 align-items-center fontsize">
                    <input type="radio" name="method" id="2">
                    <span class=" regular pt-1">Cash on delivery</span>
                </div>
                <div class=" bg-black w-100" style=" height: 1px;"></div>

                <div class=" d-flex flex-row gap-2 align-items-center fontsize">
                    <input type="checkbox" name="" id="conditions">
                    <span class=" regular pt-1">I have read and agree to the website terms and conditions.</span>
                </div>

                <div class=" d-flex flex-row gap-2 align-items-center fontsize">
                    <input type="checkbox" name="" id="save-address">
                    <span class=" regular pt-1">Save my address for future purchases.</span>
                </div>

                <div class=" d-flex justify-content-center align-items-center fontsize bold">
                    <button type="submit" onclick='openSandbox(<?php echo json_encode($products, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>, <?php echo $total ?>)'>Place Order</button>
                </div>
            </div>
        </div>
        <div class=" w-50 h-auto d-flex align-items-center flex-column">

            <div class="sub-div">

                <span class=" bold fs-4">Your Cart</span>

                <div class=" bg-black w-100" style=" height: 1px;"></div>


                <div class=" d-flex flex-row largefontsize medium">
                    <span style="flex:4;">Product</span>
                    <span style="flex:1;">Subtotal</span>
                </div>



                <?php

                for ($i = 0; $i < $cart_n; $i++) {

                ?>

                    <div class=" d-flex flex-row fontsize regular">
                        <span style="flex:4;"><?php echo $products[$i][0] ?> - <?php echo $products[$i][1] ?> <span class=" italic">x <?php echo $products[$i][2] ?></span></span>
                        <span style="flex:1;">LKR <?php echo number_format($products[$i][3], 2) ?></span>
                    </div>

                <?php

                }
                
                ?>

                <div class=" bg-black w-100" style=" height: 1px;"></div>

                <div class=" d-flex flex-row largefontsize medium">
                    <span style="flex:3;">Total</span>
                    <span style="flex:1;">LKR <?php echo number_format($total, 2) ?></span>
                </div>
                <div class=" d-flex flex-row largefontsize medium justify-content-between">
                    <span>Shipping</span>
                    <div class=" d-flex flex-column fontsize regular align-items-end">
                        <span>Within Colombo: LKR 300.00</span>
                        <span>Outside Colombo: LKR 700.00</span>
                    </div>
                </div>
                <div class=" d-flex flex-row fourteen gap-2 regular text-muted">
                    <i class="bi bi-info-circle-fill"></i>
                    <span>Shipping fee will be calculated during the payment process.</span>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="checkout.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>