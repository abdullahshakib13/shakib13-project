<div class="card login-form">
    <div class="card-body">
        <h3 class="card-title text-center">Log In</h3>
        <div class="card-text">
            <form method="POST" action="action.php">
                <!-- to error: add class "has-danger" -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <!-- <a href="#" style="float:right;font-size:12px;">Forgot password?</a> -->
                    <input type="password" name="password" class="form-control form-control-sm" id="exampleInputPassword1" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block">Sign in</button>
                
                <div class="sign-up">
                    Don't have an account? <a href="./signup.php">Create One</a>
                </div>
            </form>
        </div>
    </div>
</div>