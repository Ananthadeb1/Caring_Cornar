<?php
    // echo "trying to connect with the server. <br>";

    $serverName ="localhost";
    $userName = "Anantha";
    $password = "12345678";
    $dbName = "assignment";

    $conn = mysqli_connect($serverName, $userName, $password, $dbName);
    if(!$conn){
      echo"connection error:". mysqli_connect_error() ;
    }

?>