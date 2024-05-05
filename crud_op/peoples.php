<?php

include('../connection/db_connection.php');

$sql = 'SELECT * FROM users ORDER BY name ASC;';

$result = mysqli_query($conn, $sql);

$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

//delete operation
if (isset($_POST["delete"])) {
    $id = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM users WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo mysqli_error($conn);
    }
    if (!isset($_SESSION['admin'])) {
        session_start();
        session_unset();
        session_destroy();
        header("location: ../index.php");
    }
}
mysqli_close($conn);
?>


<!-- user table  -->

<?php include("../header/header.php");
if (!(isset($_SESSION['name']))) {
    header("Location: ../login/login.php");
}

?>

<h1 class="text-center">users</h1>
<table class="table table-dark table-striped ">
    <thead>
        <tr>
            <th class="col-4 text-center h4">Name</th>
            <th class="col-4 text-center h4">Role</th>
            <th class="col-4 text-center h4">Modify</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        foreach ($users as $user) { ?>
            <tr>
                <td class=" text-center"><?php echo $user['name'] ?></td>
                <td class=" text-center"><?php echo $user['role'] ?></td>
                <th class=" text-center">
                    <div class="d-flex justify-content-center">
                        <?php if ($_SESSION['role'] === 'admin') { ?>
                            <form action="" method="POST">
                                <input type="hidden" name="id_to_delete" value="<?php echo $user['id'] ?>">
                                <button class="btn btn-danger mr-2 " name="delete" type="submit">Delete</button>
                            </form>
                        <?php } else { ?>
                            <?php if ($_SESSION['id'] == $user['id']) { ?>
                                <form action="update.php" method="POST">
                                    <input type="hidden" name="id_to_update" value="<?php echo $user['id'] ?>">
                                    <button class="btn btn-success" name="update" type="submit">update</button>
                                </form>
                                <form class="ml-4" action="" method="POST">
                                    <input type="hidden" name="id_to_delete" value="<?php echo $user['id'] ?>">
                                    <button class="btn btn-danger mr-2 " name="delete" type="submit">Delete</button>
                                </form>
                        <?php }
                        }  ?>
                    </div>
                </th>
            </tr>
        <?php }
        ?>
    </tbody>
</table>

<?php include("../footer/footer.php"); ?>