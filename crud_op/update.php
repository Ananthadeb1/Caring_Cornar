<?php
include('../header/header.php');
include('../connection/db_connection.php');
$passPlace = "Enter new password here";


if (isset($_POST["update"])) {
    $id = mysqli_real_escape_string($conn, $_POST['id_to_update']);

    // get the data from the server 
    $sql = "SELECT * FROM users Where id='$id';";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
};

//store the old data to the variables
$upId;
$oldname;
$oldpass;
if (!empty($user))  {
    $upId = $user[0]['id'];
    $oldname=$user[0]['name'];
    $oldpass=$user[0]['pass'];
}
else {
    $upId = 0; 
}

// check the button click
$errors = array('name' => '');

if (isset($_POST['submit'])) {
    $user[0]['name'] = '';
    $user[0]['email'] = '';
    $passPlace = '';

    // input field validation 
    if (empty($_POST['name']) && empty($_POST['password'])) $errors['name'] = "No data found to update.";
}


if (!array_filter($errors)) {
    if (isset($_POST['submit'])) {

        // get the data from input field 
        $id = mysqli_real_escape_string($conn, $_POST['id_old']);
        $name = mysqli_real_escape_string($conn, $_POST['name_old']);
        $pass=mysqli_real_escape_string($conn, $_POST['pass_old']);
        $newName = mysqli_real_escape_string($conn, $_POST['name']);
        $newPass = mysqli_real_escape_string($conn, $_POST['password']);
        
        // checking if the data change or not 
        $upName=$newName;
        $upPass=$newPass;

        if(empty($newName)) $upName=$name;
        if(empty($newPass)) $upPass=$pass;
        
        //update the data to the server 
        $nSql = "UPDATE users SET name = '$upName', pass= '$upPass'
        WHERE id = '$id';";

        if(mysqli_query($conn, $nSql)) {  ?>
        <!-- successful alert  -->
            <div class="alert alert-success" role="alert">
                updated data successfully!
            </div>
        <?php }
        else echo "query error ". mysqli_error($conn);   
    }
}

//close the connection
mysqli_close($conn);
?>


<!-- update section -->
<div class="w-50 mx-auto mt-5 ">
    <h6 class="text-center h1 font-weight-bold">update data!</h6>
    <form action="" method="POST">
        <!-- pass the old values with the post method -->
        <input type="hidden" name="id_old" value="<?php echo $upId; ?>">
        <input type="hidden" name="name_old" value="<?php echo $oldname; ?>">
        <input type="hidden" name="pass_old" value="<?php echo $oldpass; ?>">
        <div class="form-group">
            <label class="h5" for="exampleInputEmail1">Edit Name</label>
            <input type="name" name="name" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $user[0]['name']; ?>">

        </div>
        <div class="form-group">
            <label class="h5" for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $user[0]['email'];   ?>" readonly>
            <div class="text-info"><?php echo "email can't be changed." ?></div>
        </div>
        <div class="form-group">
            <label class="h5" for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="<?php echo $passPlace ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-success" <?php if($upId==0) echo "disabled"?>>update</button> <!-- disable the button to stop the multiple updates -->
        <div class="text-danger"> <?php echo $errors['name'] ?></div>
    </form>
</div>

<?php include('../footer/footer.php');
?>