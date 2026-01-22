<?php

session_start();
require "connection.php";

$id = $_SESSION['user']['id'];

$cart_rs = Database::search("SELECT * FROM cart WHERE user_id = '".$id."' ");
$cart_n = $cart_rs->num_rows;

$products = [];
$total = 0;

for ($i=0; $i < $cart_n; $i++) { 
    
    $cart_data = $cart_rs->fetch_assoc();
    
}