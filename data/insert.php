<?php
$con = mysqli_connect('mysql', 'root', 'MyVery1nsecureP4ssw0rd', 'otravo_test');
$filename = '/var/www/html/data/airports.json';


$data = file_get_contents($filename);
$array = json_decode($data, true);


foreach ($array as $row) {
    $sql = "INSERT INTO wp_airports(code, name, cityCode, countryCode, continentCode, latitude, longitude) VALUES('" . $row["code"] . "', '" . $row["name"] . "', '" . $row["location"]["cityCode"] . "', '" . $row["location"]["countryCode"] . "', '" . $row["location"]["continentCode"] . "', '" . $row["location"]["position"]["latitude"] . "', '" . $row["location"]["position"]["longitude"] . "')";
    mysqli_query($con, $sql);
}
