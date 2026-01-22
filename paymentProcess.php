<?php

session_start();
require "connection.php";

$products = $_POST['products'];
$total = $_POST['total'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$street = $_POST['street'];
$city = $_POST['city'];
$user = $_SESSION['user'];

function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    
    return $randomString;
}

$merchant_id = "YOUR_MERCHANT_ID";
$merchant_secret = "YOUR_MERCHANT_SECRET";

// Payment details
$payment = [
    "sandbox" => true,
    "merchant_id" => $merchant_id,
    "return_url" => "http://localhost/shoes/home.php",
    "cancel_url" => "http://localhost/shoes/cart.php",
    "notify_url" => "http://sample.com/notify",
    "order_id" => generateRandomString(),
    "items" => $products,
    "amount" => $total,
    "currency" => "LKR",
    "first_name" => $fname,
    "last_name" => $lname,
    "email" => $user['email'],
    "phone" => $user['email'],
    "address" => $street,
    "city" => $city,
    "country" => "Sri Lanka",
];

// Generate the hash
// $hash = strtoupper(md5($merchant_id . $payment["order_id"] . $payment["amount"] . $payment["currency"] . strtoupper(md5($merchant_secret))));

$hash = strtoupper(
    md5(
        $merchant_id . 
        $payment["order_id"] . 
        number_format($payment["amount"], 2, '.', '') . 
        $payment["currency"] .  
        strtoupper(md5($merchant_secret)) 
    ) 
);

// Add hash to the payment array
$payment["hash"] = $hash;

// Convert PHP array to JSON
echo json_encode($payment);