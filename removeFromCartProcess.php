<?php

session_start();
require "connection.php";

$id = $_GET["id"];

if($id == "all"){

    Database::iud("DELETE FROM cart WHERE user_id='".$_SESSION["user"]["id"]."' ");
}else{

    Database::iud("DELETE FROM cart WHERE id='".$id."' ");
}


echo "success";