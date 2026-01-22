<?php
require "connection.php";

$data = file_get_contents("php://input");

$cartData = json_decode($data, true);

if ($cartData) {
    foreach ($cartData as $key => $value) {
        
        Database::iud("UPDATE cart SET `qty`='".$value."' WHERE id='".$key."' ");

    }

    echo "success";
} else {
    
    echo "empty";
}
?>