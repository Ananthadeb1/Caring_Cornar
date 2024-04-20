<?php 
include('../header/header.php'); 
include("../connection/db_connection.php");
?>

<?php
$errors = array('name' => '', 'email' => '','role' => '', 'password' => '');

if (isset($_POST['submit'])) {
    $user_mail = $_POST['email'];
    // input field validation 
    if (empty($_POST['name'])) $errors['name'] = "Name should be fulfilled.";
    if (empty($_POST['email'])) $errors['email'] = "email field can't be empty.";
    if (empty($_POST['role'])) $errors['role'] = "role field can't be empty.";
    if (empty($_POST['password'])) $errors['password'] = "pass field can't be empty.";
    $sql = "SELECT * FROM users WHERE email='$user_mail'";
    $result = mysqli_query( $conn,$sql);
    $row = mysqli_num_rows($result);
    if($row!=0) $errors['email'] = "this email is already used.";
}

if (!array_filter($errors)) {
    if (isset($_POST['submit'])) {
        // for make the data safe 
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);


        //insert data into table
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(name,email,role,pass) VALUES('$name','$email','$role','$hash');";

        //redirect to the people page if successful
        if(mysqli_query($conn, $sql)) header('location: http://localhost/assignment_login/');
        else echo "query error ". mysqli_error($conn);
    }
}
?>

<!-- signup section -->
<div class="w-50 mx-auto mt-5 ">
    <h6 class="text-center h1 font-weight-bold">Sign up!</h6>
    <form action="" method="POST">
        <div class="form-group">
            <label class="h5" for="exampleInputEmail1">Name</label>
            <input type="name" name="name" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your full name">
            <div class="text-danger"><?php echo $errors['name'] ?></div>
        </div>
        <div class="form-group">
            <label class="h5" for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <div class="text-danger"><?php echo $errors['email'] ?></div>
        </div>
        <div class="form-group">
            <label class="h5" for="exampleInputRole1">Role</label>
            <input type="role" name="role" class="form-control " id="exampleInputRole1" aria-describedby="role." placeholder="Enter Role">
            <div class="text-danger"><?php echo $errors['role'] ?></div>
        </div>
        <div class="form-group">
            <label class="h5" for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            <div class="text-danger"><?php echo $errors['password'] ?></div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <p class="pt-3">Already have an account? <a href="index.php" name="login">log in</a></p>
    </form>
</div>



<?php include('../footer/footer.php'); ?>