<?php include('../header/header.php');
include("../connection/db_connection.php");

$errors = array('amoun' => '');

$amount=0;
if (isset($_POST["donation"])) {
    $inst_id = mysqli_real_escape_string($conn, $_POST['id_to_donation']);
    $_SESSION['inst_id'] = $inst_id;
};

$i_id = $_SESSION['inst_id'];
$user_id = $_SESSION['id'];
?>

<?php
if (isset($_POST['submit'])) {
    // input field validation 
    if (empty($_POST['amoun'])) $errors['amount'] = "amount field should be fulfilled.";
}
if (!array_filter($errors)) {
    // for make the data safe 

    $amount = ( $_POST['amount']);

    //insert data into table
    if ($amount != 0) {
        $sql = "INSERT INTO payment_details(amount,u_id,i_id,payment_type) VALUES('$amount','$user_id','$i_id','donation');";

        //redirect to the people page if successful
        if (mysqli_query($conn, $sql)) { ?>
            <div class="alert alert-success" role="alert">
                Taka donated successfully!
            </div>
<?php
        } else echo "query error " . mysqli_error($conn);
    }
}
?>
<div class="w-50 mx-auto mt-5 ">
    <h6 class="text-center h1 font-weight-bold">Donate to help the poor!</h6>
    <form action="" method="POST">
        <div class="form-group">
            <label class="h5" for="exampleInputamount1">Amount</label>
            <input type="amount" name="amount" class="form-control " id="exampleInputamount1" aria-describedby="amountHelp" placeholder="0.00 BDT">
            <div class="text-danger"><?php echo $errors['amoun'] ?></div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Confirm</button>
    </form>
</div>

<?php include('../footer/footer.php'); ?>