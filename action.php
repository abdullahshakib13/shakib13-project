<?php
require_once "./config/db.php";

if (isset($_POST['signup']))
{
    $name = mysqli_real_escape_string($connection, trim($_POST['name']));
    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
    $password = mysqli_real_escape_string($connection, trim($_POST['password']));
    $confirmPassword = mysqli_real_escape_string($connection, trim($_POST['confirm-password']));

    if (empty($name) || strlen($name) > 50)
    {
        $_SESSION['errMsg'] = "Sorry, name can not be more than 50 character.";
        header("Location: signup.php");
    }

    if (empty($email) || strlen($email) > 150)
    {
        $_SESSION['errMsg'] = "Sorry, email can not be more than 50 character.";
        header("Location: signup.php");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['errMsg'] = "Sorry, email format is not valid.";
        header("Location: signup.php");
    }

    if (empty($password) || strlen($password) < 4 || strlen($confirmPassword) < 4)
    {
        $_SESSION['errMsg'] = "Sorry, password and confirm password cannot be less than 4 characters.";
        header("Location: signup.php");
    }

    if ($password !== $confirmPassword)
    {
        $_SESSION['errMsg'] = "Sorry, password are not matching.";
        header("Location: signup.php");
    }

    $checkSql = "SELECT * FROM `users` WHERE `email` = '".$email."'";
    $execute = mysqli_query($connection, $checkSql);

    if (mysqli_num_rows($execute) > 0) 
    {
        $_SESSION['errMsg'] = "Sorry, the user is already exists.";
        header("Location: signup.php");
    }
    else
    {        
        $password = md5($password);
        $confirmPassword = base64_encode($confirmPassword);

        $insertSql = "INSERT INTO `users` (`name`, `email`, `password`, `salt`) VALUES ('".$name."', '".$email."', '".$password."', '".$confirmPassword."')";
        $executeInsert = mysqli_query($connection, $insertSql);

        if ($executeInsert)
        {
            $_SESSION['succMsg'] = "You have successfully sign up. You can login now.";
            header("Location: index.php");
        }
        else
        {
            $_SESSION['errMsg'] = "Error: " . $connection . "<br>" . mysqli_error($conn);
            header("Location: signup.php");
        }
    }
}

if (isset($_POST['login']))
{
    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
    $password = mysqli_real_escape_string($connection, trim($_POST['password']));

    if (empty($email) || strlen($email) > 150)
    {
        $_SESSION['errMsg'] = "Sorry, email can not be more than 50 character.";
        header("Location: index.php");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['errMsg'] = "Sorry, email format is not valid.";
        header("Location: index.php");
    }

    if (empty($password) || strlen($password) < 4)
    {
        $_SESSION['errMsg'] = "Sorry, password and confirm password cannot be less than 4 characters.";
        header("Location: index.php");
    }

    $checkSql = "SELECT * FROM `users` WHERE `email` = '".$email."'";
    $execute = mysqli_query($connection, $checkSql);

    if (mysqli_num_rows($execute) > 0) 
    {
        $user = mysqli_fetch_assoc($execute);
        
        if ($user['password'] !== md5($password))
        {
            $_SESSION['errMsg'] = "Sorry, your password is not matching!";
            header("Location: index.php");
        }

        $_SESSION['isLoggedIn'] = true;
        $_SESSION['loggedInUser'] = $user;

        $_SESSION['succMsg'] = "Login Successfully!";
        header("Location: index.php");
    }
    else
    {
        $_SESSION['errMsg'] = "Sorry, the user is not found.";
        header("Location: index.php");
    }
}

if (isset($_POST['logout']))
{
    unset($_SESSION);
    session_destroy();
    
    $_SESSION['succMsg'] = "Logout Successfully!";
    header("Location: index.php");
}

