<?php require_once "./header.php"; ?>

<section class="body container-wrapper">
    <div class="global-container">
        <div class="card login-form">
            <div class="card-body">
                <h3 class="card-title text-center">Sign Up</h3>
                <div class="card-text">
                    <!--
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
                    <form method="POST" action="./action.php">
                        <!-- to error: add class "has-danger" -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Email address</label>
                            <input type="email" name="email" class="form-control form-control-sm" id="exampleInputEmail2" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control form-control-sm" id="exampleInputPassword1" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">Confirm Password</label>
                            <input type="password" name="confirm-password" class="form-control form-control-sm" id="exampleInputPassword2" required>
                        </div>
                        <button type="submit" name="signup" class="btn btn-primary btn-block">Sign up</button>
                        
                        <div class="sign-up">
                            Already have account? <a href="./index.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once "./footer.php"; ?>