<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="shop.css" />
    <link rel="stylesheet" href="fonts.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>

<body class="body" onload="loadShop()">

    <?php include "header.php" ?>

    <div class="main-div">
        <div class="main-sub-1">
            <div>
                <span class=" fs-4 bold align-self-center">Shop by</span>
            </div>
            <div>
                <span class=" fs-6 bold"><i class="bi bi-bookmark-check-fill mx-1"></i> Category</span>
                <select name="" id="category" class="medium">
                    <option value="0" class=" text-muted">Any Category</option>
                    <?php

                    $rs1 = Database::search("SELECT * FROM category");
                    for ($i = 0; $i < $rs1->num_rows; $i++) {
                        $d1 = $rs1->fetch_assoc();

                    ?>
                        <option class=" text-black" value="<?php echo $d1["id"] ?>"><?php echo $d1["name"] ?></option>

                    <?php

                    }
                    ?>
                </select>
            </div>
            <div>
                <span class=" fs-6 bold"><i class="bi bi-tag-fill mx-1"></i> Brand</span>
                <select name="" id="brand" class="medium">
                    <option value="0" class=" text-muted">Any Brand</option>
                    <?php

                    $rs2 = Database::search("SELECT * FROM brand");
                    for ($i = 0; $i < $rs2->num_rows; $i++) {
                        $d2 = $rs2->fetch_assoc();

                    ?>
                        <option class=" text-black" value="<?php echo $d2["id"] ?>"><?php echo $d2["name"] ?></option>

                    <?php

                    }
                    ?>
                </select>
            </div>
            <div>
                <span class=" fs-6 bold"><i class="bi bi-aspect-ratio-fill mx-1"></i> Size</span>
                <select name="" id="size" class="medium">
                    <option value="0" class=" text-muted">Any Size</option>
                    <?php

                    $rs3 = Database::search("SELECT * FROM `size`");
                    for ($i = 0; $i < $rs3->num_rows; $i++) {
                        $d3 = $rs3->fetch_assoc();

                    ?>
                        <option class=" text-black" value="<?php echo $d3["id"] ?>"><?php echo $d3["name"] ?></option>

                    <?php

                    }
                    ?>
                </select>
            </div>
            <div>
                <span class=" fs-6 bold"><i class="bi bi-person-standing mx-1"></i> Gender</span>
                <select name="" id="gender" class="medium">
                    <option value="0" class=" text-muted">Any Gender</option>
                    <?php

                    $rs4 = Database::search("SELECT * FROM gender");
                    for ($i = 0; $i < $rs4->num_rows; $i++) {
                        $d4 = $rs4->fetch_assoc();

                    ?>
                        <option class=" text-black" value="<?php echo $d4["id"] ?>"><?php echo $d4["name"] ?></option>

                    <?php

                    }
                    ?>
                </select>
            </div>
            <div>
                <span class=" fs-6 bold"><i class="bi bi-palette-fill mx-1"></i> Color</span>
                <select name="" id="color" class="medium">
                    <option value="0" class=" text-muted">Any Color</option>
                    <?php

                    $rs5 = Database::search("SELECT * FROM color");
                    for ($i = 0; $i < $rs5->num_rows; $i++) {
                        $d5 = $rs5->fetch_assoc();

                    ?>
                        <option class=" text-black" value="<?php echo $d5["id"] ?>"><?php echo $d5["name"] ?></option>

                    <?php

                    }
                    ?>
                </select>
            </div>
            <div class="bold">
                <button onclick="setCurrentPage(1)">Apply Filters</button>
            </div>
            <div class="bold">
                <button onclick="reset();">Reset Filters</button>
            </div>

        </div>
        <div class=" main-sub-2">

            <div class="shop-header">

                <span class=" fs-6 regular text-secondary" id="result-count">Showing 1-6 of 10 results</span>
                <select name="" id="sort" class="medium">
                    <option value="0">Default Sorting</option>
                    <option value="1">Price low to high</option>
                    <option value="2">Price high to low</option>
                    <option value="3">Sort by latest</option>
                </select>

            </div>
            <div class=" shop-content">
                <!-- <div class=" shop-item">
                    <img src="resources/14.jpg" alt="">
                    <div class="shop-item-details">
                        <span class="bold">Name</span>
                        <span class="medium text-muted">ASICS | <span class="bold text-black">LKR 5000.00</span></span>

                        <span class="medium text-muted">12 Available</span>
                        <button class="medium text-white" onclick="window.location.href='singleProductView?id=1'"><i class="bi bi-cart-fill text-white fs-4"></i></button>
                    </div>
                </div> -->
            </div>
            <div id="pagination" class=" shop-footer bold">

                <!-- <button><i class="bi bi-arrow-left"></i></button>
                <button onclick="setCurrentPage(2)">1</button>
                <button onclick="setCurrentPage(3)">2</button>
                <button><i class="bi bi-arrow-right"></i></button> -->

            </div>

        </div>
    </div>

    <?php include "footer.php" ?>

    <script src="shop.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>