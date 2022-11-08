<?php
    require_once "./config/db.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expense Management System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <main class="container-wrapper">
        <?php require_once "./nav.php"; ?>

        <?php if (!empty($_SESSION['errMsg'])){?>
            <div class="container">
                <div class="alert alert-danger mb-3" role="alert">
                    <?=$_SESSION['errMsg'];?>
                </div>
            </div>
        <?php unset($_SESSION['errMsg']); }?>

        <?php if (!empty($_SESSION['succMsg'])){?>
            <div class="container">
                <div class="alert alert-primary mb-3" role="alert">
                    <?=$_SESSION['succMsg'];?>
                </div>
            </div>
        <?php unset($_SESSION['succMsg']); }?>