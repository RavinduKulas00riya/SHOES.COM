<?php
require "connection.php";

$fn = $_POST["fn"];
$ln = $_POST["ln"];
$e = $_POST["e"];
$m = $_POST["m"];
$p = $_POST["p"];

$rs = Database::search("SELECT * FROM `user` WHERE `email`='".$e."' OR `mobile`='".$m."'");
$n = $rs->num_rows;

if($n > 0){
    echo ("User with the same Email or Mobile already exists.");
}else{

    Database::iud("INSERT INTO `user` 
    (`fname`,`lname`,`email`,`mobile`,`password`) VALUES 
    ('".$fn."','".$ln."','".$e."','".$m."','".$p."')");

    echo "success";

}

?>