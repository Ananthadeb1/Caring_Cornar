<?php
session_start();
if (isset($_POST["home"])) header('location: index.php');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caring Corner</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body class="">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid ">
            <div>
                <a class=" font-weight-bold h3 text-uppercase" style="color: skyblue" method='POST' type="home" name="home" href="http://localhost/assignment_login/">Caring Corner</a>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
                    <a class="btn btn-outline-primary ml-4" href='http://localhost/assignment_login/admin.php'>Admin Dashboard</a>
                <?php }  ?>
            </div>

            <div class="d-flex">
                <?php if (isset($_SESSION['name'])) { ?>
                    <p class="text-white mr-4 align-middle"><?php echo $_SESSION['name']; ?></p><?php } ?>
                <div>
                    <a class="btn btn-outline-primary mr-4" href='http://localhost/assignment_login/crud_op/peoples.php'>Users</a>
                    <?php
                    if (isset($_SESSION['name'])) { ?>
                        <a class="btn btn-outline-primary" href='http://localhost/assignment_login/login/logout.php'>logout</a>

                    <?php } else { ?>
                        <a class="btn btn-outline-primary" href='http://localhost/assignment_login/login/login.php'>login</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>