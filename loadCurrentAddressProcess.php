<?php

session_start();
require "connection.php";

$address_rs = Database::search("SELECT * FROM `address` WHERE user_id = '".$_SESSION["user"]["id"]."' ");

if($address_rs -> num_rows >0){

    $address_data = $address_rs->fetch_assoc();

    $city_rs = Database::search("SELECT * FROM `city` WHERE id = '".$address_data["city_id"]."' ");
    $city_data = $city_rs->fetch_assoc();

    $address_data["province_id"] = $city_data["province_id"];
    
    echo json_encode($address_data);
}else{

    echo "null";
}