if (isset($_POST['expenseOrIncome']))
{
    $exType = mysqli_real_escape_string($connection, trim($_POST['exType']));
    $exDate = mysqli_real_escape_string($connection, trim($_POST['exDate']));
    $exAmount = mysqli_real_escape_string($connection, trim($_POST['exAmount']));
    $userId = $_SESSION['loggedInUser']['id'];

    if (empty($exType) || !in_array($exType, ['EXPENSE', 'INCOME']))
    {
        $_SESSION['errMsg'] = "Invalid expense type";
        header("Location: add.php");
    }

    if (empty($exDate))
    {
        $_SESSION['errMsg'] = "Expense date is required!";
        header("Location: add.php");
    }

    if (empty($exAmount))
    {
        $_SESSION['errMsg'] = "Expense amount is required!";
        header("Location: add.php");
    }

    $insertSql = "INSERT INTO `user_expense_income` (`user_id`, `type`, `amount`, `expense_date`) VALUES ('".$userId."', '".$exType."', '".$exAmount."', '".$exDate."')";
    $executeInsert = mysqli_query($connection, $insertSql);

    if ($executeInsert)
    {
        $_SESSION['succMsg'] = "Expense added successfully.";
        header("Location: index.php");
    }
    else
    {
        $_SESSION['errMsg'] = "Error: " . $connection . "<br>" . mysqli_error($conn);
        header("Location: add.php");
    }
}

if (isset($_POST['updateExpenseOrIncome']))
{
    $exType = mysqli_real_escape_string($connection, trim($_POST['exType']));
    $exDate = mysqli_real_escape_string($connection, trim($_POST['exDate']));
    $exAmount = mysqli_real_escape_string($connection, trim($_POST['exAmount']));
    $id = mysqli_real_escape_string($connection, trim($_POST['trxId']));

    if (empty($exType) || !in_array($exType, ['EXPENSE', 'INCOME']))
    {
        $_SESSION['errMsg'] = "Invalid expense type";
        header("Location: add.php");
    }

    if (empty($exDate))
    {
        $_SESSION['errMsg'] = "Expense date is required!";
        header("Location: add.php");
    }

    if (empty($exAmount))
    {
        $_SESSION['errMsg'] = "Expense amount is required!";
        header("Location: add.php");
    }

    $checkSql = "SELECT * FROM `user_expense_income` WHERE `id` = '".$id."'";
    $execute = mysqli_query($connection, $checkSql);

    if (mysqli_num_rows($execute) > 0) 
    {
        $updateSql = "UPDATE `user_expense_income` SET `type` = '".$exType."', `amount` = '".$exAmount."', `expense_date` = '".$exDate."' WHERE `id` = '".$id."'";
        $executeUpdate = mysqli_query($connection, $updateSql);

        if ($executeUpdate)
        {
            $_SESSION['succMsg'] = "Successfully updated!";
            header("Location: index.php");
        }
        else
        {
            $_SESSION['errMsg'] = "Error to update transaction! Please try again.";
            header("Location: edit.php?id=".$id);
        }
    }
    else
    {
        $_SESSION['errMsg'] = "Error: " . $connection . "<br>" . mysqli_error($conn);
        header("Location: edit.php?id=".$id);
    }
}

if (isset($_GET['delId']) && !empty($_GET['delId']))
{
    $checkSql = "SELECT * FROM `user_expense_income` WHERE `id` = '".$_GET['delId']."'";
    $execute = mysqli_query($connection, $checkSql);
    if (mysqli_num_rows($execute) > 0) 
    {
        $deleteSql = "DELETE FROM `user_expense_income` WHERE `id` = '".$_GET['delId']."'";
        $delExecute = mysqli_query($connection, $deleteSql);

        if ($delExecute)
        {
            $_SESSION['succMsg'] = "Deleted successfully!";
            header("Location: index.php");
        }
        else
        {
            $_SESSION['errMsg'] = "Error to delete transaction!";
            header("Location: index.php");
        }
    }
    else
    {
        $_SESSION['errMsg'] = "Invalid transection requested!";
        header("Location: index.php");
    }
}