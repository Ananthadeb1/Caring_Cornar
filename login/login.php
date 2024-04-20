<?php
// $login = false;
include('../connection/db_connection.php');
include('../header/header.php');




$errors = array('email' => '', 'password' => '');
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // fetch data from the server 
    $sql = "SELECT id,email,pass FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    
    
    // user validation 
    if (empty($user)) $errors['email'] = 'no user found please signup first.';
    else if(!password_verify($password,$user[0]['pass']))$errors['password'] = "Wrong password! try again.";

    // input field validation 
    if (empty($_POST['email'])) $errors['email'] = "email field can't be empty.";
    if (empty($_POST['password'])) $errors['password'] = "pass field can't be empty.";
}

// after matching redirect to the peoples page 
if (!array_filter($errors)) {
    $login = true;
    if (isset($_POST['submit'])) {
        header('location: http://localhost/assignment_login/');
    } else if (isset($_POST['signup'])) header('location: signup.php');
}
?>

<!-- login form  -->

<div class="w-50 mx-auto mt-5 ">
    <h6 class="text-center h1 font-weight-bold">log in!</h6>
    <form action="" method="POST">
        <div class="form-group">
            <label class="h5" for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <div class="text-danger"><?php echo $errors['email'] ?></div>
        </div>
        <div class="form-group">
            <label class="h5" for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            <div class="text-danger"><?php echo $errors['password'] ?></div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Login</button>
        <p class="pt-3">don't have an account? <a href="signup.php">sign up</a></p>
    </form>
</div>

<?php
include('../footer/footer.php');
?>