<div class="card my-4 w-75">
    <div class="card-body">
        <h5 class="card-title">
            Hello 
            <strong><?=$_SESSION['loggedInUser']['name'];?></strong>, 
            Here's your Incomes/Expenses

            <a href="./add.php" class="btn btn-primary btn-sm float-right mt-0">Add Income/Expense</a>
        </h5>
        <div class="card-text">
        <table class="table table-hover">
            <thead class="bg-dark text-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Income/Expense</th>
                    <th scope="col">Income/Expense Date</th>
                    <th scope="col">Entry Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $userId = $_SESSION['loggedInUser']['id'];
                    $transactionSql = "SELECT * FROM `user_expense_income` WHERE `user_id` = '".$userId."'";
                    $execute = mysqli_query($connection, $transactionSql);

                    $totalIncome = [];
                    $totalExpense = [];

                    if (mysqli_num_rows($execute) > 0) {
                        while($row = mysqli_fetch_assoc($execute)) {
                            if ($row['type'] === "INCOME")
                            {
                                $totalIncome[] = $row['amount'];
                            }
                            else
                            {
                                $totalExpense[] = $row['amount'];
                            }
                    ?>
                    <tr>
                        <th scope="row"><?=$row['id'];?></th>
                        <td><?=$row['type'];?></td>
                        <td><?=$row['expense_date'];?></td>
                        <td><?=$row['created_at'];?></td>
                        <td><?='৳'.number_format($row['amount'], 2);?></td>
                        <td>
                            <a class="btn btn-sm btn-dark" href="./edit.php?id=<?=$row['id'];?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="./action.php?delId=<?=$row['id'];?>" onclick="return confirm('Are you sure want to delete the transaction?')">Delete</a>
                        </td>
                    </tr>

                <?php }} else {?>
                    <tr>
                        <td colspan="5" class="text-center">No Data found!</td>
                    </tr>
                <?php }?>
            </tbody>
            <tfoot class="bg-dark text-light">
                <tr>
                    <th colspan="3">#</th>
                    <td class="text-right">
                        Total Incomes
                        <br>
                        Total Expenses
                        <br>
                        <hr>
                        <h5>Current Balance</h5>
                    </td>
                    <th>
                        <?='৳'.number_format(array_sum($totalIncome), 2);?>
                        <br>
                        <?='৳'.number_format(array_sum($totalExpense), 2);?>
                        <br>
                        <hr>
                        <h5><?='৳'.number_format((array_sum($totalIncome) - array_sum($totalExpense)), 2)?></h5>
                    </th>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        </div>
    </div>
</div>