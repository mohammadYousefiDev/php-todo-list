<?php

require 'config.php';

$con = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);

if(!$con) {
    echo "Error connecting to MySQL <br>";
    exit;
}