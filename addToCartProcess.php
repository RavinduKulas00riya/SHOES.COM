<?php

session_start();
require "connection.php";

$user_id = $_SESSION["user"]["id"];
$amount = $_POST["amount"];
$shoe_id = $_POST["shoe_id"];
$size_id = $_POST["size_id"];

$rs = Database::search("SELECT * FROM cart WHERE user_id='".$user_id."' AND shoe_id='".$shoe_id."' AND size_id='".$size_id."' ");

if($rs->num_rows > 0){

    $d = $rs->fetch_assoc();
    Database::iud("UPDATE cart SET qty='".$amount."' WHERE id='".$d["id"]."' ");
    echo "Cart Updated";
}else{

    Database::iud("INSERT INTO cart(user_id, shoe_id, size_id, qty) VALUES ('".$user_id."', '".$shoe_id."', '".$size_id."', '".$amount."') ");
    echo "Added to Cart";
}