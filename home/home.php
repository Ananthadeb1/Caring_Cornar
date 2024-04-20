<?php
include('banner.php');
include('connection/db_connection.php');
$sql = 'SELECT * FROM inst ';

$result = mysqli_query($conn, $sql);

$institutes = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);



?>


<h1 class="text-center pt-4z">Institutes</h1>

<div class="card-deck pt-4" >
    <?php
    foreach ($institutes as $institute) { ?>
        <div class="col-md-4 pt-4" >
            <div class="card "style='background-color:skyblue'>
                <img class="card-img-top p-2 " src="https://tribecacare.com/wp-content/uploads/2019/02/fun-activities-in-old-age-home.png" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">
                        Name: <?php echo $institute['inst_name']; ?>
                    </h5>
                    <p class="card-text">Type: <?php echo $institute['inst_type']; ?></p>
                    <p class="card-text"><small class="text-muted"> Rating: <?php echo $institute['rating']; ?></small></p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>