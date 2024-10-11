<?php
require "constants.php";


// Connect to the Database

$conn = new mysqli(DB_HOST,USER_NAME,PASSWORD,DB_NAME);

if (mysqli_error($conn)){
    die(mysqli_error($conn));
}