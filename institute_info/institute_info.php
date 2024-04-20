<?php
include('../header/header.php');
include('../connection/db_connection.php');


if (isset($_POST["info"])) {
    $id = mysqli_real_escape_string($conn, $_POST['id_for_info']);

    // get the data from the server 
    $sql = "SELECT * FROM inst Where inst_id='$id'";
    $result = mysqli_query($conn, $sql);
    $institute = mysqli_fetch_all($result, MYSQLI_ASSOC);
    print_r($institute);
    mysqli_free_result($result);
};
?>

<div>
     <?php echo $institute[0]['inst_id'];?> 
</div>
