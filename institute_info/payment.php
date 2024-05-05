<?php include('../header/header.php');
include("../connection/db_connection.php");

$amount=0;
if (isset($_POST["payment"])) {
    $inst_id = mysqli_real_escape_string($conn, $_POST['id_to_payment']);
    $_SESSION['inst_id'] = $inst_id;
};
$i_id = $_SESSION['inst_id'];
$user_id = $_SESSION['id'];

$sql1 = "SELECT * FROM inst WHERE inst_id='$i_id'";
    $result = mysqli_query($conn, $sql1);
    $inst = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);

$amount = $inst[0]['cost_per_month'];
if (isset($_POST['submit'])) {

    //insert data into table
        $sql = "INSERT INTO payment_details(amount,u_id,i_id,payment_type) VALUES('$amount','$user_id','$i_id','payment');";

        //redirect to the people page if successful
        if (mysqli_query($conn, $sql)) { ?>
            <div class="alert alert-success" role="alert">
                Taka payed successfully!
            </div>
<?php
        } else echo "query error " . mysqli_error($conn);
    }


?>

<div class="w-50 mx-auto mt-5 ">
    <h6 class="text-center h1 font-weight-bold">Pay the amount of </h6>
    <form action="" method="POST">
        <div class="form-group">
            <label class="h5" for="exampleInputamount1"><?php echo $inst[0]['cost_per_month'] ?> taka
            </label>
            
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Confirm</button>
    </form>
</div>

<?php include('../footer/footer.php'); ?>