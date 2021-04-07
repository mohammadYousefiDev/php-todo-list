<?php

define('DATABASE', 'php_todo');
define('USERNAME', 'root');
define('PASSWORD', '');

$con = mysqli_connect("localhost", USERNAME, PASSWORD, DATABASE);

if(!$con) {
    echo "Error connecting to MySQL <br>";
    exit;
}
require 'todo.class.php';

$todo = new Todo($con);