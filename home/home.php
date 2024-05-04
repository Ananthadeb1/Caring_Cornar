<?php
include('banner.php');
include('connection/db_connection.php');


$sql = 'SELECT * FROM inst';
$result = mysqli_query($conn, $sql);
$institutes = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'options' key exists in $_POST
    if (isset($_POST['options1'])) {
        // Retrieve the selected option value
        if (isset($_POST['options2'])) {
            $selectedOption2 = $_POST['options2'];
            // if($selectedOption2=="free")$cost=0;
            // else $cost =1;
        }
        $selectedOption1 = $_POST['options1'];
        echo "The selected option is: " . $selectedOption1;
        if ($selectedOption1 != 'All') {
                if($selectedOption2=='free'){
                    $sql = "SELECT * FROM inst where inst_type='$selectedOption1' and cost_per_month=0";
                $result = mysqli_query($conn, $sql);
                $institutes = mysqli_fetch_all($result, MYSQLI_ASSOC);
                mysqli_free_result($result);
                }
                else if($selectedOption2=='paid'){
                    $sql = "SELECT * FROM inst where inst_type='$selectedOption1' and cost_per_month!=0";
                $result = mysqli_query($conn, $sql);
                $institutes = mysqli_fetch_all($result, MYSQLI_ASSOC);
                mysqli_free_result($result);
                }
            } 
        else {
            if ($selectedOption2 == 'free') {
                $sql = "SELECT * FROM inst where cost_per_month=0";
                $result = mysqli_query($conn, $sql);
                $institutes = mysqli_fetch_all($result, MYSQLI_ASSOC);
                mysqli_free_result($result);
            }
            else {
                $sql = "SELECT * FROM inst where cost_per_month!=0";
                $result = mysqli_query($conn, $sql);
                $institutes = mysqli_fetch_all($result, MYSQLI_ASSOC);
                mysqli_free_result($result);
            }
        }
    } else {
        $selectedOption1 = 'All';
        echo 'hi' . $selectedOption1;
    }
}
?>


<h1 class="text-center pt-4">Institutes</h1>
<div class="ml-4">
    <p>select institute type</p>


    <form method="post">
        <select name="options1">
            <option value="All">All</option>
            <option value="orphanage">orphanage</option>
            <option value="old_age_home">old_age_home</option>
        </select>
        <select name="options2">
            <option value="any">Any</option>
            <option value="free">Free</option>
            <option value="paid">Paid</option>
        </select>
        <input type="submit" value="submit">
    </form>
</div>
<div class="card-deck pt-4">
    <?php
    foreach ($institutes as $institute) { ?>
        <div class="col-md-4 pt-4">
            <div class="card " style='background-color:skyblue'>
                <img class="card-img-top p-2 " src="https://tribecacare.com/wp-content/uploads/2019/02/fun-activities-in-old-age-home.png" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">
                        Name: <?php echo $institute['inst_name']; ?>
                    </h5>
                    <p class="card-text">Type: <?php echo $institute['inst_type']; ?></p>
                    <p class="card-text">Cost: <?php
                                                if ($institute['cost_per_month'] == 0) echo "Free";
                                                else echo "Paid";
                                                ?></p>
                    <div class="d-flex justify-content-between">
                        <p class="card-text"><small class="text-muted"> Rating: <?php echo $institute['rating']; ?></small></p>

                        <form action="institute_info/institute_info.php" method="POST">
                            <input type="hidden" name="id_for_info" value="<?php echo $institute['inst_id'] ?>">
                            <button class="btn btn-success" name="info" type="submit">info</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>