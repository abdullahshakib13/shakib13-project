<?php 
require_once "./header.php"; 

if (!isset($_SESSION['isLoggedIn']))
{
    $_SESSION['errMsg'] = "Sorry, your are not logged in!";
    header("Location: index.php");
}

if (empty($_GET['id']))
{
    $_SESSION['errMsg'] = "Invalid transection requested!";
    header("Location: index.php");
}

$checkSql = "SELECT * FROM `user_expense_income` WHERE `id` = '".$_GET['id']."'";
$execute = mysqli_query($connection, $checkSql);
if (mysqli_num_rows($execute) > 0) 
{
    $transection = mysqli_fetch_assoc($execute);
}
else
{
    $_SESSION['errMsg'] = "Invalid transection requested!";
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
                        <input type="hidden" name="trxId" value="<?=$transection['id'];?>"/>
                        <div class="form-group">
                            <label for="exType">Type</label>
                            <select class="form-control form-control-sm" name="exType" required>
                                <option value="INCOME" <?=($transection['type'] === "INCOME")?'selected':'';?>>INCOME</option>
                                <option value="EXPENSE" <?=($transection['type'] === "EXPENSE")?'selected':'';?>>EXPENSE</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exDate">Income/Expense Date</label>
                            <input type="date" name="exDate" class="form-control form-control-sm" id="exDate" value="<?=$transection['expense_date'];?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exAmount">Amount</label>
                            <input type="number" name="exAmount" class="form-control form-control-sm" id="exAmount" value="<?=$transection['amount'];?>" required>
                        </div>
                        <button type="submit" name="updateExpenseOrIncome" class="btn btn-primary btn-block">Save</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once "./footer.php"; ?>