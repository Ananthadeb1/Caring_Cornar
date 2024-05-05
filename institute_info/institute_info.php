<?php
include('../header/header.php');
include('../connection/db_connection.php');


if (isset($_POST["info"])) {
    $id = mysqli_real_escape_string($conn, $_POST['id_for_info']);

    // get the data from the server 
    $sql = "SELECT * FROM inst Where inst_id='$id'";
    $result = mysqli_query($conn, $sql);
    $institute = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // print_r($institute);
    mysqli_free_result($result);
};
?>

<h1 class="text-center pt-4">Institute`s Information</h1>
<div class="card-deck pt-4">
    <div class=" mx-auto ">
        <div class="card text-center" style='background-color:skyblue'>
            <img class="card-img-top p-2 " src="https://tribecacare.com/wp-content/uploads/2019/02/fun-activities-in-old-age-home.png" alt="Card image cap">
            <div class="card-body">
                <h3 class="card-title">
                    Name: <?php echo $institute[0]['inst_name']; ?>
                </h3>
                <h3 class="d-inline-block">Type: </h3>
                <h5 class="d-inline-block"> <?php echo $institute[0]['inst_type']; ?></h5><br>
                <h3 class="d-inline-block">Total Seats:</h3>
                <h5 class="d-inline-block"> <?php echo $institute[0]['total_seat']; ?></h5><br>
                <h3 class="d-inline-block">Booked Seats: </h3>
                <h5 class="d-inline-block"> <?php echo $institute[0]['booked_seat']; ?></h5><br>
                <h3 class="d-inline-block">Available Seats: </h3>
                <h5 class="d-inline-block"> <?php echo ($institute[0]['total_seat'] - $institute[0]['booked_seat']); ?>
                </h5><br>
                <h3 class="d-inline-block">cost: </h3>
                <h5 class="d-inline-block">
                    <?php
                    if ($institute[0]['cost_per_month'] == 0) echo 'Free';
                    else echo $institute[0]['cost_per_month']; ?></h5><br>
                <h3 class="d-inline-block">About us: </h3>
                <h5 class="d-inline-block"> <?php echo $institute[0]['about_us']; ?></h5><br>
                <div class='d-flex justify-content-between'>
                    <div class="d-flex">

                        <!-- donation  -->
                        <form action="donation.php" method="POST" class="mr-4">
                            <input type="hidden" name="id_to_donation" value="<?php echo $institute[0]['inst_id'] ?>">
                            <button class="btn btn-success " name="donation" type="submit" href="http://localhost/assignment_login/institute_info/donation.php">donation</button>
                        </form>

                        <!-- payment  -->
                        <?php if ($institute[0]['cost_per_month'] != 0) { ?>
                            <form action="payment.php" method="POST">
                                <input type="hidden" name="id_to_payment" value="<?php echo $institute[0]['inst_id'] ?>">
                                <button class="btn btn-success " name="payment" type="submit" href="http://localhost/assignment_login/institute_info/payment.php">payment</button>
                            </form>
                        <?php } ?>
                    </div>
                    <div class="d-flex justify-content-end">
                        <p class="card-text text-muted"> Rating: <?php echo $institute[0]['rating']; ?></p>
                        <a class="btn btn-success ml-4" href="http://localhost/assignment_login/institute_info/main_map.php">location</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("../footer/footer.php") ?>
<!-- <div class='mx-auto'>
     <h1><?php echo $institute[0]['inst_name'] ?></h1>
     <img src="https://tribecacare.com/wp-content/uploads/2019/02/fun-activities-in-old-age-home.png" alt="this is image"> 
</div> -->