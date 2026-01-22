<?php

require "connection.php";

$category = $_POST["category"];
$brand = $_POST["brand"];
$size = $_POST["size"];
$gender = $_POST["gender"];
$color = $_POST["color"];
$sort = $_POST["sort"];
$page = $_POST["currentPage"];

$query = "SELECT shoe.id AS shoe_id, shoe.name AS shoe_name, brand.name AS brand_name, shoe.price AS 
price FROM shoe INNER JOIN brand ON `shoe`.`brand_id`=`brand`.`id` ";

if ($category != 0) {
    $query .= " WHERE category_id=" . $category;
}

if ($brand != 0) {

    if (strpos($query, 'WHERE') !== false) {

        $query .= " AND brand_id =" . $brand;
    } else {
        $query .= " WHERE brand_id=" . $brand;
    }
}

if ($gender != 0) {

    if (strpos($query, 'WHERE') !== false) {

        $query .= " AND gender_id =" . $gender;
    } else {
        $query .= " WHERE gender_id=" . $gender;
    }
}

if ($sort != 0) {

    if ($sort == 1) {

        $query .= " ORDER BY shoe.price ASC";

    } else if($sort == 2){
        
        $query .= " ORDER BY shoe.price DESC";

    } else{

        $query .= " ORDER BY shoe.id DESC";
    }
}

$itemsPerPage = 6;

$offset = ($page - 1) * $itemsPerPage;

$items = [];

// echo $query;

$rs1 = Database::search($query);
for ($i = 0; $i < $rs1->num_rows; $i++) {
    $d1 = $rs1->fetch_assoc();
    $rs2 = Database::search("SELECT SUM(shoe_has_size.qty) AS qty FROM shoe_has_size WHERE shoe_id='" . $d1["shoe_id"] . "'");
    $d2 = $rs2->fetch_assoc();

    if ($color != 0 || $size != 0) {


        if ($color != 0) {

            $color_rs = Database::search("SELECT * FROM shoe_has_color WHERE shoe_id='" . $d1["shoe_id"] . "' AND color_id = '" . $color . "' ");

            if ($color_rs->num_rows == 0) {

                continue;
            }
        }

        if ($size != 0) {

            $size_rs = Database::search("SELECT * FROM shoe_has_size WHERE shoe_id='" . $d1["shoe_id"] . "' AND size_id = '" . $size . "' ");

            if ($size_rs->num_rows == 0) {

                continue;
            }
        }

        $items[] = $d1 + $d2;
    } else {
        $items[] = $d1 + $d2;
    }
}

$totalItems = count($items);
$items = array_slice($items, $offset, $itemsPerPage);


echo json_encode([
    "items" => $items,
    "totalItems" => $totalItems
]);
