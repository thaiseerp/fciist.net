<?php
$mysqli = new mysqli("localhost", "dbuser", "dbpassword", "db");

$mysqli->query("TRUNCATE TABLE booking_si");
$mysqli->query("TRUNCATE TABLE booking_bf");
$mysqli->query("TRUNCATE TABLE booking_veg");

$mysqli->close();
?>