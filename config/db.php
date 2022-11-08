<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "expense_management";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$connection) 
{
  die("Connection failed: " . mysqli_connect_error());
}