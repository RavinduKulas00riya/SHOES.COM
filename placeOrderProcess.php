<?php

session_start();
require "connection.php";

$user = $_SESSION['user'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$orderId = $_POST['order_id'];
$street = $_POST['street'];
$city = $_POST['city'];
$postal = $_POST['postal'];

$city_rs = Database::search("SELECT * FROM city WHERE `name`='" . $city . "' ");
$city_data = $city_rs->fetch_assoc();

$currentDateTime = date('Y-m-d H:i:s');

if (isset($_POST['saveAddress'])) {

    $address_rs = Database::search("SELECT * FROM `address` WHERE user_id = '" . $user['id'] . "' ");

    if ($address_rs->num_rows > 0) {

        $address_data = $address_rs->fetch_assoc();
        Database::iud("UPDATE `address` SET street='" . $street . "', postal_code='" . $postal . "', city_id='" . $city_data['id'] . "' WHERE user_id = '" . $user['id'] . "'  ");
    } else {

        Database::iud("INSERT INTO `address`(street, postal_code, city_id, user_id) VALUES ('" . $street . "', '" . $postal . "', '" . $city_data['id'] . "', '" . $user['id'] . "')");
    }
}

//insert to purchase table
Database::iud("INSERT INTO purchase(id, user_id, date_time, fname, lname, street, city_id, postal_code) VALUES ('" . $orderId . "', '" . $user['id'] . "', '" . $currentDateTime . "', '" . $fname . "', '" . $lname . "', '" . $street . "', '" . $city_data['id'] . "', '" . $postal . "') ");

//insert to purchase items table one by one
$cart_rs = Database::search("SELECT * FROM `cart` WHERE user_id='".$user['id']."' ");
$cart_n = $cart_rs->num_rows;

for ($i=0; $i < $cart_n; $i++) { 

    echo $cart_n;
    
    $cart_data = $cart_rs->fetch_assoc();

    Database::iud("INSERT INTO purchase_item(shoe_id, size_id, qty, purchase_id) VALUES ('".$cart_data['shoe_id']."', '".$cart_data['size_id']."', '".$cart_data['qty']."', '".$orderId."') ");

    //edit qty from storage
    Database::iud("UPDATE shoe_has_size SET qty = qty - '" . $cart_data['qty'] . "' WHERE shoe_id='" . $cart_data['shoe_id'] . "' AND size_id='" . $cart_data['size_id'] . "' ");

    //edit or remove rows from other people's carts
    $other_carts_rs = Database::search("SELECT * FROM `cart` WHERE shoe_id='".$cart_data['shoe_id']."' AND size_id='".$cart_data['size_id']."' ");
    $other_carts_n = $other_carts_rs->num_rows;

    for ($n=0; $n < $other_carts_n; $n++) { 
        
        $other_cart = $other_carts_rs->fetch_assoc();

        if($cart_data['qty'] == $other_cart['qty']){

            Database::iud("DELETE FROM cart WHERE id='".$other_cart['id']."' ");
        }else{

            Database::iud("UPDATE cart SET qty = qty - '".$cart_data['qty']."' WHERE id ='".$other_cart['id']."' ");
        }
    }

}

//delete the cart
// Database::iud("DELETE FROM cart WHERE user_id = '".$user['id']."' ");

echo "success";
