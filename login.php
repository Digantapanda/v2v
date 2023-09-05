<?php include_once("connection.php") ;//semi-colon was missing
     session_start();
     ?>
     <?php
    include('connection.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    //$user_type = $_POST['usertype'];

        //to prevent from mysqli injection
        $username = stripcslashes($username);
        $password = stripcslashes($password);
        //$user_type = stripcslashes($user_type);
        $username = mysqli_real_escape_string($con, $username);
        $password = mysqli_real_escape_string($con, $password);
        //$user_type = mysqli_real_escape_string($con, $user_type);

        $sql = "select * from user_details where username = '$username' and password = '$password'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if($count == 1){
            echo "<h1><center> Login successful </center></h1>";
            $_SESSION["login"] = "OK";
            $_SESSION['username']=$username;
            $sql_user_type = "SELECT user_type from user_details where username = '$username'";
            $result_user_type = mysqli_query($con, $sql_user_type);
            while($row = mysqli_fetch_assoc($result_user_type)) {
              $user_type = $row['user_type'];
            }
            header("location: $user_type.php");

          }
        else{
            echo "<h1> Login failed. Invalid username or password.$username,$password</h1>";
        }
?>
