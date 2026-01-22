<?php

session_start();
require "connection.php";

$id = $_GET['id'];

$array = [];

$city_rs = Database::search("SELECT * FROM city WHERE province_id='".$id."' ORDER BY name ASC ");
$city_n = $city_rs->num_rows;

for ($i=0; $i < $city_n; $i++) { 
    
    $city_data = $city_rs->fetch_assoc();

    $array[] = [
        "id" => $city_data["id"], 
        "name" => $city_data["name"]
    ];
}

echo json_encode($array);