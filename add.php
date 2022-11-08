<?php 
require_once "./header.php"; 

if (!isset($_SESSION['isLoggedIn']))
{
    $_SESSION['errMsg'] = "Sorry, your are not logged in!";
    header("Location: index.php");
}
?>
<section class="body container-wrapper">
    <div class="global-container">
        <div class="card login-form">
            <div class="card-body">
                <h3 class="card-title text-center">Add Expense/Income</h3>
                <div class="card-text">
                    <form method="POST" action="action.php">
                        <div class="form-group">
                            <label for="exType">Type</label>
                            <select class="form-control form-control-sm" name="exType" required>
                                <option value="INCOME">INCOME</option>
                                <option value="EXPENSE">EXPENSE</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exDate">Income/Expense Date</label>
                            <input type="date" name="exDate" class="form-control form-control-sm" id="exDate" required>
                        </div>
                        <div class="form-group">
                            <label for="exAmount">Amount</label>
                            <input type="number" name="exAmount" class="form-control form-control-sm" id="exAmount" required>
                        </div>
                        <button type="submit" name="expenseOrIncome" class="btn btn-primary btn-block">Save</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once "./footer.php"; ?>