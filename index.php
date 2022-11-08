<?php require_once "./header.php"; ?>
<section class="body container-wrapper">
    <div class="global-container">
        
            <?php if (!empty($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true){?>
                
                <?php include_once "./partials/expenses.php"; ?>

            <?php } else {?>

                <?php include_once "./partials/login.php"; ?>

            <?php }?>

    </div>
</section>

<?php require_once "./footer.php"; ?>