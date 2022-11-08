<header class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="./index.php">Expense Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- <li class="nav-item active">
                    <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
                </li> -->
            </ul>

            <?php if (!empty($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true){?>
                <form class="form-inline my-2 my-lg-0" action="./action.php" method="POST">
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit" name="logout">Logout</button>
                </form>
            <?php }else{?>
                <form class="form-inline my-2 my-lg-0">
                    <a class="btn btn-outline-success my-2 my-sm-0" href="./index.php">Login</a>
                    <a class="text-light ml-3" href="./signup.php">Signup</a>
                </form>
            <?php }?>
        </div>
    </nav>
</header>